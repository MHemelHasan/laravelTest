
<?php $__env->startSection('content'); ?>

    <div class="card-body login-card-body">
        <p class="login-box-msg"><?php echo e(__('auth.login_title')); ?></p>

        <form action="<?php echo e(url('/login')); ?>" method="post">
            <?php echo csrf_field(); ?>


            <div class="input-group mb-3">
                <input value="<?php echo e(old('email')); ?>" type="email" class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" placeholder="<?php echo e(__('auth.email')); ?>" aria-label="<?php echo e(__('auth.email')); ?>">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <?php if($errors->has('email')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('email')); ?>

                    </div>
                <?php endif; ?>
            </div>

            <div class="input-group mb-3">
                <input value="<?php echo e(old('password')); ?>" type="password" class="form-control  <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" placeholder="<?php echo e(__('auth.password')); ?>" aria-label="<?php echo e(__('auth.password')); ?>">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <?php if($errors->has('password')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('password')); ?>

                    </div>
                <?php endif; ?>
            </div>

            <div class="row mb-2">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember" name="remember"> <label for="remember">
                            <?php echo e(__('auth.remember_me')); ?>

                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('auth.login')); ?></button>
                </div>
            </div>

            <?php if(config('installer.demo_app')): ?>
                <div class="my-4">
                    <div class="col-12 card card-outline card-primary">
                        <div class="card-body">
                            <div class="text-bold">Admin</div>
                            <small>User: admin@demo.com | Password: 123456</small>
                            <div class="text-bold mt-3">Provider</div>
                            <small>User: provider@demo.com | Password: 123456</small>
                            <div class="text-bold mt-3">Customer</div>
                            <small>User: customer@demo.com | Password: 123456</small>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </form>

        <?php if(setting('enable_facebook',false) || setting('enable_google',false) || setting('enable_twitter',false)): ?>
            <div class="social-auth-links text-center mb-3">
                <p style="text-transform: uppercase">- <?php echo e(__('lang.or')); ?> -</p>
                <?php if(setting('enable_facebook',false)): ?>
                    <a href="<?php echo e(url('login/facebook')); ?>" class="btn btn-block btn-facebook"> <i class="fab fa-facebook mr-2"></i> <?php echo e(__('auth.login_facebook')); ?>

                    </a>
                <?php endif; ?>
                <?php if(setting('enable_google',false)): ?>
                    <a href="<?php echo e(url('login/google')); ?>" class="btn btn-block btn-google"> <i class="fab fa-google mr-2"></i> <?php echo e(__('auth.login_google')); ?>

                    </a>
                <?php endif; ?>
                <?php if(setting('enable_twitter',false)): ?>
                    <a href="<?php echo e(url('login/twitter')); ?>" class="btn btn-block btn-twitter"> <i class="fab fa-twitter mr-2"></i> <?php echo e(__('auth.login_twitter')); ?>

                    </a>
                <?php endif; ?>
            </div>
            <!-- /.social-auth-links -->
        <?php endif; ?>

        <p class="mb-1 text-center">
            <a href="<?php echo e(url('/password/reset')); ?>"><?php echo e(__('auth.forgot_password')); ?></a>
        </p>
        <p class="mb-0 text-center">
            <a href="<?php echo e(url('/register')); ?>" class="text-center"><?php echo e(__('auth.register_new_member')); ?></a>
        </p>
    </div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.auth.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\cleanany\resources\views/auth/login.blade.php ENDPATH**/ ?>