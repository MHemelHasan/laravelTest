<?php
/*
 * File name: User.php
 * Last modified: 2021.06.28 at 23:44:43
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2021
 */

namespace App\Models;

use App\Casts\EProviderCast;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Permission\Traits\HasRoles;
use Nwidart\Modules\Facades\Module;
use Nwidart\Modules\Exceptions\ModuleNotFoundException;
use Spatie\OpeningHours\OpeningHours;

/**
 * Class User
 * @package App\Models
 * @version July 10, 2018, 11:44 am UTC
 *
 * @property int id
 * @property string name
 * @property string email
 * @property string phone_number
 * @property string phone_verified_at
 * @property string password
 * @property string api_token
 * @property string device_token
 */
class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use Billable;
    use HasMediaTrait {
        getFirstMediaUrl as protected getFirstMediaUrlTrait;
    }
    use HasRoles;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255|unique:users',
        'phone_number' => 'required|max:255|unique:users',
        'mobile_number' => 'max:50',
        // 'availability_range' => 'required|numeric|max:9999999.99|min:0.01',
        'password' => 'required',
    ];

    public $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'name',
        'email',
        'phone_number',
        'phone_verified_at',
        'password',
        'api_token',
        'device_token',
        'description',
        'mobile_number',
        'availability_range',
        'available',
        'featured',
        'accepted',
        'types'
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'phone_number' => 'string',
        'password' => 'string',
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'api_token' => 'string',
        'device_token' => 'string',
        'remember_token' => 'string',
        'description' => 'string',
        'mobile_number' => 'string',
        'availability_range' => 'double',
        'available' => 'boolean',
        'featured' => 'boolean',
        'accepted' => 'boolean'
    ];
    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields',
        'has_media',
        'rate',
        'available',
        'total_reviews',
        'has_valid_subscription'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Route notifications for the FCM channel.
     *
     * @param \Illuminate\Notifications\Notification $notification
     * @return string|null
     */
    public function routeNotificationForFcm(\Illuminate\Notifications\Notification $notification): ?string
    {
        return $this->device_token;
    }

    /**
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(\Spatie\MediaLibrary\Models\Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 200, 200)
            ->sharpen(10);

        $this->addMediaConversion('icon')
            ->fit(Manipulations::FIT_CROP, 100, 100)
            ->sharpen(10);
    }

    /**
     * to generate media url in case of fallback will
     * return the file type icon
     * @param string $conversion
     * @return string url
     */
    public function getFirstMediaUrl($collectionName = 'default', $conversion = '')
    {
        $url = $this->getFirstMediaUrlTrait($collectionName);
        if ($url) {
            $array = explode('.', $url);
            $extension = strtolower(end($array));
            if (in_array($extension, config('medialibrary.extensions_has_thumb'))) {
                return asset($this->getFirstMediaUrlTrait($collectionName, $conversion));
            } else {
                return asset(config('medialibrary.icons_folder') . '/' . $extension . '.png');
            }
        } else {
            return asset('images/avatar_default.png');
        }
    }

    public function getCustomFieldsAttribute()
    {
        $hasCustomField = in_array(static::class, setting('custom_field_models', []));
        if (!$hasCustomField) {
            return [];
        }
        $array = $this->customFieldsValues()
            ->join('custom_fields', 'custom_fields.id', '=', 'custom_field_values.custom_field_id')
            ->select(['value', 'view', 'name'])
            ->get()->toArray();

        return convertToAssoc($array, 'name');
    }

    public function customFieldsValues(): MorphMany
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
    }

    /**
     * Add Media to api results
     * @return bool
     */
    public function getHasMediaAttribute(): bool
    {
        return $this->hasMedia('avatar');
    }

    /**
     * @return BelongsToMany
     **/
    public function eProviders(): BelongsToMany
    {
        return $this->belongsToMany(EProvider::class, 'e_provider_users');
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'e_provider_addresses');
    }

    public function taxes()
    {
        return $this->belongsToMany(Tax::class, 'e_provider_taxes');
    }

    public function availabilityHours(): HasMany
    {
        return $this->hasMany(AvailabilityHour::class, 'user_id')->orderBy('start_at');
    }

    public function getRateAttribute(): float
    {
        return (float)$this->eProviderReviews()->avg('rate');
    }

    public function eProviderReviews()
    {
        return $this->hasManyThrough(EServiceReview::class, EService::class);
    }

    public function getAvailableAttribute(): bool
    {
        return $this->attributes['available']; // this is just test purpose only though i did not know the features of opening hour .
        // return $this->accepted && $this->attributes['available'] && $this->openingHours()->isOpen();
    }

    public function getTotalReviewsAttribute(): float
    {
        return (int)$this->eProviderReviews()->count();
    }

    public function getHasValidSubscriptionAttribute(): ?bool
    {
        if (!Module::isActivated('Subscription')) {
            return null;
        }
        $result = $this->eProviderSubscriptions
            ->where('expires_at', '>', now())
            ->where('starts_at', '<=', now())
            ->where('active', '=', 1)
            ->count();
        return $result > 0;
    }

    public function discountables()
    {
        return $this->morphMany('App\Models\Discountable', 'discountable');
    }

    public function openingHours(): OpeningHours
    {
        $openingHoursArray = [];
        foreach ($this->availabilityHours as $element) {
            $openingHoursArray[$element['day']] = [
                'data' => $element['data'],
                $element['start_at'] . '-' . $element['end_at']
            ];
        }
        return OpeningHours::createAndMergeOverlappingRanges($openingHoursArray);
    }

    public function weekCalendarRange(Carbon $date): array
    {
        $period = CarbonPeriod::since($date->subDay()->ceilDay()->subMinutes(30))->minutes(30)->until($date->addDay()->ceilDay()->subMinutes(60));
        $dates = [];
        // Iterate over the period
        foreach ($period as $key => $d) {
            $firstDate = $d->locale('en')->toDateTime();
            $secondDate = $d->locale('en')->addMinutes(30)->toDateTime();
            $isOpen = $this->openingHours()->isOpenAt($firstDate) || $this->openingHours()->isOpenAt($secondDate);
            $times = [$d->locale('en')->toIso8601String()];
            $times[] = $d->locale('en')->addMinutes(30)->toIso8601String();
            $dates[] = [$times, $isOpen];
        }
        return $dates;
    }

    public function weekCalendar(Carbon $date): array
    {
        $period = CarbonPeriod::since($date->subDay()->ceilDay())->minutes(15)->until($date->addDay()->ceilDay()->subMinutes(15));
        $dates = [];
        // Iterate over the period
        foreach ($period as $key => $d) {
            $firstDate = $d->locale('en')->toDateTime();
            $isOpen = $this->openingHours()->isOpenAt($firstDate);
            $times = $d->locale('en')->toIso8601String();
            $dates[] = [$times, $isOpen];
        }
        return $dates;
    }

    public function awards()
    {
        return $this->hasMany(Award::class, 'user_id');
    }
    
    public function experiences()
    {
        return $this->hasMany(Experience::class, 'user_id');
    }

    public function eProviderSubscriptions(): HasMany
    {
        if (Module::isActivated('Subscription'))
            return $this->hasMany('Modules\Subscription\Models\EProviderSubscription', 'e_provider_id');
        else
            throw new ModuleNotFoundException();

    }

    public function eServices()
    {
        return $this->hasMany(EService::class, 'user_id');
    }

    /**
     * @return HasMany
     **/
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'user_id');
    }

    public function services()
    {
        return $this->belongsToMany(EService::class, 'service_provides', 'user_id', 'e_service_id');
    }

    public static function castUsing()
    {
        return EProviderCast::class;
    }
}