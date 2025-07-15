@extends('backend.admin-master')

@section('site-title')
    {{ __('Mobile Sliders') }}
@endsection

@section('style')
    <x-bulk-action.css />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-msg.error />
            <x-msg.flash />
            <div class="btn-wrapper mb-4">
                <a class="cmn_btn btn_bg_profile" href="{{ route('admin.mobile.slider.create') }}">{{ __('Create') }}</a>
            </div>
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title">{{ __('Mobile Sliders List') }}</h4>
                </div>
                <div class="dashboard__card__body mt-4">
                    <div class="table-responsive">
                        <table class="table table-default" id="dataTable">
                            <thead>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Button Text') }}</th>
                                <th>{{ __('Button URL') }}</th>
                                <th>{{ __('Action') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($mobileSliders as $slider)
                                    <tr>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->description }}</td>
                                        <td style="width: 120px">
                                            {!! render_image_markup_by_attachment_id($slider->image_id) !!}
                                        </td>
                                        <td>{{ $slider->button_text }}</td>
                                        <td>{{ $slider->url }}</td>
                                        <td>
                                            @can('state-edit')
                                                <a class="btn btn-warning text-dark btn-sm btn-xs mb-2 me-1"
                                                    title="{{ __('Edit Data') }}"
                                                    href="{{ route('admin.mobile.slider.edit', $slider->id) }}">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                            @endcan
                                            @can('state-delete')
                                                <x-table.btn.swal.delete :route="route('admin.mobile.slider.delete', $slider->id)" />
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
@endsection

@section('script')
    <x-media.js />
    <x-table.btn.swal.js />
@endsection
