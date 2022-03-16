@extends('layouts.master')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>
    <!-- Slider Start -->
    <section id="home" class="iq-main-slider p-0">
        <div id="home-slider" class="slider m-0 p-0">
            @foreach ($cat_slider as $slider)
                <div class="slide slick-bg s-bg-1"
                    style="background-image:url('{{ asset($slider->featuredL ? 'storage/' . $slider->featuredL->full : 'https://cdn.designcrowd.com/blog/2018/March/50-Typographic-Oscars-Film-Posters/GR_Typographic-Oscar-Film-Posters_Banner_828x300.jpg') }}') !important">
                    <div class="container-fluid position-relative h-100">
                        <div class="slider-inner h-100">
                            <div class="row align-items-center  h-100">
                                <div class="col-xl-6 col-lg-12 col-md-12">
                                    <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft"
                                        data-delay-in="0.6" style="font-size: 40px;">{{ $slider->title_en }}</h1>
                                    <div class="d-flex align-items-center" data-animation-in="fadeInUp" data-delay-in="1">
                                        <span class="badge badge-secondary p-2">{{ $slider->age_limit }}</span>
                                        @if ($slider->video_nature_id == 2)
                                            <span class="ml-3">2 Seasons</span>
                                        @endif
                                    </div>
                                    <p data-animation-in="fadeInUp" data-delay-in="1.2">{!! $slider->description_en !!}
                                    </p>
                                    <div class="d-flex align-items-center r-mb-23" data-animation-in="fadeInUp"
                                        data-delay-in="1.2">
                                        <a href="{{ route('frontend.details', $slider->slug) }}" class="btn btn-link">
                                            {{ $slider->details_button_text ? $slider->details_button_text : 'More details' }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @if ($slider->trailler_button_url)
                                <div class="trailor-video">
                                    <a href="{{ $slider->trailler_button_url }}" class="video-open playbtn">
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
                                            {{ $slider->trailler_button_text ? $slider->trailler_button_text : 'Watch Trailer' }}
                                        </span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle"
                fill="none" stroke="currentColor">
                <circle r="20" cy="22" cx="22" id="test"></circle>
            </symbol>
        </svg>
    </section>

    <!-- Slider End -->
    <!-- MainContent -->
    <div class="main-content">
        @forelse ($categories as $key =>  $list)
            @include('layouts.part.slider_category',['slider' => ['data' => $list->medias, 'name' =>
            $list->title_english,'cat_slug' => $list->slug]])
        @empty
            @include('layouts.essential.empty')
        @endforelse
    </div>

@endsection

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
