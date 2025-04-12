@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Register') }}
@endsection
@section('content')
    <section class="sign-in-area-wrapper padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="sign-in register">
                        <h4 class="single-title">{{ __('Create Account') }}</h4>
                        <div class="form-wrapper custom__form mt-4">
                            <x-msg.error />
                            <x-msg.flash />
                            
                            <div class="alert alert-danger" id="error" style="display: none;"></div>
                            <div class="alert alert-success" id="sentSuccess" style="display: none;">OTP Sent Successfully!</div>
                            <div class="alert alert-success" id="verifiedSuccess" style="display: none;">OTP Verified Successfully!</div>
                        
                            <!-- Step 1: Phone Number Verification -->
                            <div id="step-1">
                                <form class="mb-3">
                                    <label>Phone Number: <span class="text-danger">*</span></label>
                                    <div class="form-group d-flex">
                                        <input type="text" id="number" class="form-control" placeholder="+880********">
                                        <button type="button" class="btn btn-submit" style="height: 48px !important;" onclick="phoneSendAuth();">Send Code</button>
                                    </div>
                                    <div id="recaptcha-container"></div>
                                </form>
                                <button type="button" class="btn btn-next step-button-outline" onclick="nextStep(1)">Next</button>
                            </div>
                        
                            <!-- Step 2: Verification Code -->
                            <div id="step-2" style="display: none;">
                                <div id="verification-form" class="mb-3">
                                    <form>
                                        <div class="form-group d-flex">
                                            <input type="text" id="verificationCode" class="form-control" placeholder="Enter verification code">
                                            <button type="button" class="btn btn-submit" style="height: 48px !important;" onclick="codeverify();">Verify</button>
                                        </div>
                                    </form>
                                </div>
                                <button type="button" class="btn btn-prev step-button-outline" onclick="prevStep(2)">Previous</button>
                                <button type="button" class="btn btn-next step-button-outline" onclick="nextStep(2)">Next</button>
                            </div>
                        
                            <!-- Step 3: Account Details -->
                            <div id="step-3" style="display: none;">
                                <form action="{{ route('user.register') }}" method="post" enctype="multipart/form-data" class="account-form">
                                    @csrf
                                    <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                    <input type="hidden" name="phone" id="verified_phone">
                        
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name *') }}" value="{{ old("name") ?? "" }}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" placeholder="{{ __('Username *') }}" value="{{ old("username") ?? "" }}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="{{ __('Email') }}" value="{{ old("email") ?? "" }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="{{ __('Password *') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password *') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="box-wrap form-check">
                                            <div class="left">
                                                <input type="checkbox" class="form-check-input" id="toc_and_privacy" name="agree_terms" required>
                                                <label class="form-check-label" for="toc_and_privacy">
                                                    {{ __('Accept all') }}
                                                    <a href="{{ url(get_static_option('toc_page_link')) }}" class="text-active">{{ __('Terms and Conditions') }}</a> &amp;
                                                    <a href="{{ url(get_static_option('privacy_policy_link')) }}" class="text-active">{{ __('Privacy Policy') }}</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-wrapper">
                                        <button type="submit" class="btn-submit w-100">{{ __('Create Account') }}</button>
                                    </div>
                                </form>
                                <button type="button" class="btn btn-prev step-button-outline pt-3" onclick="prevStep(3)">Previous</button>
                            </div>
                        
                            <div class="signin__account__para d-flex justify-content-center mt-4">
                                <p class="info">{{ __('Already Have account?') }}</p>
                                <a href="{{ route('user.login') }}" class="active">
                                    <strong>{{ __('Sign in') }}</strong>
                                </a>
                            </div>
                        </div>
                        
                        <script>
                            let currentStep = 1;
                        
                            // Function to handle sending OTP
                            function phoneSendAuth() {
                                const phoneNumber = document.getElementById('number').value;
                                
                                // Simulate OTP send and show success message
                                setTimeout(() => {
                                    document.getElementById('sentSuccess').style.display = 'block';
                                    setTimeout(() => {
                                        document.getElementById('sentSuccess').style.display = 'none';
                                        nextStep(1); // Move to step 2 after success
                                    }, 2000); // Wait 2 seconds before moving to next step
                                }, 1000);
                            }
                        
                            // Function to handle OTP verification
                            function codeverify() {
                                const verificationCode = document.getElementById('verificationCode').value;
                                
                                // Simulate OTP verification
                                setTimeout(() => {
                                    document.getElementById('verifiedSuccess').style.display = 'block';
                                    setTimeout(() => {
                                        document.getElementById('verifiedSuccess').style.display = 'none';
                                        nextStep(2); // Move to step 3 after success
                                    }, 2000); // Wait 2 seconds before moving to next step
                                }, 1000);
                            }
                        
                            // Function to go to the next step
                            function nextStep(step) {
                                if (step === 1) {
                                    document.getElementById('step-1').style.display = 'none';
                                    document.getElementById('step-2').style.display = 'block';
                                } else if (step === 2) {
                                    document.getElementById('step-2').style.display = 'none';
                                    document.getElementById('step-3').style.display = 'block';
                                }
                            }
                        
                            // Function to go to the previous step
                            function prevStep(step) {
                                if (step === 2) {
                                    document.getElementById('step-2').style.display = 'none';
                                    document.getElementById('step-1').style.display = 'block';
                                } else if (step === 3) {
                                    document.getElementById('step-3').style.display = 'none';
                                    document.getElementById('step-2').style.display = 'block';
                                }
                            }
                        </script>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')

    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    
    <script
        src="https://www.google.com/recaptcha/api.js?render={{ get_static_option('site_google_captcha_v3_site_key') }}">
    </script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute("{{ get_static_option('site_google_captcha_v3_site_key') }}", {
                action: 'homepage'
            }).then(function(token) {
                document.getElementById('gcaptcha_token').value = token;
            });
        });
    </script>

    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyC0MrxJImZMkVRN4giYpv8K11NpmWc7DNY",
            authDomain: "sombokchab-laravel.firebaseapp.com",
            projectId: "sombokchab-laravel",
            storageBucket: "sombokchab-laravel.firebasestorage.app",
            messagingSenderId: "663828199574",
            appId: "1:663828199574:web:b205a70700279494cbeab7",
            measurementId: "G-95NBRK1SJ5"
        };
    
        firebase.initializeApp(firebaseConfig);
    </script>
    <script>
        function phoneSendAuth() {
            const number = $("#number").val();
            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier)
                .then(function (confirmationResult) {
                    window.confirmationResult = confirmationResult;
                    coderesult = confirmationResult;
                    console.log(coderesult);
                    $("#sentSuccess").text("OTP sent successfully. Please check your phone.").show();
                    $("#verification-form").show(); // Show the verification form
                })
                .catch(function (error) {
                    console.error(error);
                    $("#error").text(error.message).show();
                });
        }

        function codeverify() {
            const code = $("#verificationCode").val();
            coderesult.confirm(code)
                .then(function (result) {
                    const user = result.user;
                    console.log(user);

                    // Display success message
                    $("#sentSuccess").text("Your phone number has been verified successfully!").show();

                    // Set the verified phone number in the hidden input field
                    const phoneNumber = $("#number").val();
                    $("#verified_phone").val(phoneNumber);
                })
                .catch(function (error) {
                    console.error(error);
                    $("#error").text(error.message).show();
                });
        }


        window.onload = function () {
            render();
        };

        function render() {
            if (!window.recaptchaVerifier) {
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
                    'recaptcha-container',
                    {
                        size: 'normal',
                        callback: function (response) {
                            console.log("reCAPTCHA resolved");
                        },
                        'expired-callback': function () {
                            console.error("reCAPTCHA expired. Reinitializing...");
                            render();
                        }
                    }
                );
            }
            window.recaptchaVerifier.render().then((widgetId) => {
                console.log("reCAPTCHA Widget ID:", widgetId);
            });
        }
    </script>

    
{{--   
  <script type="text/javascript">
      window.onload=function () {
        render();
      };
  
      function render() {
          if (!window.recaptchaVerifier) {
              window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
                  'recaptcha-container',
                  {
                      size: 'normal', 
                      callback: function(response) {
                          console.log("reCAPTCHA resolved");
                      },
                      'expired-callback': function() {
                          console.error("reCAPTCHA expired. Reinitializing...");
                          render();
                      }
                  }
              );
          }
          window.recaptchaVerifier.render().then((widgetId) => {
              console.log("reCAPTCHA Widget ID:", widgetId);
          });
      }

      function phoneSendAuth() {
          var number = $("#number").val();
          firebase.auth().signInWithPhoneNumber(number,window.recaptchaVerifier).then(function (confirmationResult) {
              window.confirmationResult=confirmationResult;
              coderesult=confirmationResult;
              console.log(coderesult);
              $("#sentSuccess").text("Message Sent Successfully.");
              $("#sentSuccess").show();
          }).catch(function (error) {
              $("#error").text(error.message);
              $("#error").show();
          });
      }
  
      function codeverify() {
          var code = $("#verificationCode").val();
          coderesult.confirm(code).then(function (result) {
              var user=result.user;
              console.log(user);
              $("#successRegsiter").text("you are register Successfully.");
              $("#successRegsiter").show();
          }).catch(function (error) {
              $("#error").text(error.message);
              $("#error").show();
          });
  
      }

  </script> --}}

{{-- <script src="https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.1.0/firebase-auth.js"></script>

<script>
    const firebaseConfig = {
        apiKey: "AIzaSyC0MrxJImZMkVRN4giYpv8K11NpmWc7DNY",
        authDomain: "sombokchab-laravel.firebaseapp.com",
        projectId: "sombokchab-laravel",
        storageBucket: "sombokchab-laravel.firebasestorage.app",
        messagingSenderId: "663828199574",
        appId: "1:663828199574:web:b205a70700279494cbeab7",
        measurementId: "G-95NBRK1SJ5"
    };
    firebase.initializeApp(firebaseConfig);
</script>

<script>
    const auth = firebase.auth();
    const phoneInput = document.getElementById('phone');
    const otpSection = document.getElementById('otp-section');
    const sendOtpBtn = document.getElementById('send-otp-btn');
    const verifyOtpBtn = document.getElementById('verify-otp-btn');
    const otpInput = document.getElementById('otp');

    auth.useDeviceLanguage();
    const recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        size: 'invisible',
    });

    sendOtpBtn.addEventListener('click', () => {
        const phoneNumber = phoneInput.value;
        auth.signInWithPhoneNumber(phoneNumber, recaptchaVerifier)
            .then((confirmationResult) => {
                window.confirmationResult = confirmationResult;
                alert('OTP sent to your phone!');
                otpSection.classList.remove('d-none');
                verifyOtpBtn.classList.remove('d-none');
            })
            .catch((error) => {
                console.error(error);
                alert('Error sending OTP. Please try again.');
            });
    });

    verifyOtpBtn.addEventListener('click', () => {
        const otp = otpInput.value;
        window.confirmationResult.confirm(otp)
            .then((result) => {
                alert('Phone number verified successfully!');
                document.getElementById('gcaptcha_token').value = result.user.uid;
            })
            .catch((error) => {
                console.error(error);
                alert('Invalid OTP. Please try again.');
            });
    });
</script> --}}


@endsection
