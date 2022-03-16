@isset($sdata->medias)
@php
    $deadline   = new DateTime($sdata->deadline);
    $today      = new DateTime("now");
@endphp
    <li class="slide-item">
        <div class="block-images position-relative">
            <div class="img-box slider-img-box">
                @if (auth('member')->check())
                    <div class="block-social-info">
                        <ul class="list-inline p-0 m-0 music-play-lists">
                            <li>
                                <span onclick="addFavorite({{ $sdata->medias ? $sdata->medias->id : 0 }});"
                                    class="{{ (in_array($sdata->medias ? $sdata->medias->id : null, $member['favorites']))? 'active':'fevourit' }} fev{{$sdata->medias ? $sdata->medias->id : null}}">
                                    <i class="ri-heart-fill"></i></span>
                            </li>
                            <li>
                                <span onclick="addListing({{ $sdata->medias ? $sdata->medias->id : 0 }});"
                                    class="{{ (in_array($sdata->medias ? $sdata->medias->id : 0, $member['listing']))? 'active':'listing' }} list{{$sdata->medias ? $sdata->medias->id : 0}}">
                                    <i class="ri-add-line"></i></span>
                            </li>
                        </ul>
                    </div>
                    @if($deadline < $today)
                    <div class="cardPremium">
                        <div class="cpPrice">
                            <div class="planbox__header__strike-through">
                                {{ $sdata->medias->regular_price ? PayCurrency($sdata->medias->regular_price) : null }}
                            </div>
                            <div class="planbox__header__value">
                                <span class="price">
                                    {{ $sdata->medias->discount_price ? PayCurrency($sdata->medias->discount_price) : null }} </span>
                            </div>
                        </div>
                    </div>
                    @endif

                @endif
                <a href="{{ route('frontend.details', $sdata->medias->slug) }}">
                    @if ($sdata->medias->featured)
                        <img data-original="{{ asset('storage/' . $sdata->medias->featured->small) }}"
                            src="{{ asset('storage/' . $sdata->medias->featured->small) }}" class="img-fluid" alt="">
                    @else
                        <img data-original="{{ asset('assets/frontend/images/noimage-p.png') }}"
                            src="{{ asset('assets/frontend/images/noimage-p.png') }}" class="img-fluid" alt="">
                    @endif
                </a>
            </div>

            <div class="block-description">
                    <div class="hover-buttons">
                        @if(auth('member')->check())
                            <a href="{{ route('frontend.show',$sdata->medias->slug) }}">
                                <span class="btn btn-warning">
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                </span>
                            </a>
                        @if($deadline < $today)
                            <a href="javascript:void(0)" onclick="AddToCart({{ $sdata->medias ? $sdata->medias->id : 0 }})">
                                <span class="btn btn-warning">
                                    <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
                                </span>
                            </a>
                        @endif
                        @endif
                    </div>

                <h6 class="hover-heading">
                    <a href="{{ route('frontend.details', $sdata->medias->slug) }}">
                        {{ $sdata->medias->title_en }}
                    </a>
                </h6>
            </div>

        </div>
    </li>
@endisset
