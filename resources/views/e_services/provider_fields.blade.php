<div class="form-group align-items-baseline d-flex flex-column flex-md-row ">
        {!! Form::label('service[]', 'Service',['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {!! Form::select('services[]', $service, $serviceSelected, ['class' => 'select2 form-control not-required' , 'data-empty'=>'Insert Services','multiple'=>'multiple']) !!}
            <div class="form-text text-muted">Insert Services</div>
        </div>
    </div>

    <!-- Submit Field -->
<div class="form-group col-12 d-flex flex-column flex-md-row justify-content-md-end justify-content-sm-center border-top pt-4">
    <button type="submit" class="btn bg-{{setting('theme_color')}} mx-md-3 my-lg-0 my-xl-0 my-md-0 my-2">
        <i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.e_service')}}</button>
    <a href="{!! route('eServices.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
