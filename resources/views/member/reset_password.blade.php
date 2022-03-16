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
                        <h3 class="mb-3 text-center">Password Reset</h3>
                        <form class="mt-4" method="POST" action="{{route('reset_password')}}">
                           @csrf
                           <div class="form-group">
                              <input type="email" class="form-control mb-0 @error('email') is-invalid @enderror" name="email"  value="{{ $email }}" required autocomplete="email" autofocus id="exampleInputEmail2" placeholder="Enter email" readonly>
                              <input type="hidden" class="form-control mb-0" name="token"  value="{{ $token }}" required readonly>
                              @error('email')
                                 <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <input type="password" class="form-control mb-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="exampleInputPassword2" placeholder="New Password">
                              @error('password')
                                 <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                              <font style="color:red">
                                       {{($errors->has('password'))?($errors->first('password')):' '}}

                               </font>
                           </div>
                           <div class="form-group">
                              <input type="password" class="form-control mb-0 @error('confirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="current-password" id="exampleInputPassword2" placeholder="confirm password">
                              @error('password')
                                 <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                              <font style="color:red">
                                       {{($errors->has('confirm_password'))?($errors->first('confirm_password')):' '}}

                               </font>
                           </div>
                           <div class="sign-info">
                              <button type="submit" class="btn btn-primary">Sign in</button>
                           </div>
                        </form>
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
