@extends('frontend.user.dashboard.user-master')

@section('section')
    <div class="btn-wrapper">
        <a href="{{ route('user.shipping.address.new') }}" class="cmn_btn btn_bg_1">
            {{ __('Add Shipping Address') }}
        </a>
    </div>
    @if ($all_shipping_address && $all_shipping_address->count())
        <div class="dashboard__card__shipping mt-4">
            <div class="dashboard__card__header">
                <h4 class="dashboard__card__title">
                    {{ __('Shipping Address') }}
                </h4>
            </div>
            <div class="dashboard__card__body mt-4">
                <div class="table-responsive table-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Serial No.') }}</th>
                                <th>{{ __('Full Name') }}</th>
                                <th>{{ __('Address') }}</th>
                                <th>{{ __('Is Default') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach ($all_shipping_address as $address)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $address->name }}</td>
                                    <td>{{ $address->address }}</td>
                                    <td>{{ $address->is_default == 1 ? 'Yes' : 'No' }}</td>
                                    <td>
                                        @if ($address->is_default != 1)
                                            <a href="{{ route('user.shipping.address.make-default', $address->id) }}"
                                                class="btn btn-success btn-xs mb-2 me-1" title="Make Default">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M6 2a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6H6zm7 1.5L18.5 9H13V3.5z">
                                                    </path>
                                                </svg>
                                            </a>
                                        @else
                                            <button class="btn btn-success bg-success text-white btn-xs px-4 mb-2 me-1"
                                                type="button" title="Default shipping">
                                                {{ __('Default') }}
                                            </button>
                                        @endif
                                        <a href="{{ route('user.shipping.address.edit', $address->id) }}"
                                            class="btn btn-sm btn-warning btn-xs mb-2 me-1" title="Edit Address">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <x-table.btn.swal.delete :route="route('shipping.address.delete', $address->id)" title="Delete Address" />
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                        <tbody>
                            @foreach ($all_shipping_address as $address)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $address->name }}</td>
                                    <td>{{ $address->address }}</td>
                                    <td>
                                        @if ($address->is_default == 1)
                                            <span class="badge bg-primary text-white">Default</span>
                                        @else
                                            <a href="{{ route('user.shipping.address.make-default', $address->id) }}"
                                            class="btn btn-secondary btn-xs mb-2 me-1" title="Make Default">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                                                </svg>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('user.shipping.address.edit', $address->id) }}"
                                        class="btn btn-sm btn-warning btn-xs mb-2 me-1" title="Edit Address">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <x-table.btn.swal.delete :route="route('shipping.address.delete', $address->id)" title="Delete Address" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    {!! $all_shipping_address->links() !!}
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
