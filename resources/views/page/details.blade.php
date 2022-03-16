@extends('layouts.master')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Slider Start -->
    {{-- @include('layouts.part.slider_home',['slider' => null]) --}}
    @php

    if (isset($mdata->featuredL->full)) {
        $bg = asset('storage/' . $mdata->featuredL->full);
    } else {
        $bg = asset('assets/frontend/images/noimage-l.jpg');
    }
    //  @dump($bg)
    @endphp
    @isset($mdata)
        <section class="banner-wrapper overlay-wrapper iq-main-slider" style="background-image: url('{{ $bg }}');">
            {{-- trailler button --}}
            @if ($mdata->trailer_url)
                <div class="trailor-video">
                    <a href="{{ $mdata->trailer_url }}" class="video-open playbtn" tabindex="0">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                            y="0px" width="80px" height="80px" viewBox="0 0 213.7 213.7" enable-background="new 0 0 213.7 213.7"
                            xml:space="preserve">
                            <polygon class="triangle" fill="none" stroke-width="7" stroke-linecap="round"
                                stroke-linejoin="round" stroke-miterlimit="10" points="73.5,62.5 148.5,105.8 73.5,149.1 ">
                            </polygon>
                            <circle class="circle" fill="none" stroke-width="7" stroke-linecap="round"
                                stroke-linejoin="round" stroke-miterlimit="10" cx="106.8" cy="106.8" r="103.3"></circle>
                        </svg>
                        <span class="w-trailor">
                            Watch Trailer
                    </a>
                </div>
            @endif
                <div class="exeptionlogin-caption" style="width: 100%">
                    <div class="position-relative mb-12">
                        <div class="exeptionlogin">
                            <div class="app-store-caption">
                                <div class="full-head">
                                    <h1 class="pb-3 app-heading">To watch this Movie<br />
                                        Please download our Apps</h1>
                                    <div class="app-download text-center">
                                        @if (isset($setting['playstore-url']) && isset($setting['playstore']))
                                            <a href="{{ route('download_android') }}" target="_blank">
                                                <img src="{{ asset($setting['playstore']) }}" class="img-fluid" />
                                            </a>
                                        @endif
                                        @if (isset($setting['appstore-url']) && isset($setting['appstore']))
                                            <a href="{{ $setting['appstore-url'] }}" target="_blank">
                                                <img src="{{ asset($setting['appstore']) }}" class="img-fluid" />
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
        </section>
        <!-- Slider End -->
        <div class="main-content details-play-group-button">
            <section class="movie-detail container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-info g-border">
                            <div>
                                <div style="position:absolute;right:0;top: 18px;text-align:center;">
                                    <h1 class="pb-3" style="font-size:20px">To watch this Movie<br />
                                        Please download our Apps</h1>
                                    <div class="app-download text-center">
                                        @if (isset($setting['playstore-url']) && isset($setting['playstore']))
                                            <a href="{{ route('download_android') }}" target="_blank">
                                                <img src="{{ asset($setting['playstore']) }}" class="img-fluid" />
                                            </a>
                                        @endif
                                        @if (isset($setting['appstore-url']) && isset($setting['appstore']))
                                            <a href="{{ $setting['appstore-url'] }}" target="_blank">
                                                <img src="{{ asset($setting['appstore']) }}" class="img-fluid" />
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                </div @if ($mdata->featured)
                                <img src="{{ asset('storage/' . $mdata->featured->small) }}"
                                    style="height:182px;float:left;padding:15px;">

                                @endif
                                <h1 class="trending-text big-title text-uppercase mt-0">{{ strtoupper($mdata->title_en) }}
                                </h1>
                                <ul class="p-0 list-inline d-flex align-items-center movie-content list-movie-content">
                                    {{-- @dump($mdata) --}}
                                    @foreach ($mdata->tags as $list)
                                        <li class="text-white font-size-32">
                                            {{ $list->title_en }}
                                        </li>
                                    @endforeach

                                    @foreach ($mdata->categories as $list)
                                        <li class="text-white font-size-32">
                                            {{ $list->title_english }}
                                        </li>
                                    @endforeach
                                </ul>

                                @if ($mdata->age_limit)
                                    <span class="badge badge-secondary p-3">{{ $mdata->age_limit }}</span>
                                @endif
                                <span class="trending-year"><strong>Release :</strong> {{ $mdata->release_year }}</span>
                                <span class="ml-5"><strong>Duration :</strong> {{ $mdata->duration }}</span><br />
                                <span><strong>Cast and Crew :</strong>&nbsp;

                                    @foreach ($mdata->artists as $key => $artist)
                                        {{ $key != 0 ? '.' : '' }} <a
                                            href="{{ route('frontend.artist.profile', $artist->slug) }}">{{ $artist->name }}</a>
                                    @endforeach
                                </span>

                            </div>

                            <!-- <div class="d-flex align-items-center text-white text-detail">

                                                            </div>
                                                            <div class="d-flex align-items-center text-white text-detail">

                                                            </div>      -->
                            <!-- <div class="d-flex align-items-center series mb-4">
                                                                             <a href="javascript:void();"><img src="images/trending/trending-label.png" class="img-fluid" alt=""></a>
                                                                             <span class="text-gold ml-3">{{ $mdata->duration }}</span>
                                                                          </div> -->
                            <div class="text-justify">
                                @if ($mdata->description_en)
                                    <p class="trending-dec w-100 mb-0 mt-3">
                                        {!! $mdata->description_en !!}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @include('layouts.part.slider_simier',['slider' => $similer])
            @include('layouts.part.slider_section',['slider' => $recomended])
            @include('layouts.part.slider_section',['slider' => $upcoming])
        </div>
    @endisset

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
@push('scripts')

    <script type="text/javascript">
        function Copy(link_url) {
            var copyText = link_url;

            document.addEventListener('copy', function(e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            alert('copied text: ' + copyText);
        }
    </script>
    <script>
        var $temp = $("<input>");
        var $url = $(location).attr('href');

        $('.clipboard').on('click', function() {
            $("body").append($temp);
            $temp.val($url).select();
            document.execCommand("copy");
            $temp.remove();
            $("button").text("copied!");
        })
    </script>



@endpush
