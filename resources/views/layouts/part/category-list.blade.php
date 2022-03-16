@isset($slider)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>

    <section id="iq-favorites" style="padding-top: 17px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 overflow-hidden">
                    <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title">
                            <a href="javascript:void(0);">{{ isset($slider) ? $slider->title_english : null }}</a>
                        </h4>
                    </div>
                    <div class="favorites-contens">
                        <div class="row p-0 mb-0">
                            @foreach ($slider->medias as $sdata)
                                @isset($sdata)
                                    <div class="col-lg-2">
                                        <div class="full_content">
                                            <div class="block-images position-relative">
                                                <div class="img-box slider-img-box">
                                                    <a href="{{ route('frontend.details', $sdata->slug) }}">
                                                        @if ($sdata->featured)
                                                            <img data-original="{{ asset('storage/' . $sdata->featured->full) }}"
                                                                src="{{ asset('storage/' . $sdata->featured->full) }}"
                                                                class="img-fluid" alt="">
                                                        @else
                                                            <img data-original="{{ asset('assets/frontend/images/favorite/01.jpg') }}"
                                                                class="img-fluid" alt="">
                                                        @endif
                                                    </a>
                                                    @if ($sdata->premium == 1)
                                                        <div class="cardPremium">
                                                            <div class="cpPrice">
                                                                <div class="planbox__header__strike-through">
                                                                    {{ $sdata->regular_price ? PayCurrency($sdata->regular_price) : null }}
                                                                </div>
                                                                <div class="planbox__header__value">
                                                                    <span class="price">
                                                                        {{ $sdata->discount_price ? PayCurrency($sdata->discount_price) : null }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="block-description">

                                                    <div class="movie-time d-flex align-items-center my-2 remove-age-limit">
                                                        <div class="badge badge-secondary p-1 mr-2">
                                                            {{ $sdata->age_limit ? $sdata->age_limit : null }}</div>
                                                        <span
                                                            class="text-white">{{ $sdata->duration ? $sdata->duration : null }}</span>
                                                    </div>

                                                    <div class="hover-buttons">
                                                        @if (auth('member')->check() && auth('member')->user()->membership_id)
                                                            <a href="{{ route('frontend.details', $sdata->slug) }}">
                                                                <span class="btn btn-warning">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </span>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('frontend.details', $sdata->slug) }}">
                                                                <span class="btn btn-warning">
                                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                                </span>
                                                            </a>
                                                        @endif
                                                        @if ($sdata->premium == 1)
                                                            @if (auth('member')->user())
                                                                @if (MyBucket($sdata->id, auth('member')->user()->id))
                                                                    {{-- <button class="btn btn-default" disabled>
                                                            <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
                                                        </button> --}}
                                                                @else
                                                                    <a href="javascript:void(0)"
                                                                        onclick="AddToCart({{ $sdata->id }})">
                                                                        <span class="btn btn-warning">
                                                                            <i class="fa fa-shopping-cart mr-1"
                                                                                aria-hidden="true"></i>
                                                                        </span>
                                                                    </a>
                                                                @endif
                                                            @else
                                                                <a href="javascript:void(0)"
                                                                    onclick="AddToCart({{ $sdata->id }})">
                                                                    <span class="btn btn-warning">
                                                                        <i class="fa fa-shopping-cart mr-1"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                </a>
                                                            @endif
                                                        @else
                                                            {{-- <a href="{{ route('frontend.details', $sdata->slug) }}">
                                                <span class="btn btn-warning">
                                                    Free
                                                </span>
                                            </a> --}}
                                                        @endif
                                                    </div>

                                                    @if (auth('member')->check())
                                                        <div class="block-social-info">
                                                            <ul class="list-inline p-0 m-0 music-play-lists">
                                                                <li>
                                                                    <span onclick="addFavorite({{ $sdata->id }});"
                                                                        class="{{ in_array($sdata->id, $member['favorites']) ? 'active' : 'fevourit' }} fev{{ $sdata->id }} ">
                                                                        <i class="ri-heart-fill"></i></span>
                                                                </li>
                                                                <li>
                                                                    <span onclick="addListing({{ $sdata->id }});"
                                                                        class="{{ in_array($sdata->id, $member['listing']) ? 'active' : 'listing' }} list{{ $sdata->id }}">
                                                                        <i class="ri-add-line"></i></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <h6 class="hover-heading">
                                                        <a href="{{ route('frontend.details', $sdata->slug) }}">
                                                            {{ $sdata->title_en }}
                                                        </a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endisset
