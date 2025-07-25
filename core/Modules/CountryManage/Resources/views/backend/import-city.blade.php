@extends('backend.admin-master')
@section('site-title')
    {{ __('Import City') }}
@endsection
@section('style')
    <style>
        .form-control[type=file]:not(:disabled):not([readonly]) {
            padding-top: 12px!important;
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <x-msg.error />
        <x-msg.flash />
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Import City') }} <small>(only csv file)</small></h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(empty($import_data))
                            <form action="{{route('admin.city.import.csv.update.settings')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="#">{{__('File')}}</label>
                                    <input type="file" name="csv_file" accept=".csv" class="form-control" required>
                                    <small class="text-primary">{{__('Only csv files are allowed.')}}</small>
                                </div>
                                <button type="submit" class="btn btn-primary loading-btn">{{__('Submit')}}</button>
                            </form>
                        @else
                            @php
                                $option_markup = '';
                                    foreach(current($import_data) as $map_item ){
                                        $option_markup .= '<option value="'.trim($map_item).'">'.$map_item.'</option>';
                                    }
                            @endphp

                            <form action="{{route('admin.city.import.database')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @csrf
                                <table class="table table-striped">
                                    <thead>
                                    <th style="width: 200px">{{{__('Field Name')}}}</th>
                                    <th>{{{__('Set Field')}}}</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><h6>{{__('Country')}}</h6></td>
                                        @php $countries = \Modules\CountryManage\Entities\Country::where('status', 1)->get(); @endphp
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" name="country_id" id="country_id">
                                                    <option value="">{{ __('Select Country') }}</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="text-info">{{ __('Select state country ') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>{{__('State')}}</h6></td>
                                        @php $cities = \Modules\CountryManage\Entities\State::where('status', 'publish')->get(); @endphp
                                        <td>
                                            <div class="form-group">
                                                <select name="state_id" id="state_id" class="get_country_state form-control">
                                                    <option value="">{{ __('Select State') }}</option>
                                                </select>
                                            </div>
                                            <p class="text-info">{{ __('Select cities state ') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>{{__('City')}}</h6></td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control mapping_select">
                                                    <option value="">{{__('Select Field')}}</option>
                                                    {!! $option_markup !!}
                                                </select>
                                                <input type="hidden" name="city">
                                            </div>
                                            <p class="text-info">{{ __('Select city and only unique cities added automatically according to the selected country and state.') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>{{__('Status')}}</h6></td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control mapping_select">
                                                    <option value="publish">{{__('Publish')}}</option>
                                                    <option value="draft">{{__('Draft')}}</option>
                                                </select>
                                                <input type="hidden" name="status" value="publish">
                                            </div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                                <button type="submit" class="cmn_btn btn_bg_profile mt-4 loading-btn">{{__('Import')}}</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                // Add CSRF token to the AJAX request headers
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).on('click','.loading-btn',function (){
                    $(this).append('<i class="ml-2 fas fa-spinner fa-spin"></i>')
                });

                $(document).on('change','.mapping_select',function (){
                    $('.mapping_select option').attr('disabled',false);
                    $(this).next('input').val($(this).val());
                    let allValue = $('.mapping_select');
                    $.each(allValue,function (index,item){
                        $('.mapping_select option[value="'+$(this).val()+'"]').attr('disabled',true);
                    });
                })

                // change country and get state
                $('#country_id').on('change', function() {
                    let country = $(this).val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('au.state.all') }}",
                        data: {
                            country: country
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                let all_options = "<option value=''>{{__('Select State')}}</option>";
                                let all_state = res.states;
                                $.each(all_state, function(index, value) {
                                    all_options += "<option value='" + value.id + "'>" + value.name + "</option>";
                                });
                                $(".get_country_state").html(all_options);
                                if(all_state.length <= 0){
                                    $(".info_msg").html('<span class="text-danger"> {{ __('No state found for selected country!') }} <span>');
                                }
                            }
                        }
                    })
                })

            });
        }(jQuery));
    </script>
@endsection
