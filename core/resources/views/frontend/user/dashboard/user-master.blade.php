@extends('frontend.frontend-page-master')

@section('page-title')
    @php
        $titles = [
            'user.home' => __('Dashboard'),
            'user.home.edit.profile' => __('Edit Profile'),
            'user.home.change.password' => __('Change Password'),
            'user.product.order.all' => __('My Orders'),
            'frontend.chat.home' => __('Chat List'),
            'user.product.refund-request' => __('Refund Requests'),
            'user.product.refund-request.view' => __('Refund Request Details'),
            'user-home.wallet.history' => __('Wallet History'),
            'user.shipping.address.all' => __('Shipping Address'),
            'user.shipping.address.edit' => __('Edit Shipping Address'),
            'user.shipping.address.new' => __('Add New Shipping Address'),
            'user.home.support.tickets' => __('Support Tickets'),
        ];

        $currentTitle = $titles[Route::currentRouteName()] ?? __('Customer Dashboard');
    @endphp

    {{ $currentTitle }}
@endsection

@section('style')
    @parent
@endsection

@section('content')
    <div class="bodyUser_overlay"></div>

    <section class="login-page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="user-dashboard-wrapper">
                        <div class="mobile_nav">
                            <i class="las la-cogs"></i>
                        </div>

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link bg-main text-white" style="padding: 20px 20px;">
                                    <i class="lar la-user-circle"></i>
                                    {{ optional(Auth::guard('web')->user())->name }}
                                </a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('user.home') ? 'active' : '' }}">
                                <a class="nav-link {{ request()->routeIs('user.home') ? 'active' : '' }}"
                                    href="{{ route('user.home') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('user.home.edit.profile') ? 'active' : '' }}">
                                <a class="nav-link {{ request()->routeIs('user.home.edit.profile') ? 'active' : '' }}"
                                    href="{{ route('user.home.edit.profile') }}">
                                    {{ __('Edit Profile') }}
                                </a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('user.home.change.password') ? 'active' : '' }}">
                                <a class="nav-link {{ request()->routeIs('user.home.change.password') ? 'active' : '' }}"
                                    href="{{ route('user.home.change.password') }}">
                                    {{ __('Change Password') }}
                                </a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('user.product.order.all') ? 'active' : '' }}">
                                <a class="nav-link {{ request()->routeIs('user.product.order.all') ? 'active' : '' }}"
                                    href="{{ route('user.product.order.all') }}">
                                    {{ __('My Orders') }}
                                </a>
                            </li>

                            @if (moduleExists('Chat'))
                                <li class="nav-item {{ request()->routeIs('frontend.chat.home') ? 'active' : '' }}">
                                    <a class="nav-link {{ request()->routeIs('frontend.chat.home') ? 'active' : '' }}"
                                        href="{{ route('frontend.chat.home') }}">
                                        {{ __('Chat List') }}
                                    </a>
                                </li>
                            @endif

                            @if (moduleExists('Refund'))
                                <li
                                    class="nav-item {{ request()->routeIs('user.product.refund-request') ? 'active' : '' }}">
                                    <a class="nav-link {{ request()->routeIs('user.product.refund-request') ? 'active' : '' }}"
                                        href="{{ route('user.product.refund-request') }}">
                                        {{ __('Refund Requests') }}
                                    </a>
                                </li>
                            @endif

                            {{-- <li class="nav-item {{ request()->routeIs('user-home.wallet.history') ? 'active' : '' }}">
                            <a class="nav-link {{ request()->routeIs('user-home.wallet.history') ? 'active' : '' }}"
                                href="{{ route('user-home.wallet.history') }}">
                                {{ __('Wallet History') }}
                            </a>
                        </li> --}}

                            <li class="nav-item {{ request()->routeIs('user.shipping.address.all') ? 'active' : '' }}">
                                <a class="nav-link {{ request()->routeIs('user.shipping.address.all') ? 'active' : '' }}"
                                    href="{{ route('user.shipping.address.all') }}">
                                    {{ __('Shipping Address') }}
                                </a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('user.home.support.tickets') ? 'active' : '' }}">
                                <a class="nav-link {{ request()->routeIs('user.home.support.tickets') ? 'active' : '' }}"
                                    href="{{ route('user.home.support.tickets') }}">
                                    {{ __('Support Tickets') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout_submit_btn').click();">
                                    {{ __('Sign Out') }}
                                </a>

                                <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                    style="display:none;">
                                    @csrf
                                    <button id="logout_submit_btn" type="submit"></button>
                                </form>
                            </li>

                        </ul>

                        <style>
                            .nav-item:has(.nav-link.active) {
                                background-color: #e9ecef;
                            }
                        </style>

                        <div class="tab-content dashboard__card">
                            <div class="tab-pane active">
                                <div class="message-show margin-top-10">
                                    <x-msg.success />
                                    <x-msg.error />
                                </div>

                                @yield('section')

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('select[name="country"] option[value="{{ optional(auth()->guard('web')->user())->country }}"]')
                .attr('selected', true);
        });

        $(document).on('click', '.bodyUser_overlay', function() {
            $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
        });

        $(document).on('click', '.mobile_nav', function() {
            $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
        });
    </script>
@endsection
