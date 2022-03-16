@extends('layouts.master')

@section('content')

    <!-- Slider Start -->
    @include('layouts.part.slider_home',['slider' => $slider])
    <!-- Slider End -->

    <!-- MainContent -->

    <div class="main-content">


        <!--Categories Slider Start -->
        @include('layouts.part.categories',['slider' => $categories])
        <!-- Categories Slider End -->


        <!-- Free Movie Slider Start -->
        @include('layouts.part.slider_section',['slider' => $free])
        <!-- Free Movie Slider End -->

        <!-- bucket Movie Slider Start -->
        @include('layouts.part.slider_order',['slider' => $bucketList])
        <!-- bucket Movie Slider End -->

        <!-- History Movie Slider Start -->
        @include('layouts.part.slider_favorites',['slider' => $history])
        <!-- History Movie Slider End -->
        <!-- Upcoming Movie Slider Start -->
        @include('layouts.part.slider_section',['slider' => $upcoming])
        <!-- Upcoming Movie Slider End -->
        @if ($suggested['data'])
            <!-- Suggested Movie Slider Start -->
            @include('layouts.part.slider_suggested',['slider' => $suggested, 'suggested' => $suggested['data']])
            <!-- Suggested Movie Slider End -->
        @else
            @include('layouts.part.slider_section',['slider' => $suggested, 'suggested' => $suggested['data']])
        @endif
        <!-- Premiam Movie Slider Start -->
        @include('layouts.part.slider_section',['slider' => $premium])
        <!-- Premiam Movie Slider End -->



        <!-- listing Movie Slider Start -->
        @include('layouts.part.slider_favorites',['slider' => $listing])
        <!-- listing Movie Slider End -->



        <!-- Favorite Movie Slider Start -->
        @include('layouts.part.slider_favorites',['slider' => $favorites])
        <!-- Favorite Movie Slider End -->


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
