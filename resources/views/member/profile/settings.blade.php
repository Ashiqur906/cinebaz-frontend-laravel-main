@extends('layouts.master')
@section('content')
<!-- MainContent -->
<section class="m-profile setting-wrapper">
    <div class="container-fluid">
        <!-- <h4 class="main-title mb-4">My Account</h4> -->
        <form action="{{ route('member.auth.update') }}" method="POST" enctype="multipart/form-data">
            @csrf()
            <div class="row">
                <div class="col-lg-3 mb-3">
                    <div class="sign-user_card text-center">
                        @if(count($user->images)>0)
                        <img src="{{url('storage/'.$user->images[0]->thumbnail)}}" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image">
                        @else
                        <img src="{{ Gravatar::src('https://www.gravatar.com/avatar/', 150) }}" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image">
                        {{--  <img src="https://visualpharm.com/assets/30/User-595b40b85ba036ed117da56f.svg" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image">  --}}
                        @endif

                        <input name="image"class="form_gallery-upload" type="file" accept=".png, .jpg, .jpeg" value="{{ old('image') }}" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" >
                        <h4 class="my-3">{{$user->name}}</h4>

                        <a href="{{ route('member.auth.profile') }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-file-user-line text-primary"></i> Manage Profile</a>
                        <a href="{{ route('member.auth.settings') }}" class="btn btn-hover btn-mng-prfl btn-block active"><i class="ri-settings-4-line text-primary"></i> Settings</a>
                        <a href="{{ route('member.auth.library') }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-store-line text-primary"></i> My Library</a>
                        <a href="{{ route('member.auth.bucket') }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-shopping-cart-2-line text-primary"></i> My Purchase</a>
                        <a href="{{ route('member.auth.change_password') }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-lock-unlock-line text-primary"></i>  Change Password</a>
                        <a href="{{ route('member.auth.logout') }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-logout-circle-line text-primary"></i> Logout</a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="sign-user_card">
                        <h5 class="mb-3 pb-3 a-border">Personal Details</h5>
                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-md-12">
                                <span class="text-light font-size-13">Name</span>
                                <input type="text" name="name" value="{{$user->name}}" class="form-control">
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-md-12">
                                <span class="text-light font-size-13">Email</span>
                                <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder="email (EX: member@domain.com)">
                                <input type="hidden" name="id" value="{{$user->id}}">
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-md-12">
                                <span class="text-light font-size-13">Phone</span>
                                <input type="type" name="phone" value="{{$user->phone}}" class="form-control" placeholder="Phone">
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-md-12">
                                <label class="">Gender</label>
                                <select name="gender" class="form-select text-light bg-dark" style="height: 40px;">
                                    <option value="">Select Gender</option>
                                    <option value="Male" @if($user->gender == 'Male') selected="" @endif>Male</option>
                                    <option value="Female" @if($user->gender == 'Female') selected="" @endif>Female</option>
                                    <option value="Others" @if($user->gender == 'Others') selected="" @endif>Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-md-12">
                                <span class="text-light font-size-13">Address</span>
                                <textarea class="form-control" name="address" placeholder="Address">{{$user->address}}</textarea>
                            </div>
                        </div>
                        <!-- <h5 class="mb-3 mt-4 pb-3 a-border">Plan Details</h5> -->
                        <!-- <div class="row justify-content-between mb-3">
                            <div class="col-md-8">
                                <p>Premium</p>
                            </div>
                            <div class="col-md-4 text-md-right text-left">
                                <a href="#" class="text-primary">Change Plan</a>
                            </div>
                        </div> -->
                        <button type="submit" class="btn btn-hover">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- MainContent End-->
@endsection
@push('scripts')
<style>
.makeupinstation {
display: block;
}
.makeupinstation small {
color: #9E9E9E;
font-weight: 200;
}
</style>
@endpush
