@isset($sdata)
    <li class="slide-item">
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
                @if ($sdata->premium == 1 && $sdata->published_at && $sdata->published_at < date('Y-m-d H:i:s'))

                    <div class="cardPremium">
                        <div class="cpPrice">
                            <div class="planbox__header__strike-through">
                                {{ $sdata->regular_price ? PayCurrency($sdata->regular_price) : null }}
                            </div>
                            <div class="planbox__header__value">
                                <span class="price">
                                    {{ $sdata->discount_price ? PayCurrency($sdata->discount_price) : null }} </span>
                            </div>
                        </div>
                    </div>
                @elseif($sdata->premium == 0 && $sdata->published_at && $sdata->published_at < date('Y-m-d H:i:s'))
                        <span class="free-tag">
                        <span>{{ FreeTag() }}</span>
                        </span>
                    @elseif($sdata->published_at == null || $sdata->published_at > date('Y-m-d H:i:s')) <span
                            class="upcoming-tag">
                            <span>{{ UpcomingTag() }}</span>
                        </span>
                    @elseif($sdata->published_status == 0 )
                        <div class="cardupcoming"></div>
                @endif
                <a href="{{ route('frontend.details', $sdata->slug) }}">
                    {{-- @dump($sdata->featured->small) --}}
                    @if ($sdata->featured)
                        <img data-original="{{ asset('storage/' . $sdata->featured->small) }}"
                            src="{{ asset('storage/' . $sdata->featured->small) }}" class="img-fluid" alt="">
                    @else
                        <img data-original="{{ asset('assets/frontend/images/noimage-p.png') }}"
                            src="{{ asset('assets/frontend/images/noimage-p.png') }}" class="img-fluid" alt="">
                    @endif
                </a>
            </div>

            <div class="block-description">

                <div class="movie-time d-flex align-items-center my-2 remove-age-limit">
                    <div class="badge badge-secondary p-1 mr-2">{{ $sdata->age_limit ? $sdata->age_limit : null }}</div>
                    <span class="text-white">{{ $sdata->duration ? $sdata->duration : null }}</span>
                </div>

                @if ($sdata->published_status == 1)
                    <div class="hover-buttons">
                        {{--  --}}
                        {{-- @dd($sdata) --}}


                        <a href="{{ route('frontend.details', $sdata->slug) }}">
                            <span class="btn btn-warning">
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </span>
                        </a>


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
    </li>
@endisset
