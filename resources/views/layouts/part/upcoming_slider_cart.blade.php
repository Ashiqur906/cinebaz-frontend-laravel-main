
@isset($sdata)
    <li class="slide-item">
        <div class="block-images position-relative">
            <div class="img-box slider-img-box">
                @if ($sdata->featured)
                    <img data-original="{{ asset('storage/'.$sdata->featured->small) }}" src="{{ asset('storage/'.$sdata->featured->small) }}" class="img-fluid" alt="">
                @else
                    <img data-original="{{ asset('assets/frontend/images/noimage-p.png') }}" src="{{ asset('assets/frontend/images/noimage-p.png') }}" class="img-fluid" alt="">
                @endif
            </div>
            <div class="block-description">
                <h6>{{ $sdata->title_en }}</h6>
                <div class="movie-time d-flex align-items-center my-2">
                    <div class="badge badge-secondary p-1 mr-2">{{ $sdata->age_limit ? $sdata->age_limit : null }}</div>
                    <span class="text-white">{{ $sdata->duration ? $sdata->duration : null }}</span>
                </div>
                @if($sdata->premium == 1)
                <div class="movie-time d-flex align-items-center my-2">
                    <div class="badge badge-secondary p-1 mr-2">Price</div>
                    <span class="text-white" style="text-decoration: line-through;font-size: 12px;">{{ $sdata->regular_price ? $sdata->regular_price : null }}</span>
                    <span class="text-white">{{ $sdata->discount_price ? '/' .$sdata->discount_price : null }} {{ PayCurrency() }}</span>
                </div>
                @endif
                <div class="hover-buttons">
                    @if(auth('member')->check() && auth('member')->user()->membership_id)
                    <a href="{{ route('frontend.details', $sdata->slug) }}">
                        <span class="btn btn-hover">
                            <i class="fa fa-play mr-1" aria-hidden="true"></i>
                        </span>
                    </a>
                    @else
                    <a href="{{ route('frontend.details', $sdata->slug) }}">
                        <span class="btn btn-hover">
                            <i class="fa fa-play mr-1" aria-hidden="true"></i>
                        </span>
                    </a>
                    @endif
                    @if($sdata->premium == 1)
                        @if(auth('member')->user())
                            @if(MyBucket($sdata->id,auth('member')->user()->id))
                                <button class="btn btn-default" disabled>
                                    <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
                                </button>
                            @else
                            <a href="javascript:void(0)" onclick="AddToCart({{$sdata->id}})">
                                <span class="btn btn-warning">
                                    <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
                                </span>
                            </a>
                            @endif
                        @else
                            <a  href="javascript:void(0)" onclick="AddToCart({{$sdata->id}})">
                                <span class="btn btn-warning">
                                    <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
                                </span>
                            </a>
                        @endif
                    @else
                    <a href="{{ route('frontend.details', $sdata->slug) }}">
                        <span class="btn btn-warning">
                            Free
                        </span>
                    </a>
                    @endif
                </div>
               
                @if(auth('member')->check())
                <div class="block-social-info">
                    <ul class="list-inline p-0 m-0 music-play-lists">
                        <li>
                            <span onclick="addFavorite({{$sdata->id}});"
                            class="{{ (in_array($sdata->id, $member['favorites']))? 'active':'fevourit' }} fev{{$sdata->id}}">
                            <i class="ri-heart-fill"></i></span>
                        </li>
                        <li>
                        <span onclick="addListing({{$sdata->id}});"
                                class="{{ (in_array($sdata->id, $member['listing']))? 'active':'listing' }} list{{$sdata->id}}">
                                <i class="ri-add-line"></i></span>  
                        </li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </li>
@endisset

