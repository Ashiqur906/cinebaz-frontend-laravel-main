@extends('layouts.master')
@section('content')
<section class="m-profile">
    <div class="container">
        <h4 class="main-title mb-4">Purchase Plan</h4>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="sign-user_card">
                    <form method="POST" class="needs-validation" novalidate>
                        <table class="table bg-color">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Total Hour</th>
                                    <th>Watch Hour</th> 
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            @foreach(MyCart() as $cart)
                            <tr>
                                <td>
                                    <img src="{{ asset($cart->associatedModel->featured ? 'storage/'.$cart->associatedModel->featured->small : 'assets/frontend/images/noimage-p.png') }}" alt="" style="height:70px;">
                                </td>
                                <td>{{$cart->name}}</td>
                                <td>{{$cart->quantity}}</td>
                                <td>{{$cart->associatedModel->duration}}</td>
                                <td>{{$cart->attributes->hour}}</td>
                                <td>{{$cart->price}} Tk</td>
                                <td>
                                    <a href="{{route('frontend.cart:remove',$cart->id)}}" class="btn btn-hover">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                                            <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                                            <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                         <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="same-address">
                            <input type="hidden" value="{{ $mdata->price }}" name="per_month" id="per_month" required/>
                            <input type="hidden" value="{{ $mdata->price }}" name="amount" id="total_amount" required/>
                        </div>
                        <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                                token="if you have any token validation"
                                postdata="your javascript arrays or objects which requires in backend"
                                order="If you already have the transaction generated for current order"
                                endpoint="{{ url('/pay-via-ajax') }}"> Pay Now
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@push('styles')
<style>
    .makeupinstation {
        display: block;
    }
    .makeupinstation small {
        color: #9E9E9E;
        font-weight: 200;
    }
    select#billing_cycle {
        background: #2c3034;
        border: 1px solid #bbbbbb;
    }

</style>
@endpush
@push('scripts')

<script>

    master_form();
    $(document).on('change', '#billing_cycle', function() {
        master_form();
    });
    function master_form(){
       var amount = {{Cart::getTotal()}};
       var months = 1;
       var total = amount*months;
       var name =$('#billing_cycle :selected').text();
       $('#total_amount').val(total);
       $('#view_billing_cycle').html(name);
       $('#view_total_amount').html(total);
       // alert(name);

       var obj = {};
        obj.package = "1";
        obj.bill = months;
        //console.log(obj);
        $('#sslczPayBtn').prop('postdata', obj);
    }


        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>

@endpush

@endsection
