
@if(count($slider) > 0)
@if(count($slider)>0)
<section id="parallex" class="parallax-window hide" style="background-image:url('{{ asset($slider[0]->image)}}');">
@else
<section id="parallex" class="parallax-window hide" style="background-image:url('{{ asset('frontend/images/parallax/p1.jpg') }}')">
@endif
    <div class="container-fluid h-100">
        <div class="row align-items-center justify-content-center h-100 parallaxt-details">
            <div class="col-lg-4 r-mb-23">
                <div class="text-left">
                    <h1 class="slider-text big-title title text-uppercase" 
                        data-animation-in="fadeInLeft"
                        data-delay-in="0.6" style="font-weight: bold;font-family: fantasy;font-style: oblique;letter-spacing: 3px;">
                        {{ $slider[0]->title_en }}
                    </h1>
                    <!-- <div class="parallax-ratting d-flex align-items-center mt-3 mb-3">
                        <ul
                            class="ratting-start p-0 m-0 list-inline text-primary d-flex align-items-center justify-content-left">
                            <li><a href="javascript:void(0);" class="text-primary"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0);" class="pl-2 text-primary"><i class="fa fa-star"
                                        aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0);" class="pl-2 text-primary"><i class="fa fa-star"
                                        aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0);" class="pl-2 text-primary"><i class="fa fa-star"
                                        aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0);" class="pl-2 text-primary"><i class="fa fa-star-half-o"
                                        aria-hidden="true"></i></a></li>
                        </ul>
                        <span class="text-white ml-3">9.2 (lmdb)</span>
                    </div> -->
                    <!-- <div class="movie-time d-flex align-items-center mb-3">
                        <div class="badge badge-secondary mr-3">13+</div>
                        <h6 class="text-white">2h 30m</h6>
                    </div> -->
                    <p>{!! $slider[0]->description_en !!}</p>
                    <div class="parallax-buttons" style="border: 1px solid white;">
                        <a href="{{ $slider[0]->trailler_button_url }}" class="video-open playbtn">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80px"
                                height="80px" viewBox="0 0 213.7 213.7" enable-background="new 0 0 213.7 213.7"
                                xml:space="preserve">
                                <polygon class='triangle' fill="none" stroke-width="7" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10"
                                    points="73.5,62.5 148.5,105.8 73.5,149.1 " />
                                <circle class='circle' fill="none" stroke-width="7" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10" cx="106.8" cy="106.8"
                                    r="103.3" />
                            </svg>
                            <span class="w-trailor">
                                {{ $slider[0]->trailler_button_text ? $slider[0]->trailler_button_text : 'Watch Trailer' }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="parallax-img">
                    @if(count($slider)>0)
                    <a href="{{ $slider[0]->trailler_button_url }}" class="video-open playbtn">
                        <img src="{{ asset($slider[0]->image)}}" class="img-fluid w-100" alt="{{ $slider[0]->title_en }}">
                    </a>
                    @else
                        <a href="{{ $slider[0]->trailler_button_url }}" class="video-open playbtn">
                            <img src="{{ asset('frontend/images/parallax/p1.jpg') }}" class="img-fluid w-100"
                                alt="bailey">
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif