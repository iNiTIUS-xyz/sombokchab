@extends('backend.admin-master')

@section('site-title')
    {{ __('Mobile vendor intros') }}
@endsection

@section('style')
    <x-bulk-action.css />
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="btn-wrapper mb-4">
                    <a class="cmn_btn btn_bg_profile" href="{{ route('admin.mobile.vendor.intro.create') }}">
                        {{ __('Create') }}
                    </a>
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Mobile Intro List') }}</h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('image') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($mobileIntros as $slider)
                                        <tr>
                                            <td>{{ $slider->title }}</td>
                                            <td>{{ $slider->description }}</td>
                                            <td>
                                                <div class="table-image image_70">
                                                    {!! render_image($slider->image) !!}
                                                </div>
                                            </td>
                                            <td>
                                                <a class="btn btn-warning text-dark btn-sm btn-xs mb-2 me-1"
                                                    title="{{ __('Edit Data') }}"
                                                    href="{{ route('admin.mobile.vendor.intro.edit', $slider->id) }}">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                                <x-table.btn.swal.delete :route="route('admin.mobile.vendor.intro.delete', $slider->id)" />
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
@endsection

@section('script')
    <x-media.js />
    <x-table.btn.swal.js />
@endsection
