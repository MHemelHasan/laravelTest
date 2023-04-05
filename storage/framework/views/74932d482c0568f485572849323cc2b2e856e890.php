<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(setting('app_name')); ?> | <?php echo e(setting('app_short_description')); ?></title>
    <link rel="icon" type="image/png" href="<?php echo e($app_logo ?? ''); ?>"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,600&display=fallback">
    <link rel="stylesheet" href="<?php echo e(asset('vendor/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.min.css')); ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <i class="fas fa-exclamation-circle text-danger"></i>
    </div>
    <div class="card shadow-sm">
        <div class="card-body login-card-body text-center">
            <h1 class="error-code display-3 text-danger"><?php echo e($code); ?></h1>
            <p class="my-3"><?php echo $message; ?></p>
        </div>
        <div class="btn-group w-100">
            <a class="btn btn-default w-50 " href="<?php echo e(url()->previous()); ?>"> <i class="fas fa-arrow-circle-left mx-3"></i><?php echo e(trans('error.back')); ?></a>
            <a class="btn btn-default w-50 " href="<?php echo e(route('users.profile')); ?>"> <i class="fas fa-user-circle mx-3"></i><?php echo e(trans('error.back_to_home')); ?></a>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
</body>
</html>

<?php /**PATH C:\wamp\www\cleanany\resources\views/vendor/errors/page.blade.php ENDPATH**/ ?>