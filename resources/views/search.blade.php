{{-- <template> --}}


    <div id="app_ser">
        {{-- v-bind:class="{ open:isSerache  }" --}}
        <div id="search_customize">
        {{-- <h1>{{ search }}</h1> --}}
        <div class="search-close-button">
            {{-- v-on:click="isActiveSearch()" --}}
            <button type="button" class="close">×</button>
        </div>
        <div class="form-group">
            <form class="d-flex" action="get">
                <button type="submit" class="btn btn-primary">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </button>
                {{-- <input type="search" v-model="searchData" class="from-controller" @keyup="someHandler" placeholder="type here to search..."> --}}
            </form>
            {{-- <h1 v-for="">
                @{{search}}
            </h1> --}}
            @{{ searchData }}
        </div>


        <div class="SearchView">
            <div class="container">
                {{-- checkbox --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex search-check-box">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                  Today's Cinebaz
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Last 3 days Cinebaz
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" checked>
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Trending Cinebaz
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" checked>
                                <label class="form-check-label" for="flexRadioDefault4">
                                    Shows All
                                </label>
                              </div>
                        </div>
                    </div>
                </div>
                {{-- check category list --}}
                <div class="row py-4">
                    <div class="col-md-12">
                        <div class="search-check-category">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" for="inlineCheckbox1">Movie</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                <label class="form-check-label" for="inlineCheckbox2">TV Show</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option2">
                                <label class="form-check-label" for="inlineCheckbox3">Web Series</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="option2">
                                <label class="form-check-label" for="inlineCheckbox4">Natok</label>
                              </div>
                        </div>
                    </div>
                </div>
                {{-- movie list --}}
                <div class="row">

                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            {{-- <h4 class="main-title">
                                <a href="javascript:void(0);">{{ isset($slider['name'])? $slider['name'] : null }}</a>
                            </h4> --}}
                        </div>
                        <div class="favorites-contens">
                            <ul class="favorites-slider list-inline  row p-0 mb-0">
                                {{-- @foreach ($sdata['data'] as $item)
                                    @dd($item)
                                @endforeach --}}
                                @isset($sdata)
                                @foreach ($sdata['data'] as $item)


                                    <li class="slide-item">
                                        <div class="block-images position-relative">
                                            <div class="img-box slider-img-box">
                                                @if($item->premium == 1)
                                                    <div class="cardPremium">
                                                        <div class="cpPrice">
                                                            <div class="planbox__header__strike-through">
                                                                {{ $item->regular_price ? PayCurrency($item->regular_price) : null }}
                                                            </div>
                                                            <div class="planbox__header__value">
                                                                <span class="price"> {{ $item->discount_price ? PayCurrency($item->discount_price)  : null }} </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <a href="">
                                                    @if ($item->featured)
                                                        <img data-original="{{ asset('storage/'.$item->featured->small) }}" src="{{ asset('storage/'.$item->featured->small) }}" class="img-fluid" alt="">
                                                    @else
                                                        <img data-original="{{ asset('assets/frontend/images/noimage-p.png') }}" src="{{ asset('assets/frontend/images/noimage-p.png') }}" class="img-fluid" alt="">
                                                    @endif
                                                </a>
                                            </div>

                                            <div class="block-description">

                                                <div class="movie-time d-flex align-items-center my-2 remove-age-limit">
                                                    <div class="badge badge-secondary p-1 mr-2">{{ $item->age_limit ? $item->age_limit : null }}</div>
                                                    <span class="text-white">{{ $item->duration ? $item->duration : null }}</span>
                                                </div>

                                                <div class="hover-buttons">
                                                    <a href="">
                                                        <span class="btn btn-warning">
                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                        </span>
                                                    </a>
                                                    @if($item->premium == 1)
                                                        @if(auth('member')->user())
                                                            @if(MyBucket($item->id,auth('member')->user()->id))
                                                                <button class="btn btn-default" disabled>
                                                                    <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
                                                                </button>
                                                            @else
                                                            <a href="javascript:void(0)" onclick="AddToCart({{$item->id}})">
                                                                <span class="btn btn-warning">
                                                                    <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
                                                                </span>
                                                            </a>
                                                            @endif
                                                        @else
                                                            <a href="javascript:void(0)" onclick="AddToCart({{$item->id}})">
                                                                <span class="btn btn-warning">
                                                                    <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
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

                                                @if(auth('member')->check())
                                                <div class="block-social-info">
                                                    <ul class="list-inline p-0 m-0 music-play-lists">
                                                        <li>
                                                            <span onclick="addFavorite({{$item->id}});"
                                                            class="{{ (in_array($item->id, $member['favorites']))? 'active':'fevourit' }} fev{{$item->id}} ">
                                                            <i class="ri-heart-fill"></i></span>
                                                        </li>
                                                        <li>
                                                        <span onclick="addListing({{$item->id}});"
                                                                class="{{ (in_array($item->id, $member['listing']))? 'active':'listing' }} list{{$item->id}}">
                                                                <i class="ri-add-line"></i></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endif
                                                <h6 class="hover-heading">
                                                    <a href="">
                                                        {{ $item->title_en }}
                                                    </a>
                                                </h6>
                                            </div>

                                        </div>
                                    </li>
                                @endforeach
                                @endisset
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- </template> --}}
@push('scripts')


@endpush
