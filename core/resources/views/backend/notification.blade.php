@extends('backend.admin-master')

@section('site-title', __('Notification list page'))

@section('style')
<style>
/* ==========================
   Notification List Styling
========================== */

.notification-row {
    cursor: pointer;
    transition: background-color 0.25s ease-in-out, color 0.25s ease-in-out;
}

/* Unread rows — soft tinted background */
.notification-row.unread {
    background-color: rgba(var(--main-color-one-rgb, 0, 128, 0), 0.2);
}

/* Hover effect for all rows (read + unread) */
.notification-row:hover {
    background-color: var(--main-color-one);
    color: #fff;
}

/* Make icons adapt to hover */
.notification-row:hover .notification-icon i,
.notification-row:hover .notification-status-icon i {
    color: #fff !important;
}

/* Notification icon */
.notification-icon i {
    font-size: 22px;
    line-height: 1;
    vertical-align: middle;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Notification content area */
.notification-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

/* Status icon (read/unread) */
.notification-status-icon i {
    font-size: 20px;
    vertical-align: middle;
}

.notification-status-icon i.las.la-envelope {
    color: var(--main-color-one);
}

/* Subtext styling (timestamp) */
.list-sub {
    font-size: 13px;
    color: #6b7280; /* Tailwind gray-500 style */
}

/* Text adjustments for hover */
.notification-row:hover .list-title,
.notification-row:hover .list-sub {
    color: #fff !important;
}

</style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ __('Notifications') }}</h2>
        </div>
        <div class="card-body">
            @php
                $type = $type ?? 'admin';
            @endphp
            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>{{ __('Message') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($notifications as $key => $notification)
                            @php

                                $namespace = new $notification->model();
                                $productName = '';

                                if ($notification->type == 'product') {
                                    $productName = $namespace->select('id', 'name')->find($notification->model_id)
                                        ?->name;
                                }

                                $href = \App\Http\Services\NotificationService::generateUrl($type, $notification);
                            @endphp

                            <tr>
                                @if ($notification->type == 'product')
                                    <td class="">
                                        <div class="notification-list-flex d-flex">
                                            <div class="notification-icon ml-3">
                                                <i class="las la-bell"></i>
                                            </div>
                                            <div class="notification-contents">
                                                <a class="list-title" href="javascript:;"
                                                    onclick="markAsReadAndRedirect('{{ route('notification.markAsRead', $notification->id) }}', '{{ $href }}')"
                                                    @if ($notification->is_read_admin == 0) style="font-weight: bold;" @endif>
                                                    {!! str_replace(
                                                        ['{product_name}', '{vendor_text}'],
                                                        ["<b>$productName</b>", ''],
                                                        formatNotificationText(strip_tags($notification->message)),
                                                    ) !!}

                                                    @if ($notification->is_read_admin == 0)
                                                        <i class="las la-eye ml-2 text-success" title="Unread"></i>
                                                    @else
                                                        <i class="las la-eye-slash ml-2 text-muted" title="Read"></i>
                                                    @endif
                                                </a>
                                                <span class="list-sub">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                @else
                                    <td>
                                        <div class="notification-list-flex d-flex">
                                            <div class="notification-icon ml-3">
                                                <i class="las la-bell"></i>
                                            </div>
                                            <a class="list-title" href="javascript:;"
                                                onclick="markAsReadAndRedirect('{{ route('notification.markAsRead', $notification->id) }}', '{{ $href }}')"
                                                @if ($notification->is_read_admin == 0) style="font-weight: bold;" @endif>

                                                @if ($notification->is_read_admin == 0)
                                                    <b>
                                                        {{ $notification->message }}
                                                    </b>
                                                @else
                                                    {{ $notification->message }}
                                                @endif

                                                @if ($notification->is_read_admin == 0)
                                                    <i class="las la-eye ml-2 text-success" title="Unread"></i>
                                                @else
                                                    <i class="las la-eye-slash ml-2 text-muted" title="Read"></i>
                                                @endif
                                            </a>
                                            <span class="list-sub">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach --}}

                        @foreach ($notifications as $key => $notification)
                            @php
                                $namespace = new $notification->model();
                                $productName = '';

                                if ($notification->type == 'product') {
                                    $productName = $namespace->select('id', 'name')->find($notification->model_id)?->name;
                                }

                                $href = \App\Http\Services\NotificationService::generateUrl($type, $notification);
                                $isUnread = $notification->is_read_admin == 0;
                            @endphp

                            <tr class="notification-row {{ $isUnread ? 'unread' : '' }}"
                                onclick="markAsReadAndRedirect('{{ route('notification.markAsRead', $notification->id) }}', '{{ $href }}')"
                                style="cursor: pointer;">
                                <td>
                                    <div class="d-flex align-items-center justify-content-between p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="notification-icon text-primary mr-3 d-flex align-items-center">
                                                <i class="las la-bell text-lg"></i>
                                            </div>
                                            <div class="notification-content">
                                                <div class="list-title" @if($isUnread) style="font-weight:bold;" @endif>
                                                    {!! str_replace(
                                                        ['{product_name}', '{vendor_text}'],
                                                        ["<b>$productName</b>", ''],
                                                        formatNotificationText(strip_tags($notification->message)),
                                                    ) !!}
                                                </div>
                                                <span class="list-sub text-muted small">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="notification-status-icon">
                                            @if ($isUnread)
                                                <i class="las la-envelope" title="Unread"></i>
                                            @else
                                                <i class="las la-envelope-open text-muted" title="Read"></i>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function markAsReadAndRedirect(markUrl, redirectUrl) {
            fetch(markUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    window.location.href = redirectUrl;
                } else {
                    console.error('Failed to mark as read.');
                    window.location.href = redirectUrl; // still redirect
                }
            }).catch(err => {
                console.error(err);
                window.location.href = redirectUrl;
            });
        }
    </script>
@endsection
