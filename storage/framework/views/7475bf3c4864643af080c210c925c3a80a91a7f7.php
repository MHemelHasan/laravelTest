<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dashboard')): ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('dashboard*') ? 'active' : ''); ?>" href="<?php echo url('dashboard'); ?>"><?php if($icons): ?>
                <i class="nav-icon fas fa-tachometer-alt"></i><?php endif; ?>
            <p><?php echo e(trans('lang.dashboard')); ?></p></a>
    </li>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('modules.index')): ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('modules*') ? 'active' : ''); ?>" href="<?php echo route('modules.index'); ?>"><?php if($icons): ?>
                <i class="nav-icon fas fa-th-large"></i><?php endif; ?>
            <p><?php echo e(trans('lang.module_plural')); ?> <?php if(config('installer.demo_app')): ?> <span class="right badge badge-danger">New</span> <?php endif; ?></p></a>
    </li>
<?php endif; ?>
<?php if(!Module::isActivated('Subscription')): ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notifications.index')): ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('notifications*') ? 'active' : ''); ?>" href="<?php echo route('notifications.index'); ?>"><?php if($icons): ?>
                <i class="nav-icon fas fa-bell"></i><?php endif; ?><p><?php echo e(trans('lang.notification_plural')); ?></p></a>
    </li>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('favorites.index')): ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('favorites*') ? 'active' : ''); ?>" href="<?php echo route('favorites.index'); ?>"><?php if($icons): ?>
                <i class="nav-icon fas fa-heart"></i><?php endif; ?><p><?php echo e(trans('lang.favorite_plural')); ?></p></a>
    </li>
<?php endif; ?>
<?php endif; ?>
<li class="nav-header"><?php echo e(trans('lang.app_management')); ?></li>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('eProviders.index')): ?>
    <li class="nav-item has-treeview <?php echo e((Request::is('eProvider*') || Request::is('requestedEProviders*') || Request::is('galleries*') || Request::is('experiences*') || Request::is('awards*') || Request::is('addresses*') || Request::is('availabilityHours*') ) && !Request::is('eProviderPayouts*') ? 'menu-open' : ''); ?>">
        <a href="#" class="nav-link <?php echo e((Request::is('eProvider*') || Request::is('requestedEProviders*') || Request::is('galleries*') || Request::is('experiences*') || Request::is('awards*') || Request::is('addresses*') || Request::is('availabilityHours*')) && !Request::is('eProviderPayouts*') ? 'active' : ''); ?>"> <?php if($icons): ?>
                <i class="nav-icon fas fa-users-cog"></i><?php endif; ?>
            <p><?php echo e(trans('lang.e_provider_plural')); ?> <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('eProviderTypes.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('eProviderTypes*') ? 'active' : ''); ?>" href="<?php echo route('eProviderTypes.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-list-alt"></i><?php endif; ?><p><?php echo e(trans('lang.e_provider_type_plural')); ?></p></a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('eProviders*') ? 'active' : ''); ?>" href="<?php echo route('eProviders.index'); ?>"><?php if($icons): ?>
                        <i class="nav-icon fas fa-list-alt"></i><?php endif; ?><p><?php echo e(trans('lang.e_provider_plural')); ?></p></a>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('requestedEProviders.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('requestedEProviders*') ? 'active' : ''); ?>" href="<?php echo route('requestedEProviders.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-list-alt"></i><?php endif; ?><p><?php echo e(trans('lang.requested_e_providers_plural')); ?></p></a>
                </li>
            <?php endif; ?>
            <?php if(Module::isActivated('EProviderDocuments')): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documents.index')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('documents*') ? 'active' : ''); ?>" href="<?php echo route('documents.index'); ?>"><?php if($icons): ?>
                                <i class="nav-icon fa fa-file"></i><?php endif; ?><p><?php echo e(trans('eproviderdocuments::lang.documents_plural')); ?></p></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('galleries.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('galleries*') ? 'active' : ''); ?>" href="<?php echo route('galleries.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-image"></i><?php endif; ?><p><?php echo e(trans('lang.gallery_plural')); ?></p></a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('awards.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('awards*') ? 'active' : ''); ?>" href="<?php echo route('awards.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-trophy"></i><?php endif; ?><p><?php echo e(trans('lang.award_plural')); ?></p></a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('experiences.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('experiences*') ? 'active' : ''); ?>" href="<?php echo route('experiences.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-briefcase"></i><?php endif; ?><p><?php echo e(trans('lang.experience_plural')); ?></p></a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('availabilityHours.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('availabilityHours*') ? 'active' : ''); ?>" href="<?php echo route('availabilityHours.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-business-time"></i><?php endif; ?><p><?php echo e(trans('lang.availability_hour_plural')); ?></p></a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('addresses.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('addresses*') ? 'active' : ''); ?>" href="<?php echo route('addresses.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-map-marked-alt"></i><?php endif; ?><p><?php echo e(trans('lang.address_plural')); ?></p></a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('categories.index')): ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('categories*') ? 'active' : ''); ?>" href="<?php echo route('categories.index'); ?>"><?php if($icons): ?>
                <i class="nav-icon fas fa-folder-open"></i><?php endif; ?><p><?php echo e(trans('lang.category_plural')); ?></p></a>
    </li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('eServices.index')): ?>
    <li class="nav-item has-treeview <?php echo e(Request::is('eServices*') || Request::is('options*') || Request::is('optionGroups*') || Request::is('eServiceReviews*') || Request::is('nutrition*') ? 'menu-open' : ''); ?>">
        <a href="#" class="nav-link <?php echo e(Request::is('eServices*') || Request::is('options*') || Request::is('optionGroups*') || Request::is('eServiceReviews*') || Request::is('nutrition*') ? 'active' : ''); ?>"> <?php if($icons): ?>
                <i class="nav-icon fas fa-pencil-ruler"></i><?php endif; ?>
            <p><?php echo e(trans('lang.e_service_plural')); ?> <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('eServices.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('eServices*') ? 'active' : ''); ?>" href="<?php echo route('eServices.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-list"></i><?php endif; ?>
                        <p><?php echo e(trans('lang.e_service_table')); ?></p></a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('optionGroups.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('optionGroups*') ? 'active' : ''); ?>" href="<?php echo route('optionGroups.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-plus-square"></i><?php endif; ?><p><?php echo e(trans('lang.option_group_plural')); ?></p></a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('options.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('options*') ? 'active' : ''); ?>" href="<?php echo route('options.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon far fa-plus-square"></i><?php endif; ?><p><?php echo e(trans('lang.option_plural')); ?></p></a>
                </li>
            <?php endif; ?>


            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('eServiceReviews.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('eServiceReviews*') ? 'active' : ''); ?>" href="<?php echo route('eServiceReviews.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-comments"></i><?php endif; ?><p><?php echo e(trans('lang.e_service_review_plural')); ?></p></a>
                </li>
            <?php endif; ?>

        </ul>
    </li>
<?php endif; ?>


<li class="nav-item has-treeview <?php echo e(Request::is('bookings*') || Request::is('bookingStatuses*') || Request::is('deliveryAddresses*')? 'menu-open' : ''); ?>">
    <a href="#" class="nav-link <?php echo e(Request::is('bookings*') || Request::is('bookingStatuses*') || Request::is('deliveryAddresses*')? 'active' : ''); ?>"> <?php if($icons): ?>
            <i class="nav-icon fas fa-calendar-check"></i><?php endif; ?>
        <p><?php echo e(trans('lang.booking_plural')); ?> <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bookings.index')): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('bookings*') ? 'active' : ''); ?>" href="<?php echo route('bookings.index'); ?>"><?php if($icons): ?>
                        <i class="nav-icon fas fa-calendar-check"></i><?php endif; ?><p><?php echo e(trans('lang.booking_plural')); ?></p></a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bookingStatuses.index')): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('bookingStatuses*') ? 'active' : ''); ?>" href="<?php echo route('bookingStatuses.index'); ?>"><?php if($icons): ?>
                        <i class="nav-icon fas fa-server"></i><?php endif; ?><p><?php echo e(trans('lang.booking_status_plural')); ?></p></a>
            </li>
        <?php endif; ?>

        
        
        
        
        
        

    </ul>
</li>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('coupons.index')): ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('coupons*') ? 'active' : ''); ?>" href="<?php echo route('coupons.index'); ?>"><?php if($icons): ?>
                <i class="nav-icon fas fa-ticket-alt"></i><?php endif; ?><p><?php echo e(trans('lang.coupon_plural')); ?> </p></a>
    </li>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('faqs.index')): ?>
    <li class="nav-item <?php echo e(Request::is('faqCategories*') || Request::is('faqs*') ? 'menu-open' : ''); ?>">
        <a href="#" class="nav-link <?php echo e(Request::is('faqs*') || Request::is('faqCategories*') ? 'active' : ''); ?>"> <?php if($icons): ?>
                <i class="nav-icon fas fa-question-circle"></i><?php endif; ?>
            <p><?php echo e(trans('lang.faq_plural')); ?> <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('faqCategories.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('faqCategories*') ? 'active' : ''); ?>" href="<?php echo route('faqCategories.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-folder-open"></i><?php endif; ?><p><?php echo e(trans('lang.faq_category_plural')); ?></p></a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('faqs.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('faqs*') ? 'active' : ''); ?>" href="<?php echo route('faqs.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-life-ring"></i><?php endif; ?>
                        <p><?php echo e(trans('lang.faq_plural')); ?></p></a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
<?php if(Module::isActivated('Subscription')): ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('subscriptionPackages.index')): ?>
<li class="nav-header"><?php echo e(trans('subscription::lang.subscriptions')); ?></li>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('subscriptionPackages.index')): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('subscriptionPackages*') ? 'active' : ''); ?>" href="<?php echo route('subscriptionPackages.index'); ?>"><?php if($icons): ?>
                    <i class="nav-icon fa fa-th-list"></i><?php endif; ?><p><?php echo e(trans('subscription::lang.subscription_package_plural')); ?><?php if(config('installer.demo_app')): ?> <span class="right badge badge-danger">Addon</span> <?php endif; ?></p></a>
        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('eProviderSubscriptions.index')): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('eProviderSubscriptions*') ? 'active' : ''); ?>" href="<?php echo route('eProviderSubscriptions.index'); ?>"><?php if($icons): ?>
                    <i class="nav-icon fa fa-address-card"></i><?php endif; ?><p><?php echo e(trans('subscription::lang.e_provider_subscription_plural')); ?><?php if(config('installer.demo_app')): ?> <span class="right badge badge-danger">Addon</span> <?php endif; ?></p></a>
        </li>
    <?php endif; ?>
<?php endif; ?>
<li class="nav-header"><?php echo e(trans('lang.payment_plural')); ?></li>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payments.index')): ?>
    <li class="nav-item has-treeview <?php echo e(Request::is('payments*') || Request::is('paymentMethods*') || Request::is('paymentStatuses*')|| Request::is('eProviderPayouts*') ? 'menu-open' : ''); ?>">
        <a href="#" class="nav-link <?php echo e(Request::is('payments*') || Request::is('paymentMethods*') || Request::is('paymentStatuses*')|| Request::is('eProviderPayouts*') ? 'active' : ''); ?>"> <?php if($icons): ?>
                <i class="nav-icon fas fa-money-check-alt"></i><?php endif; ?>
            <p><?php echo e(trans('lang.payment_plural')); ?><i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payments.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('payments*') ? 'active' : ''); ?>" href="<?php echo route('payments.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-money-check-alt"></i><?php endif; ?><p><?php echo e(trans('lang.payment_table')); ?></p></a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('paymentMethods.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('paymentMethods*') ? 'active' : ''); ?>" href="<?php echo route('paymentMethods.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-credit-card"></i><?php endif; ?><p><?php echo e(trans('lang.payment_method_plural')); ?></p></a>
                </li>
            <?php endif; ?>


            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('paymentStatuses.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('paymentStatuses*') ? 'active' : ''); ?>" href="<?php echo route('paymentStatuses.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-file-invoice-dollar"></i><?php endif; ?><p><?php echo e(trans('lang.payment_status_plural')); ?></p></a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('eProviderPayouts.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('eProviderPayouts*') ? 'active' : ''); ?>" href="<?php echo route('eProviderPayouts.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-money-bill-wave"></i><?php endif; ?><p><?php echo e(trans('lang.e_provider_payout_plural')); ?></p></a>
                </li>
            <?php endif; ?>

        </ul>
    </li>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('wallets.index')): ?>
    <li class="nav-item has-treeview <?php echo e(Request::is('wallet*') ? 'menu-open' : ''); ?>">
        <a href="#" class="nav-link <?php echo e(Request::is('wallet*') ? 'active' : ''); ?>"> <?php if($icons): ?>
                <i class="nav-icon fas fa-wallet"></i><?php endif; ?>
            <p><?php echo e(trans('lang.wallet_plural')); ?><i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('wallets*') ? 'active' : ''); ?>" href="<?php echo route('wallets.index'); ?>"><?php if($icons): ?>
                        <i class="nav-icon fa fa-wallet"></i><?php endif; ?><p><?php echo e(trans('lang.wallet_table')); ?></p></a>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('walletTransactions.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('walletTransactions*') ? 'active' : ''); ?>" href="<?php echo route('walletTransactions.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fa fa-list-alt"></i><?php endif; ?><p><?php echo e(trans('lang.wallet_transaction_plural')); ?></p></a>
                </li>
            <?php endif; ?>

        </ul>
    </li>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('earnings.index')): ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('earnings*') ? 'active' : ''); ?>" href="<?php echo route('earnings.index'); ?>"><?php if($icons): ?>
                <i class="nav-icon fas fa-money-bill"></i><?php endif; ?><p><?php echo e(trans('lang.earning_plural')); ?>  </p></a>
    </li>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('app-settings')): ?>
<li class="nav-header"><?php echo e(trans('lang.app_setting')); ?></li>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('medias')): ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('medias*') ? 'active' : ''); ?>" href="<?php echo url('medias'); ?>"><?php if($icons): ?>
                <i class="nav-icon fas fa-photo-video"></i><?php endif; ?>
            <p><?php echo e(trans('lang.media_plural')); ?></p></a>
    </li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('app-settings')): ?>
    <li class="nav-item has-treeview <?php echo e(Request::is('settings/mobile*') || Request::is('slides*') || Request::is('customPages*') ? 'menu-open' : ''); ?>">
        <a href="#" class="nav-link <?php echo e(Request::is('settings/mobile*') || Request::is('slides*') || Request::is('customPages*') ? 'active' : ''); ?>">
            <?php if($icons): ?><i class="nav-icon fas fa-mobile-alt"></i><?php endif; ?>
            <p>
                <?php echo e(trans('lang.mobile_menu')); ?>

                <i class="right fas fa-angle-left"></i>
            </p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?php echo url('settings/mobile/globals'); ?>" class="nav-link <?php echo e(Request::is('settings/mobile/globals*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fas fa-cog"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_globals')); ?>

                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/mobile/colors'); ?>" class="nav-link <?php echo e(Request::is('settings/mobile/colors*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fas fa-magic"></i> <?php endif; ?> <p><?php echo e(trans('lang.mobile_colors')); ?>

                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/mobile/authentication'); ?>" class="nav-link <?php echo e(Request::is('settings/mobile/authentication*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fas fa-comment-alt"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_authentication')); ?>

                    </p>
                </a>
            </li>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customPages.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('customPages*') ? 'active' : ''); ?>" href="<?php echo route('customPages.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fa fa-file"></i><?php endif; ?><p><?php echo e(trans('lang.custom_page_plural')); ?></p></a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('slides.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('slides*') ? 'active' : ''); ?>" href="<?php echo route('slides.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-images"></i><?php endif; ?><p><?php echo e(trans('lang.slide_plural')); ?> </p>
                    </a>
                </li>
            <?php endif; ?>
        </ul>

    </li>
    <li class="nav-item has-treeview <?php echo e((Request::is('settings*') ||
     Request::is('users*')) && !Request::is('settings/mobile*')
        ? 'menu-open' : ''); ?>">
        <a href="#" class="nav-link <?php echo e((Request::is('settings*') ||
         Request::is('users*')) && !Request::is('settings/mobile*')
          ? 'active' : ''); ?>"> <?php if($icons): ?><i class="nav-icon fas fa-cogs"></i><?php endif; ?>
            <p><?php echo e(trans('lang.app_setting')); ?> <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?php echo url('settings/app/globals'); ?>" class="nav-link <?php echo e(Request::is('settings/app/globals*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fas fa-cog"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_globals')); ?></p>
                </a>
            </li>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('users*') ? 'active' : ''); ?>" href="<?php echo route('users.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-users"></i><?php endif; ?>
                        <p><?php echo e(trans('lang.user_plural')); ?></p></a>
                </li>
            <?php endif; ?>

            <li class="nav-item has-treeview <?php echo e(Request::is('settings/permissions*') || Request::is('settings/roles*') ? 'menu-open' : ''); ?>">
                <a href="#" class="nav-link <?php echo e(Request::is('settings/permissions*') || Request::is('settings/roles*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fas fa-user-secret"></i><?php endif; ?>
                    <p>
                        <?php echo e(trans('lang.permission_menu')); ?>

                        <i class="right fas fa-angle-left"></i>
                    </p></a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('settings/permissions') ? 'active' : ''); ?>" href="<?php echo route('permissions.index'); ?>">
                            <?php if($icons): ?><i class="nav-icon fas fa-circle-o"></i><?php endif; ?>
                            <p><?php echo e(trans('lang.permission_table')); ?></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('settings/permissions/create') ? 'active' : ''); ?>" href="<?php echo route('permissions.create'); ?>">
                            <?php if($icons): ?><i class="nav-icon fas fa-circle-o"></i><?php endif; ?>
                            <p><?php echo e(trans('lang.permission_create')); ?></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('settings/roles') ? 'active' : ''); ?>" href="<?php echo route('roles.index'); ?>">
                            <?php if($icons): ?><i class="nav-icon fas fa-circle-o"></i><?php endif; ?>
                            <p><?php echo e(trans('lang.role_table')); ?></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('settings/roles/create') ? 'active' : ''); ?>" href="<?php echo route('roles.create'); ?>">
                            <?php if($icons): ?><i class="nav-icon fas fa-circle-o"></i><?php endif; ?>
                            <p><?php echo e(trans('lang.role_create')); ?></p>
                        </a>
                    </li>
                </ul>

            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('settings/customFields*') ? 'active' : ''); ?>" href="<?php echo route('customFields.index'); ?>"><?php if($icons): ?>
                        <i class="nav-icon fas fa-list"></i><?php endif; ?><p><?php echo e(trans('lang.custom_field_plural')); ?></p></a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/app/localisation'); ?>" class="nav-link <?php echo e(Request::is('settings/app/localisation*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fas fa-language"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_localisation')); ?></p></a>
            </li>
            <li class="nav-item">
                <a href="<?php echo url('settings/translation/en'); ?>" class="nav-link <?php echo e(Request::is('settings/translation*') ? 'active' : ''); ?>">
                    <?php if($icons): ?> <i class="nav-icon fas fa-language"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_translation')); ?></p></a>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('currencies.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('settings/currencies*') ? 'active' : ''); ?>" href="<?php echo route('currencies.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-dollar-sign"></i><?php endif; ?><p><?php echo e(trans('lang.currency_plural')); ?></p></a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('taxes.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('settings/taxes*') ? 'active' : ''); ?>" href="<?php echo route('taxes.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fas fa-coins"></i><?php endif; ?>
                        <p><?php echo e(trans('lang.tax_plural')); ?></p></a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a href="<?php echo url('settings/payment/payment'); ?>" class="nav-link <?php echo e(Request::is('settings/payment*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fas fa-credit-card"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_payment')); ?></p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/app/social'); ?>" class="nav-link <?php echo e(Request::is('settings/app/social*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fas fa-globe"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_social')); ?></p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/app/notifications'); ?>" class="nav-link <?php echo e(Request::is('settings/app/notifications*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fas fa-bell"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_notifications')); ?></p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/mail/smtp'); ?>" class="nav-link <?php echo e(Request::is('settings/mail*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fas fa-envelope"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_mail')); ?></p>
                </a>
            </li>

        </ul>
    </li>
<?php endif; ?>

<?php /**PATH C:\wamp\www\cleanany\resources\views/layouts/menu.blade.php ENDPATH**/ ?>