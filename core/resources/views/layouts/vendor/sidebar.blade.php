<div class="dashboard-left-content">
    <div class="dashboard-close-main">
        <div class="close-bars"> <i class="las la-times"></i> </div>
        <div class="dashboard-top">
            <div class="dashboard-logo">
                <a href="{{ route('vendor.home') }}">
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
            <ul class="dashboard-list">
                <li class="list {{ Route::is('vendor.home') ? 'active' : '' }}">
                    <a href="{{ route('vendor.home') }}">
                        <i class="ti-view-grid"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                @if (auth('vendor')->user()->is_vendor_verified && auth('vendor')->user()->verified_at)
                    <li
                        class="main_dropdown @if (request()->is(['vendor-home/product', 'vendor-home/product/*'])) active open @endif">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-layout-tab"></i> <span>{{ __('Products') }}
                            </span>
                        </a>

                        <ul class="collapse">
                            <li class="{{ active_menu('vendor-home/product/all') }}">
                                <a href="{{ route('vendor.products.all') }}">{{ __('Products List') }}</a>
                            </li>

                            <li class="{{ active_menu('vendor-home/product/create') }}">
                                <a href="{{ route('vendor.products.create') }}">{{ __('Add New Product') }}</a>
                            </li>
                        </ul>
                    </li>
                @endif


                <li class="{{ active_menu('vendor-home/product-inventory') }}">
                    <a href="{{ route('vendor.products.inventory.all') }}">
                        <i class="ti-package"></i>
                        <span>{{ __('Inventory') }}</span>
                    </a>
                </li>

                <li class="{{ active_menu('vendor-home/shipping-method') }}" style="display: none;">
                    <a href="{{ route('vendor.shipping-method.index') }}">
                        <i class="ti-money"></i>
                        <span>{{ __('Shipping Method') }}</span>
                    </a>
                </li>

                @if (auth('vendor')->user()->is_vendor_verified && auth('vendor')->user()->verified_at)
                    <li class="{{ active_menu('vendor-home/orders') }}">
                        <a href="{{ route('vendor.orders.list') }}">
                            <i class="ti-view-list-alt"></i>
                            <span>{{ __('Orders List') }}</span>
                        </a>
                    </li>
                    {{-- <li
                        class="main_dropdown @if (request()->is(['vendor-home/orders', 'vendor-home/orders/*'])) active open @endif">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-view-list-alt"></i>
                            <span>{{ __('Order') }}</span>
                        </a>

                        <ul class="collapse">
                            <li class="{{ active_menu('vendor-home/orders') }}">
                                <a href="{{ route('vendor.orders.list') }}">{{ __('Orders List') }}</a>
                            </li>
                        </ul>
                    </li> --}}
                @endif

                <li
                    class="main_dropdown @if (request()->is(['vendor-home/wallet', 'vendor-home/wallet/*'])) active open @endif">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-wallet"></i> <span>{{ __('Wallet') }}
                        </span>
                    </a>

                    <ul class="collapse">

                        <li class="{{ active_menu('vendor-home/wallet') }}">
                            <a href="{{ route('vendor.wallet.home') }}">
                                <span>{{ __('Wallet Dashboard') }}</span>
                            </a>
                        </li>

                        <li class="{{ active_menu('vendor-home/wallet/gateway') }}">
                            <a href="{{ route('vendor.wallet.withdraw.gateway.index') }}">
                                <span>{{ __('Wallet Settings') }}</span>
                            </a>
                        </li>

                        <li class="{{ active_menu('vendor-home/wallet/withdraw') }}">
                            <a href="{{ route('vendor.wallet.withdraw') }}">
                                <span>{{ __('Withdraw') }}</span>
                            </a>
                        </li>

                        <li class="{{ active_menu('vendor-home/wallet/withdraw-request') }}">
                            <a href="{{ route('vendor.wallet.withdraw-request') }}">
                                <span>{{ __('Withdraw Requests') }}</span>
                            </a>
                        </li>

                        <li class="{{ active_menu('vendor-home/wallet/history') }}">
                            <a href="{{ route('vendor.wallet.history') }}">
                                <span>{{ __('Wallet History') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Campaign route wrapper --}}
                {{-- <li class="{{ active_menu('vendor-home/campaigns') }}">
                    <a href="{{ route('vendor.campaigns.all') }}">
                        <i class="ti-announcement"></i>
                        <span>{{ __('Campaigns') }}</span>
                    </a>
                </li> --}}

                <li
                    class="main_dropdown {{ active_menu('vendor-home/campaigns') }} @if (request()->is('vendor-home/campaigns/*')) active open @endif">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-announcement"></i>
                        <span>{{ __('Campaigns') }}</span>
                    </a>
                    <ul class="collapse">
                        <li class="{{ Route::is('vendor.campaigns.all') ? 'active' : '' }}">
                            <a href="{{ route('vendor.campaigns.all') }}">{{ __('Campaigns') }}</a>
                        </li>

                        <li class="{{ Route::is('vendor.campaigns.new') ? 'active' : '' }}">
                            <a href="{{ route('vendor.campaigns.new') }}">{{ __('Add New Campaigns') }}</a>
                        </li>
                    </ul>
                </li>

                <li class="list {{ Route::is('vendor.profile.update') ? 'active' : '' }}">
                    <a href="{{ route('vendor.profile.update') }}">
                        <i class="ti-user"></i> {{ __('Profile') }}
                    </a>
                </li>

                <li
                    class="main_dropdown {{ active_menu('vendor-home/support-tickets') }} @if (request()->is('vendor-home/support-tickets/*')) active open @endif">
                    <a href="#1" aria-expanded="true">
                        <i class="ti-headphone-alt"></i>
                        <span>{{ __('Support Tickets') }}</span>
                    </a>
                    <ul class="collapse">
                        <li class="{{ active_menu('vendor-home/support-tickets') }}">
                            <a href="{{ route('vendor.support.ticket.all') }}">{{ __('All Support Tickets') }}</a>
                        </li>

                        <li class="{{ active_menu('vendor-home/support-tickets/new') }}">
                            <a href="{{ route('vendor.support.ticket.new') }}">{{ __('Add New Support Ticket') }}</a>
                        </li>
                    </ul>
                </li>
                @if (moduleExists('Chat'))
                    <li class="{{ active_menu('vendor-home/chat') }}">
                        <a href="{{ route('vendor.chat.home') }}">
                            <i class="ti-comment-alt"></i>
                            <span>{{ __('Chat') }}</span>
                        </a>
                    </li>
                @endif

                <li class="list">
                    <a href="{{ route('vendor.logout') }}">
                        <i class="ti-share-alt"></i>
                        Sign Out
                    </a>
                </li>
                <li class="list empty"></li>
            </ul>
        </div>
    </div>
</div>