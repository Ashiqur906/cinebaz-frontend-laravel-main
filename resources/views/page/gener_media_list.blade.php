@extends('layouts.master')

@section('content')
    <!-- MainContent -->
    <div class="main-content" style="padding-top:70px;">

        @include('layouts.part.gener_details',['slider' => $gener_media_list])

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
