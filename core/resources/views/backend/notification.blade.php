@extends('backend.admin-master')

@section('site-title', __('Notification list page'))

@section('style')

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
                        @foreach ($notifications as $key => $notification)
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
