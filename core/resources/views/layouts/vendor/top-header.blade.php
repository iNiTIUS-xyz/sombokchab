<div class="dashboard-top-contents mb-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="top-inner-contents search-area top-searchbar-wrapper">
                <div class="dashboard-flex-contetns">
                    <div class="dashboard-left-flex">
                        <span class="date-text"></span>
                        @if (auth('vendor')->user()->is_vendor_verified && auth('vendor')->user()->verified_at)
                        <h3 class="text-success">
                            <i class="las la-user-check"></i>
                            {{ __('Verified Vendor') }}
                        </h3>
                        @else
                        <h3 class="text-danger">
                            <i class="las la-times-circle"></i>
                            {{ __('Not Verified Yet') }}
                        </h3>
                        @endif
                    </div>
                    <div class="dashboard-right-flex">
                        <div class="author-flex-contents">
                            {{-- <div class="author-icon">
                                <div class="single-icon-flex">
                                    <div class="single-icon notifications-parent">
                                        <div class="gtranslate_wrapper_vendor"></div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="author-icon">
                                <div class="single-icon-flex">
                                    <div class="single-icon notifications-parent">
                                        <x-notification.header type="vendor" />
                                    </div>
                                </div>
                            </div>
                            <div class="author-thumb-contents">
                                <div class="author-thumb" style="font-size: 24px !important; font-weight: normal;">
                                    @php
                                    $vendor = auth()->guard('vendor')->user();
                                    $profile_img = get_attachment_image_by_id($vendor->image, null, true);
                                    @endphp
                                    @if (!empty($profile_img))
                                    <img src="{{ $profile_img['img_url'] }}" alt="{{ $vendor->owner_name }}">
                                    @else
                                    <i class="las la-user"></i>
                                    @endif
                                </div>
                                <ul class="author-account-list">
                                    <li class="list">
                                        <a href="#" class="vendor_active_sidebar">
                                            Welcome, {{ $vendor->username }}
                                        </a>
                                    </li>
                                    <li class="list">
                                        <a href="{{ route('vendor.profile.update') }}">
                                            {{ __('Edit Profile') }}
                                        </a>
                                    </li>
                                    <li class="list">
                                        <a href="{{ route('vendor.password.change') }}">
                                            {{ __('Change Password') }}
                                        </a>
                                    </li>
                                    <li class="list">
                                        <a href="{{ route('vendor.logout') }}">
                                            {{ __('Sign Out') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>