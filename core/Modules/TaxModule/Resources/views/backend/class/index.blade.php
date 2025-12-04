@extends('backend.admin-master')
@section('site-title', __('Tax Class'))

@section('style')

@endsection

@section('content')
    <div>
        <x-msg.flash />
        <x-msg.error />
    </div>

    <div class="col-lg-12 col-ml-12">
        <div class="row g-4">
            <div class="col-lg-12">

                <div class="btn-wrapper d-flex">
                    <a class="cmn_btn btn_bg_profile mb-4" data-bs-toggle="modal" data-bs-target="#add_tax_class">
                        {{ __('Add New Tax Class') }}
                    </a>
                </div>

                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <div class="dashboard__card__header__left">
                            <h3 class="dashboard__card__title">{{ __('Manage Tax Class') }}</h3>
                            <small class="text-secondary mt-1">
                                {{ __('You cannot delete a class that still has options; either remove all its options first or perform a force delete.') }}
                            </small>
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        {{-- <th>{{ __('Serial No.') }}</th> --}}
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classes as $class)
                                        <tr>
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>{{ $class->name }}</td>
                                            <td>
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('admin.tax-module.tax-class-option', $class->id) }}"
                                                    title="{{ __('View') }}">
                                                    <i class="ti-eye"></i>
                                                </a>
                                                <button data-id="{{ $class->id }}" data-name="{{ $class->name }}"
                                                    id="updateTaxClassButton" class="btn btn-warning text-dark btn-sm"
                                                    data-bs-target="#updateTaxClass" data-bs-toggle="modal"
                                                    title="{{ __('Edit') }}">
                                                    <i class="ti-pencil"></i>
                                                </button>
                                                <button id="deleteTaxClassButton" data-id="{{ $class->id }}"
                                                    data-option-count="{{ $class->class_option_count }}"
                                                    data-href="{{ route('admin.tax-module.tax-class-delete', $class->id) }}"
                                                    class="btn btn-danger btn-sm" title="{{ __('Delete Data') }}">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_tax_class" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom__form">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Tax Class') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{ route('admin.tax-module.tax-class') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="#tax-class-name" class="form-label">
                                {{ __('Name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input name="name" type="text" class="form-control"
                                placeholder="{{ __('Enter tax name') }}" required="" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button id="submit" type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateTaxClass" tabindex="-1" aria-labelledby="exampleUpdateTaxClass" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content custom__form">
                <form action="{{ route('admin.tax-module.tax-class') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="" id="tax-class-id" class="form-control">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Update Tax Class') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="#update-tax-class-name" class="form-label">
                                {{ __('Name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input id="update-tax-class-name" name="name" type="text" class="form-control"
                                placeholder="{{ __('Enter tax name') }}" required="" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on("click", "#updateTaxClassButton", function() {
            $("#updateTaxClass #tax-class-id").val($(this).attr("data-id"));
            $("#updateTaxClass #update-tax-class-name").val($(this).attr("data-name"));

        })
        $(document).on("click", "#deleteTaxClassButton", function() {
            let countOption = $(this).attr("data-option-count");
            let formData = new FormData();
            formData.append("_method", "DELETE");
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("id", $(this).attr("data-id"));

            if (countOption > 0) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "if delete this tax class then all tax class option will be deleted and You won't be able to revert those!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#55545b',
                    confirmButtonText: "{{ __('Yes, delete it!') }}",
                    cancelButtonText: "{{ __('No') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        send_ajax_request("GET", formData, $(this).data("data-href"), () => {
                            // before send request
                            toastr.warning("Request send please wait while");
                        }, (data) => {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );

                            $(this).parent().parent().remove();
                        }, (data) => {
                            prepare_errors(data);
                        })
                    }
                });
            }

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#55545b',
                confirmButtonText: "{{ __('Yes, delete it!') }}",
                cancelButtonText: "{{ __('No') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    send_ajax_request("post", formData, $(this).data("data-href"), () => {
                        // before send request
                        toastr.warning("Request send please wait while");
                    }, (data) => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );

                        $(this).parent().parent().remove();
                    }, (data) => {
                        prepare_errors(data);
                    })
                }
            });
        });
    </script>
@endsection
