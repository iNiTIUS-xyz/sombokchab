@extends('frontend.user.dashboard.user-master')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
@endsection

@section('section')
    <div class="btn-wrapper">
        <a href="{{ route('user.shipping.address.new') }}" class="cmn_btn btn_bg_1">
            {{ __('Add New Shipping Address') }}
        </a>
    </div>
    @if ($all_shipping_address && $all_shipping_address->count())
        <div class="dashboard__card__shipping mt-4">
            <div class="dashboard__card__header">
                {{-- <h4 class="dashboard__card__title">
                    {{ __('Shipping Address') }}
                </h4> --}}
            </div>
            <div class="dashboard__card__body mt-4">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>{{ __('Full Name') }}</th>
                                <th>{{ __('Address') }}</th>
                                <th>{{ __('Default Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_shipping_address as $address)
                                <tr>
                                    <td>{{ $address->name }}</td>
                                    <td>{{ $address->address }}</td>
                                    <td>
                                        @if ($address->is_default == 1)
                                            <span class="badge bg-primary text-white">{{ __('Yes') }}</span>
                                        @else
                                            <span class="badge bg-danger text-white">{{ __('No') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($address->is_default != 1)
                                            <a href="{{ route('user.shipping.address.make-default', $address->id) }}"
                                                class="btn btn-secondary btn-xs mb-2 me-1"
                                                title="{{ __('Make Default') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-bookmark-check-fill"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                                </svg>
                                            </a>
                                        @endif
                                        <a href="{{ route('user.shipping.address.edit', $address->id) }}"
                                            class="btn btn-sm btn-warning btn-xs mb-2 me-1" title="{{ __('Edit Data') }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <x-table.btn.swal.delete :route="route('shipping.address.delete', $address->id)" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning mt-4">
            {{ __('No shipping address found. ') }}
        </div>
    @endif
@endsection

@section('script')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <x-table.btn.swal.js />
    <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            if ($('#dataTable').length) {
                $('#dataTable').DataTable({
                    paging: true,
                    lengthChange: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    responsive: true,
                    order: [
                        [0, 'desc']
                    ],
                    pagingType: "simple_numbers",
                    language: {
                        lengthMenu: "{{ __('_MENU_ entries per page') }}",
                        search: "{{ __('Filter:') }}",
                        info: "{{ __('Showing _START_ to _END_ of _TOTAL_ entries') }}",
                        infoEmpty: "{{ __('No entries available') }}",
                        infoFiltered: "{{ __('(filtered from _MAX_ total entries)') }}",

                        zeroRecords: "{{ __('No matching records found') }}",
                        emptyTable: "{{ __('No entries available') }}",
                        paginate: {
                            previous: "{{ __('Prev') }}",
                            next: "{{ __('Next') }}"
                        },
                        emptyTable: "{{ __('No data available in table') }}"
                    }
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.bodyUser_overlay', function() {
                $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
            });
            $(document).on('click', '.mobile_nav', function() {
                $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
            });
        });
    </script>
@endsection
