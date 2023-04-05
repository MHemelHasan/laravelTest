<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceProvide extends Model
{
    //
    public $fillable = [
        'name'
    ];

    public function eService()
    {
        return $this->belongsTo(EService::class,'user_id','id');
    }

    public function getService()
    {
        return $this->hasMany(EService::class,'id','service_id');
    }

    public function getProvider($id)
    {
        return $this->belongsTo(EService::class,'id',$id);
    }
}
