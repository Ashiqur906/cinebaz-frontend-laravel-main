{{-- @dump($slider) --}}
<section id="home" class="iq-main-slider p-0">
    <div id="home-slider" class="slider m-0 p-0">
        {{-- @dd($slider) --}}
        @forelse ($slider as $key => $list)
        <div class="slide slick-bg s-bg-1" style="background-image: url('{{asset($list->image)}}'); height: 100vh;">
            <div class="container-fluid position-relative h-100">
                <div class="slider-inner h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-xl-6 col-lg-12 col-md-12">
                            <div class="banner-width-custom">
                            {{-- <a href="javascript:void(0);">
                                <div class="channel-logo" data-animation-in="fadeInLeft" data-delay-in="0.5">
                                    <img src="images/logo.png" class="c-logo" alt="streamit">
                                </div>
                            </a> --}}
                            <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft"
                                data-delay-in="0.6" style="font-size: 40px;">{{ $list->title_en }}</h1>
                            {{-- <div class="d-flex align-items-center pb-2" data-animation-in="fadeInUp" data-delay-in="1">
                                @if ($list->age_limit)

                                    <span class="badge badge-secondary p-2"> {{ $list->age_limit }}</span>
                                @endif
                                <!-- <span class="ml-3">2 Seasons</span> -->
                            </div> --}}
                            @if ($list->description_en)
                                <p data-animation-in="fadeInUp" data-delay-in="1.2" class="py-4">
                                    {{ $list->description_en }}

                                </p>
                            @endif
                            <div class="d-flex align-items-center r-mb-23" data-animation-in="fadeInUp"
                                data-delay-in="1.2">
                                @if ($list->play_button_url)
                                    <a href="{{ $list->play_button_url }}" class="btn btn-hover">
                                        <i class="fa fa-play mr-2" aria-hidden="true"></i>

                                        {{ $list->play_button_text ? $list->play_button_text : 'Play Now' }}
                                    </a>
                                @endif
                                @if ($list->details_button_url)
                                    <a href="{{ $list->details_button_url }}" class="btn btn-link">
                                        {{ $list->details_button_text ? $list->details_button_text : 'More details' }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="trailor-video">
                        @if ($list->trailler_button_url)
                            <a href="{{ $list->trailler_button_url }}" class="video-open playbtn">
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
                                    {{ $list->trailler_button_text ? $list->trailler_button_text : 'Watch Trailer' }}
                                </span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div> 
        @empty
        @endforelse
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle"
            fill="none" stroke="currentColor">
            <circle r="20" cy="22" cx="22" id="test"></circle>
        </symbol>
    </svg>
</section>
