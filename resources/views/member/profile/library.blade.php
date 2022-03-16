@extends('layouts.master')
@section('content')
    {{--  --}}

    <section class="m-profile setting-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 mb-3">
                    <div class="library-full_card">
                        <div class="sign-user_card text-center">
                            @if (count($user->images) > 0)
                                <img src="{{ url('storage/' . $user->images[0]->thumbnail) }}"
                                    class="img-fluid d-block mx-auto mb-3" alt="{{ $user->name }}" id="image">
                            @else
                                <img src="{{ Gravatar::src('https://www.gravatar.com/avatar/', 150) }}" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image">
                                {{--  <img src="https://visualpharm.com/assets/30/User-595b40b85ba036ed117da56f.svg"
                                    class="img-fluid d-block mx-auto mb-3" alt="{{ $user->name }}" id="image">  --}}
                            @endif
                            <h4 class="mb-3">{{ $user->name }}</h4>
                            <a href="{{ route('member.auth.profile') }}" class="btn btn-hover btn-mng-prfl btn-block"><i
                                    class="ri-file-user-line text-primary"></i> Manage Profile</a>
                            <a href="{{ route('member.auth.settings') }}" class="btn btn-hover btn-mng-prfl btn-block"><i
                                    class="ri-settings-4-line text-primary"></i> Settings</a>
                            <a href="{{ route('member.auth.library') }}"
                                    class="btn btn-hover btn-mng-prfl btn-block active"><i class="ri-store-line text-primary">
                                        </i> My Library</a>
                            <a href="{{ route('member.auth.bucket') }}" class="btn btn-hover btn-mng-prfl btn-block"><i
                                    class="ri-shopping-cart-2-line text-primary"></i> My Purchase</a>
                            <a href="{{ route('member.auth.change_password') }}"
                                class="btn btn-hover btn-mng-prfl btn-block"><i
                                    class="ri-lock-unlock-line text-primary"></i> Change Password</a>
                            <a href="{{ route('member.auth.logout') }}" class="btn btn-hover btn-mng-prfl btn-block"><i
                                    class="ri-logout-circle-line text-primary"></i> Logout</a>
                        </div>

                    </div>

                </div>

                <div class="col-lg-9">
                    {{-- style="padding-top: 70px" --}}

                    <section id="iq-upcoming-movie">
                        @isset($lastWatch)
                            @include('layouts.part.slider_favorites',['slider' => $lastWatch])
                        @endisset
                    </section>


                    <section id="iq-upcoming-movie">
                        @isset($listing)
                            @include('layouts.part.slider_favorites',['slider' => $listing])
                        @endisset
                    </section>
                    <section id="iq-list-movie">
                        @isset($favorites)
                            @include('layouts.part.slider_favorites',['slider' => $favorites])
                        @endisset
                    </section>
                </div>
            </div>
        </div>
    </section>


@endsection
@push('style')
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
