@isset($slider)

    <section id="iq-favorites" style="padding-top: 17px; min-height: 70vh;">
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
                            @isset($slider->medias)
                                @forelse($slider->medias as $sdata)
                                    @isset($sdata)
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-6 custom-content">
                                            <div class="full_content">
                                                <div class="block-images position-relative">
                                                    <div class="img-box slider-img-box">
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
                                                        @if ($sdata->premium == 1 && $sdata->published_status == 1)
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
                                                            @elseif($sdata->premium == 0 && $sdata->published_status == 1)
                                                                <span class="free-tag">
                                                                    <span>{{ FreeTag() }}</span>
                                                                </span>
                                                            @elseif($sdata->published_status == 0 )
                                                                <span class="upcoming-tag">
                                                                    <span>{{ UpcomingTag() }}</span>
                                                                </span>
                                                            @elseif($sdata->published_status == 0 )
                                                                <div class="cardupcoming"></div>
                                                        @endif
                                                        <a href="{{ route('frontend.details', $sdata->slug) }}">
                                                            @if ($sdata->featured)
                                                                <img data-original="{{ asset('storage/' . $sdata->featured->small) }}"
                                                                    src="{{ asset('storage/' . $sdata->featured->small) }}"
                                                                    class="img-fluid" alt="">
                                                            @else
                                                                <img data-original="{{ asset('assets/frontend/images/noimage-p.png') }}"
                                                                    src="{{ asset('assets/frontend/images/noimage-p.png') }}"
                                                                    class="img-fluid" alt="">
                                                            @endif
                                                        </a>

                                                    </div>

                                                    <div class="block-description">

                                                        <div class="movie-time d-flex align-items-center my-2 remove-age-limit">
                                                            <div class="badge badge-secondary p-1 mr-2">
                                                                {{ $sdata->age_limit ? $sdata->age_limit : null }}</div>
                                                            <span
                                                                class="text-white">{{ $sdata->duration ? $sdata->duration : null }}</span>
                                                        </div>

                                                        @if ($sdata->published_status == 1)
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
                                                                    <button class="btn btn-default" disabled>
                                                                        <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
                                                                    </button>
                                                                @else
                                                                    <a href="javascript:void(0)" onclick="AddToCart({{ $sdata->id }})">
                                                                        <span class="btn btn-warning">
                                                                            <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
                                                                        </span>
                                                                    </a>
                                                                @endif
                                                            @else
                                                                <a href="javascript:void(0)" onclick="AddToCart({{ $sdata->id }})">
                                                                    <span class="btn btn-warning">
                                                                        <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
                                                                    </span>
                                                                </a>
                                                            @endif
                                                                @endif
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
                                @empty
                                    @include('layouts.essential.empty')
                                @endforelse
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endisset
