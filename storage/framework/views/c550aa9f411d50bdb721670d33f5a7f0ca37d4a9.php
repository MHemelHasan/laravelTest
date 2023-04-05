<?php if($customFields): ?>
    <h5 class="col-12 pb-4"><?php echo trans('lang.main_fields'); ?></h5>
<?php endif; ?>
<div class="d-flex flex-column col-sm-12 col-md-6">
    <!-- Name Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        <?php echo Form::label('name', trans("lang.e_service_name"), ['class' => 'col-md-3 control-label text-md-right mx-1']); ?>

        <div class="col-md-9">
            <?php echo Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.e_service_name_placeholder")]); ?>

            <div class="form-text text-muted">
                <?php echo e(trans("lang.e_service_name_help")); ?>

            </div>
        </div>
    </div>

    <!-- Categories Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row ">
        <?php echo Form::label('categories[]', trans("lang.e_service_categories"),['class' => 'col-md-3 control-label text-md-right mx-1']); ?>

        <div class="col-md-9">
            <?php echo Form::select('categories[]', $category, $categoriesSelected, ['class' => 'select2 form-control not-required' , 'data-empty'=>trans('lang.e_service_categories_placeholder'),'multiple'=>'multiple']); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.e_service_categories_help")); ?></div>
        </div>
    </div>

    <!-- Price Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row ">
        <?php echo Form::label('price', trans("lang.e_service_price"), ['class' => 'col-md-3 control-label text-md-right mx-1']); ?>

        <div class="col-md-9">
            <div class="input-group">
                <?php echo Form::number('price', null, ['class' => 'form-control','step'=>'any', 'min'=>'0', 'placeholder'=> trans("lang.e_service_price_placeholder")]); ?>

                <div class="input-group-append">
                    <div class="input-group-text text-bold px-3"><?php echo e(setting('default_currency','$')); ?></div>
                </div>
            </div>
            <div class="form-text text-muted">
                <?php echo e(trans("lang.e_service_price_help")); ?>

            </div>
        </div>
    </div>

    <!-- Discount Price Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row ">
        <?php echo Form::label('discount_price', trans("lang.e_service_discount_price"), ['class' => 'col-md-3 control-label text-md-right mx-1']); ?>

        <div class="col-md-9">
            <div class="input-group">
                <?php echo Form::number('discount_price', null, ['class' => 'form-control','step'=>'any', 'min'=>'0', 'placeholder'=> trans("lang.e_service_discount_price_placeholder")]); ?>

                <div class="input-group-append">
                    <div class="input-group-text text-bold px-3"><?php echo e(setting('default_currency','$')); ?></div>
                </div>
            </div>
            <div class="form-text text-muted">
                <?php echo e(trans("lang.e_service_discount_price_help")); ?>

            </div>
        </div>
    </div>

    <!-- Price Unit Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row ">
        <?php echo Form::label('price_unit', trans("lang.e_service_price_unit"),['class' => 'col-md-3 control-label text-md-right mx-1']); ?>

        <div class="col-md-9">
            <?php echo Form::select('price_unit', ['hourly' => trans('lang.e_service_price_unit_hourly'),'fixed'=> trans('lang.e_service_price_unit_fixed')], null, ['class' => 'select2 form-control']); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.e_service_price_unit_help")); ?></div>
        </div>
    </div>

    <!-- Quantity Unit Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        <?php echo Form::label('quantity_unit', trans("lang.e_service_quantity_unit"), ['class' => 'col-md-3 control-label text-md-right mx-1']); ?>

        <div class="col-md-9">
            <?php echo Form::text('quantity_unit', null,  ['class' => 'form-control','placeholder'=>  trans("lang.e_service_quantity_unit_placeholder")]); ?>

            <div class="form-text text-muted">
                <?php echo e(trans("lang.e_service_quantity_unit_help")); ?>

            </div>
        </div>
    </div>

    <!-- Duration Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row ">
        <?php echo Form::label('duration', trans("lang.e_service_duration"), ['class' => 'col-md-3 control-label text-md-right mx-1']); ?>

        <div class="col-md-9">
            <div class="input-group timepicker duration" data-target-input="nearest">
                <?php echo Form::text('duration', null,  ['class' => 'form-control datetimepicker-input','placeholder'=>  trans("lang.e_service_duration_placeholder"), 'data-target'=>'.timepicker.duration','data-toggle'=>'datetimepicker','autocomplete'=>'off']); ?>

                <div id="widgetParentId"></div>
                <div class="input-group-append" data-target=".timepicker.duration" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fas fa-business-time"></i></div>
                </div>
            </div>
            <div class="form-text text-muted">
                <?php echo e(trans("lang.e_service_duration_help")); ?>

            </div>
        </div>
    </div>

    <!-- E Provider Id Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row ">
        <?php echo Form::label('user_id', trans("lang.e_service_e_provider_id"),['class' => 'col-md-3 control-label text-md-right mx-1']); ?>

        <div class="col-md-9">
            <?php echo Form::select('user_id', $eProvider, null, ['class' => 'select2 form-control']); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.e_service_e_provider_id_help")); ?></div>
        </div>
    </div>
</div>
<div class="d-flex flex-column col-sm-12 col-md-6">

    <!-- Image Field -->
    <div class="form-group align-items-start d-flex flex-column flex-md-row">
        <?php echo Form::label('image', trans("lang.e_service_image"), ['class' => 'col-md-3 control-label text-md-right mx-1']); ?>

        <div class="col-md-9">
            <div style="width: 100%" class="dropzone image" id="image" data-field="image">
            </div>
            <a href="#loadMediaModal" data-dropzone="image" data-toggle="modal" data-target="#mediaModal" class="btn btn-outline-<?php echo e(setting('theme_color','primary')); ?> btn-sm float-right mt-1"><?php echo e(trans('lang.media_select')); ?></a>
            <div class="form-text text-muted w-50">
                <?php echo e(trans("lang.e_service_image_help")); ?>

            </div>
        </div>
    </div>
    <?php $__env->startPrepend('scripts'); ?>
        <script type="text/javascript">
            var var16110647911349350349ble = [];
            <?php if(isset($eService) && $eService->hasMedia('image')): ?>
            <?php $__currentLoopData = $eService->getMedia('image'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            var16110647911349350349ble.push({
                name: "<?php echo $media->name; ?>",
                size: "<?php echo $media->size; ?>",
                type: "<?php echo $media->mime_type; ?>",
                uuid: "<?php echo $media->getCustomProperty('uuid');; ?>",
                thumb: "<?php echo $media->getUrl('thumb');; ?>",
                collection_name: "<?php echo $media->collection_name; ?>"
            });
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            var dz_var16110647911349350349ble = $(".dropzone.image").dropzone({
                url: "<?php echo url('uploads/store'); ?>",
                addRemoveLinks: true,
                maxFiles: 5 - var16110647911349350349ble.length,
                init: function () {
                    <?php if(isset($eService) && $eService->hasMedia('image')): ?>
                    var16110647911349350349ble.forEach(media => {
                        dzInit(this, media, media.thumb);
                    });
                    <?php endif; ?>
                },
                accept: function (file, done) {
                    dzAccept(file, done, this.element, "<?php echo config('medialibrary.icons_folder'); ?>");
                },
                sending: function (file, xhr, formData) {
                    dzSendingMultiple(this, file, formData, '<?php echo csrf_token(); ?>');
                },
                complete: function (file) {
                    dzCompleteMultiple(this, file);
                    dz_var16110647911349350349ble[0].mockFile = file;
                },
                removedfile: function (file) {
                    dzRemoveFileMultiple(
                        file, var16110647911349350349ble, '<?php echo url("eServices/remove-media"); ?>',
                        'image', '<?php echo isset($eService) ? $eService->id : 0; ?>', '<?php echo url("uploads/clear"); ?>', '<?php echo csrf_token(); ?>'
                    );
                }
            });
            dz_var16110647911349350349ble[0].mockFile = var16110647911349350349ble;
            dropzoneFields['image'] = dz_var16110647911349350349ble;
        </script>
<?php $__env->stopPrepend(); ?>
<!-- Description Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row ">
        <?php echo Form::label('description', trans("lang.e_service_description"), ['class' => 'col-md-3 control-label text-md-right mx-1']); ?>

        <div class="col-md-9">
            <?php echo Form::textarea('description', null, ['class' => 'form-control','placeholder'=>
             trans("lang.e_service_description_placeholder")  ]); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.e_service_description_help")); ?></div>
        </div>
    </div>

</div>
<?php if($customFields): ?>
    <div class="clearfix"></div>
    <div class="col-12 custom-field-container">
        <h5 class="col-12 pb-4"><?php echo trans('lang.custom_field_plural'); ?></h5>
        <?php echo $customFields; ?>

    </div>
<?php endif; ?>
<!-- Submit Field -->
<div class="form-group col-12 d-flex flex-column flex-md-row justify-content-md-end justify-content-sm-center border-top pt-4">
    <div class="d-flex flex-row justify-content-between align-items-center">
        <?php echo Form::label('featured', trans("lang.e_service_featured"),['class' => 'control-label my-0 mx-3']); ?> <?php echo Form::hidden('featured', 0, ['id'=>"hidden_featured"]); ?>

        <span class="icheck-<?php echo e(setting('theme_color')); ?>">
            <?php echo Form::checkbox('featured', 1, null); ?> <label for="featured"></label> </span>
    </div>
    <div class="d-flex flex-row justify-content-between align-items-center">
        <?php echo Form::label('enable_booking', trans("lang.e_service_enable_booking"),['class' => 'control-label my-0 mx-3'], false); ?> <?php echo Form::hidden('enable_booking', 0, ['id'=>"hidden_enable_booking"]); ?>

        <span class="icheck-<?php echo e(setting('theme_color')); ?>">
            <?php echo Form::checkbox('enable_booking', 1, null); ?> <label for="enable_booking"></label> </span>
    </div>
    <div class="d-flex flex-row justify-content-between align-items-center">
        <?php echo Form::label('available', trans("lang.e_service_available"),['class' => 'control-label my-0 mx-3']); ?> <?php echo Form::hidden('available', 0, ['id'=>"hidden_available"]); ?>

        <span class="icheck-<?php echo e(setting('theme_color')); ?>">
            <?php echo Form::checkbox('available', 1, null); ?> <label for="available"></label> </span>
    </div>
    <button type="submit" class="btn bg-<?php echo e(setting('theme_color')); ?> mx-md-3 my-lg-0 my-xl-0 my-md-0 my-2">
        <i class="fa fa-save"></i> <?php echo e(trans('lang.save')); ?> <?php echo e(trans('lang.e_service')); ?></button>
    <a href="<?php echo route('eServices.index'); ?>" class="btn btn-default"><i class="fa fa-undo"></i> <?php echo e(trans('lang.cancel')); ?></a>
</div>
<?php /**PATH C:\wamp\www\cleanany\resources\views/e_services/fields.blade.php ENDPATH**/ ?>