@extends('layouts.master')

@section('content')

<section id="home" class="iq-main-slider p-0">
    <div id="home-slider" class="slider m-0 p-0">
        <div class="slide slick-bg s-bg-2">
            <div class="container-fluid position-relative h-100">
                <div class="slider-inner h-100">
                    <div class="row align-items-center  h-100">
                        <div class="col-xl-6 col-lg-12 col-md-12">
                            <a href="javascript:void(0);">
                                <div class="channel-logo" data-animation-in="fadeInLeft">
                                    <img src="images/logo.png" class="c-logo" alt="streamit">
                                </div>
                            </a>
                            <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft">
                                sail coaster</h1>
                            <div class="d-flex align-items-center" data-animation-in="fadeInUp" data-delay-in="0.5">
                                <span class="badge badge-secondary p-2">16+</span>
                                <span class="ml-3">2h 40m</span>
                            </div>
                            <p data-animation-in="fadeInUp" data-delay-in="0.7">Lorem Ipsum is simply dummy text of
                                the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                                dummy text ever since the 1500s.
                            </p>
                            <div class="d-flex align-items-center r-mb-23" data-animation-in="fadeInUp"
                                data-delay-in="1">
                                <a href="movie-details.html" class="btn btn-hover"><i class="fa fa-play mr-2"
                                        aria-hidden="true"></i>Play Now</a>
                                <a href="movie-details.html" class="btn btn-link">More details</a>
                            </div>
                        </div>



                    </div>
                    <div class="trailor-video">
                        <a href="video/trailer.mp4" class="video-open playbtn">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px" height="80px"
                                viewBox="0 0 213.7 213.7" enable-background="new 0 0 213.7 213.7" xml:space="preserve">
                                <polygon class='triangle' fill="none" stroke-width="7" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10"
                                    points="73.5,62.5 148.5,105.8 73.5,149.1 " />
                                <circle class='circle' fill="none" stroke-width="7" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10" cx="106.8" cy="106.8" r="103.3" />
                            </svg>
                            <span class="w-trailor">Watch Trailer</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide slick-bg s-bg-3">
            <div class="container-fluid position-relative h-100">
                <div class="slider-inner h-100">
                    <div class="row align-items-center  h-100">
                        <div class="col-xl-6 col-lg-12 col-md-12">
                            <a href="javascript:void(0);">
                                <div class="channel-logo" data-animation-in="fadeInLeft">
                                    <img src="images/logo.png" class="c-logo" alt="streamit">
                                </div>
                            </a>
                            <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft">
                                the army</h1>
                            <div class="d-flex align-items-center" data-animation-in="fadeInUp" data-delay-in="0.5">
                                <span class="badge badge-secondary p-2">20+</span>
                                <span class="ml-3">3h</span>
                            </div>
                            <p data-animation-in="fadeInUp" data-delay-in="0.7">Lorem Ipsum is simply dummy text of
                                the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                                dummy text ever since the 1500s.
                            </p>
                            <div class="d-flex align-items-center r-mb-23" data-animation-in="fadeInUp"
                                data-delay-in="1">
                                <a href="movie-details.html" class="btn btn-hover"><i class="fa fa-play mr-2"
                                        aria-hidden="true"></i>Play Now</a>
                                <a href="movie-details.html" class="btn btn-link">More details</a>
                            </div>
                        </div>
                    </div>
                    <div class="trailor-video">
                        <a href="video/trailer.mp4" class="video-open playbtn">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px" height="80px"
                                viewBox="0 0 213.7 213.7" enable-background="new 0 0 213.7 213.7" xml:space="preserve">
                                <polygon class='triangle' fill="none" stroke-width="7" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10"
                                    points="73.5,62.5 148.5,105.8 73.5,149.1 " />
                                <circle class='circle' fill="none" stroke-width="7" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10" cx="106.8" cy="106.8" r="103.3" />
                            </svg>
                            <span class="w-trailor">Watch Trailer</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle"
            fill="none" stroke="currentColor">
            <circle r="20" cy="22" cx="22" id="test"></circle>
        </symbol>
    </svg>
</section>
@push('styles')
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
