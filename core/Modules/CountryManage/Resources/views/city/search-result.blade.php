<div class="table-responsive">
    <table class="table bg-light" id="dataTable">
        <thead>
            <tr>
                <th class="no-sort">
                    <div class="mark-all-checkbox">
                        <input type="checkbox" class="all-checkbox">
                    </div>
                </th>
                {{-- <th>{{ __('Serial No.') }}</th> --}}
                <th>{{ __('City') }}</th>
                <th>{{ __('Province') }}</th>
                <th>{{ __('Country') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_cities as $city)
                <tr>
                    <td>
                        <x-bulk-action.bulk-delete-checkbox :id="$city->id" />
                    </td>
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->state?->name }}</td>
                    <td>{{ $city->country?->name }}</td>
                    <td>
                        <x-status.table.active-inactive :status="$city->status" />
                    </td>
                    <td>
                        {{-- <x-status.table.status-change :url="route('admin.city.status', $city->id)" /> --}}
                        <a href="javascript:;" title="{{ __('Edit Data') }}"
                            class="btn btn-warning btn-sm text-dark edit_city_modal" data-bs-toggle="modal"
                            data-bs-target="#editCityModal" data-city="{{ $city->name }}"
                            data-city_id="{{ $city->id }}" title="{{ __('Edit Data') }}"
                            data-state_id="{{ $city->state_id }}" data-country_id="{{ $city->country_id }}" data-city_status="{{ $city->status }}">
                            <i class="ti-pencil"></i>
                        </a>
                        <x-popup.delete-popup :url="route('admin.city.delete', $city->id)" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
