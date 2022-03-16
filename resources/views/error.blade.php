@extends('layouts.master')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>

    <!-- 4040 part Start -->
    <div class="error_wrapper">
        <div class="container pt-5">
            <div class="row no-gutters height-self-center">
                <div class="col-md-6 text-center align-self-center">
                    <div class="iq-error position-relative">
                        <img src="images/error_images/morph.png" alt=""> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="error-text">
                        <h2 class="mb-0 mt-4">404 Not Found.</h2>
                        <p>The requested page dose not exist.</p>
                        <a class="btn btn-primary mt-3 error-button" href="index.html"><i class="ri-home-4-line"></i>Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 4040 part END -->  

@endsection