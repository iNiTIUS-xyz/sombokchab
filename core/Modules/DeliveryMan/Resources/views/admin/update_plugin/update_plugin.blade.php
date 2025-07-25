@extends('backend.admin-master')
@section('site-title')
    {{ __('License Settings') }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-12 col-md-6">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">
                            {{__("Delivery Man License Settings")}}
                            <button class="btn btn-sm btn-info"
                                    style="padding: 5px; margin-left: 20px"
                                    data-bs-toggle="modal"
                                    data-bs-target="#licenseRequestModal"
                            >{{__("Get License Key")}}</button>
                        </h4>
                        @if('verified' == get_static_option('item_license_status'))
                            <div class="alert alert-success">{{__('Your Application is Registered')}}</div>
                        @endif
                        <form action="{{route('admin.delivery-man.license_update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="site_license_key">{{__('License Key')}}</label>
                                <input type="text" name="delivery_man_license_key"  class="form-control" value="{{get_static_option('delivery_man_license_key')}}" >
                                <small>{{__("enter license key, which you get in your email after verify your license while install or you can get your license by click on \"Get License Key\", then system will send you a license code into your email, check your email inbox and spam folder as well. ")}}</small>
                            </div>
                            <div class="form-group">
                                <label for="envato_username">{{__('Envato Username')}}</label>
                                <input type="text" class="form-control"  name="envato_username" value="{{get_static_option("license_username")}}">
                            </div>
                            <button type="submit" id="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Submit Information')}}</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="col-lg-12 col-ml-12">
                    <div class="row">
                        <div class="col-12">
                            {{-- @include('backend.partials.message') --}}
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title"> {{__("Check Update")}}</h4>
                                    <button type="button" class="btn btn-primary mt-4 pr-4 pl-4" id="click_for_check_update"> <i class="fas fa-spinner fa-spin d-none"></i> {{__('Click to check For Update')}}</button>
            
                                    <div id="update_notice_wrapper" class="d-none text-center">
            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-media.markup/>
            </div>
        </div>
    </div>

    <div class="modal fade" id="licenseRequestModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Request for license key...')}}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route("admin.general.license.key.generate")}}" id="user_password_change_modal_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">{{__('Your Email')}}</label>
                            <input type="email" class="form-control" name="email" value="{{get_static_option("license_email")}}">
                            <small>{{__("Make sure you have given valid email, we will send you license key for enable one click update, We'll email you script updates - no spam, just the good stuff!")}} 🌟✉️</small>
                        </div>
                        <div class="form-group">
                            <label for="envato_username">{{__('Envato Username')}}</label>
                            <input type="text" class="form-control"  name="envato_username" value="{{get_static_option("license_username")}}">
                        </div>
                        <div class="form-group">
                            <label for="envato_purchase_code">{{__('Envato Purchase code')}}</label>
                            <input type="text" class="form-control" name="envato_purchase_code" value="{{get_static_option("license_purchase_code")}}">
                            <small>{{__('follow this article to know how you will get your envato purchase code for this script')}}
                                <a href="https://xgenious.com/where-can-i-find-my-purchase-code-at-codecanyon/">{{__('how to get envato purchase code')}}</a></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button id="update" type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section("script")
<script>
    (function($){
            "use strict";
            $(document).ready(function() {
                //todo write code
                $("body").on("click","#update_download_and_run_update",function (e){
                    e.preventDefault();

                    var el = $(this);
                    el.children().removeClass('d-none');

                    if(el.attr("disabled") != undefined && el.attr("disabled") === "disabled"){
                        return;
                    }
                    el.attr("disabled",true);
                    $.ajax({
                        url: el.attr("data-action"),
                        type: "POST",
                        data: {
                            _token : "{{csrf_token()}}",
                            version: el.attr("data-version")
                        },
                        success: function (data){
                            console.log(data);
                            el.children().addClass('d-none');
                            if(data.msg != undefined && data.msg != ""){
                                el.text(data.msg).removeClass("btn-warning").addClass("btn-"+data.type);
                            }
                        },
                        error: function (error) {
                            console.log(error)
                        }
                    });

                });


                $(document).on("click","#click_for_check_update",function (e){
                    e.preventDefault();
                    var el = $(this);
                    el.children().removeClass('d-none');
                    el.attr("disabled",true);
                    $.ajax({
                        url: "{{route('admin.delivery-man.version_check')}}",
                        type: "GET",
                        success: function (data){
                            el.children().addClass('d-none');
                            if(data.markup != ""){
                                $("#update_notice_wrapper").append(data.markup);
                            }else if(data.msg != ""){
                                $("#update_notice_wrapper").append("<div class='alert alert-"+data.type+"'>"+data.msg+"</div>");
                            }
                            $("#update_notice_wrapper").removeClass('d-none');
                            el.hide();
                        },
                        error: function (error) {
                            console.log(error)
                        }
                    });
                });

            });
        }(jQuery));
</script>
    <script>
        (function($){
            "use strict";

            $(document).ready(function () {
                <x-btn.custom :id="'submit'" :title="__('Verifying')" />
            });
        })(jQuery);
    </script>



@endsection