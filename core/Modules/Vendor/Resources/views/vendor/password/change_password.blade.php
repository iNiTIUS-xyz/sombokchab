@extends('vendor.vendor-master')
@section('site-title')
    {{ __('Change Password') }}
@endsection
@section('content')
    <div class="main-content-inner margin-top-30">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('vendor.password.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="old_password">{{ __('Old Password') }}</label>
                                <div class="input-group-custom">
                                    <input type="password" class="form-control" id="old_password" name="old_password"
                                        placeholder="{{ __('Enter Old Password') }}">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn-toggle-password" data-target="old_password">
                                            <i class="la la-eye"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('New Password') }}</label>
                                <div class="input-group-custom">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="{{ __('Enter New Password') }}">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn-toggle-password" data-target="old_password">
                                            <i class="la la-eye"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Confirm Password') }}</label>
                                <div class="input-group-custom">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="{{ __('Enter Confirm Password') }}">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn-toggle-password" data-target="old_password">
                                            <i class="la la-eye"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">


                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .input-group-custom {
            position: relative;
            display: flex;
            width: 100%;
        }

        .input-group-custom .form-control {
            flex: 1;
            padding-right: 40px;
        }

        .input-group-btn {
            background: transparent;
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .btn-toggle-password {
            background: transparent;
            border: none;
            padding: 0 10px;
            height: 100%;
            cursor: pointer;
            color: gray;
            outline: none;
        }

        .btn-toggle-password:hover {
            color: #000;
        }
    </style>

    <script>
        document.querySelectorAll('.btn-toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('la-eye');
                    icon.classList.add('la-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('la-eye-slash');
                    icon.classList.add('la-eye');
                }
            });
        });
    </script>
@endsection
