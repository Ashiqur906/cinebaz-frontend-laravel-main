@extends('layouts.master')
@section('content')
<!-- MainContent -->
<section class="m-profile setting-wrapper">
    <div class="container-fluid">
        <!-- <h4 class="main-title mb-4">My Account</h4> -->
        <div class="row">
            <div class="col-lg-3 mb-3">
                <div class="sign-user_card text-center">
                    @if(count($user->images)>0)
                    <img src="{{url('storage/'.$user->images[0]->thumbnail)}}" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image">
                    @else
                    <img src="{{ Gravatar::src('https://www.gravatar.com/avatar/', 150) }}" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image">
                    {{--  <img src="https://visualpharm.com/assets/30/User-595b40b85ba036ed117da56f.svg" class="img-fluid d-block mx-auto mb-3" alt="{{$user->name}}" id="image">  --}}
                    @endif
                    <h4 class="mb-3">{{$user->name}}</h4>

                        <a href="{{ route('member.auth.profile') }}" class="btn btn-hover btn-mng-prfl btn-block active"><i class="ri-file-user-line text-primary"></i> Manage Profile</a>
                        <a href="{{ route('member.auth.settings') }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-settings-4-line text-primary"></i> Settings</a>
                        <a href="{{ route('member.auth.library') }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-store-line text-primary"></i> My Library</a>
                        <a href="{{ route('member.auth.bucket') }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-shopping-cart-2-line text-primary"></i> My Purchase</a>
                        <a href="{{ route('member.auth.change_password') }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-lock-unlock-line text-primary"></i>  Change Password</a>
                        <a href="{{ route('member.auth.logout') }}" class="btn btn-hover btn-mng-prfl btn-block"><i class="ri-logout-circle-line text-primary"></i> Logout</a>

                    <a href="{{route('member.auth.settings')}}" class="edit-icon text-primary"><i class="fa fa-pencil" style="background-color: white;color:red; padding:5px 7px;border-radius: 50px;"></i></a>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="sign-user_card">
                    <h5 class="mb-3 pb-3 a-border">Personal Details</h5>
                    <div class="row align-items-center justify-content-between mb-3">
                        <div class="col-md-8">
                            <span class="text-light font-size-13">Email</span>
                            <p class="mb-0">{{$user->email}}</p>
                        </div>
                    </div>
                    <div class="row align-items-center justify-content-between mb-3">
                        <div class="col-md-8">
                            <span class="text-light font-size-13">Phone</span>
                            <p class="mb-0">{{$user->phone}}</p>
                        </div>
                    </div>
                    <div class="row align-items-center justify-content-between mb-3">
                        <div class="col-md-8">
                            <span class="text-light font-size-13">Joining Date</span>
                            <p class="mb-0">{{date('dM, Y',strtotime($user->created_at))}}</p>
                        </div>
                    </div>
                    <div class="row justify-content-between mb-3">
                        <div class="col-md-12 r-mb-15" style="border: 1px solid white;">
                            <h5 class="mb-3 mt-4 pb-3 a-border">Billing Details</h5>
                            <div style="overflow-x:auto;">
                                <table class="table text-light">
                                    <tr>
                                        <th>SL</th>
                                        <th>Paid Amount</th>
                                        <th>Date</th>
                                        <th>Deadline</th>
                                        <th>Account Status</th>
                                    </tr>
                                    @foreach($get_bill as $bill)
                                    <tr>
                                        <td>#{{$loop->index+1}}</td>
                                        <td>{{$bill->amount ? $bill->amount : null}} {{ $bill->amount ? PayCurrency() : null }}</td>
                                        <td>{{date('dM, Y',strtotime($bill->created_at))}}</td>
                                        @php
                                            $paid       = $bill->amount;
                                            $price      = $bill->PlanHead ? $bill->PlanHead->price : 1;
                                            $month      = ($paid/$price);
                                        @endphp
                                        <td>{{date("dM, Y", strtotime("+$month month", strtotime($bill->created_at)))}}</td>

                                        @if($bill->created_at > date("Y-m-d"))
                                        <td>
                                            <button type="button" class="btn-sm btn-success">Active</button>
                                        </td>
                                        @else
                                        <td>
                                            <button type="button" class="btn-sm btn-danger">Expired</button>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="row justify-content-between mb-3">
                        <div class="col-md-12 r-mb-15" style="border: 1px solid white;">
                            <h5 class="mb-3 mt-4 pb-3 a-border">Order Details</h5>
                            <div style="overflow-x:auto;">
                                <table class="table text-light">
                                    <tr>
                                        <th>SL</th>
                                        <th>Media</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Deadline</th>
                                        <th>Movie Details</th>
                                        <th>Ticket Status</th>
                                    </tr>
                                    @foreach($get_ticket as $ticket)
                                    <tr>
                                        {{--  @dd($ticket->medias)  --}}
                                        <td>#{{$loop->index+1}}</td>
                                        <td>{{$ticket->medias ? $ticket->medias->title_en : null}}</td>
                                        <td>{{$ticket->medias ? $ticket->medias->discount_price : null}} {{$ticket->medias && $ticket->medias->discount_price ? PayCurrency() : null }}</td>
                                        <td>{{date('dM, Y',strtotime($ticket->orders->created_at))}}</td>
                                        <td>{{date("dM, Y", strtotime($ticket->deadline))}}</td>
                                        <td>
                                            <a href="{{ route('frontend.details', $ticket->medias->slug) }}" type="button" class="btn-sm btn-info">Details</a>
                                        </td>
                                        @if( $ticket->deadline < date("Y-m-d"))
                                        <td>
                                            <button type="button" class="btn-sm btn-danger">Expired</button>
                                        </td>
                                        @else
                                        <td>
                                            <button type="button" class="btn-sm btn-success">Active</button>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </table>
                            </div>

                        </div>
                    </div>
                    {{--  <h5 class="mb-3 mt-4 pb-3 a-border">Plan Details</h5>
                    <div class="row justify-content-between mb-3">
                        <div class="col-md-8">
                        <p>{{$user->SubHead ? $user->SubHead->title : 'Free Member'}}</p>
                        </div>
                        <div class="col-md-4 text-md-right text-left">
                            <a href="#" class="text-primary">Change Plan</a>
                        </div>
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MainContent End-->
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
