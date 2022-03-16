@extends('layouts.master')

@section('content')
    <!-- MainContent -->
    <div class="main-content" style="padding-top:70px;">

        @include('layouts.part.category_details',['slider' => $cat])

    </div>


    <script>
        function AddToCart(id) {
            $.ajax({
                url: "{{ url('cart/add/') }}" + '/' + id,
                type: 'get',
                success: function(result) {
                    $('.cart_items').html(result);
                }
            });
        }
    </script>
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
