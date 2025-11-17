<div class="dashboard-left-content">
    <div class="dashboard-close-main">
        <div class="close-bars"> <i class="las la-times"></i> </div>
        <div class="dashboard-top">
            <div class="dashboard-logo">
                <a href="{{ route('admin.home') }}">
                    @if (get_static_option('site_admin_dark_mode') == 'off')
                        {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                    @else
                        {!! render_image_markup_by_attachment_id(get_static_option('site_white_logo')) !!}
                    @endif
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
            <ul class="dashboard-list pb-5">
                <li class="{{ active_menu('admin-home') }}">
                    <a href="{{ route('admin.home') }}" aria-expanded="true">
                        <i class="ti-layout-grid2"></i>
                        <span>@lang('Dashboard')</span>
                    </a>
                </li>

                @if (auth('admin')->user()->hasRole('Super Admin'))
                    <li class="main_dropdown @if (request()->is(['admin-home/admin/*'])) active open @endif">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-user"></i>
                            <span>{{ __('Admin Management') }}</span>
                        </a>
                        <ul class="collapse">
                            <li class="{{ active_menu('admin-home/admin/all') }}">
                                <a href="{{ route('admin.all.user') }}">
                                    {{ __('Admin Accounts') }}
                                </a>
                            </li>
                            <li class="{{ active_menu('admin-home/admin/new-user') }}">
                                <a href="{{ route('admin.new.user') }}">
                                    {{ __('Add New Admin') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (auth('admin')->user()->hasRole('Super Admin'))
                    <li class="main_dropdown @if (request()->is(['admin-home/roles', 'admin-home/roles/*'])) active open @endif">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-user"></i>
                            <span>{{ __('Role Permission Management') }}</span>
                        </a>
                        <ul class="collapse">
                            <li class="{{ active_menu('admin-home/roles') }}">
                                <a href="{{ route('admin.roles.index') }}">
                                    {{ __('Admin Roles') }}
                                </a>
                            </li>
                            <li class="{{ active_menu('admin-home/admin/roles') }}">
                                <a href="{{ route('admin.roles.index', ['create' => 'add_new_role']) }}">
                                    {{ __('Add New Role') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @canany(['manage-user', 'view-user', 'add-user', 'edit-user', 'delete-user'])
                    <li class="main_dropdown
                        @if (request()->is([
                                'admin-home/frontend/new-user',
                                'admin-home/frontend/all-user',
                                'admin-home/frontend/all-user/role',
                            ])) active open @endif ">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-user"></i>
                            <span>{{ __('Customers Management') }}</span>
                        </a>
                        <ul class="collapse">
                            @can('view-user')
                                <li class="{{ active_menu('admin-home/frontend/all-user') }}">
                                    <a href="{{ route('admin.all.frontend.user') }}">
                                        {{ __('Customer Accounts') }}
                                    </a>
                                </li>
                            @endcan
                             @can('add-user')
                                <li class="{{ active_menu('admin-home/frontend/new-user') }}">
                                    <a href="{{ route('admin.frontend.new.user') }}">
                                        {{ __('Add New Customer') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['manage-newsletter', 'view-subscriber'])
                    <li class="main_dropdown @if (request()->is(['admin-home/newsletter/*', 'admin-home/newsletter'])) active open @endif ">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-email"></i>
                            <span>{{ __('Newsletter Management') }}</span>
                        </a>
                        <ul class="collapse">
                            @can('view-subscriber')
                                <li class="{{ active_menu('admin-home/newsletter') }}">
                                    <a href="{{ route('admin.newsletter') }}">
                                        {{ __('Newsletter Subscribers') }}

                                    </a>
                                </li>
                            @endcan
                            @can('manage-newsletter')
                                <li class="{{ active_menu('admin-home/newsletter/all') }}">
                                    <a href="{{ route('admin.newsletter.mail') }}">
                                        {{ __('Send Mail to All Subscribers') }}

                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['view-support-ticket', 'add-support-ticket', 'manage-support-ticket'])
                    <li
                        class="main_dropdown {{ active_menu('admin-home/support-tickets') }} @if (request()->is('admin-home/support-tickets/*')) active open @endif">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-headphone-alt"></i>
                            <span>{{ __('Support Tickets Management') }}</span>
                        </a>
                        <ul class="collapse">
                            @can('view-support-ticket')
                                <li class="{{ active_menu('admin-home/support-tickets') }}">
                                    <a href="{{ route('admin.support.ticket.all') }}">
                                        {{ __('Customer Support Tickets') }}

                                    </a>
                                </li>
                            @endcan

                            @can('view-support-ticket')
                                <li class="{{ active_menu('admin-home/support-tickets/vendor-tickets') }}">
                                    <a href="{{ route('admin.support.ticket.all.vendor') }}">
                                        {{ __('Vendors Support Tickets') }}
                                    </a>
                                </li>
                            @endcan

                            @can('support-tickets-new')
                                <li class="{{ active_menu('admin-home/support-tickets/new') }}">
                                    <a href="{{ route('admin.support.ticket.new') }}">
                                        {{ __('Add New Ticket') }}

                                    </a>
                                </li>
                            @endcan

                            @can('manage-support-ticket')
                                <li class="{{ active_menu('admin-home/support-tickets/department') }}">
                                    <a href="{{ route('admin.support.ticket.department') }}">
                                        {{ __('Support Ticket Departments') }}
                                    </a>
                                </li>
                            @endcan

                            @can('manage-support-ticket')
                                <li class="{{ active_menu('admin-home/support-tickets/page-settings') }}"
                                    style="display: none;">
                                    <a href="{{ route('admin.support.ticket.page.settings') }}">
                                        {{ __('Page Settings') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @if (moduleExists('MobileApp'))
                    {{-- @if (auth('admin')->user()->hasRole('Super Admin'))
                        <li class="main_dropdown @if (request()->is(['admin-home/mobile-intro/*', 'admin-home/vendor-intro/*'])) active @endif">
                            <a href="#1" aria-expanded="true">
                                <i class="ti-mobile"></i>
                                <span>{{ __('Mobile Intro Management') }}</span>
                            </a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/mobile-intro/list') }}">
                                    <a href="{{ route('admin.mobile.intro.all') }}">
                                        {{ __('Customer Intro List') }}
                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-intro/new') }}">
                                    <a href="{{ route('admin.mobile.intro.create') }}">
                                        {{ __('Customer Intro Create') }}
                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/vendor-intro/list') }}">
                                    <a href="{{ route('admin.mobile.vendor.intro.all') }}">
                                        {{ __('Vendor Intro List') }}
                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/vendor-intro/new') }}">
                                    <a href="{{ route('admin.mobile.vendor.intro.create') }}">
                                        {{ __('Vendor Intro Create') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif --}}

                    {{-- @if (auth('admin')->user()->hasRole('Super Admin'))
                        <li class="main_dropdown @if (request()->is(['admin-home/mobile-slider-two/*', 'admin-home/mobile-slider-three/*', 'admin-home/mobile-slider/*', 'admin-home/mobile-featured-product/*', 'admin-home/mobile-campaign/*', 'admin-home/mobile-settings/*'])) active @endif">
                            <a href="#1" aria-expanded="true">
                                <i class="ti-mobile"></i>
                                <span>{{ __('Buyer App Management') }}</span>
                            </a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/mobile-slider/new') }}">
                                    <a href="{{ route('admin.mobile.slider.create') }}">
                                        {{ __('Slider Create') }}
                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-slider/list') }}">
                                    <a href="{{ route('admin.mobile.slider.all') }}">
                                        {{ __('Slider List') }}
                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-slider-two/new') }}">
                                    <a href="{{ route('admin.mobile.slider.two.create') }}">
                                        {{ __('Slider Two Create') }}
                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-slider-two/list') }}">
                                    <a href="{{ route('admin.mobile.slider.two.all') }}">
                                        {{ __('Slider Two List') }}
                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-slider-three/new') }}">
                                    <a href="{{ route('admin.mobile.slider.three.create') }}">
                                        {{ __('Slider Three Create') }}
                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-slider-three/list') }}">
                                    <a href="{{ route('admin.mobile.slider.three.all') }}">
                                        {{ __('Slider Three List') }}
                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-campaign/create') }}">
                                    <a href="{{ route('admin.mobile.campaign.create') }}">
                                        {{ __('Campaign Update') }}
                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-featured-product/new') }}">
                                    <a href="{{ route('admin.featured.product.create') }}">
                                        {{ __('Featured Product Update') }}
                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-settings/terms-and-controller') }}">
                                    <a href="{{ route('admin.mobile.settings.terms_and_condition') }}">
                                        {{ __('Terms and Condition') }}
                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-settings/privacy-policy') }}">
                                    <a href="{{ route('admin.mobile.settings.privacy.policy') }}">
                                        {{ __('Privacy and Policy') }}
                                    </a>
                                </li>

                                @if (auth('admin')->user()->hasRole('Super Admin'))
                                    <li class="{{ active_menu('admin-home/mobile-settings/buyer-app-settings') }}">
                                        <a href="{{ route('admin.mobile.settings.buyer-app-settings') }}">
                                            {{ __('Buyer App Settings') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif --}}
                @endif

                @if (moduleExists('DeliveryMan'))
                    {{-- @canany(['delivery-man-zone', 'delivery-man-pickup-point', 'delivery-man-add',
                        'delivery-man-settings', 'delivery-man-wallet-gateway'])

                        <li class="main_dropdown @if (request()->is(['admin-home/delivery-man/*', 'admin-home/delivery-man/pickup-point/*', 'admin-home/delivery-man'])) active open @endif addon-module">
                            <a href="#1" aria-expanded="true">
                                <i class="ti-truck"></i>
                                <span>
                                    {{ __('Delivery Man Management') }}
                                </span>
                            </a>
                            <ul class="collapse">
                                @can('delivery-man-pickup-point')
                                    <li class="{{ active_menu('admin-home/delivery-man/pickup-point') }}">
                                        <a href="{{ route('admin.delivery-man.pickup-point.index') }}">
                                            {{ __('Pickup Point') }}
                                        </a>
                                    </li>
                                @endcan

                                @can('delivery-man-zone')
                                    <li class="{{ active_menu('admin-home/delivery-man/zone') }}">
                                        <a href="{{ route('admin.delivery-man.zone.index') }}">
                                            {{ __('Delivery Man Zone') }}
                                        </a>
                                    </li>
                                @endcan

                                @can('delivery-man')
                                    <li class="{{ active_menu('admin-home/delivery-man') }}">
                                        <a href="{{ route('admin.delivery-man.index') }}">
                                            {{ __('Delivery Man List') }}
                                        </a>
                                    </li>
                                @endcan

                                @can('delivery-man-add')
                                    <li class="{{ active_menu('admin-home/delivery-man/add') }}">
                                        <a href="{{ route('admin.delivery-man.add') }}">
                                            {{ __('Create Delivery Man') }}
                                        </a>
                                    </li>
                                @endcan

                                @can('delivery-man-settings')
                                    <li class="{{ active_menu('admin-home/delivery-man/settings') }}">
                                        <a href="{{ route('admin.delivery-man.settings') }}">
                                            {{ __('Delivery Man Settings') }}
                                        </a>
                                    </li>
                                @endcan

                                @can('delivery-man-wallet-gateway')
                                    <li class="{{ active_menu('admin-home/delivery-man/wallet/gateway') }}">
                                        <a href="{{ route('admin.delivery-man.wallet.withdraw.gateway') }}">
                                            {{ __('Withdraw Gateway') }}
                                        </a>
                                    </li>
                                @endcan
                                @if (auth('admin')->user()->hasRole('Super Admin'))
                                    <li class="{{ active_menu('admin-home/delivery-man/update') }}" style="display: none;">
                                        <a href="{{ route('admin.delivery-man.license_update') }}">
                                            <span>{{ __('Update Plugin') }}</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endcanany --}}
                @endif

                @if (moduleExists('Wallet'))
                    @canany(['manage-wallet', 'view-wallet', 'add-wallet', 'edit-wallet', 'delete-wallet'])

                        <li class="main_dropdown @if (request()->is(['admin-home/wallet/*'])) active open @endif ">
                            <a href="#1" aria-expanded="true">
                                <i class="ti-wallet"></i>
                                <span>{{ __('Wallet Management') }}</span>
                            </a>
                            <ul class="collapse">
                                @can('manage-wallet')
                                    <li class="{{ active_menu('admin-home/wallet/withdraw-request') }}">
                                        <a href="{{ route('admin.wallet.withdraw-request') }}">
                                            {{ __('Withdraw Request') }}
                                        </a>
                                    </li>
                                @endcan

                                @if (moduleExists('DeliveryMan'))
                                    @can('manage-wallet')
                                        <li class="{{ active_menu('admin-home/wallet/delivery-man-withdraw-request') }}">
                                            <a href="{{ route('admin.wallet.delivery-man-withdraw-request') }}">
                                                {{ __('Delivery man Withdraw Request') }}
                                            </a>
                                        </li>
                                    @endcan
                                @endcan

                                @can('view-wallet')
                                    <li class="{{ active_menu('admin-home/wallet/vendor/lists') }}">
                                        <a href="{{ route('admin.wallet.lists') }}">
                                            {{ __('Vendor Wallet List') }}
                                        </a>
                                    </li>
                                @endcan

                                @if (moduleExists('DeliveryMan'))
                                    @can('view-wallet')
                                        <li class="{{ active_menu('admin-home/wallet/delivery-man/lists') }}">
                                            <a href="{{ route('admin.wallet.delivery-man.lists') }}">
                                                {{ __('Delivery man List') }}
                                            </a>
                                        </li>
                                    @endcan
                                @endif
                                @can('view-wallet')
                                    <li class="{{ active_menu('admin-home/wallet/customer/lists') }}">
                                        <a href="{{ route('admin.wallet.customer.lists') }}">
                                            {{ __('Customer Wallet List') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('view-wallet')
                                    <li class="{{ active_menu('admin-home/wallet/history/records') }}">
                                        <a href="{{ route('admin.wallet.history') }}">
                                            {{ __('Customer Deposit History') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('manage-wallet')
                                    <li class="{{ active_menu('admin-home/wallet/withdraw/gateway') }}">
                                        <a href="{{ route('admin.wallet.withdraw.gateway') }}">
                                            {{ __('Wallet Payment Methods') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('manage-wallet')
                                    <li class="{{ active_menu('admin-home/wallet/settings/update') }}">
                                        <a href="{{ route('admin.wallet.settings') }}">
                                            {{ __('Wallet Settings') }}
                                        </a>
                                    </li>
                                @endcan
                        </ul>
                    </li>
                @endcanany
            @endcan

            @if (moduleExists('Refund'))
                @canany(['manage-refund-request'])
                    {{--                Wallet Manage                 --}}
                    <li class="main_dropdown @if (request()->is(['admin-home/refund/*'])) active open @endif ">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-control-backward"></i>
                            <span>{{ __('Refund Management') }}
                                {{-- <span class="badge bg-danger ml-5-px">{{ __("Plugin") }}</span> --}}
                            </span>
                        </a>
                        <ul class="collapse">
                            @can('manage-refund-request')
                                <li class="{{ active_menu('admin-home/refund/request') }}">
                                    <a href="{{ route('admin.refund.request') }}">
                                        {{ __('Refund Requests') }}

                                    </a>
                                </li>
                            @endcan
                            @can('manage-refund-request')
                                <li class="{{ active_menu('admin-home/refund/reason') }}">
                                    <a href="{{ route('admin.refund.reason.index') }}">
                                        {{ __('Refund Reasons') }}
                                    </a>
                                </li>
                            @endcan
                            @can('manage-refund-request')
                                <li class="{{ active_menu('admin-home/refund/preferred-option') }}">
                                    <a href="{{ route('admin.refund.preferred-option.index') }}">
                                        {{ __('Refund Payment Methods') }}
                                    </a>
                                </li>
                            @endcan
                            @can('manage-refund-request')
                                <li class="{{ active_menu('admin-home/refund/settings') }}">
                                    <a href="{{ route('admin.refund.settings.index') }}">
                                        {{ __('Refund Settings') }}
                                    </a>
                                </li>
                            @endcan
                            @if (auth('admin')->user()->hasRole('Super Admin'))
                                <li class="{{ active_menu('admin-home/refund/update-plugin') }}"
                                    style="display: none;">
                                    <a href="{{ route('admin.refund.refund_plugin_license_update') }}">
                                        <span>{{ __('Update Plugin') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endcanany
            @endif

            @if (moduleExists('EmailTemplate'))
                @can('manage-email-template')
                    {{--                Wallet Manage                 --}}
                    <li class="main_dropdown @if (request()->is(['admin-home/email-template/*'])) active open @endif "
                        style="display: none">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-email"></i>
                            <span>{{ __('Email Template Management') }}</span>
                        </a>
                        <ul class="collapse">
                            <li class="{{ active_menu('admin-home/email-template/all-templates') }}">
                                <a href="{{ route('admin.email-template.email.template.all') }}">
                                    {{ __('All Email Templates') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
            @endif

            @if (moduleExists('Wallet'))
                @canany(['manage-admin-shop'])
                    {{--                Shop Manage Manage                 --}}
                    <li class="main_dropdown @if (request()->is(['admin-home/shop-manage/*', 'admin-home/shop-manage', 'admin-home/invoice-note'])) active open @endif "
                        style="display: none">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-shopping-cart"></i>
                            <span>{{ __('Shop Management') }}</span>
                        </a>
                        <ul class="collapse">
                                <li class="{{ active_menu('admin-home/shop-manage') }}">
                                    <a href="{{ route('admin.shop-manage.update') }}">
                                        {{ __('Shop Manage') }}

                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/invoice-note') }}">
                                    <a href="{{ route('admin.shop-manage.invoice-note') }}">
                                        {{ __('Invoice Notes') }}
                                    </a>
                                </li>
                        </ul>
                    </li>
                @endcanany
            @endif

            @if (moduleExists('Order'))
                @canany(['manage-order', 'add-order', 'edit-order', 'view-order'])
                    {{-- Order Manage --}}
                    <li class="main_dropdown @if (request()->is([
                            'admin-home/orders/*',
                            'admin-home/orders',
                            'admin-home/assign-delivery-man/orders',
                            'admin-home/assign-delivery-man/orders/*',
                        ])) active open @endif ">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-view-list-alt"></i>
                            <span>{{ __('Order Management') }}</span>
                        </a>

                        <ul class="collapse">
                            {{-- @if (moduleExists('DeliveryMan'))
                                @can('assign-delivery-man-orders')
                                    <li class="{{ active_menu('admin-home/assign-delivery-man/orders') }}">
                                        <a href="{{ route('admin.assign-delivery-man.orders') }}">
                                            {{ __('Assign Delivery Man') }}
                                        </a>
                                    </li>
                                @endcan
                            @endif --}}
                            @can('view-order')
                                <li class="{{ active_menu('admin-home/orders/vendor/list') }}">
                                    <a href="{{ route('admin.orders.vendor.list') }}">
                                        {{ __('Store Order Summary') }}
                                    </a>
                                </li>
                            @endcan
                            @can('manage-order')
                                <li class="{{ active_menu('admin-home/orders') }}">
                                    <a href="{{ route('admin.orders.list') }}">
                                        {{ __('All Store Orders') }}
                                    </a>
                                </li>
                            @endcan
                            @can('manage-order')
                                <li class="{{ active_menu('admin-home/orders/sub-order') }}">
                                    <a href="{{ route('admin.orders.sub_order.list') }}">
                                        {{ __('All Store Sub Orders') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
            @endif

            @if (moduleExists('Pos'))
                {{-- @canany(['pos-view', 'pos-payment-gateway-settings'])
                    <li class="main_dropdown @if (request()->is(['admin-home/pos/*'])) active open @endif ">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-layout-sidebar-2"></i>
                            <span>{{ __('Pos Management') }}
                            </span>
                        </a>

                        <ul class="collapse">
                            @can('pos-view')
                                <li class="{{ active_menu('admin-home/pos/view') }}">
                                    <a href="{{ route('admin.pos.view') }}">
                                        {{ __('Pos Manage') }}

                                    </a>
                                </li>
                            @endcan
                            @can('pos-payment-gateway-settings')
                                <li class="{{ active_menu('admin-home/pos/payment-gateway/settings') }}">
                                    <a href="{{ route('admin.pos.payment-gateway-settings') }}">
                                        {{ __('Pos Settings') }}
                                    </a>
                                </li>
                            @endcan
                            @if (auth('admin')->user()->hasRole('Super Admin'))
                                <li class="{{ active_menu('admin-home/pos/update-plugin') }}"
                                    style="display: none">
                                    <a href="{{ route('admin.pos.pos_plugin_license_update') }}">
                                        <span>{{ __('Update Plugin') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endcanany --}}
            @endif



            @canany(['manage-country', 'manage-province', 'manage-city'])
                <li class="main_dropdown @if (request()->is([
                        'admin-home/country',
                        'admin-home/country/*',
                        'admin-home/state',
                        'admin-home/state/*',
                        'admin-home/city',
                        'admin-home/city/*',
                    ])) active @endif ">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-clipboard"></i>
                        <span>{{ __('Country Management') }}</span>
                    </a>
                    <ul class="collapse">
                        @can('manage-country')
                            <li class="{{ active_menu('admin-home/country') }}">
                                <a href="{{ route('admin.country.all') }}">
                                    {{ __('All Countries') }}
                                </a>
                            </li>
                        @endcan

                        @can('add-country')
                            <li class="{{ active_menu('admin-home/country/csv/import') }}">
                                <a href="{{ route('admin.country.import.csv.settings') }}">
                                    {{ __('Import Country') }}
                                </a>
                            </li>
                        @endcan

                        @can('manage-province')
                            <li class="{{ active_menu('admin-home/state') }}">
                                <a href="{{ route('admin.state.all') }}">
                                    {{ __('All Provinces') }}
                                </a>
                            </li>
                        @endcan

                        @can('add-province')
                            <li class="{{ active_menu('admin-home/state/csv/import') }}">
                                <a href="{{ route('admin.state.import.csv.settings') }}">
                                    {{ __('Import Province') }}
                                </a>
                            </li>
                        @endcan

                        @can('manage-city')
                            <li class="{{ active_menu('admin-home/city') }}">
                                <a href="{{ route('admin.city.all') }}">
                                    {{ __('All Cities') }}
                                </a>
                            </li>
                        @endcan

                        @can('add-city')
                            <li class="{{ active_menu('admin-home/city/csv/import') }}">
                                <a href="{{ route('admin.city.import.csv.settings') }}">
                                    {{ __('Import City') }}

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['manage-tax', 'add-tax'])
                <li class="main_dropdown @if (request()->is(['admin-home/tax/*', 'admin-home/tax-module/*'])) active open @endif ">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-money"></i>
                        <span>{{ __('Tax Settings Management') }}</span>
                    </a>
                    <ul class="collapse">
                        @can('manage-tax')
                            <li class="{{ active_menu('admin-home/tax-module/settings') }}">
                                <a href="{{ route('admin.tax-module.settings') }}">
                                    {{ __('Tax Settings') }}
                                </a>
                            </li>
                        @endcan

                        @if (get_static_option('tax_system') == 'advance_tax_system')
                            @can('manage-tax')
                                <li class="{{ active_menu('admin-home/tax-module/tax-class') }}">
                                    <a href="{{ route('admin.tax-module.tax-class') }}">
                                        {{ __('Manage Tax Class') }}

                                    </a>
                                </li>
                            @endcan
                        @endif

                        @if (get_static_option('tax_system') == 'zone_wise_tax_system')
                            @can('manage-tax')
                                <li class="{{ active_menu('admin-home/tax/country') }}">
                                    <a href="{{ route('admin.tax.country.all') }}">
                                        {{ __('All Country Tax') }}

                                    </a>
                                </li>
                            @endcan

                            @can('manage-tax')
                                <li class="{{ active_menu('admin-home/tax/state') }}">
                                    <a href="{{ route('admin.tax.state.all') }}">
                                        {{ __('All Province Tax') }}
                                    </a>
                                </li>
                            @endcan
                        @endif
                    </ul>
                </li>
            @endcanany

            @canany([
                    'manage-category','view-category','add-category',
                    'manage-category-menu','view-category-menu','add-category-menu',
                    'manage-attribute','view-attribute','add-attribute',
                    'manage-brand','view-brand','add-brand',
                    'manage-badge','view-badge','add-badge',
                    'manage-product-variant','view-product-variant','add-product-variant'
                ])
                {{--                  Attribute Manage menu bar                 --}}
                <li class="main_dropdown @if (request()->is([
                        'admin-home/categories',
                        'admin-home/sub-categories',
                        'admin-home/child-categories',
                        'admin-home/units',
                        'admin-home/tags',
                        'admin-home/delivery-manage',
                        'admin-home/brand-manage',
                        'admin-home/brand-manage',
                        'admin-home/colors',
                        'admin-home/sizes',
                        'admin-home/attributes',
                        'admin-home/badge',
                    ])) active open @endif ">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-panel"></i>
                        <span>{{ __('Attributes Management') }}</span>
                    </a>
                    <ul class="collapse">
                        @can('view-category')
                            <li class="{{ active_menu('admin-home/categories') }}">
                                <a href="{{ route('admin.category.all') }}">
                                    {{ __('Product Categories') }}

                                </a>
                            </li>
                        @endcan

                        @can('view-category')
                            <li class="{{ active_menu('admin-home/sub-categories') }}">
                                <a href="{{ route('admin.subcategory.all') }}">
                                    {{ __('Product Sub-Categories') }}

                                </a>
                            </li>
                        @endcan

                        @can('view-category')
                            <li class="{{ active_menu('admin-home/child-categories') }}" style="display: none">
                                <a href="{{ route('admin.child-category.all') }}">
                                    {{ __('Child-Category') }}

                                </a>
                            </li>
                        @endcan

                        @can('view-attribute')
                            <li class="{{ active_menu('admin-home/units') }}">
                                <a href="{{ route('admin.units.all') }}">
                                    {{ __('Units') }}

                                </a>
                            </li>
                        @endcan

                        {{-- @can('view-attribute')
                                <li class="{{ active_menu('admin-home/tags') }}">
                                    <a href="{{ route('admin.tag.all') }}">
                                        {{ __('Tag') }}

                                    </a>
                                </li>
                            @endcan --}}

                        @can('view-attribute')
                            <li class="{{ active_menu('admin-home/delivery-manage') }}">
                                <a href="{{ route('admin.delivery.option.all') }}">
                                    {{ __('Delivery Options') }}
                                </a>
                            </li>
                        @endcan

                        @can('view-brand')
                            <li class="{{ active_menu('admin-home/brand-manage') }}">
                                <a href="{{ route('admin.brand.manage.all') }}">
                                    {{ __('Brands') }}

                                </a>
                            </li>
                        @endcan

                        @can('view-attribute')
                            <li class="{{ active_menu('admin-home/colors') }}">
                                <a href="{{ route('admin.product.colors.all') }}">
                                    {{ __('Product Variant Colors') }}

                                </a>
                            </li>
                        @endcan

                        @can('view-attribute')
                            <li class="{{ active_menu('admin-home/sizes') }}">
                                <a href="{{ route('admin.product.sizes.all') }}">
                                    {{ __('Sizes') }}

                                </a>
                            </li>
                        @endcan

                        @can('view-attribute')
                            <li class="{{ active_menu('admin-home/attributes') }}">
                                <a href="{{ route('admin.products.attributes.all') }}">
                                    {{ __('Custom Attributes') }} </a>
                            </li>
                        @endcan

                        @can('view-badge')
                            <li class="{{ active_menu('admin-home/badge') }}">
                                <a href="{{ route('admin.badge.all') }}">
                                    {{ __('Badges') }}

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['manage-vendor', 'view-vendor', 'add-vendor'])
                {{--                Vendor Manage                 --}}
                <li class="main_dropdown @if (request()->is(['admin-home/vendor/*'])) active open @endif ">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-user"></i>
                        <span>{{ __('Vendor Management') }}</span>
                    </a>
                    <ul class="collapse">
                        @can('view-vendor')
                            <li class="{{ active_menu('admin-home/vendor/index') }}">
                                <a href="{{ route('admin.vendor.all') }}">
                                    {{ __('Vendor List') }}

                                </a>
                            </li>
                        @endcan
                        @can('add-vendor')
                            <li class="{{ active_menu('admin-home/vendor/create') }}">
                                <a href="{{ route('admin.vendor.create') }}">
                                    {{ __('Create Vendor') }}

                                </a>
                            </li>
                        @endcan
                        @can('manage-vendor')
                            <li class="{{ active_menu('admin-home/vendor/settings') }}">
                                <a href="{{ route('admin.vendor.settings') }}">
                                    {{ __('Vendor Settings') }}

                                </a>
                            </li>
                        @endcan
                        @can('manage-vendor')
                            <li class="{{ active_menu('admin-home/vendor/commission-settings') }}">
                                <a href="{{ route('admin.vendor.commission-settings') }}">
                                    {{ __('Vendor Commission') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            {{--        Product Inventory manage        --}}
            @can('manage-product-variant')
                <li class="{{ active_menu('admin-home/product-inventory') }}">
                    <a href="{{ route('admin.products.inventory.all') }}">
                        <i class="ti-package"></i>
                        <span>{{ __('Inventory Management') }}</span>
                    </a>
                </li>
            @endcan

            {{-- Product Manage Sidebar menu list --}}
            @canany(['manage-coupon', 'view-coupon', 'add-coupon'])
                <li class="@if (request()->is(['admin-home/coupons', 'admin-home/coupons/*'])) active open @endif">
                    <a href="{{ route('admin.products.coupon.all') }}" aria-expanded="true">
                        <i class="ti-layout-tab"></i>
                        <span>{{ __('Coupon Management') }}</span>
                    </a>
                </li>
            @endcanany
            {{-- Product Manage Sidebar menu list --}}
            @canany(['manage-product', 'view-product', 'add-product'])
                <li class="main_dropdown @if (request()->is(['admin-home/product', 'admin-home/product/*'])) active open @endif">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-layout-tab"></i><span>{{ __('Product Management') }}</span>
                    </a>
                    <ul class="collapse">
                        @can('view-product')
                            <li class="{{ active_menu('admin-home/product/all') }}">
                                <a href="{{ route('admin.products.all') }}">
                                    {{ __('Products List') }}

                                </a>
                            </li>
                        @endcan

                        @can('add-product')
                            <li class="{{ active_menu('admin-home/product/create') }}">
                                <a href="{{ route('admin.products.create') }}">
                                    {{ __('Add New Product') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['manage-campaign', 'view-campaign', 'add-campaign'])
                <li class="main_dropdown @if (request()->is(['admin-home/campaigns', 'admin-home/campaigns/*'])) active open @endif">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-announcement"></i>
                        <span>{{ __('Campaign Management') }}</span>
                    </a>
                    <ul class="collapse">
                        @can('view-campaign')
                            <li class="{{ active_menu('admin-home/campaigns') }}">
                                <a href="{{ route('admin.campaigns.all') }}">
                                    {{ __('All Campaigns') }}
                                </a>
                            </li>
                        @endcan

                        @can('add-campaign')
                            <li class="{{ active_menu('admin-home/campaigns/new') }}">
                                <a href="{{ route('admin.campaigns.new') }}">
                                    {{ __('Add New Campaign') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            {{-- Shipping zone route wrapper --}}
            @canany(['manage-shipping', 'add-shipping'])
                <li class="main_dropdown @if (request()->is([
                        'admin-home/shipping/*',
                        'admin-home/shipping-method/*',
                        'admin-home/shipping-method',
                        'admin-home/shipping',
                    ])) open active @endif ">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-truck"></i><span>{{ __('Shipping Management') }}</span>
                    </a>
                    <ul class="collapse">
                        @can('manage-shipping')
                            <li class="{{ active_menu('admin-home/shipping/zone') }}">
                                <a href="{{ route('admin.shipping.zone.all') }}">
                                    {{ __('Shipping Zones') }}

                                </a>
                            </li>
                        @endcan
                        @can('manage-shipping')
                            <li class="@if (request()->is(['admin-home/shipping-method', 'admin-home/shipping-method/*'])) open active @endif">
                                <a href="{{ route('admin.shipping-method.index') }}">
                                    {{ __('Shipping Methods') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            {{-- Blog Routes Wrapper --}}
            @canany(['manage-blog', 'view-blog', 'add-blog', 'manage-blog-settings'])
                <li class="main_dropdown @if (request()->is(['admin-home/blog/*', 'admin-home/blog'])) active open @endif ">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-write"></i>
                        <span>{{ __('Blogs Management') }}</span>
                    </a>
                    <ul class="collapse">
                        @can('view-blog')
                            <li class="{{ active_menu('admin-home/blog') }}">
                                <a href="{{ route('admin.blog') }}">
                                    {{ __('All Blog') }}

                                </a>
                            </li>
                        @endcan
                        @can('add-blog')
                            <li class="{{ active_menu('admin-home/blog/new') }}">
                                <a href="{{ route('admin.blog.new') }}">
                                    {{ __('Add New Blog') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-blog-settings')
                            <li class="{{ active_menu('admin-home/blog/category') }}">
                                <a href="{{ route('admin.blog.category') }}">
                                    {{ __('All Categories') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-blog-settings')
                            <li class="{{ active_menu('admin-home/blog/page-settings') }}">
                                <a href="{{ route('admin.blog.page.settings') }}">
                                    {{ __('Blog Page Settings') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-blog-settings')
                            <li class="{{ active_menu('admin-home/blog/single-settings') }}">
                                <a href="{{ route('admin.blog.single.settings') }}">
                                    {{ __('Blog Single Page Settings') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @can('manage-faq')
                <li class="{{ active_menu('admin-home/faq') }}">
                    <a href="{{ route('admin.faq') }}" aria-expanded="true">
                        <i class="ti-control-forward"></i>
                        <span>{{ __('FAQ Management') }}</span>
                    </a>
                </li>
            @endcan

            @if (moduleExists('Chat'))
                @can('manage-site-settings')
                    <li class="main_dropdown @if (request()->is(['admin-home/livechat/*'])) open active @endif ">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-write"></i>
                            <span>{{ __('Livechat Management') }}</span>
                            {{-- <span class="badge bg-danger ml-5-px">
                                    {{ __("Plugin") }}
                                </span> --}}
                        </a>
                        <ul class="collapse">
                            @can('manage-site-settings')
                                <li class="{{ active_menu('admin-home/livechat/settings') }}">
                                    <a href="{{ route('admin.livechat.settings') }}">
                                        <i class="ti-comment-alt"></i>
                                        <span>{{ __('Livechat Settings') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @if (auth('admin')->user()->hasRole('Super Admin'))
                                <li class="{{ active_menu('admin-home/livechat/update-plugin') }}"
                                    style="display: none;">
                                    <a href="{{ route('admin.livechat.chat_plugin_license_update') }}">
                                        <span>{{ __('Update Plugin') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endcan
            @endif

            @canany(['manage-page', 'view-page', 'add-page'])
                <li class="main_dropdown @if (request()->is(['admin-home/page-edit/*', 'admin-home/page/edit/*', 'admin-home/page/all', 'admin-home/page/new'])) open active @endif ">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-write"></i>
                        <span>{{ __('Pages Management') }}</span>
                    </a>

                    <ul class="collapse">
                        @can('view-page')
                            <li class="{{ active_menu('admin-home/page/all') }}">
                                <a href="{{ route('admin.page') }}">
                                    {{ __('All Pages') }}

                                </a>
                            </li>
                        @endcan

                        @can('add-page')
                            <li class="{{ active_menu('admin-home/page/new') }}">
                                <a href="{{ route('admin.page.new') }}">
                                    {{ __('Add New Page') }}

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['manage-topbar', 'manage-menu', 'manage-widget', 'manage-form', 'add-media'])
                <li
                    class="main_dropdown
                        @if (request()->is([
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
                            ])) active open @endif ">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-stamp"></i>
                        <span>{{ __('Appearance Settings Management') }}</span>
                    </a>
                    <ul class="collapse ">
                        @can(['manage-topbar'])
                            <li class="{{ active_menu('admin-home/appearance-settings/topbar/all') }}">
                                <a href="{{ route('admin.topbar.settings') }}" aria-expanded="true">
                                    {{ __('Topbar Manage') }}
                                </a>
                            </li>
                        @endcan

                        @can('manage-menu')
                            <li
                                class="main_dropdown {{ active_menu('admin-home/menu') }} @if (request()->is('admin-home/menu-edit/*')) active open @endif ">
                                <a href="#1" aria-expanded="true">
                                    {{ __('Menus Manage') }}

                                </a>
                                <ul class="collapse">
                                    <li class="{{ active_menu('admin-home/menu') }}">
                                        <a href="{{ route('admin.menu') }}">
                                            {{ __('All Menus') }}

                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('manage-menu')
                            <li class="{{ active_menu('admin-home/category-menu') }}" style="display: none">
                                <a href="{{ route('admin.category.menu.settings') }}" aria-expanded="true">
                                    {{ __('Category Menu Manage') }}
                                </a>
                            </li>
                        @endcan

                        @can('manage-widget')
                            <li
                                class="main_dropdown {{ active_menu('admin-home/widgets/all') }} @if (request()->is('admin-home/widgets/*')) active open @endif ">
                                <a href="#1" aria-expanded="true">
                                    {{ __('Widgets Manage') }}
                                </a>
                                <ul class="collapse">
                                    <li class="{{ active_menu('admin-home/widgets/all') }}">
                                        <a href="{{ route('admin.widgets') }}">
                                            {{ __('All Widgets') }}

                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('manage-form')
                            <li class="main_dropdown @if (request()->is('admin-home/form-builder/*')) active open @endif ">
                                <a href="#1" aria-expanded="true">
                                    {{ __('Form Builder') }}
                                </a>
                                <ul class="collapse">
                                    <li class="{{ active_menu('admin-home/form-builder/custom/all') }}">
                                        <a href="{{ route('admin.form.builder.all') }}">
                                            {{ __('Custom Form') }}

                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('add-media')
                            <li class="{{ active_menu('admin-home/media-upload/page') }}">
                                <a href="{{ route('admin.upload.media.images.page') }}"
                                    class="{{ active_menu('admin-home/form-builder/custom/all') }}">
                                    {{ __('Uploaded Media Files') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['manage-page-settings'])
                <li
                    class="main_dropdown
                                                @if (request()->is([
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
                                                    ])) active open @endif">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-settings"></i>
                        <span>{{ __('All Page Settings Management') }}</span>
                    </a>
                    <ul class="collapse">
                        <li
                            class="main_dropdown
                                                            @if (request()->is([
                                                                    'admin-home/page-settings/*',
                                                                    'admin-home/page-settings/wishlist',
                                                                    'admin-home/page-settings/cart',
                                                                    'admin-home/page-settings/compare',
                                                                ])) active open @endif
                                                            ">
                            <a href="#1" aria-expanded="true">
                                {{ __('Page Settings') }}
                            </a>
                            <ul class="collapse">
                                @can('manage-page-settings')
                                    <li class="{{ active_menu('admin-home/page-settings/wishlist') }}">
                                        <a href="{{ route('admin.page.settings.wishlist') }}">
                                            {{ __('Wishlist Page') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('manage-page-settings')
                                    <li class="{{ active_menu('admin-home/page-settings/cart') }}">
                                        <a href="{{ route('admin.page.settings.cart') }}">
                                            {{ __('Cart Page') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('manage-page-settings')
                                    <li class="{{ active_menu('admin-home/page-settings/checkout') }}">
                                        <a href="{{ route('admin.page.settings.checkout') }}">
                                            {{ __('Checkout Page') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('manage-page-settings')
                                    <li class="{{ active_menu('admin-home/page-settings/compare') }}">
                                        <a href="{{ route('admin.page.settings.compare') }}">
                                            {{ __('Compare Page') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('manage-page-settings')
                                    <li class="{{ active_menu('admin-home/page-settings/login-register') }}">
                                        <a href="{{ route('admin.page.settings.user.auth') }}">
                                            {{ __('Sign In /Sign Up Page') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('manage-page-settings')
                                    <li class="{{ active_menu('admin-home/page-settings/shop-page') }}">
                                        <a href="{{ route('admin.page.settings.shop.page') }}">
                                            {{ __('Shop Page') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('manage-page-settings')
                                    <li class="{{ active_menu('admin-home/page-settings/product-details-page') }}">
                                        <a href="{{ route('admin.page.settings.product.detail.page') }}">
                                            {{ __('Product Details Page') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('manage-page-settings')
                                    <li class="{{ active_menu('admin-home/page-settings/product-settings-page') }}">
                                        <a href="{{ route('admin.page.settings.product.settings.page') }}">
                                            {{ __('Product Settings') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        {{--                 @endcan                --}}
                        @can('404-page-manage')
                            <li class="{{ active_menu('admin-home/404-page-manage') }}">
                                <a href="{{ route('admin.404.page.settings') }}" aria-expanded="true">
                                    {{ __('404 Error Page Settings') }}
                                </a>
                            </li>
                        @endcan
                        @can('maintains-page-settings')
                            <li class="{{ active_menu('admin-home/maintains-page/settings') }}">
                                <a href="{{ route('admin.maintains.page.settings') }}" aria-expanded="true">
                                    {{ __('Maintenance Page Settings') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['manage-site-settings'])
                <li class="main_dropdown @if (request()->is('admin-home/general-settings/*') || request()->is('admin-home/shipping-charge-settings')) active open @endif ">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-new-window"></i>
                        <span>{{ __('Website Settings Management') }}</span>
                    </a>
                    <ul class="collapse">
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/shipping-charge-settings') }}">
                                <a href="{{ route('admin.shipping-charge-settings') }}">
                                    {{ __('Shipping Charge Settings') }}
                                </a>
                            </li>
                        @endcan

                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/reading') }}"
                                style="display: none;">
                                <a href="{{ route('admin.general.reading') }}">
                                    {{ __('Reading') }}

                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/global-variant-navbar') }}"
                                style="display: none;">
                                <a href="{{ route('admin.general.global.variant.navbar') }}">
                                    {{ __('Navbar Global Variant') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/site-identity') }}">
                                <a href="{{ route('admin.general.site.identity') }}">
                                    {{ __('Site Identity') }}

                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/basic-settings') }}">
                                <a href="{{ route('admin.general.basic.settings') }}">
                                    {{ __('Basic Settings') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/color-settings') }}">
                                <a href="{{ route('admin.general.color.settings') }}">
                                    {{ __('Color Settings') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/typography-settings') }}">
                                <a href="{{ route('admin.general.typography.settings') }}">
                                    {{ __('Typography Settings') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/seo-settings') }}">
                                <a href="{{ route('admin.general.seo.settings') }}">
                                    {{ __('SEO Settings') }}

                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/scripts') }}">
                                <a href="{{ route('admin.general.scripts.settings') }}">
                                    {{ __('Third Party Scripts') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/email-template') }}">
                                <a href="{{ route('admin.general.email.template') }}">
                                    {{ __('Email Template') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/smtp-settings') }}">
                                <a href="{{ route('admin.general.smtp.settings') }}">
                                    {{ __('SMTP Settings') }}

                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            @if (!empty(get_static_option('site_payment_gateway')))
                                <li class="{{ active_menu('admin-home/general-settings/payment-settings') }}">
                                    <a href="{{ route('admin.general.payment.settings') }}">
                                        {{ __('Payment Gateway Settings') }}
                                    </a>
                                </li>
                            @endif
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/custom-css') }}">
                                <a href="{{ route('admin.general.custom.css') }}">
                                    {{ __('Custom CSS') }}

                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/custom-js') }}">
                                <a href="{{ route('admin.general.custom.js') }}">
                                    {{ __('Custom JS') }}

                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/cache-settings') }}">
                                <a href="{{ route('admin.general.cache.settings') }}">
                                    {{ __('Cache Settings') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/gdpr-settings') }}">
                                <a href="{{ route('admin.general.gdpr.settings') }}">
                                    {{ __('GDPR Compliant Cookies Settings') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/sitemap-settings') }}"
                                style="display: none;">
                                <a href="{{ route('admin.general.sitemap.settings') }}">
                                    {{ __('Sitemap Settings') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/rss-settings') }}"
                                style="display: none;">
                                <a href="{{ route('admin.general.rss.feed.settings') }}">
                                    {{ __('RSS Feed Settings') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/license-setting') }}"
                                style="display: none;">
                                <a href="{{ route('admin.general.license.settings') }}">
                                    {{ __('Licence Settings') }}
                                </a>
                            </li>

                            <li class="{{ active_menu('admin-home/general-settings/software-update-setting') }}"
                                style="display: none;">
                                <a href="{{ route('admin.general.software.update.settings') }}">
                                    {{ __('Check update') }}
                                </a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/general-settings/database-upgrade') }}"
                                style="display: none;">
                                <a href="{{ route('admin.general.database.upgrade') }}">
                                    {{ __('Database update') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            {{-- @can('languages')
                <li class="@if (request()->is('admin-home/languages/*') || request()->is('admin-home/languages')) active @endif" style="display: none;">
                    <a href="{{ route('admin.languages') }}" aria-expanded="true">
                        <i class="ti-signal"></i>
                        <span>{{ __('Languages Management') }}</span>
                    </a>
                </li>
            @endcan --}}

            @if (moduleExists('PluginManage') && auth('admin')->user()->hasRole('Super Admin'))
            @can('manage-site-settings')
                <li
                    class="main_dropdown
                     @if (request()->is(['admin-home/plugin-manage', 'admin-home/plugin-manage/*'])) active @endif ">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-clipboard"></i>
                        <span>{{ __('Plugin Management') }}</span>
                    </a>
                    <ul class="collapse">
                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/plugin-manage/all') }}">
                                <a href="{{ route('admin.plugin.manage.all') }}">
                                    {{ __('All Plugins') }}

                                </a>
                            </li>
                        @endcan

                        @can('manage-site-settings')
                            <li class="{{ active_menu('admin-home/plugin-manage/new') }}">
                                <a href="{{ route('admin.plugin.manage.new') }}">
                                    {{ __('Add New Plugin') }}

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @endif
    </ul>
</div>
</div>
</div>
