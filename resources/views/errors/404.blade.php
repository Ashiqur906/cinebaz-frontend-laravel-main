@extends('errors::minimal')

@section('title', __('Not Found'))
@section('error-message')
<div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-12 p-3 error-main" style="background-color:rgb(10, 41, 92); border-radius: 10px;">
  
          <div class="row">
            <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1">
              <h1 class="m-0" height="100px">
                 <img src="https://cdn4.iconfinder.com/data/icons/gradient-4/50/312-512.png" alt="thumbnail" style="width: 100px;height:100px;" class="responsive">
              </h1>
               <br/>
              <h6 style="color:white">Sorry !!!</h6>
              <h6 style="color:white;padding:5px">Your expecting page not found</h6>
              <br/>
              <br/>
              <p><a href="{{URL('/')}}" class="btn btn-secondary btn-sm ">Home</a></p>
            </div>
           
            
          </div>

        </div>
@endsection
