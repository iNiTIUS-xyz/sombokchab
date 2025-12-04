@extends('vendor.vendor-master')

@section('site-title', __('Notification list page'))

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
                        @foreach ($notifications as $notification)
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
                                    <td class="{{ $notification->type == 'stock_out' ? 'bg bg-warning' : '' }}">
                                        <div class="notification-list-flex d-flex">
                                            <div class="notification-icon ml-3">
                                                <i class="las la-bell"></i>
                                            </div>
                                            <div class="notification-contents">
                                                <a class="list-title" href="javascript:;"
                                                    onclick="markAsReadAndRedirect('{{ route('notification.markAsRead', $notification->id) }}', '{{ $href }}')">
                                                    {!! str_replace(
                                                        ['{product_name}', '{vendor_text}'],
                                                        ["<b>$productName</b>", ''],
                                                        formatNotificationText(strip_tags($notification->message)),
                                                    ) !!} </a>

                                                @if ($notification->is_read_vendor == 0)
                                                    <i class="las la-eye ml-2 text-success" title="Unread"></i>
                                                @else
                                                    <i class="las la-eye-slash ml-2 text-muted" title="Read"></i>
                                                @endif
                                                <span class="list-sub">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                @else
                                    <td>
                                        <div class="notification-list-flex d-flex"
                                            @if ($notification->is_read_vendor == 0) style="font-weight: bold;" @endif>
                                            <div class="notification-icon ml-3">
                                                <i class="las la-bell"></i>
                                            </div>
                                            <a class="list-title" href="javascript:;"
                                                onclick="markAsReadAndRedirect('{{ route('notification.markAsRead', $notification->id) }}', '{{ $href }}')">

                                                @if ($notification->is_read_vendor == 0)
                                                    <b>
                                                        {{ $notification->message }}
                                                    </b>
                                                @else
                                                    {{ $notification->message }}
                                                @endif

                                                @if ($notification->is_read_vendor == 0)
                                                    <i class="las la-eye ml-2 text-success" title="Unread"></i>
                                                @else
                                                    <i class="las la-eye-slash ml-2 text-muted" title="Read"></i>
                                                @endif
                                                <span class="list-sub">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </a>
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
            console.log("Mark URL:", markUrl);
            console.log("Redirect URL:", redirectUrl);

            fetch(markUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    console.log("Fetch response:", response.status);
                    window.location.href = redirectUrl;
                })
                .catch(err => {
                    console.error("Fetch error:", err);
                    window.location.href = redirectUrl;
                });
        }
    </script>
@endsection
