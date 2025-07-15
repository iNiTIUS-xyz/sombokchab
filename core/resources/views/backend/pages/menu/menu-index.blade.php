@extends('backend.admin-master')
@section('site-title')
    {{ __('All Menus') }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-6">
                <x-msg.error />
                <x-msg.success />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Menus') }}</h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-wrap">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_menu as $data)
                                        <tr>
                                            <td>{{ $data->title }}</td>
                                            <td>
                                                @if ($data->status == 'default')
                                                    <span class="badge bg-primary">{{ __('Default Menu') }}</span>
                                                @else
                                                    @can('menu-default')
                                                        <form action="{{ route('admin.menu.default', $data->id) }}" method="post">
                                                            @csrf
                                                            <button type="submit" title="{{ __('Set Default') }}"
                                                                class="btn btn-secondary btn-sm set_default_menu">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                    fill="currentColor" class="bi bi-bookmark-check-fill"
                                                                    viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd"
                                                                        d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z">
                                                                    </path>
                                                                </svg> {{ __('Set Default') }}
                                                            </button>
                                                        </form>
                                                    @endcan
                                                @endif
                                            </td>
                                            <td>

                                                @can('menu-edit')
                                                    <a class="btn btn-lg btn-warning text-dark btn-sm mb-2 me-1"
                                                        title="{{ __('Edit Data') }}"
                                                        href="{{ route('admin.menu.edit', $data->id) }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('menu-delete')
                                                    @if ($data->status != 'default')
                                                        <x-delete-popover :url="route('admin.menu.delete', $data->id)" />
                                                    @endif
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
            @can('menu-new-menu')
                <div class="col-lg-6">
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__title">{{ __('Add New Menu') }}</h4>
                        </div>
                        <div class="dashboard__card__body custom__form mt-4">
                            <form action="{{ route('admin.menu.new') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="title">{{ __('Title') }}</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="{{ __('Enter title') }}">
                                        </div>
                                        <div class="form-group mt-4">
                                            <button id="submit" type="submit" class="cmn_btn btn_bg_profile">
                                                {{ __('Add') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection

@section('script')
    <script>
        < x - btn.submit / >
    </script>
@endsection