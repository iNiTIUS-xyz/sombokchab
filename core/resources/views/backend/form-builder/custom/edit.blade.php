@extends('backend.admin-master')
@section('site-title')
    {{ __('Edit Form') }}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery-ui.min.css') }}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row g-4">
            <div class="col-lg-6">
                <x-msg.success />
                <x-msg.error />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Edit Form') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('admin.form.builder.update') }}" method="Post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $form->id }}">
                            <div class="form-group">
                                <label for="text">
                                    {{ __('Title') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" placeholder="{{ __('Enter title') }}" class="form-control" name="title"
                                    value="{{ $form->title }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="text">
                                    {{ __('Receiving Email') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control" name="email"
                                    placeholder="{{ __('Enter receiving email') }}" value="{{ $form->email }}" required="">
                                <span class="info-text">
                                    {{ __('your will get mail with all info of from to this email') }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="text">
                                    {{ __('Button Title') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" placeholder="{{ __('Enter button title') }}" class="form-control"
                                    name="button_title" value="{{ $form->button_text }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="success_message">
                                    {{ __('Success Message') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" placeholder="{{ __('Enter success message') }}" class="form-control"
                                    name="success_message" value="{{ $form->success_message }}" required="">
                            </div>
                            <div class="form-group">
                                {!! \App\Helpers\FormBuilderCustom::render_drag_drop_form_builder($form->fields) !!}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="cmn_btn btn_bg_profile">
                                    {{ __('Update') }}
                                </button>
                                <a href="{{ route('admin.form.builder.all') }}" class="cmn_btn default-theme-btn"
                                    style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                    {{ __('Back') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Available Form Fields') }}</h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <ul id="sortable_02" class="available-form-field form-field-space">
                            <li class="ui-state-default" type="text">
                                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                {{ __('Text') }}
                            </li>
                            <li class="ui-state-default" type="email">
                                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                {{ __('Email') }}
                            </li>
                            <li class="ui-state-default" type="tel">
                                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                {{ __('Tel') }}
                            </li>
                            <li class="ui-state-default" type="url">
                                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                {{ __('URL') }}
                            </li>
                            <li class="ui-state-default" type="select">
                                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                {{ __('Select') }}
                            </li>
                            <li class="ui-state-default" type="checkbox">
                                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                {{ __('Check Box') }}
                            </li>
                            <li class="ui-state-default" type="file">
                                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                {{ __('File') }}
                            </li>
                            <li class="ui-state-default" type="textarea">
                                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                {{ __('Textarea') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('form-builder-custom-new')
        <div class="modal fade" id="create_new_custom_form" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add New Form') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">
                            <span>×</span></button>
                    </div>
                    <form action="{{ route('admin.form.builder.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="text">{{ __('Title') }}</label>
                                <input type="text" class="form-control" name="title" placeholder="{{ __('Enter Title') }}">
                            </div>
                            <div class="form-group">
                                <label for="text">{{ __('Receiving Email') }}</label>
                                <input type="email" class="form-control" name="email" placeholder="{{ __('Email') }}">
                                <span class="info-text">
                                    {{ __('your will get mail with all info of from to this email') }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="text">{{ __('Button Title') }}</label>
                                <input type="text" class="form-control" name="button_title"
                                    placeholder="{{ __('Enter Button Title') }}">
                            </div>
                            <div class="form-group">
                                <label for="success_message">{{ __('Success Message') }}</label>
                                <input type="text" class="form-control" name="success_message"
                                    placeholder="{{ __('form submit success message') }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('script')
    <script src="{{ asset('assets/backend/js/jquery-ui.min.js') }}"></script>

    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                <
                    x - btn.save / >
                    $("#sortable").sortable({
                        axis: "y",
                        placeholder: "sortable-placeholder",
                        out: function (event, ui) {
                            setTimeout(function () {
                                var allShortableList = $("#sortable li");
                                allShortableList.each(function (index, value) {
                                    var el = $(this);
                                    el.find('.field-required').attr('name',
                                        'field_required[' + index + ']');
                                    el.find('.mime-type').attr('name', 'mimes_type[' +
                                        index + ']');
                                });
                            }, 500);
                        }
                    }).disableSelection();
                $("#sortable_02").sortable({
                    connectWith: '#sortable',
                    helper: "clone",
                    remove: function (e, li) {
                        var value = li.item.prop('type');
                        var random = Math.floor(Math.random(9999) * 999999);
                        var formFiledLength = $('#sortable li').length - 1;

                        var markup = render_drag_drop_form_field_markup(value, random,
                            formFiledLength);
                        li.item.clone()
                            .prop('id', value + '_' + random)
                            .text('')
                            .append(markup)
                            .insertAfter(li.item);
                        $(this).sortable('cancel');
                        return li.item.clone();
                    }
                }).disableSelection();

                $('.field-placeholder').on('change paste keyup', function (e) {
                    $(this).parent().parent().parent().prev().find('.placeholder-name').text($(this)
                        .val());
                });
                $('body').on('click', '.remove-fields', function (e) {
                    $(this).parent().remove();
                    $("#sortable").sortable("refreshPositions");
                });

                function render_drag_drop_form_field_markup(type, random, formFiledLength) {
                    var markup = '';
                    markup +=
                        '<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>\n <span class="remove-fields">x</span>\n<a data-bs-toggle="collapse" href="#collapseExample-' +
                        random + '" role="button" aria-expanded="false" aria-controls="collapseExample">\n' +
                        type + ': <span class="placeholder-name"></span>\n</a>\n' +
                        '<div class="collapse" id="collapseExample-' + random + '">\n' +
                        '<div class="card card-body margin-top-30">\n' +
                        '<input type="hidden" class="form-control" name="field_type[]" value="' + type + '">' +
                        '<div class="form-group">\n' +
                        '<label>Name</label>\n' +
                        '<input type="text" class="form-control" name="field_name[]" placeholder="enter field name" >\n</div>\n' +
                        '<div class="form-group">\n <label>Placeholder/Label</label>\n' +
                        ' <input type="text" class="form-control field-placeholder" name="field_placeholder[]" placeholder="enter field name" >\n' +
                        '</div>\n<div class="form-group">\n<label ><strong>Required</strong></label>\n<label class="switch">\n' +
                        '<input type="checkbox" class="field-required" name="field_required[' +
                        formFiledLength + ']" >\n' +
                        '<span class="slider-yes-no"></span>\n</label>\n</div>';
                    if (type == 'select') {
                        markup += '<div class="form-group">\n' +
                            '<label>Options</label>\n' +
                            '<textarea name="select_options[]"  class="form-control max-height-120" cols="30" rows="10" ></textarea>\n' +
                            '<small>separate option by new line </small>\n' +
                            '</div>\n';
                    }
                    if (type == 'file') {
                        markup += '<div class="form-group">\n' +
                            '<label>File Type</label>\n' +
                            '<select name="mimes_type[' + formFiledLength +
                            ']" class="form-control mime-type">\n' +
                            '<option value="mimes:jpg,jpeg,png" >jpg,jpeg,png</option>\n' +
                            '<option value="mimes:txt,pdf">txt,pdf</option>\n' +
                            '<option value="mimes:doc,docx">doc,docx</option>\n' +
                            '<option value="mimes:doc,docx,jpg,jpeg,png,txt,pdf">doc,docx,jpg,jpeg,png,txt,pdf</option>\n' +
                            '</select>\n' +
                            '</div>';
                    }

                    markup += '</div>\n  </div>';

                    return markup;
                }
            });
        }(jQuery));
    </script>
@endsection