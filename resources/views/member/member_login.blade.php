@extends('layouts.master')

@section('content')
  <!-- Sign in Start -->
   <section class="sign-in-page" style="height:auto;background-color: #191919;">
      <div class="container">
         <div class="row justify-content-center align-items-center height-self-center">
            <div class="col-lg-6 col-md-12 align-self-center">
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
               <div class="sign-user_card ">
                  <div class="sign-in-page-data">
                     <div class="sign-in-from w-100 m-auto">
                        <h3 class="mb-3 text-center">Sign in</h3>
                        <form class="mt-4" method="POST" action="{{ route('member.auth.login') }}">
                           @csrf
                           <div class="form-group">
                              <input type="email" class="form-control mb-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus id="exampleInputEmail2" placeholder="Enter email">
                              @error('email')
                                 <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <input type="password" class="form-control mb-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="exampleInputPassword2" placeholder="Password">
                              @error('password')
                                 <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                           </div>
                           <div class="sign-info">
                              <button type="submit" class="btn btn-primary">Sign in</button>
                              <div class="custom-control custom-checkbox d-inline-block">
                                 <input type="checkbox" class="custom-control-input" id="customCheck" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                 <label class="custom-control-label" for="customCheck">Remember Me</label>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="col-md-12">
                        <h4 class="text-center mb-3">Login with </h4>
                     </div>
                     <div class="col-md-6">
                        <a href="{{ route('login.otp') }}" class="btn btn-warning btn-block register-otp">
                            <i class="fa fa-key"></i> OTP
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('login.google') }}" class="btn btn-primary btn-block register-google">
                            <i class="fa fa-google"></i> Google
                        </a>
                    </div>
                  </div>
                  <div class="mt-3">
                     <div class="d-flex justify-content-center links">
                        Don't have an account? <a href="{{ route('member.auth.register') }}" class="text-primary ml-2">Sign Up</a>
                     </div>
                     <div class="d-flex justify-content-center links">
                        <a href="{{route('pass-forgot')}}" class="f-link" style="color:#2e46ed">Forgot your password?</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Sign in END -->
<style>
   .sign-in-page .btn{
      padding:10px !important;
   }
</style>   
@endsection
