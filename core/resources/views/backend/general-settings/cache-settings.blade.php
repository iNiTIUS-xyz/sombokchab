@extends('backend.admin-master')
@section('site-title')
    {{ __('Cache Settings') }}
@endsection
@section('content')

    <style>
        #cache_settings_form {
            display: flex; 
            justify-content: space-between; 
            align-items: center;
        }

        #cache_settings_form button{
            width: 100%;
        }

        @media (max-width: 768px) {
            #cache_settings_form {
                flex-direction: column;
                align-items: flex-start; /* or center, depending on your design */
            }

             #cache_settings_form button{
                width: 85%;
            }
        }
    </style>

    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-12">
                @include('backend.partials.message')
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Cache Settings') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form">
                        <form action="{{ route('admin.general.cache.settings') }}" method="POST" id="cache_settings_form"
                            enctype="multipart/form-data" class="" style="">
                            @csrf
                            <input type="hidden" name="cache_type" id="cache_type" class="form-control">
                            {{-- <div class="row">
                                <div class="col-md-3">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="cmn_btn w-100 btn_bg_profile mt-4 clear-cache-submit-btn" data-value="route">
                                        {{ __('Clear Route Cache') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="cmn_btn w-100 btn_bg_profile mt-4 clear-cache-submit-btn" data-value="config">
                                        {{ __('Clear Configure Cache') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="cmn_btn w-100 btn_bg_profile mt-4 clear-cache-submit-btn" data-value="cache">
                                        {{ __('Clear Cache') }}
                                    </button>
                                </div>
                            </div> --}}
                                <button class="cmn_btn btn_bg_profile m-4 clear-cache-submit-btn" data-value="view">
                                    {{ __('Clear View Cache') }}
                                </button>
                                <button class="cmn_btn btn_bg_profile m-4 clear-cache-submit-btn" data-value="route">
                                    {{ __('Clear Route Cache') }}
                                </button>
                                <button class="cmn_btn btn_bg_profile m-4 clear-cache-submit-btn" data-value="config">
                                    {{ __('Clear Configure Cache') }}
                                </button>
                                <button class="cmn_btn btn_bg_profile m-4 clear-cache-submit-btn" data-value="cache">
                                    {{ __('Clear Cache') }}
                                </button>
                        </form>
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

            $(document).ready(function() {
                $(document).on('click', '.clear-cache-submit-btn', function(e) {
                    e.preventDefault();
                    $('#cache_type').val($(this).data('value'));
                    $('#cache_settings_form').trigger('submit');
                });
            });


        })(jQuery);
    </script>
@endsection
