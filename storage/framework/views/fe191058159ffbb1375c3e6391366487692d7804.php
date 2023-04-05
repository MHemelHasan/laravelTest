<div class='btn-group btn-group-sm'>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('optionGroups.show')): ?>
        <a data-toggle="tooltip" data-placement="left" title="<?php echo e(trans('lang.view_details')); ?>" href="<?php echo e(route('optionGroups.show', $id)); ?>" class='btn btn-link'>
            <i class="fas fa-eye"></i> </a> <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('optionGroups.edit')): ?>
        <a data-toggle="tooltip" data-placement="left" title="<?php echo e(trans('lang.option_group_edit')); ?>" href="<?php echo e(route('optionGroups.edit', $id)); ?>" class='btn btn-link'>
            <i class="fas fa-edit"></i> </a> <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('optionGroups.destroy')): ?> <?php echo Form::open(['route' => ['optionGroups.destroy', $id], 'method' => 'delete']); ?> <?php echo Form::button('<i class="fas fa-trash"></i>', [ 'type' => 'submit', 'class' => 'btn btn-link text-danger', 'onclick' => "return confirm('Are you sure?')" ]); ?> <?php echo Form::close(); ?> <?php endif; ?>
</div>
<?php /**PATH C:\wamp\www\cleanany\resources\views/option_groups/datatables_actions.blade.php ENDPATH**/ ?>