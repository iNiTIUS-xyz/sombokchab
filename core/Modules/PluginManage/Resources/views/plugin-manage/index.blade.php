@extends('backend.admin-master')
@section('site-title')
    {{ __('All Plugins') }}
@endsection

@section('style')
    <style>
        .plugin-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1em;
        }

        .plugin-card {
            width: calc((100% - 2em) / 3);
            box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .plugin-card .thumb-bg-color {
            background-color: #009688;
            padding: 40px;
            color: #fff;
        }

        .plugin-card .thumb-bg-color strong {
            font-size: 20px;
            line-height: 26px;
        }

        .plugin-card .thumb-bg-color strong .version {
            font-size: 14px;
            line-height: 18px;
            background-color: #fff;
            padding: 5px 10px;
            display: inline-block;
            color: #333;
            border-radius: 3px;
            margin-top: 15px;
        }

        .plugin-title {
            font-size: 16px;
            font-weight: 500;
            background-color: #03A9F4;
            box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.2);
            display: inline-block;
            padding: 12px 30px;
            border-radius: 25px;
            color: #fff;
            position: relative;
            margin-top: -20px;
        }

        .plugin-title.externalplugin {
            background-color: #3F51B5;
        }

        .plugin-meta {
            font-size: 0.9em;
            color: #666;
            padding: 20px;
        }

        .padding-30 {
            padding: 30px;
        }

        .plugin-card .thumb-bg-color.externalplugin {
            background-color: #FF9800;
        }

        .plugin-card .plugin-meta {
            min-height: 50px;
        }

        .plugin-card .btn-group-wrap {
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .plugin-card .btn-group-wrap a {
            display: inline-block;
            padding: 8px 25px;
            background-color: #4b4e5b;
            border-radius: 25px;
            color: #fff;
            text-decoration: none;
            font-size: 12px;
            transition: all 300ms;
        }

        .plugin-card .btn-group-wrap a.pl_delete {
            background-color: #e13a3a;
        }

        .plugin-card .btn-group-wrap a:hover {
            opacity: .8;
        }

        @media (min-width: 900px) {
            .plugin-card {
                width: calc((100% - 3em) / 3);
            }
        }

        @media (max-width: 600px) {
            .plugin-card {
                width: calc((100% - 2em) / 2);
            }

            .plugin-card .btn-group-wrap {
                gap: 5px;
            }

            .plugin-card .btn-group-wrap a {
                padding: 7px 15px;
            }

            .plugin-title {
                font-size: 12px;
                line-height: 16px;
            }
        }

        @media (max-width: 500px) {
            .plugin-card {
                width: calc((100% - 2em) / 1);
            }

            .plugin-title {
                font-size: 16px;
                line-height: 20px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-recent-order">
        <div class="row">
            <x-flash-msg />
            <div class="col-md-12">
                <div class="recent-order-wrapper dashboard-table bg-white padding-30">
                    <div class="header-wrap">
                        <h4 class="header-title mb-2">{{ __('All Plugins') }}</h4>
                        <p>{{ __('Manage all plugins from here, you can activate/deactivate or delete any plugin.') }}</p>
                    </div>

                    <div class="plugin-grid">
                        @foreach ($pluginList as $plugin)
                            <div class="plugin-card">
                                <div
                                    class="thumb-bg-color {{ \Illuminate\Support\Str::slug($plugin->category, null, '_') }}">
                                    <strong class="{{ \Illuminate\Support\Str::slug($plugin->category, null, '_') }}">
                                        {{ $plugin->name }}
                                        <p><span class="version">{{ $plugin->version }}</span></p>
                                    </strong>
                                </div>
                                <h3 class="plugin-title {{ \Illuminate\Support\Str::slug($plugin->category, null, '_') }}">
                                    {{ $plugin->category }}</h3>
                                <p class="plugin-meta">
                                    @if (!empty($plugin->description))
                                        {{ $plugin->description }}
                                    @else
                                        {{ $plugin->name . ' ' . sprintf(__('is a %s developed by %s to enhance platform features'), $plugin->category, \Illuminate\Support\Str::slug($plugin->category, null, '_') === 'coreplugin' ? __('Core Team') : __('External Developer')) }}
                                    @endif
                                </p>

                                @if (\Illuminate\Support\Str::slug($plugin->category, null, '_') != 'coreplugin')
                                    <div class="btn-group-wrap">
                                        <a href="javascript:;" title="{{ __('Status Change') }}"
                                            data-status="{{ $plugin->status ? 1 : 0 }}"
                                            data-plugintype="{{ $plugin->category }}" data-plugin="{{ $plugin->name }}"
                                            class="pl-btn pl_active_deactive">
                                            {{ $plugin->status ? __('Deactivate') : __('Activate') }}
                                        </a>

                                        <a href="javascript:;" data-plugintype="{{ $plugin->category }}"
                                            data-plugin="{{ $plugin->name }}" class="pl-btn pl_delete"
                                            title="{{ __('Delete Plugin') }}">
                                            <i class="las la-trash-alt"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        (function($) {
            "use strict";

            // Handle plugin activation/deactivation
            $(document).on("click", ".pl_active_deactive", function(e) {
                e.preventDefault();
                var el = $(this);
                let allData = el.data();

                var swalDesc = '';
                var swalTitle = '';
                var swalBtnText = '';
                var buttonText = '';

                if (allData.status == 1) {
                    swalTitle = 'Are you sure you want to deactivate "' + allData.plugin + '" plugin?';
                    swalDesc = 'This will disable the features provided by this plugin.';
                    swalBtnText = 'Yes, deactivate it!';
                    buttonText = 'Activate';
                } else {
                    swalTitle = 'Are you sure you want to activate "' + allData.plugin + '" plugin?';
                    swalDesc = 'You are about to enable new plugin features.';
                    swalBtnText = 'Yes, Activate it!';
                    buttonText = 'Deactivate';
                }

                Swal.fire({
                    title: swalTitle,
                    text: swalDesc,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#55545b',
                    confirmButtonText: swalBtnText,
                    cancelButtonText: "No",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.plugin.manage.status.change') }}",
                            type: "post",
                            data: {
                                _token: "{{ csrf_token() }}",
                                plugin: allData.plugin,
                                status: allData.status,
                            },
                            success: function(data) {
                                location.reload();
                            }
                        });
                    }
                });
            });

            // Handle plugin deletion
            $(document).on("click", ".pl_delete", function(e) {
                e.preventDefault();
                var el = $(this);
                let allData = el.data();

                if (allData.plugintype === "Core Plugin") {
                    Swal.fire({
                        icon: 'error',
                        title: "Oops...",
                        text: "You cannot delete any core plugin.",
                        timer: 3000,
                        timerProgressBar: true,
                    });
                    return;
                }

                Swal.fire({
                    title: 'Are you sure you want to delete "' + allData.plugin + '" plugin?',
                    text: 'You will not be able to restore this plugin again!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#55545b',
                    confirmButtonText: "Yes, Delete it!",
                    cancelButtonText: "No",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('.pl_delete[data-plugin="' + allData.plugin + '"]').parent().parent().hide();
                        $.ajax({
                            url: "{{ route('admin.plugin.manage.delete') }}",
                            type: "post",
                            data: {
                                _token: "{{ csrf_token() }}",
                                plugin: allData.plugin,
                            },
                            success: function(data) {
                                location.reload();
                            }
                        });
                    }
                });
            });
        })(jQuery);
    </script>
@endsection
