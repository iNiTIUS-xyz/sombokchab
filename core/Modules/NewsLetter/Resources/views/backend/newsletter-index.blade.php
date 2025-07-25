@extends('backend.admin-master')

@section('style')
    <x-summernote.css />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
@endsection

@section('site-title')
    {{ __('Newsletter Subscribers') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row g-4">
            <div class="col-lg-12">
                <x-msg.success />
                <x-msg.error />
                @can('newsletter-new')
                    <div class="btn-wrapper mb-4">
                        <button class="cmn_btn btn_bg_profile" data-bs-toggle="modal" data-bs-target="#new_subscribe_model">
                            {{ __('Add New Subscribe') }}
                        </button>
                    </div>
                @endcan
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Newsletter Subscribers') }}</h4>
                        <div class="btn-wrapper d-flex">
                            @can('newsletter-bulk-action')
                                <div class="bulk-delete-wrapper">
                                    <div class="select-box-wrap d-flex">
                                        <select name="bulk_option" id="bulk_option">
                                            <option value="">{{ __('Bulk Action') }}</option>
                                            <option value="delete">{{ __('Delete') }}</option>
                                        </select>
                                        <button class="btn btn-primary btn-sm px-5" id="bulk_delete_btn">
                                            {{ __('Apply') }}
                                        </button>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    @can('newsletter-bulk-action')
                                        <th class="no-sort">
                                            <div class="mark-all-checkbox">
                                                <input type="checkbox" class="all-checkbox">
                                            </div>
                                        </th>
                                    @endcan
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Subscribe Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_subscriber as $data)
                                        <tr>
                                            @can('newsletter-bulk-action')
                                                <td>
                                                    <div class="bulk-checkbox-wrapper">
                                                        <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]"
                                                            value="{{ $data->id }}">
                                                    </div>
                                                </td>
                                            @endcan
                                            <td>{{ $data->email }} @if ($data->verified > 0)
                                                <i class="las la-check-circle text-primary"></i>
                                            @endif
                                            </td>
                                            <td>
                                                @if ($data->subscribe_status == 0)
                                                    <span class="badge bg-danger">{{ __('Unsubscribed') }}</span>
                                                @else
                                                    <span class="badge bg-primary">{{ __('Subscribed') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @can('newsletter-newsletter-verify-mail-send')
                                                    <a class="btn btn-lg btn-success btn-sm mb-2 me-2 send_mail_modal_btn" href="#1"
                                                        data-bs-toggle="modal" data-bs-target="#send_mail_to_subscriber_modal"
                                                        data-email="{{ $data->email }}" data-id="{{ $data->id }}"
                                                        title="{{ __('Send Mail') }}">
                                                        <i class="ti-email"></i>
                                                    </a>

                                                    {{-- @if ($data->verified < 1) <form class="mb-2 me-2"
                                                        style="display: inline;float: left;"
                                                        action="{{ route('admin.newsletter.verify.mail.send') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                                        <button class="btn btn-sm btn-secondary" type="submit"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="{{ __('Send Verify Mail') }}">
                                                            <i class="ti-receipt"></i>
                                                        </button>
                                                        </form>
                                                        @endif --}}
                                                @endcan

                                                    @can('newsletter-delete')
                                                        <x-delete-popover :url="route('admin.newsletter.delete', $data->id)" />
                                                    @endcan
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
    @can('newsletter-newsletter-verify-mail-send')
        <div class="modal fade" id="new_subscribe_model" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add New Subscriber') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.newsletter.new.add') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="{{ __('Enter email') }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button id="submit" type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="send_mail_to_subscriber_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Send Mail to Subscriber') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.newsletter.single.mail') }}" id="send_mail_to_subscriber_edit_modal_form"
                        method="post">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="id" id="newsletter_id">
                            <div class="d-none form-group">
                                <label for="email">
                                    {{ __('Email') }}
                                </label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="{{ __('Enter email') }}">
                            </div>
                            <div class="form-group">
                                <label for="edit_icon">
                                    {{ __('Subject') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="subject" name="subject"
                                    placeholder="{{ __('Enter subject') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="message">
                                    {{ __('Message') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="hidden" name="message">
                                <div class="summernote"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button id="submit" type="submit" class="btn btn-primary">{{ __('Send Mail') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    <x-media.markup />
@endsection


@section('script')
    <script src="{{ asset('assets/backend/js/summernote-bs4.js') }}"></script>
    <x-summernote.js />
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @can('newsletter-bulk-action')
        <x-bulk-action-js :url="route('admin.newsletter.bulk.action')" />
    @endcan
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                <
                    x - btn.submit / >

                    $(document).on('click', '.send_mail_modal_btn', function () {
                        var el = $(this);
                        var id = el.data('id');
                        var email = el.data('email');
                        var form = $('#send_mail_to_subscriber_edit_modal_form');
                        form.find('#email').val(email);
                        form.find('#newsletter_id').val(id);
                    });

                $(document).on('click', '.swal_delete_button', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{ __('Are you sure?') }}',
                        text: '{{ __('You would not be able to revert this item!') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#55545b',
                        confirmButtonText: "{{ __('Yes, delete it!') }}",
                        cancelButtonText: "{{ __('No') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

                $('.summernote').summernote({
                    height: 300, //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function (contents, $editable) {
                            $(this).prev('input').val(contents);
                        },
                        onPaste: function (e) {
                            let bufferText = ((e.originalEvent || e).clipboardData || window
                                .clipboardData).getData('text/plain');
                            e.preventDefault();
                            document.execCommand('insertText', false, bufferText);
                        }
                    }
                });
            });
        })(jQuery)
    </script>
@endsection