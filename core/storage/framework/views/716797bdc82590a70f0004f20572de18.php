<div class="dashboard-left-content">
    <div class="dashboard-close-main">
        <div class="close-bars"> <i class="las la-times"></i> </div>
        <div class="dashboard-top">
            <div class="dashboard-logo">
                <a href="<?php echo e(route('admin.home')); ?>">
                    <?php if(get_static_option('site_admin_dark_mode') == 'off'): ?>
                        <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                    <?php else: ?>
                        <?php echo render_image_markup_by_attachment_id(get_static_option('site_white_logo')); ?>

                    <?php endif; ?>
                </a>
            </div>
            <div class="dashboard-top-search mt-4">
                <div class="dashboard__bottom__search dashboard-input">
                    <input class="form--control  w-100" type="text" placeholder="Search here..."
                           id="search_sidebarList">
                </div>
            </div>
        </div>
        <div class="dashboard-bottom custom__form mt-4" id="sidbar-menu-wrap">
            <ul class="dashboard-list">
                <li class="<?php echo e(active_menu('admin-home')); ?>">
                    <a href="<?php echo e(route('admin.home')); ?>" aria-expanded="true">
                        <i class="ti-layout-grid2"></i>
                        <span><?php echo app('translator')->get('Dashboard'); ?></span>
                    </a>
                </li>

                <?php if(auth('admin')->user()->hasRole('Super Admin')): ?>
                    <li class="main_dropdown <?php if(request()->is(['admin-home/admin/*'])): ?> active open <?php endif; ?>">
                        <a href="#1" aria-expanded="true"><i class="ti-user"></i>
                            <span><?php echo e(__('Admin Manage')); ?></span>
                        </a>
                        <ul class="collapse">
                            <li class="<?php echo e(active_menu('admin-home/admin/all-user')); ?>">
                                <a href="<?php echo e(route('admin.all.user')); ?>"><?php echo e(__('All Admin')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/admin/new-user')); ?>">
                                <a href="<?php echo e(route('admin.new.user')); ?>"><?php echo e(__('Add New Admin')); ?></a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(auth('admin')->user()->hasRole('Super Admin')): ?>
                    <li class="main_dropdown <?php if(request()->is(['admin-home/roles', 'admin-home/roles/*'])): ?> active open <?php endif; ?>">
                        <a href="#1" aria-expanded="true"><i class="ti-user"></i>
                            <span><?php echo e(__('Manage Role Permission')); ?></span></a>
                        <ul class="collapse">
                            <li class="<?php echo e(active_menu('admin-home/admin/roles')); ?>">
                                <a href="<?php echo e(route('admin.roles.index')); ?>"><?php echo e(__('Roles')); ?></a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['frontend-all-user', 'frontend-new-user', 'frontend-user-update',
                    'frontend-user-password-change', 'frontend-delete-user', 'frontend-all-user-bulk-action',
                    'frontend-all-user-email-status'])): ?>
                    <li class="main_dropdown
                        <?php if(request()->is([
                                'admin-home/frontend/new-user',
                                'admin-home/frontend/all-user',
                                'admin-home/frontend/all-user/role',
                            ])): ?> active open <?php endif; ?> ">
                        <a href="#1" aria-expanded="true"><i class="ti-user"></i>
                            <span><?php echo e(__('Users Manage')); ?></span></a>
                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('frontend-all-user')): ?>
                                <li class="<?php echo e(active_menu('admin-home/frontend/all-user')); ?>">
                                    <a href="<?php echo e(route('admin.all.frontend.user')); ?>">
                                        <?php echo e(__('All Users')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('frontend-new-user')): ?>
                                <li class="<?php echo e(active_menu('admin-home/frontend/new-user')); ?>">
                                    <a href="<?php echo e(route('admin.frontend.new.user')); ?>">
                                        <?php echo e(__('Add New User')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['newsletter', 'newsletter-all'])): ?>
                    <li class="main_dropdown <?php if(request()->is(['admin-home/newsletter/*', 'admin-home/newsletter'])): ?> active open <?php endif; ?> ">
                        <a href="#1" aria-expanded="true"><i class="ti-email"></i>
                            <span><?php echo e(__('Newsletter Manage')); ?></span>
                        </a>
                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('newsletter')): ?>
                                <li class="<?php echo e(active_menu('admin-home/newsletter')); ?>">
                                    <a href="<?php echo e(route('admin.newsletter')); ?>"><?php echo e(__('All Subscriber')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('newsletter-all')): ?>
                                <li class="<?php echo e(active_menu('admin-home/newsletter/all')); ?>">
                                    <a href="<?php echo e(route('admin.newsletter.mail')); ?>"><?php echo e(__('Send Mail To All')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['support-tickets', 'support-ticket-vendor-tickets', 'support-ticket-new',
                    'support-ticket-department', 'support-ticket-page-settings'])): ?>
                    <li
                            class="main_dropdown <?php echo e(active_menu('admin-home/support-tickets')); ?> <?php if(request()->is('admin-home/support-tickets/*')): ?> active open <?php endif; ?>">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-headphone-alt"></i>
                            <span><?php echo e(__('Support Tickets')); ?></span>
                        </a>
                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('support-tickets')): ?>
                                <li class="<?php echo e(active_menu('admin-home/support-tickets')); ?>">
                                    <a href="<?php echo e(route('admin.support.ticket.all')); ?>"><?php echo e(__('All Tickets')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('support-tickets-vendor-tickets')): ?>
                                <li class="<?php echo e(active_menu('admin-home/support-tickets/vendor-tickets')); ?>">
                                    <a
                                            href="<?php echo e(route('admin.support.ticket.all.vendor')); ?>"><?php echo e(__('All Vendors Tickets')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('support-tickets-new')): ?>
                                <li class="<?php echo e(active_menu('admin-home/support-tickets/new')); ?>">
                                    <a href="<?php echo e(route('admin.support.ticket.new')); ?>"><?php echo e(__('Add New Ticket')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('support-tickets-department')): ?>
                                <li class="<?php echo e(active_menu('admin-home/support-tickets/department')); ?>">
                                    <a href="<?php echo e(route('admin.support.ticket.department')); ?>"><?php echo e(__('Departments')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('support-tickets-page-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/support-tickets/page-settings')); ?>">
                                    <a href="<?php echo e(route('admin.support.ticket.page.settings')); ?>"><?php echo e(__('Page Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                
                <?php if(moduleExists('MobileApp')): ?>
                    <?php if(auth('admin')->user()->hasRole('Super Admin')): ?>
                        <li class="main_dropdown <?php if(request()->is(['admin-home/mobile-intro/*', 'admin-home/vendor-intro/*'])): ?> active <?php endif; ?>">
                            <a href="#1" aria-expanded="true"><i class="ti-mobile"></i>
                                <span><?php echo e(__('Mobile Intro Manage')); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/mobile-intro/list')); ?>"><a
                                            href="<?php echo e(route('admin.mobile.intro.all')); ?>"><?php echo e(__('Buyer Intro List')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/mobile-intro/new')); ?>"><a
                                            href="<?php echo e(route('admin.mobile.intro.create')); ?>"><?php echo e(__('Buyer Intro Create')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/vendor-intro/list')); ?>"><a
                                            href="<?php echo e(route('admin.mobile.vendor.intro.all')); ?>"><?php echo e(__('Vendor Intro List')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/vendor-intro/new')); ?>"><a
                                            href="<?php echo e(route('admin.mobile.vendor.intro.create')); ?>"><?php echo e(__('Vendor Intro Create')); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(auth('admin')->user()->hasRole('Super Admin')): ?>
                        <li class="main_dropdown <?php if(request()->is([
                                'admin-home/mobile-slider-two/*',
                                'admin-home/mobile-slider-three/*',
                                'admin-home/mobile-slider/*',
                                'admin-home/mobile-featured-product/*',
                                'admin-home/mobile-campaign/*',
                                'admin-home/mobile-settings/*',
                            ])): ?> active <?php endif; ?>">
                            <a href="#1" aria-expanded="true"><i class="ti-mobile"></i>
                                <span><?php echo e(__('Buyer App Manages')); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/mobile-slider/create')); ?>"><a
                                            href="<?php echo e(route('admin.mobile.slider.create')); ?>"><?php echo e(__('Slider Create')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/mobile-slider/list')); ?>"><a
                                            href="<?php echo e(route('admin.mobile.slider.all')); ?>"><?php echo e(__('Slider List')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/mobile-slider-two/new')); ?>"><a
                                            href="<?php echo e(route('admin.mobile.slider.two.create')); ?>"><?php echo e(__('Slider two Create')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/mobile-slider-two/list')); ?>"><a
                                            href="<?php echo e(route('admin.mobile.slider.two.all')); ?>"><?php echo e(__('Slider two List')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/mobile-slider-three/new')); ?>"><a
                                            href="<?php echo e(route('admin.mobile.slider.three.create')); ?>"><?php echo e(__('Slider three Create')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/mobile-slider-three/list')); ?>"><a
                                            href="<?php echo e(route('admin.mobile.slider.three.all')); ?>"><?php echo e(__('Slider three List')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/mobile-campaign/create')); ?>">
                                    <a
                                            href="<?php echo e(route('admin.mobile.campaign.create')); ?>"><?php echo e(__('Campaign Update')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/mobile-featured-product/new')); ?>">
                                    <a
                                            href="<?php echo e(route('admin.featured.product.create')); ?>"><?php echo e(__('Featured Product Update')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/mobile-settings/terms-and-controller')); ?>">
                                    <a
                                            href="<?php echo e(route('admin.mobile.settings.terms_and_condition')); ?>"><?php echo e(__('Terms and condition page')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/mobile-settings/privacy-policy')); ?>">
                                    <a href="<?php echo e(route('admin.mobile.settings.privacy.policy')); ?>"><?php echo e(__('Privacy and policy page')); ?></a>
                                </li>

                                <?php if(auth('admin')->user()->hasRole('Super Admin')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/mobile-settings/buyer-app-settings')); ?>">
                                        <a href="<?php echo e(route('admin.mobile.settings.buyer-app-settings')); ?>"><?php echo e(__('Buyer App Settings')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(moduleExists('DeliveryMan')): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['delivery-man-zone', 'delivery-man-pickup-point', 'delivery-man-add',
                        'delivery-man-settings', 'delivery-man-wallet-gateway'])): ?>
                        
                        <li class="main_dropdown <?php if(request()->is(['admin-home/delivery-man/*', 'admin-home/delivery-man/pickup-point/*', 'admin-home/delivery-man'])): ?> active open <?php endif; ?> addon-module">
                            <a href="#1" aria-expanded="true">
                                <i class="ti-truck"></i>
                                <span><?php echo e(__('Delivery Man')); ?> 
                                    
                                </span>
                            </a>
                            <ul class="collapse">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delivery-man-pickup-point')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/delivery-man/pickup-point')); ?>">
                                        <a
                                                href="<?php echo e(route('admin.delivery-man.pickup-point.index')); ?>"><?php echo e(__('Pickup Point')); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delivery-man-zone')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/delivery-man/zone')); ?>">
                                        <a href="<?php echo e(route('admin.delivery-man.zone.index')); ?>">
                                            <?php echo e(__('Delivery Man Zone')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delivery-man')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/delivery-man')); ?>">
                                        <a href="<?php echo e(route('admin.delivery-man.index')); ?>">
                                            <?php echo e(__('Delivery Man List')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delivery-man-add')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/delivery-man/add')); ?>">
                                        <a href="<?php echo e(route('admin.delivery-man.add')); ?>">
                                            <?php echo e(__('Create Delivery Man')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delivery-man-settings')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/delivery-man/settings')); ?>">
                                        <a href="<?php echo e(route('admin.delivery-man.settings')); ?>">
                                            <?php echo e(__('Delivery Man Settings')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delivery-man-wallet-gateway')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/delivery-man/wallet/gateway')); ?>">
                                        <a href="<?php echo e(route('admin.delivery-man.wallet.withdraw.gateway')); ?>">
                                            <?php echo e(__('Withdraw Gateway')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(auth('admin')->user()->hasRole('Super Admin')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/delivery-man/update')); ?>">
                                        <a href="<?php echo e(route('admin.delivery-man.license_update')); ?>">
                                            <span><?php echo e(__('Update Plugin')); ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(moduleExists('Wallet')): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['wallet-withdraw-request', 'wallet-vendor-lists', 'wallet-delivery-man-lists',
                        'wallet-customer-lists', 'wallet-history-records', 'wallet-withdraw-gateway',
                        'wallet-settings-update'])): ?>
                        
                        <li class="main_dropdown <?php if(request()->is(['admin-home/wallet/*'])): ?> active open <?php endif; ?> ">
                            <a href="#1" aria-expanded="true"><i class="ti-wallet"></i>
                                <span><?php echo e(__('Wallet')); ?></span></a>
                            <ul class="collapse">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('wallet-withdraw-request')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/wallet/withdraw-request')); ?>">
                                        <a href="<?php echo e(route('admin.wallet.withdraw-request')); ?>"><?php echo e(__('Withdraw Request')); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(moduleExists("DeliveryMan")): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('wallet-delivery-man-withdraw-request')): ?>
                                        <li class="<?php echo e(active_menu('admin-home/wallet/delivery-man-withdraw-request')); ?>">
                                            <a
                                                    href="<?php echo e(route('admin.wallet.delivery-man-withdraw-request')); ?>"><?php echo e(__('Delivery man Withdraw Request')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('wallet-vendor-lists')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/wallet/vendor/lists')); ?>">
                                        <a href="<?php echo e(route('admin.wallet.lists')); ?>"><?php echo e(__('Vendor Wallet List')); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(moduleExists("DeliveryMan")): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('wallet-delivery-man-lists')): ?>
                                        <li class="<?php echo e(active_menu('admin-home/wallet/delivery-man/lists')); ?>">
                                            <a href="<?php echo e(route('admin.wallet.delivery-man.lists')); ?>"><?php echo e(__('Delivery man List')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('wallet-customer-lists')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/wallet/customer/lists')); ?>">
                                        <a href="<?php echo e(route('admin.wallet.customer.lists')); ?>"><?php echo e(__('Customer Wallet List')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('wallet-history-records')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/wallet/history/records')); ?>">
                                        <a href="<?php echo e(route('admin.wallet.history')); ?>"><?php echo e(__('Customer Deposit History')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('wallet-withdraw-gateway')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/wallet/withdraw/gateway')); ?>">
                                        <a href="<?php echo e(route('admin.wallet.withdraw.gateway')); ?>"><?php echo e(__('Wallet Gateway')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('wallet-settings-update')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/wallet/settings/update')); ?>">
                                        <a href="<?php echo e(route('admin.wallet.settings')); ?>"><?php echo e(__('Wallet Settings')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(moduleExists('Refund')): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['refund-request', 'refund-reason', 'refund-preferred-option', 'refund-settings'])): ?>
                        
                        <li class="main_dropdown <?php if(request()->is(['admin-home/refund/*'])): ?> active open <?php endif; ?> ">
                            <a href="#1" aria-expanded="true"><i class="ti-control-backward"></i>
                                <span><?php echo e(__('Refund Manage')); ?>

                                    
                                </span></a>
                            <ul class="collapse">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refund-request')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/refund/request')); ?>">
                                        <a href="<?php echo e(route('admin.refund.request')); ?>"><?php echo e(__('Refund Request')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refund-reason')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/refund/reason')); ?>">
                                        <a href="<?php echo e(route('admin.refund.reason.index')); ?>"><?php echo e(__('Refund Reason')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refund-preferred-option')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/refund/preferred-option')); ?>">
                                        <a
                                                href="<?php echo e(route('admin.refund.preferred-option.index')); ?>"><?php echo e(__('Refund preferred')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refund-settings')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/refund/settings')); ?>">
                                        <a href="<?php echo e(route('admin.refund.settings.index')); ?>"><?php echo e(__('Refund Settings')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(auth('admin')->user()->hasRole('Super Admin')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/refund/update-plugin')); ?>">
                                        <a href="<?php echo e(route('admin.refund.refund_plugin_license_update')); ?>">
                                            <span><?php echo e(__('Update Plugin')); ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(moduleExists('EmailTemplate')): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('email-template-all-templates')): ?>
                        
                        <li class="main_dropdown <?php if(request()->is(['admin-home/email-template/*'])): ?> active open <?php endif; ?> ">
                            <a href="#1" aria-expanded="true"><i class="ti-email"></i>
                                <span><?php echo e(__('Email Template')); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/email-template/all-templates')); ?>">
                                    <a href="<?php echo e(route('admin.email-template.email.template.all')); ?>">
                                        <?php echo e(__('All Email Template')); ?>

                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(moduleExists('Wallet')): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['shop-manage', 'invoice-note'])): ?>
                        
                        <li class="main_dropdown <?php if(request()->is(['admin-home/shop-manage/*', 'admin-home/shop-manage', 'admin-home/invoice-note'])): ?> active open <?php endif; ?> ">
                            <a href="#1" aria-expanded="true"><i class="ti-shopping-cart"></i>
                                <span><?php echo e(__('Shop Manage')); ?></span></a>
                            <ul class="collapse">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shop-manage')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/shop-manage')); ?>">
                                        <a href="<?php echo e(route('admin.shop-manage.update')); ?>"><?php echo e(__('Shop Manage')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('invoice-note')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/invoice-note')); ?>">
                                        <a href="<?php echo e(route('admin.shop-manage.invoice-note')); ?>"><?php echo e(__('Invoice Note')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(moduleExists('Order')): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['assign-delivery-man-orders', 'orders-vendor-list', 'orders', 'orders-sub-order'])): ?>
                        
                        <li class="main_dropdown <?php if(request()->is([
                                'admin-home/orders/*',
                                'admin-home/orders',
                                'admin-home/assign-delivery-man/orders',
                                'admin-home/assign-delivery-man/orders/*',
                            ])): ?> active open <?php endif; ?> ">
                            <a href="#1" aria-expanded="true">
                                <i class="ti-view-list-alt"></i>
                                <span><?php echo e(__('Orders')); ?></span>
                            </a>

                            <ul class="collapse">
                                <?php if(moduleExists('DeliveryMan')): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('assign-delivery-man-orders')): ?>
                                        <li class="<?php echo e(active_menu('admin-home/assign-delivery-man/orders')); ?>">
                                            <a href="<?php echo e(route('admin.assign-delivery-man.orders')); ?>">
                                                <?php echo e(__('Assign Delivery Man')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orders-vendor-list')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/orders/vendor/list')); ?>">
                                        <a href="<?php echo e(route('admin.orders.vendor.list')); ?>">
                                            <?php echo e(__('All vendors')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orders')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/orders')); ?>">
                                        <a href="<?php echo e(route('admin.orders.list')); ?>">
                                            <?php echo e(__('All Orders')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orders-sub-order')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/orders/sub-order')); ?>">
                                        <a href="<?php echo e(route('admin.orders.sub_order.list')); ?>"><?php echo e(__('All Sub Orders')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(moduleExists('Pos')): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['pos-view', 'pos-payment-gateway-settings'])): ?>
                        
                        <li class="main_dropdown <?php if(request()->is(['admin-home/pos/*'])): ?> active open <?php endif; ?> ">
                            <a href="#1" aria-expanded="true">
                                <i class="ti-layout-sidebar-2"></i>
                                <span><?php echo e(__('Pos Manage')); ?> 
                                    
                                </span>
                            </a>

                            <ul class="collapse">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pos-view')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/pos/view')); ?>">
                                        <a href="<?php echo e(route('admin.pos.view')); ?>"><?php echo e(__('Pos Manage')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pos-payment-gateway-settings')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/pos/payment-gateway/settings')); ?>">
                                        <a
                                                href="<?php echo e(route('admin.pos.payment-gateway-settings')); ?>"><?php echo e(__('Pos Settings')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(auth('admin')->user()->hasRole('Super Admin')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/pos/update-plugin')); ?>">
                                        <a href="<?php echo e(route('admin.pos.pos_plugin_license_update')); ?>">
                                            <span><?php echo e(__('Update Plugin')); ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(moduleExists('PluginManage') && auth('admin')->user()->hasRole('Super Admin')): ?>
                    <li class="main_dropdown
                     <?php if(request()->is([
                            'admin-home/plugin-manage',
                            'admin-home/plugin-manage/*',
                        ])): ?> active <?php endif; ?> ">
                        <a href="#1" aria-expanded="true"><i class="ti-clipboard"></i>
                            <span><?php echo e(__('Plugin Manage')); ?></span></a>
                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country')): ?>
                                <li class="<?php echo e(active_menu('admin-home/plugin-manage/all')); ?>">
                                    <a href="<?php echo e(route('admin.plugin.manage.all')); ?>"><?php echo e(__('All Plugin')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('state')): ?>
                                <li class="<?php echo e(active_menu('admin-home/plugin-manage/new')); ?>">
                                    <a href="<?php echo e(route('admin.plugin.manage.new')); ?>"><?php echo e(__('Add New Plugin')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['country', 'state', 'city'])): ?>
                    <li class="main_dropdown <?php if(request()->is([
                            'admin-home/country',
                            'admin-home/country/*',
                            'admin-home/state',
                            'admin-home/state/*',
                            'admin-home/city',
                            'admin-home/city/*',
                        ])): ?> active <?php endif; ?> ">
                        <a href="#1" aria-expanded="true"><i class="ti-clipboard"></i>
                        <span><?php echo e(__('Country Manage')); ?></span></a>
                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country')): ?>
                                <li class="<?php echo e(active_menu('admin-home/country')); ?>">
                                    <a href="<?php echo e(route('admin.country.all')); ?>"><?php echo e(__('Country')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country')): ?>
                                <li class="<?php echo e(active_menu('admin-home/country/csv/import')); ?>">
                                    <a href="<?php echo e(route('admin.country.import.csv.settings')); ?>"><?php echo e(__('Import Country')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('state')): ?>
                                <li class="<?php echo e(active_menu('admin-home/state')); ?>">
                                    <a href="<?php echo e(route('admin.state.all')); ?>"><?php echo e(__('State')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('state')): ?>
                                <li class="<?php echo e(active_menu('admin-home/state/csv/import')); ?>">
                                    <a href="<?php echo e(route('admin.state.import.csv.settings')); ?>"><?php echo e(__('Import State')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('city')): ?>
                                <li class="<?php echo e(active_menu('admin-home/city')); ?>">
                                    <a href="<?php echo e(route('admin.city.all')); ?>"><?php echo e(__('City')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('city')): ?>
                                <li class="<?php echo e(active_menu('admin-home/city/csv/import')); ?>">
                                    <a href="<?php echo e(route('admin.city.import.csv.settings')); ?>"><?php echo e(__('Import City')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['tax-module-settings', 'tax-module-tax-class'])): ?>
                    <li class="main_dropdown <?php if(request()->is(['admin-home/tax/*', 'admin-home/tax-module/*'])): ?> active open <?php endif; ?> ">
                        <a href="#1" aria-expanded="true"><i class="ti-money"></i>
                            <span><?php echo e(__('Tax Settings')); ?></span></a>
                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax-module-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/tax-module/settings')); ?>">
                                    <a href="<?php echo e(route('admin.tax-module.settings')); ?>"><?php echo e(__('Tax Manage Settings')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(get_static_option('tax_system') == 'advance_tax_system'): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax-module-tax-class')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/tax-module/tax-class')); ?>">
                                        <a href="<?php echo e(route('admin.tax-module.tax-class')); ?>"><?php echo e(__('Tax Class')); ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if(get_static_option('tax_system') == 'zone_wise_tax_system'): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax-country')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/tax/country')); ?>">
                                        <a href="<?php echo e(route('admin.tax.country.all')); ?>"><?php echo e(__('Country Tax')); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax-state')): ?>
                                    <li class="<?php echo e(active_menu('admin-home/tax/state')); ?>">
                                        <a href="<?php echo e(route('admin.tax.state.all')); ?>"><?php echo e(__('State Tax')); ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['categories', 'sub-categories', 'child-categories', 'units', 'tags', 'delivery-option',
                    'brand-manage', 'colors', 'sizes', 'attributes', 'badge'])): ?>
                    
                    <li class="main_dropdown <?php if(request()->is([
                                                        'admin-home/categories',
                                                        'admin-home/sub-categories',
                                                        'admin-home/child-categories',
                                                        'admin-home/units',
                                                        'admin-home/tags',
                                                        'admin-home/delivery-option',
                                                        'admin-home/brand-manage',
                                                        'admin-home/brand-manage',
                                                        'admin-home/colors',
                                                        'admin-home/sizes',
                                                        'admin-home/attributes',
                                                    ])): ?> active open <?php endif; ?> ">
                        <a href="#1" aria-expanded="true"><i class="ti-panel"></i>
                            <span><?php echo e(__('Attributes Manage')); ?></span></a>
                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('categories')): ?>
                                <li class="<?php echo e(active_menu('admin-home/categories')); ?>">
                                    <a href="<?php echo e(route('admin.category.all')); ?>"><?php echo e(__('Category')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sub-categories')): ?>
                                <li class="<?php echo e(active_menu('admin-home/sub-categories')); ?>">
                                    <a href="<?php echo e(route('admin.subcategory.all')); ?>"><?php echo e(__('Sub-Category')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('child-categories')): ?>
                                <li class="<?php echo e(active_menu('admin-home/child-categories')); ?>">
                                    <a href="<?php echo e(route('admin.child-category.all')); ?>"><?php echo e(__('Child-Category')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('units')): ?>
                                <li class="<?php echo e(active_menu('admin-home/units')); ?>">
                                    <a href="<?php echo e(route('admin.units.all')); ?>"><?php echo e(__('Units')); ?></a>
                                </li>
                            <?php endif; ?>

                            

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delivery-option')): ?>
                                <li class="<?php echo e(active_menu('admin-home/delivery-option')); ?>">
                                    <a href="<?php echo e(route('admin.delivery.option.all')); ?>"><?php echo e(__('Delivery Options')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brand-manage')): ?>
                                <li class="<?php echo e(active_menu('admin-home/brand-manage')); ?>">
                                    <a href="<?php echo e(route('admin.brand.manage.all')); ?>"><?php echo e(__('Brand Manage')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('colors')): ?>
                                <li class="<?php echo e(active_menu('admin-home/colors')); ?>">
                                    <a href="<?php echo e(route('admin.product.colors.all')); ?>"><?php echo e(__('Color Manage')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sizes')): ?>
                                <li class="<?php echo e(active_menu('admin-home/sizes')); ?>">
                                    <a href="<?php echo e(route('admin.product.sizes.all')); ?>"><?php echo e(__('Size Manage')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('attributes')): ?>
                                <li class="<?php echo e(active_menu('admin-home/attributes')); ?>">
                                    <a href="<?php echo e(route('admin.products.attributes.all')); ?>"> <?php echo e(__('Custom Attribute')); ?> </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('badge')): ?>
                                <li class="<?php echo e(active_menu('admin-home/badge')); ?>">
                                    <a href="<?php echo e(route('admin.badge.all')); ?>"><?php echo e(__('Badge List')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['vendor-index', 'vendor-create', 'vendor-settings', 'vendor-commission-settings'])): ?>
                    
                    <li class="main_dropdown <?php if(request()->is(['admin-home/vendor/*'])): ?> active open <?php endif; ?> ">
                        <a href="#1" aria-expanded="true"><i class="ti-user"></i>
                            <span><?php echo e(__('Vendor Manage')); ?></span></a>
                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-index')): ?>
                                <li class="<?php echo e(active_menu('admin-home/vendor/index')); ?>">
                                    <a href="<?php echo e(route('admin.vendor.all')); ?>"><?php echo e(__('Vendor List')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-create')): ?>
                                <li class="<?php echo e(active_menu('admin-home/vendor/create')); ?>">
                                    <a href="<?php echo e(route('admin.vendor.create')); ?>"><?php echo e(__('Vendor Create')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/vendor/settings')); ?>">
                                    <a href="<?php echo e(route('admin.vendor.settings')); ?>"><?php echo e(__('Vendor Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-commission-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/vendor/commission-settings')); ?>">
                                    <a href="<?php echo e(route('admin.vendor.commission-settings')); ?>"><i
                                                class="las la-cog pl-0"></i><?php echo e(__('Vendor commission')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-inventory')): ?>
                    <li class="<?php echo e(active_menu('admin-home/product-inventory')); ?>">
                        <a href="<?php echo e(route('admin.products.inventory.all')); ?>">
                            <i class="ti-package"></i>
                            <span><?php echo e(__('Inventory')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['coupons', 'coupons-new'])): ?>
                    <li class="<?php if(request()->is(['admin-home/coupons', 'admin-home/coupons/*'])): ?> active open <?php endif; ?>">
                        <a href="<?php echo e(route('admin.products.coupon.all')); ?>" aria-expanded="true">
                            <i class="ti-layout-tab"></i>
                            <span><?php echo e(__('Coupon Manage')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['product-all', 'product-create'])): ?>
                    <li class="main_dropdown <?php if(request()->is(['admin-home/product', 'admin-home/product/*'])): ?> active open <?php endif; ?>">
                        <a href="#1" aria-expanded="true"><i
                                    class="ti-layout-tab"></i><span><?php echo e(__('Product Manage')); ?></span></a>
                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-all')): ?>
                                <li class="<?php echo e(active_menu('admin-home/product/all')); ?>">
                                    <a href="<?php echo e(route('admin.products.all')); ?>"><?php echo e(__('Product List')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-create')): ?>
                                <li class="<?php echo e(active_menu('admin-home/product/create')); ?>">
                                    <a href="<?php echo e(route('admin.products.create')); ?>"><?php echo e(__('Create Product')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('campaigns')): ?>
                    <li class="<?php echo e(active_menu('admin-home/campaigns')); ?>">
                        <a href="<?php echo e(route('admin.campaigns.all')); ?>" aria-expanded="true"><i class="ti-announcement"></i>
                            <span><?php echo e(__('Campaign Manage')); ?></span></a>
                    </li>
                <?php endif; ?>
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['shipping-zone', 'shipping-method'])): ?>
                    <li class="main_dropdown <?php if(request()->is([
                                                        'admin-home/shipping/*',
                                                        'admin-home/shipping-method/*',
                                                        'admin-home/shipping-method',
                                                        'admin-home/shipping',
                                                    ])): ?> open active <?php endif; ?> ">
                        <a href="#1" aria-expanded="true"><i
                                    class="ti-truck"></i><span><?php echo e(__('Shipping Manage')); ?></span></a>
                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shipping-zone')): ?>
                                <li class="<?php echo e(active_menu('admin-home/shipping/zone')); ?>">
                                    <a href="<?php echo e(route('admin.shipping.zone.all')); ?>"><?php echo e(__('Shipping Zones')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shipping-method')): ?>
                                <li class="<?php if(request()->is(['admin-home/shipping-method', 'admin-home/shipping-method/*'])): ?> open active <?php endif; ?>">
                                    <a href="<?php echo e(route('admin.shipping-method.index')); ?>"><?php echo e(__('Shipping Methods')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['blog', 'blog-category', 'blog-new', 'blog-page-settings', 'blog-single-page-settings'])): ?>
                    <li class="main_dropdown <?php if(request()->is(['admin-home/blog/*', 'admin-home/blog'])): ?> active open <?php endif; ?> ">
                        <a href="#1" aria-expanded="true"><i class="ti-write"></i>
                            <span><?php echo e(__('Blogs')); ?></span></a>
                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog')): ?>
                                <li class="<?php echo e(active_menu('admin-home/blog')); ?>"><a
                                            href="<?php echo e(route('admin.blog')); ?>"><?php echo e(__('All Blog')); ?></a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-category')): ?>
                                <li class="<?php echo e(active_menu('admin-home/blog/category')); ?>"><a
                                            href="<?php echo e(route('admin.blog.category')); ?>"><?php echo e(__('Category')); ?></a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-new')): ?>
                                <li class="<?php echo e(active_menu('admin-home/blog/new')); ?>">
                                    <a href="<?php echo e(route('admin.blog.new')); ?>">
                                        <?php echo e(__('Add New Post')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-page-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/blog/page-settings')); ?>"><a
                                            href="<?php echo e(route('admin.blog.page.settings')); ?>"><?php echo e(__('Blog Page Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-single-page-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/blog/single-settings')); ?>"><a
                                            href="<?php echo e(route('admin.blog.single.settings')); ?>"><?php echo e(__('Blog Single Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('faq')): ?>
                    <li class="<?php echo e(active_menu('admin-home/faq')); ?>">
                        <a href="<?php echo e(route('admin.faq')); ?>" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span><?php echo e(__('FAQ')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(moduleExists("Chat")): ?>
                    <li class="main_dropdown <?php if(request()->is(['admin-home/livechat/*'])): ?> open active <?php endif; ?> ">
                        <a href="#1" aria-expanded="true"><i class="ti-write"></i>
                            <span><?php echo e(__('Livechat Module')); ?></span>
                            
                        </a>
                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('livechat-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/livechat/settings')); ?>">
                                    <a href="<?php echo e(route('admin.livechat.settings')); ?>">
                                        <i class="ti-comment-alt"></i>
                                        <span><?php echo e(__('Livechat Settings')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(auth('admin')->user()->hasRole('Super Admin')): ?>
                                <li class="<?php echo e(active_menu('admin-home/livechat/update-plugin')); ?>">
                                    <a href="<?php echo e(route('admin.livechat.chat_plugin_license_update')); ?>">
                                        <span><?php echo e(__('Update Plugin')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['page-all', 'page-new'])): ?>
                    <li class="main_dropdown <?php if(request()->is(['admin-home/page-edit/*', 'admin-home/page/edit/*', 'admin-home/page/all', 'admin-home/page/new'])): ?> open active <?php endif; ?> ">
                        <a href="#1" aria-expanded="true"><i class="ti-write"></i>
                            <span><?php echo e(__('Pages')); ?></span>
                        </a>

                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-all')): ?>
                                <li class="<?php echo e(active_menu('admin-home/page/all')); ?>"><a
                                            href="<?php echo e(route('admin.page')); ?>"><?php echo e(__('All Pages')); ?></a></li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-new')): ?>
                                <li class="<?php echo e(active_menu('admin-home/page/new')); ?>"><a
                                            href="<?php echo e(route('admin.page.new')); ?>"><?php echo e(__('Add New Page')); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['appearance-settings-topbar-all', 'menu', 'category-menu', 'widgets-all',
                    'form-builder-custom-all', 'media-upload-page'])): ?>
                    <li class="main_dropdown
                        <?php if(request()->is([
                                'admin-home/appearance-settings/topbar/*',
                                'admin-home/category-menu/*',
                                'admin-home/category-menu',
                                'admin-home/appearance-settings/navbar/*',
                                'admin-home/appearance-settings/home-variant/*',
                                'admin-home/media-upload/page',
                                'admin-home/menu',
                                'admin-home/menu-edit/*',
                                'admin-home/widgets',
                                'admin-home/widgets/*',
                                'admin-home/popup-builder/*',
                                'admin-home/form-builder/*',
                            ])): ?> active open <?php endif; ?> ">
                        <a href="#1" aria-expanded="true"><i class="ti-stamp"></i>
                            <span><?php echo e(__('Appearance Settings')); ?></span></a>
                        <ul class="collapse ">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(['appearance-settings-topbar-all'])): ?>
                                <li class="<?php echo e(active_menu('admin-home/appearance-settings/topbar/all')); ?>">
                                    <a href="<?php echo e(route('admin.topbar.settings')); ?>" aria-expanded="true">
                                        <?php echo e(__('Topbar Manage')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menu')): ?>
                                <li
                                        class="main_dropdown <?php echo e(active_menu('admin-home/menu')); ?> <?php if(request()->is('admin-home/menu-edit/*')): ?> active open <?php endif; ?> ">
                                    <a href="#1" aria-expanded="true"><?php echo e(__('Menus Manage')); ?></a>
                                    <ul class="collapse">
                                        <li class="<?php echo e(active_menu('admin-home/menu')); ?>">
                                            <a href="<?php echo e(route('admin.menu')); ?>"><?php echo e(__('All Menus')); ?></a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-menu')): ?>
                                <li class="<?php echo e(active_menu('admin-home/category-menu')); ?>">
                                    <a href="<?php echo e(route('admin.category.menu.settings')); ?>" aria-expanded="true">
                                        <?php echo e(__('Category Menu Manage')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('widgets-all')): ?>
                                <li
                                        class="main_dropdown <?php echo e(active_menu('admin-home/widgets/all')); ?> <?php if(request()->is('admin-home/widgets/*')): ?> active open <?php endif; ?> ">
                                    <a href="#1" aria-expanded="true">
                                        <?php echo e(__('Widgets Manage')); ?></a>
                                    <ul class="collapse">
                                        <li class="<?php echo e(active_menu('admin-home/widgets/all')); ?>"><a
                                                    href="<?php echo e(route('admin.widgets')); ?>"><?php echo e(__('All Widgets')); ?></a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('form-builder-custom-all')): ?>
                                <li class="main_dropdown <?php if(request()->is('admin-home/form-builder/*')): ?> active open <?php endif; ?> ">
                                    <a href="#1" aria-expanded="true">
                                        <?php echo e(__('Form Builder')); ?>

                                    </a>
                                    <ul class="collapse">
                                        <li class="<?php echo e(active_menu('admin-home/form-builder/custom/all')); ?>">
                                            <a href="<?php echo e(route('admin.form.builder.all')); ?>"><?php echo e(__('Custom Form')); ?></a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('media-upload-page')): ?>
                                <li class="<?php echo e(active_menu('admin-home/media-upload/page')); ?>">
                                    <a href="<?php echo e(route('admin.upload.media.images.page')); ?>"
                                       class="<?php echo e(active_menu('admin-home/form-builder/custom/all')); ?>">
                                        <?php echo e(__('Media Upload Page')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['page-settings-wishlist', 'page-settings-cart', 'page-settings-checkout', 'page-settings-compare',
                    'page-settings-login-register', 'page-settings-shop-page', 'page-settings-product-page', 'page-all',
                    'page-new', 'page-edit', 'page-update', 'page-delete', 'page-builk-action', 'page-builder-update',
                    'page-builder-new', 'page-builder-delete', 'page-builder-dynamic-page', 'page-builder-update-order',
                    'page-builder-get-admin-markup'])): ?>
                    <li
                            class="main_dropdown
                                                <?php if(request()->is([
                                                        'admin-home/home-page-01/*',
                                                        'admin-home/header',
                                                        'admin-home/keyfeatures',
                                                        'admin-home/about-page/*',
                                                        'admin-home/404-page-manage',
                                                        'admin-home/maintains-page/settings',
                                                        'admin-home/page-builder/home-page',
                                                        'admin-home/page-settings/*',
                                                        'admin-home/page-settings/wishlist',
                                                        'admin-home/page-settings/cart',
                                                        'admin-home/page-settings/compare',
                                                        'admin-home/page-builder/contact-page',
                                                        'admin-home/page-builder/about-page',
                                                        'admin-home/page-builder/faq-page',
                                                    ])): ?> active open <?php endif; ?>">
                        <a href="#1" aria-expanded="true"><i class="ti-settings"></i>
                            <span><?php echo e(__('All Page Settings')); ?></span>
                        </a>
                        <ul class="collapse">
                            <li
                                    class="main_dropdown
                                                            <?php if(request()->is([
                                                                    'admin-home/page-settings/*',
                                                                    'admin-home/page-settings/wishlist',
                                                                    'admin-home/page-settings/cart',
                                                                    'admin-home/page-settings/compare',
                                                                ])): ?> active open <?php endif; ?>
                                                            ">
                                <a href="#1" aria-expanded="true">
                                    <?php echo e(__('Module Page Settings')); ?>

                                </a>
                                <ul class="collapse">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-wishlist')): ?>
                                        <li class="<?php echo e(active_menu('admin-home/page-settings/wishlist')); ?>">
                                            <a href="<?php echo e(route('admin.page.settings.wishlist')); ?>">
                                                <?php echo e(__('Wishlist Page')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-cart')): ?>
                                        <li class="<?php echo e(active_menu('admin-home/page-settings/cart')); ?>">
                                            <a href="<?php echo e(route('admin.page.settings.cart')); ?>">
                                                <?php echo e(__('Cart Page')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-checkout')): ?>
                                        <li class="<?php echo e(active_menu('admin-home/page-settings/checkout')); ?>">
                                            <a href="<?php echo e(route('admin.page.settings.checkout')); ?>">
                                                <?php echo e(__('Checkout Page')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-compare')): ?>
                                        <li class="<?php echo e(active_menu('admin-home/page-settings/compare')); ?>">
                                            <a href="<?php echo e(route('admin.page.settings.compare')); ?>">
                                                <?php echo e(__('Compare Page')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-login-register')): ?>
                                        <li class="<?php echo e(active_menu('admin-home/page-settings/login-register')); ?>">
                                            <a href="<?php echo e(route('admin.page.settings.user.auth')); ?>">
                                                <?php echo e(__('Login/Register Page')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-shop-page')): ?>
                                        <li class="<?php echo e(active_menu('admin-home/page-settings/shop-page')); ?>">
                                            <a href="<?php echo e(route('admin.page.settings.shop.page')); ?>">
                                                <?php echo e(__('Shop Page')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-product-details-page')): ?>
                                        <li class="<?php echo e(active_menu('admin-home/page-settings/product-details-page')); ?>">
                                            <a href="<?php echo e(route('admin.page.settings.product.detail.page')); ?>">
                                                <?php echo e(__('Product Details Page')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-product-details-page')): ?>
                                        <li class="<?php echo e(active_menu('admin-home/page-settings/product-settings-page')); ?>">
                                            <a href="<?php echo e(route('admin.page.settings.product.settings.page')); ?>">
                                                <?php echo e(__('Product Settings')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('404-page-manage')): ?>
                                <li class="<?php echo e(active_menu('admin-home/404-page-manage')); ?>">
                                    <a href="<?php echo e(route('admin.404.page.settings')); ?>" aria-expanded="true">
                                        <?php echo e(__('404 Page Manage')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('maintains-page-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/maintains-page/settings')); ?>">
                                    <a href="<?php echo e(route('admin.maintains.page.settings')); ?>" aria-expanded="true">
                                        <?php echo e(__('Maintain Page Manage')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['shipping-charge-settings', 'general-settings-reading', 'general-settings-global-navbar',
                    'general-settings-site-identity', 'general-settings-basic-settings', 'general-settings-color-settings',
                    'general-settings-typography-settings', 'general-settings-seo-settings', 'general-settings-scripts',
                    'general-settings-email-template', 'general-settings-smtp-settings', 'general-settings-payment-gateway',
                    'general-settings-custom-css', 'general-settings-custom-js', 'general-settings-cache-settings',
                    'general-settings-gdpr-settings', 'general-settings-sitemap-settings', 'general-settings-rss-settings',
                    'general-settings-license-setting'])): ?>
                    <li class="main_dropdown <?php if(request()->is('admin-home/general-settings/*')): ?> active open <?php endif; ?> ">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-new-window"></i>
                            <span><?php echo e(__('General Settings')); ?></span>
                        </a>
                        <ul class="collapse">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shipping-charge-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/shipping-charge-settings')); ?>"><a
                                            href="<?php echo e(route('admin.shipping-charge-settings')); ?>"><?php echo e(__('Shipping Charge Settings')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-reading')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/reading')); ?>"><a
                                            href="<?php echo e(route('admin.general.reading')); ?>"><?php echo e(__('Reading')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-global-navbar')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/global-variant-navbar')); ?>"><a
                                            href="<?php echo e(route('admin.general.global.variant.navbar')); ?>"><?php echo e(__('Navbar Global Variant')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-site-identity')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/site-identity')); ?>"><a
                                            href="<?php echo e(route('admin.general.site.identity')); ?>"><?php echo e(__('Site Identity')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-basic-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/basic-settings')); ?>"><a
                                            href="<?php echo e(route('admin.general.basic.settings')); ?>"><?php echo e(__('Basic Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-color-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/color-settings')); ?>"><a
                                            href="<?php echo e(route('admin.general.color.settings')); ?>"><?php echo e(__('Color Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-typography-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/typography-settings')); ?>"><a
                                            href="<?php echo e(route('admin.general.typography.settings')); ?>"><?php echo e(__('Typography Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-seo-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/seo-settings')); ?>"><a
                                            href="<?php echo e(route('admin.general.seo.settings')); ?>"><?php echo e(__('SEO Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-scripts')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/scripts')); ?>"><a
                                            href="<?php echo e(route('admin.general.scripts.settings')); ?>"><?php echo e(__('Third Party Scripts')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-email-template')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/email-template')); ?>"><a
                                            href="<?php echo e(route('admin.general.email.template')); ?>"><?php echo e(__('Email Template')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-smtp-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/smtp-settings')); ?>"><a
                                            href="<?php echo e(route('admin.general.smtp.settings')); ?>"><?php echo e(__('SMTP Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-payment-gateway')): ?>
                                <?php if(!empty(get_static_option('site_payment_gateway'))): ?>
                                    <li class="<?php echo e(active_menu('admin-home/general-settings/payment-settings')); ?>"><a
                                                href="<?php echo e(route('admin.general.payment.settings')); ?>"><?php echo e(__('Payment Gateway Settings')); ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-custom-css')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/custom-css')); ?>"><a
                                            href="<?php echo e(route('admin.general.custom.css')); ?>"><?php echo e(__('Custom CSS')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-custom-js')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/custom-js')); ?>"><a
                                            href="<?php echo e(route('admin.general.custom.js')); ?>"><?php echo e(__('Custom JS')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-cache-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/cache-settings')); ?>"><a
                                            href="<?php echo e(route('admin.general.cache.settings')); ?>"><?php echo e(__('Cache Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-gdpr-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/gdpr-settings')); ?>"><a
                                            href="<?php echo e(route('admin.general.gdpr.settings')); ?>"><?php echo e(__('GDPR Compliant Cookies Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-sitemap-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/sitemap-settings')); ?>"><a
                                            href="<?php echo e(route('admin.general.sitemap.settings')); ?>"><?php echo e(__('Sitemap Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-rss-settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/rss-settings')); ?>"><a
                                            href="<?php echo e(route('admin.general.rss.feed.settings')); ?>"><?php echo e(__('RSS Feed Settings')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-license-setting')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/license-setting')); ?>"><a
                                    href="<?php echo e(route('admin.general.license.settings')); ?>"><?php echo e(__('Licence Settings')); ?></a>
                                </li>

                                <li class="<?php echo e(active_menu('admin-home/general-settings/software-update-setting')); ?>"><a
                                    href="<?php echo e(route('admin.general.software.update.settings')); ?>"><?php echo e(__('Check update')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-license-setting')): ?>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/database-upgrade')); ?>"><a
                                    href="<?php echo e(route('admin.general.database.upgrade')); ?>"><?php echo e(__('Database update')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('languages')): ?>
                    <li class="<?php if(request()->is('admin-home/languages/*') || request()->is('admin-home/languages')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.languages')); ?>" aria-expanded="true"><i class="ti-signal"></i>
                            <span><?php echo e(__('Languages')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/layouts/backend/sidebar.blade.php ENDPATH**/ ?>