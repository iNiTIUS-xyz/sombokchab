<table class="table table-responsive" id="dataTable">
    <thead>
        <tr>
            <th>{{ __('Serial No.') }}</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($routes as $route)
            @if ($route['permission'] ?? false)
                @can($route['permission'])
                    <tr>
                        <td><strong>{{ $loop->iteration }}</strong></td>
                        <td>
                            {{ $route['title'] }}
                            <p><small class="text-info">{{ $route['description'] }}</small></p>
                        </td>
                        <td>
                            <a href="{{ $route['route'] }}" class="btn btn-warning text-dark btn-xs mb-2 me-1"
                                title="{{ __('Edit') }}">
                                <i class="ti-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @endcan
            @endif
        @endforeach
    </tbody>
</table>
