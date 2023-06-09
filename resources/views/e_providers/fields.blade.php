@if($customFields)
    <h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div class="d-flex flex-column col-sm-12 col-md-6">
    <!-- Image Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('avatar', trans("lang.user_avatar"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            <div style="width: 100%" class="dropzone avatar" id="avatar" data-field="avatar">
                <input type="hidden" name="avatar">
            </div>
            <a href="#loadMediaModal" data-dropzone="avatar" data-toggle="modal" data-target="#mediaModal" class="btn btn-outline-{{setting('theme_color','primary')}} btn-sm float-right mt-1">{{ trans('lang.media_select')}}</a>
            <div class="form-text text-muted w-50">
                {{ trans("lang.user_avatar_help") }}
            </div>
        </div>
    </div>
    @prepend('scripts')
    <script type="text/javascript">
        var user_avatar = '';
        @if(isset($provider) && $provider->hasMedia('avatar'))
            user_avatar = {
            name: "{!! $provider->getFirstMedia('avatar')->name !!}",
            size: "{!! $provider->getFirstMedia('avatar')->size !!}",
            type: "{!! $provider->getFirstMedia('avatar')->mime_type !!}",
            collection_name: "{!! $provider->getFirstMedia('avatar')->collection_name !!}"
        };
                @endif
        var dz_user_avatar = $(".dropzone.avatar").dropzone({
                url: "{!!url('uploads/store')!!}",
                addRemoveLinks: true,
                maxFiles: 1,
                init: function () {
                    @if(isset($provider) && $provider->hasMedia('avatar'))
                    dzInit(this, user_avatar, '{!! url($provider->getFirstMediaUrl('avatar','thumb')) !!}')
                    @endif
                },
                accept: function (file, done) {
                    dzAccept(file, done, this.element, "{!!config('medialibrary.icons_folder')!!}");
                },
                sending: function (file, xhr, formData) {
                    dzSending(this, file, formData, '{!! csrf_token() !!}');
                },
                maxfilesexceeded: function (file) {
                    dz_user_avatar[0].mockFile = '';
                    dzMaxfile(this, file);
                },
                complete: function (file) {
                    dzComplete(this, file, user_avatar, dz_user_avatar[0].mockFile);
                    dz_user_avatar[0].mockFile = file;
                },
                removedfile: function (file) {
                    dzRemoveFile(
                        file, user_avatar, '{!! url("users/remove-media") !!}',
                        'avatar', '{!! isset($provider) ? $provider->id : 0 !!}', '{!! url("uplaods/clear") !!}', '{!! csrf_token() !!}'
                    );
                }
        });
        dz_user_avatar[0].mockFile = user_avatar;
        dropzoneFields['avatar'] = dz_user_avatar;
    </script>
    @endprepend

<!-- Name Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('name', trans("lang.e_provider_name"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.e_provider_name_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.e_provider_name_help") }}
            </div>
        </div>
    </div>

    <!-- Description Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('description', trans("lang.e_provider_description"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::textarea('description', null, ['class' => 'form-control','placeholder'=>
             trans("lang.e_provider_description_placeholder")  ]) !!}
            <div class="form-text text-muted">{{ trans("lang.e_provider_description_help") }}</div>
        </div>
    </div>

</div>
<div class="d-flex flex-column col-sm-12 col-md-6">

    <!-- Email Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('email', 'email', ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::email('email', null,  ['class' => 'form-control','placeholder'=>  "Insert email"]) !!}
            <div class="form-text text-muted">
                {{ "Insert email" }}
            </div>
        </div>
    </div>

    <!-- Phone Number Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('phone_number', trans("lang.e_provider_phone_number"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('phone_number', null,  ['class' => 'form-control','placeholder'=>  trans("lang.e_provider_phone_number_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.e_provider_phone_number_help") }}
            </div>
        </div>
    </div>
    <!-- Mobile Number Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('mobile_number', trans("lang.e_provider_mobile_number"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::text('mobile_number', null,  ['class' => 'form-control','placeholder'=>  trans("lang.e_provider_mobile_number_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.e_provider_mobile_number_help") }}
            </div>
        </div>
    </div>

    <!-- Addresses Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('addresses[]', trans("lang.e_provider_addresses"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::select('addresses[]', $address, $addressesSelected, ['class' => 'select2 form-control' , 'multiple'=>'multiple']) !!}
            <div class="form-text text-muted">
                {{ trans("lang.e_provider_addresses_help") }}
                @can('addresses.create')
                    <a href="{{route('addresses.create')}}" class="text-success float-right">{{__('lang.address_create')}}</a>
                @endcan
            </div>
        </div>
    </div>

    <!-- Taxes Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('taxes[]', trans("lang.e_provider_taxes"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::select('taxes[]', $tax, $taxesSelected, ['class' => 'select2 form-control' , 'multiple'=>'multiple']) !!}
            <div class="form-text text-muted">{{ trans("lang.e_provider_taxes_help") }}</div>
        </div>
    </div>

    <!-- Availability Range Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row ">
        {!! Form::label('availability_range', trans("lang.e_provider_availability_range"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            <div class="input-group">
                {!! Form::number('availability_range', null, ['class' => 'form-control','step'=>'any', 'min'=>'0', 'placeholder'=> trans("lang.e_provider_availability_range_placeholder")]) !!}
                <div class="input-group-append">
                    <div class="input-group-text text-bold px-3">{{trans("lang.app_setting_".setting('distance_unit','mi'))}}</div>
                </div>
            </div>
            <div class="form-text text-muted">
                {{ trans("lang.e_provider_availability_range_help") }}
            </div>
        </div>
    </div>

</div>
@if($customFields)
    <div class="clearfix"></div>
    <div class="col-12 custom-field-container">
        <h5 class="col-12 pb-4">{!! trans('lang.custom_field_plural') !!}</h5>
        {!! $customFields !!}
    </div>
@endif
<!-- Submit Field -->
<div class="form-group col-12 d-flex flex-column flex-md-row justify-content-md-end justify-content-sm-center border-top pt-4">
    @role('admin')
    <div class="d-flex flex-row justify-content-between align-items-center">
        {!! Form::label('accepted', trans("lang.e_provider_accepted"),['class' => 'control-label my-0 mx-3']) !!} {!! Form::hidden('accepted', 0, ['id'=>"hidden_accepted"]) !!}
        <span class="icheck-{{setting('theme_color')}}">
            {!! Form::checkbox('accepted', 1, null) !!} <label for="accepted"></label> </span>
    </div>
    @endrole
    <div class="d-flex flex-row justify-content-between align-items-center">
        {!! Form::label('available', trans("lang.e_provider_available"),['class' => 'control-label my-0 mx-3']) !!} {!! Form::hidden('available', 0, ['id'=>"hidden_available"]) !!}
        <span class="icheck-{{setting('theme_color')}}">
            {!! Form::checkbox('available', 1, null) !!} <label for="available"></label> </span>
    </div>
    <div class="d-flex flex-row justify-content-between align-items-center">
        {!! Form::label('featured', trans("lang.e_provider_featured"),['class' => 'control-label my-0 mx-3']) !!} {!! Form::hidden('featured', 0, ['id'=>"hidden_featured"]) !!}
        <span class="icheck-{{setting('theme_color')}}">
            {!! Form::checkbox('featured', 1, null) !!} <label for="featured"></label> </span>
    </div>
    <button type="submit" class="btn bg-{{setting('theme_color')}} mx-md-3 my-lg-0 my-xl-0 my-md-0 my-2">
        <i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.e_provider')}}</button>
    <a href="{!! route('eProviders.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
