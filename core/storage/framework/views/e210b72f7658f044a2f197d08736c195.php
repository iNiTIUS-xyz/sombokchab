<div class="dashboard-left-content">
    <div class="dashboard-close-main">
        <div class="close-bars"> <i class="las la-times"></i> </div>
        <div class="dashboard-top">
            <div class="dashboard-logo">
                <a href="<?php echo e(route('vendor.home')); ?>">
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
                <li class="list active">
                    <a href="<?php echo e(route('vendor.home')); ?>">
                        <i class="ti-view-grid"></i> <?php echo e(__('Dashboard')); ?>

                    </a>
                </li>
                <li class="list">
                    <a href="<?php echo e(route('vendor.profile.update')); ?>">
                        <i class="ti-user"></i> <?php echo e(__('Profile')); ?>

                    </a>
                </li>

                
                <li class="<?php echo e(active_menu('vendor-home/product-inventory')); ?>">
                    <a href="<?php echo e(route('vendor.products.inventory.all')); ?>">
                        <i class="ti-package"></i>
                        <span><?php echo e(__('Inventory')); ?></span>
                    </a>
                </li>

                <?php if(moduleExists("Chat")): ?>
                    
                    <li class="<?php echo e(active_menu('vendor-home/chat')); ?>">
                        <a href="<?php echo e(route('vendor.chat.home')); ?>">
                            <i class="ti-comment-alt"></i>
                            <span><?php echo e(__('Chat Module')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <li class="main_dropdown <?php if(request()->is(['vendor-home/wallet', 'vendor-home/wallet/*'])): ?> active open <?php endif; ?>">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-wallet"></i> <span><?php echo e(__('Wallet Module')); ?>

                        </span>
                    </a>

                    <ul class="collapse">
                        
                        <li class="<?php echo e(active_menu('vendor-home/wallet')); ?>">
                            <a href="<?php echo e(route('vendor.wallet.home')); ?>">
                                <span><?php echo e(__('Wallet')); ?></span>
                            </a>
                        </li>
                        
                        <li class="<?php echo e(active_menu('vendor-home/wallet/gateway')); ?>">
                            <a href="<?php echo e(route('vendor.wallet.withdraw.gateway.index')); ?>">
                                <span><?php echo e(__('Wallet settings')); ?></span>
                            </a>
                        </li>
                        
                        <li class="<?php echo e(active_menu('vendor-home/wallet/withdraw')); ?>">
                            <a href="<?php echo e(route('vendor.wallet.withdraw')); ?>">
                                <span><?php echo e(__('Withdraw')); ?></span>
                            </a>
                        </li>
                        
                        <li class="<?php echo e(active_menu('vendor-home/wallet/withdraw-request')); ?>">
                            <a href="<?php echo e(route('vendor.wallet.withdraw-request')); ?>">
                                <span><?php echo e(__('Withdraw request')); ?></span>
                            </a>
                        </li>
                        
                        <li class="<?php echo e(active_menu('vendor-home/wallet/history')); ?>">
                            <a href="<?php echo e(route('vendor.wallet.history')); ?>">
                                <span><?php echo e(__('History')); ?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                
                <li class="<?php echo e(active_menu('vendor-home/shipping-method')); ?>">
                    <a href="<?php echo e(route('vendor.shipping-method.index')); ?>">
                        <i class="ti-money"></i>
                        <span><?php echo e(__('Shipping Method')); ?></span>
                    </a>
                </li>

                
                <li class="main_dropdown <?php if(request()->is(['vendor-home/product', 'vendor-home/product/*'])): ?> active open <?php endif; ?>">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-layout-tab"></i> <span><?php echo e(__('Product Module')); ?>

                        </span>
                    </a>

                    <ul class="collapse">
                        <li class="<?php echo e(active_menu('vendor-home/product/all')); ?>">
                            <a href="<?php echo e(route('vendor.products.all')); ?>"><?php echo e(__('Product List')); ?></a>
                        </li>

                        <li class="<?php echo e(active_menu('vendor-home/product/create')); ?>">
                            <a href="<?php echo e(route('vendor.products.create')); ?>"><?php echo e(__('Create Product')); ?></a>
                        </li>
                    </ul>
                </li>

                
                <li class="main_dropdown <?php if(request()->is(['vendor-home/orders', 'vendor-home/orders/*'])): ?> active open <?php endif; ?>">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-view-list-alt"></i>
                        <span><?php echo e(__('Order Module')); ?></span>
                    </a>

                    <ul class="collapse">
                        <li class="<?php echo e(active_menu('vendor-home/orders')); ?>">
                            <a href="<?php echo e(route('vendor.orders.list')); ?>"><?php echo e(__('Order List')); ?></a>
                        </li>
                    </ul>
                </li>

                
                <li class="<?php echo e(active_menu('vendor-home/campaigns')); ?>">
                    <a href="<?php echo e(route('vendor.campaigns.all')); ?>">
                        <i class="ti-announcement"></i>
                        <span><?php echo e(__('Campaign Module')); ?></span>
                    </a>
                </li>

                <li
                        class="main_dropdown <?php echo e(active_menu('vendor-home/support-tickets')); ?> <?php if(request()->is('vendor-home/support-tickets/*')): ?> active open <?php endif; ?>">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-headphone-alt"></i>
                        <span><?php echo e(__('Support Tickets')); ?></span>
                    </a>
                    <ul class="collapse">
                        <li class="<?php echo e(active_menu('admin-home/support-tickets')); ?>">
                            <a href="<?php echo e(route('vendor.support.ticket.all')); ?>"><?php echo e(__('All Tickets')); ?></a>
                        </li>

                        <li class="<?php echo e(active_menu('admin-home/support-tickets/new')); ?>">
                            <a href="<?php echo e(route('vendor.support.ticket.new')); ?>"><?php echo e(__('Add New Ticket')); ?></a>
                        </li>
                    </ul>
                </li>

                <li class="list">
                    <a href="<?php echo e(route('vendor.logout')); ?>"> <i class="ti-share-alt"></i> Sign Out </a>
                </li>
                <li class="list empty"></li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/layouts/vendor/sidebar.blade.php ENDPATH**/ ?>