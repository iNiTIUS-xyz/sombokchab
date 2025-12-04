@php
$type = $type ?? 'admin';
@endphp

<div class="single-icon-flex">
    @if (auth('vendor')->check())
    {{-- <div class="single-icon notifications-parent">
        <a class="btn btn-outline-danger site-health-btn btn-icon-text" target="__blank"
            href="{{ route('frontend.vendors.single', auth('vendor')->user()->username ?? "") }}">
            <i class="las la-eye"></i> <span class="d-none d-sm-inline-block">{{ __("Visit Store") }}</span>
        </a>
    </div> --}}
    @elseif(auth('admin')->check())
    {{-- <div class="single-icon notifications-parent">
        <a class="btn btn-outline-danger site-health-btn btn-icon-text" target="__blank" href="{{ route('homepage') }}">
            <i class="las la-eye"></i> <span class="d-none d-sm-inline-block">{{ __("Visit Site") }}</span>
        </a>
    </div> --}}
    @endif

    @if (auth('admin')->check())
    <div class="single-icon notifications-parent">
        <a class="btn btn-danger site-health-btn btn-icon-text" href="{{ route('admin.health') }}">
            <i class="las la-stethoscope"></i> <span class="d-none d-sm-inline-block">{{ __('Health') }}</span>
        </a>
    </div>
    @endif

    @if (auth('admin')->check())
    @if (auth('admin')->user()->hasRole('Super Admin'))
    @php
    $isDummy = \Modules\Product\Http\Services\Admin\DummyProductDeleteServices::isDummyProduct();
    @endphp
    @if ($isDummy)
    <div class="single-icon notifications-parent">
        <a class="btn btn-danger site-health-btn btn-icon-text" id="remove-dummy-data"
            href="{{ route('admin.products.delete_dummy_product') }}">
            <i class="las la-stethoscope"></i>
            <span class="d-none d-sm-inline-block">
                {{ __('Remove Dummy Data') }}
            </span>
        </a>
    </div>
    @endif
    @endif
    @endif
    <div class="single-icon notifications-parent cursor-pointer">
        <span class="notification-icon" id="top-bar-notification-icon">
            <i class="las la-bell"></i>
        </span>
        <div class="notification-list-wrapper">
            <h6 class="notification-title">
                {{ __('Notifications') }}
            </h6>
            <ul class="notification-list">
                @foreach (xgNotifications()->where('is_read_admin', 0)->get() as $notification)
                @php
                $namespace = new $notification->model();
                $productName = '';

                if ($notification->type == 'product') {
                $productName = $namespace->select('id', 'name')->find($notification->model_id)?->name;
                }

                $href = \App\Http\Services\NotificationService::generateUrl($type, $notification);
                $isUnread = $notification->is_read_admin == 0;
                @endphp

                <li class="list {{ $isUnread ? 'unread' : '' }}"
                    onclick="markAsReadAndRedirect('{{ route('notification.markAsRead', $notification->id) }}', '{{ $href }}')">

                    <div class="notification-list-flex d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="notification-icon mr-3">
                                <i class="las la-bell"></i>
                            </div>
                            <div class="notification-contents">
                                <a class="list-title" href="javascript:;" @if($isUnread) style="font-weight:bold;"
                                    @endif>
                                    {!! str_replace(
                                    ['{product_name}', '{vendor_text}', '{order_id}'],
                                    ["<b>$productName</b>", '', "#$notification->model_id"],
                                    formatNotificationText(strip_tags($notification->message)),
                                    ) !!}
                                </a>
                                <span class="list-sub">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        {{-- Envelope status icon --}}
                        <div class="notification-status-icon ml-2">
                            @if ($isUnread)
                            <i class="las la-envelope" title="Unread"></i>
                            @else
                            <i class="las la-envelope-open text-muted" title="Read"></i>
                            @endif
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>


            @if ($type == 'vendor')
            <a href="{{ route('vendor.notifications') }}" class="all-notification">
                {{ __('See All Notification') }}
            </a>
            @else
            <a href="{{ route('admin.notifications') }}" class="all-notification">
                {{ __('See All Notification') }}
            </a>
            @endif
        </div>
        @php
            $unreadField = $type === 'vendor' ? 'is_read_vendor' : 'is_read_admin';
            $unreadCount = xgNotifications()->where($unreadField, 0)->count();
        @endphp
        <span class="badge-icon" id="top-bar-notification-count">
            {{ $unreadCount }}
        </span>
    </div>
</div>


<style>
    /* ==========================
   Header Notification Styling
========================== */

    .notification-list-wrapper {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .notification-list {
        max-height: 300px;
        overflow-y: auto;
        padding: 0;
        margin: 0;
    }

    .notification-list .list {
        list-style: none;
        transition: background-color 0.25s ease-in-out, color 0.25s ease-in-out;
        padding: 10px 15px;
        cursor: pointer;
        border-bottom: 1px solid #f1f1f1;
    }

    /* Unread items — soft tinted background */
    .notification-list .list.unread {
        background-color: rgba(var(--main-color-one-rgb, 0, 128, 0), 0.2);
    }

    /* Hover effect (applies to both read/unread) */
    .notification-list .list:hover {
        background-color: var(--main-color-one);
        color: #fff;
    }

    /* Icons adapt to hover */
    .notification-list .list:hover .list-title,
    .notification-list .list:hover .list-sub {
        color: #fff !important;
    }

    .notification-list .list:hover .notification-icon i {
        color: var(--main-color-one) !important;
    }

    /* Notification icon */
    .notification-icon i {
        font-size: 20px;
        color: var(--main-color-one);
        vertical-align: middle;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Envelope icon styling */
    .notification-status-icon i {
        font-size: 18px;
        transition: color 0.25s ease-in-out;
        color: var(--main-color-one);
    }

    /* On hover, envelope turns white for better visibility */
    .notification-list .list:hover .notification-status-icon i {
        color: #fff !important;
    }

    .notifications-parent .notification-list .list .notification-list-flex .notification-icon {
        margin-right: 10px
    }

    /* Content wrapper */
    .notification-contents {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Timestamp */
    .list-sub {
        font-size: 12px;
        color: #6b7280;
    }

    /* Title link */
    .list-title {
        font-size: 14px;
        color: #111827;
        text-decoration: none;
    }

    .list-title b {
        font-weight: 600;
    }
</style>

<script>
    function markAsReadAndRedirect(markUrl, redirectUrl) {
        fetch(markUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(response => {
            window.location.href = redirectUrl;
        }).catch(() => {
            window.location.href = redirectUrl;
        });
    }
</script>