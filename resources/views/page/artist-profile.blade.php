
@extends('layouts.master')
@push('styles')
<link rel="stylesheet" href="{{ url('assets/frontend/artist-profile/style.css') }}" />
@endpush
@section('content')
<section>
<div style="padding-top:75px">
    <img src="{{url('images/ArtistProfile.jpg')}}" alt="image" style="width:100% ; height:250px"/>
</div>
</section>
<div class="profile-img-body" >          
    <img src="{{asset('storage/' . $artist->image)}}"  class="img-fluid"/>
</div>
<div class="profile-artist-name" >          
    <h1>{{$artist->name}}</h1>
    <h3 class="mt-2">{{$artist->company}}</h3>
</div>

<section class="single-page" style="padding-top:100px"> 
<div class="container mb-4  d-flex justify-content-center ">
    <div class="row col-md-12">
        <div class="profile-artist-about col-md-8" >          
            <h1>About</h1>
            <p class="mt-3">{{$artist->description}}</p>
        </div>

            
        <div class="profile-infos col-md-4 mt-5  p-3" style="width:500px;height:auto; background:#000;color:#ffffff">
            <h2><strong style="color:#ffffff;font-size:26px;">Information</strong></h2>
            <table class="table table-borderless mt-2" id="artist-table">
                    <tr>
                        <td width="40%"><strong>Date of Birth &nbsp;&nbsp; &nbsp;&nbsp; </strong></td>
                       
                        <td width="40%">{{date('j F, Y', strtotime($artist->dob))}}</td>
                    </tr>
                    <tr>
                        <td width="40%"><strong>Nationality &nbsp;&nbsp; &nbsp;&nbsp; </strong></td>
                       
                        <td width="40%">Bangladesh</td>
                    </tr>
                    <tr>
                        <td><strong>Education &nbsp;&nbsp; &nbsp;&nbsp; </strong></td>
                       
                        <td>Bsc</td>
                    </tr>
                    <tr>
                        <td><strong>Occupation &nbsp;&nbsp; &nbsp;&nbsp; </strong></td>
                       
                        <td>Actor</td>
                    </tr>
                    <tr>
                        <td><strong>Years Active &nbsp;&nbsp; &nbsp;&nbsp; </strong></td>
                       
                        <td>2001–2015</td>
                    </tr>
                    <tr>
                        <td><strong>Marital Status  &nbsp;&nbsp; &nbsp;&nbsp; </strong></td>
                       
                        <td>Single</td>
                    </tr>
                    <tr>
                        <td><strong>Spouse(s)  &nbsp;&nbsp; &nbsp;&nbsp; </strong></td>
                       
                        <td>jigma</td>
                    </tr>
                    <tr>
                        <td width="40%"><strong>Awards  &nbsp;&nbsp; &nbsp;&nbsp; </strong></td>
                       
                        <td width="40%">Kalaimamani Filmfare Awards</td>
                    </tr>
            </table>
        </div>  
    </div>
   
  </div>   
</div>
</section> 
@endsection
@push('scripts') 
@endpush
