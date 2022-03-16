<div class="laraNoti">
<x:notify-messages />
</div>
    <li class="nav-item nav-icon">
        <a href="#" class="search-toggle position-relative">
            <i class="fa fa-shopping-cart"></i>
            <span class="bg-danger cart_count" style="height: 14px;width: 14px;font-size: 10px;text-align: center;padding: 2px;
                                                position: absolute;
                                                top: 0px;
                                                right: -2px;
                                                border-radius: 50%;"
            >
                {{CountMyCart()}}
            </span>
        </a>
        <div class="iq-sub-dropdown">
            <div class="iq-card shadow-none m-0">
                <div class="iq-card-body">
                    <div class="cart_items">
                    @foreach(MyCart() as $cart)
                        <a href="#" class="iq-sub-card" style="background-color:#323131;">
                            <div class="media align-items-center">
                                <img src="{{ asset($cart->associatedModel->featured ? 'storage/'.$cart->associatedModel->featured->small : 'assets/frontend/images/noimage-p.png') }}"
                                    class="img-fluid mr-3" alt="cinebaz" style="width:40px;"/>
                                <div class="media-body">
                                    <h6 class="mb-0 ">{{$cart->name}}</h6>
                                    <small class="font-size-12"> Price :{{ PayCurrency() }} {{$cart->price}} </small>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    </div>
                    <a href="#" class="iq-sub-card" style="background-color:#323131;">
                        <div class="media align-items-center">
                            <div class="media-body pull-right" style="text-align:right; float:right;">
                                <span><span class="mb-0 ">Total Price :</span> <small style="font-size:15px;"> {{ PayCurrency() }} {{ MyCartTotal() }} </small></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="iq-card-footer">
                    @if(CountMyCart()>0)
                    <a href="{{route('frontend.cart:checkout')}}" class="btn btn-hover btn-block"> Checkout </a>
                    @else
                    <button class="btn btn-hover btn-block" disabled>Oops! Bucket is Empty. </button>
                    @endif
                </div>
            </div>
        </div>
    </li>