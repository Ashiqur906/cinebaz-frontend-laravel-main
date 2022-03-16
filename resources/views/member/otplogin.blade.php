@extends('layouts.security')
@section('seq_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- Sign in Start -->
   <section class="sign-in-page" style="height:auto;background-color: #191919;">
      <div class="container">
         <div class="row justify-content-center align-items-center height-self-center">
            <div class="col-lg-7 col-md-12 align-self-center">
               @if (session('fail_mail'))
               <div class="alert alert-danger">
                  {{ session('fail_mail') }}
               </div>
               @endif
               @if (session('fail'))
               <div class="alert alert-danger">
                  {{ session('fail') }}
               </div>
               @endif
               {{-- @dd(CountryCode()) --}}
               <div class="sign-user_card ">
                  <div class="sign-in-page-data">
                     <div class="sign-in-from w-100 m-auto">
                        <h3 class="mb-3 text-center">OTP Sign in</h3>
                        <form class="mt-4" action="#">
                            @csrf
                            <div class="form-group sendOTP">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="phone_no">Code</label>
                                        <select class="form-control" name="country_code" id="code">
                                            <option value="">Country Code</option>                                            
                                            @foreach(CountryCode() as $conCode)
                                            <option data-countryCode="{{ $conCode['contry_code'] }}" value="{{ $conCode['phone_code'] }}" @if($conCode['phone_code'] =='88' ) Selected @endif>{{ $conCode['contry'] }} (+{{ $conCode['phone_code'] }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="phone_no">Phone Number</label>
                                        <input type="text" class="form-control" name="phone_no" id="number" placeholder="Phone no ......">
                                    </div>
                                </div>
                            </div>
                            <div id="recaptcha-container"></div>
                            <a href="#" id="getcode" class="btn btn-dark btn-sm sendOTP" onclick="sendMemberOtp()">Get Code</a>

                            <div class="form-group mt-4 sendOtpCode">
                                <input type="text" name="" id="codeToVerify" name="getcode" class="form-control" placeholder="Enter Code">
                                <span class="resendotp_code">Your OTP Code successfully send. <a href="">Resend</a></span>
                            </div>
                            <button type="button" class="btn btn-success sendOtpCode" id="verifPhNum">Sign in</button>
                        </form>
                     </div>
                  </div>
                  <div class="mt-3">
                     <div class="d-flex justify-content-center links">
                        Don't have an account? <a href="{{ route('member.auth.register') }}" class="text-primary ml-2">Sign Up</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      <!-- Sign in END -->
      </div>
   </section>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase.js"></script>

   <!-- <script src="{{ asset('assets/frontend/js/firebase.js') }}"></script> -->
   
   <script type="text/javascript">
        $(document).ready(function() {

            const firebaseConfig = {
                apiKey: "AIzaSyDsvdKuS_PBvmEcVlX3PkXIZmiW5yJsNYw",
                authDomain: "shapla-media.firebaseapp.com",
                databaseURL: "https://shapla-media.firebaseio.com",
                projectId: "shapla-media",
                storageBucket: "shapla-media.appspot.com",
                messagingSenderId: "379398615317",
                appId: "1:379398615317:web:20b5b4fad388c26648f91c",
                measurementId: "G-QCXRK1RY3J"
            };
            // Initialize Firebase
            
            firebase.initializeApp(firebaseConfig);

            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                'size': 'invisible',
                'callback': function (response) {
                    // reCAPTCHA solved, allow signInWithPhoneNumber.
                    console.log('recaptcha resolved');
                }
            });
            onSignInSubmit();
        });

        $('.sendOTP').show();
        $('.sendOtpCode').hide();
        function sendMemberOtp(){
            var code    = $('#code').find(":selected").val();
            var phoneNo = $('#number').val();
            var phone   = '+'+code+phoneNo;

            $.ajax({
                data : { phone : phone},
				url: "{{ url('send/otp/code') }}",
				success:function(result){
                    if(result == 1){
                        $('.sendOTP').hide();
                        $('.sendOtpCode').show();
                        // Swal.fire({
                        //     position: 'center',
                        //     icon: 'success',
                        //     title: 'we have sent a code to your phone. Please check!',
                        //     showConfirmButton: true,
                        //     timer: 15000
                        // })
                        var appVerifier = window.recaptchaVerifier;
                        firebase.auth().signInWithPhoneNumber(phone, appVerifier)
                        .then(function (confirmationResult) {
                            window.confirmationResult=confirmationResult;
                            coderesult=confirmationResult;
                            //console.log(coderesult);

                            
                        }).catch(function (error) {
                            alert(error.message);
                        });
                    }else{
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Phone Number hasn`t registerd!',
                            showConfirmButton: true,
                            timer: 15000
                        })
                    }
				}
			});
        }
        function onSignInSubmit() {
            $('#verifPhNum').on('click', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let phoneNo = '';
                var code = $('#codeToVerify').val();
                console.log(code);
                $(this).attr('disabled', 'disabled');
                $(this).text('Processing..');
                confirmationResult.confirm(code)
                .then(function (result) {
                    var code    = $('#code').find(":selected").val();
                    var phn     = $('#number').val();
                    var phone   = code+phn;
                    // console.log(result)
                    $.ajax({
                        //data : { phone : phone,code : code},
                        url: "{{ url('save/otp/code') }}",
                        method: "get",
                        data: {phone:phone},
                        success:function(data){
                            window.location.href = "{{ url('home') }}"; 
                        }
                    })
                    
                }.bind($(this))).catch(function (error) {

                    $(this).removeAttr('disabled');
                    $(this).text('Invalid Code');
                    setTimeout(() => {
                        $(this).text('Verify Phone No');
                    }, 2000);
                }.bind($(this)));
            
            });
            
            
            $('#getcode').on('click', function () {
                var code    = $('#code').find(":selected").val();
                var phoneNo = $('#number').val();
                var phone   = '+'+code+phoneNo;
                console.log(phoneNo);
                // getCode(phoneNo);
                var appVerifier = window.recaptchaVerifier;
                firebase.auth().signInWithPhoneNumber(phone, appVerifier)
                .then(function (confirmationResult) {
            
                    window.confirmationResult=confirmationResult;
                    coderesult=confirmationResult;
                    console.log(coderesult);
                }).catch(function (error) {
                    console.log(error.message);
            
                });
            });
        }
    </script>

<style>
    .sign-in-page .form-control, .m-profile .form-control{
        color: gray !important;
    }
</style>
@endsection
