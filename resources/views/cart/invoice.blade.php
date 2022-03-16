@extends('layouts.master')
 
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <div class="main-content ">
        <div class="cart_section cards-print"> 
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="page-content container">
                            <div class="page-header text-blue-d2">
                                <h1 class="page-title text-secondary-d1">
                                    Invoice
                                    <small class="page-info">
                                        <i class="fa fa-angle-double-right text-80"></i>
                                        ID: #{{$getOrder->code}}
                                    </small>
                                </h1>
                                <img src="{{asset('assets/frontend/images/logo.png')}}" style="width:200px;">
                                <div class="page-tools">
                                    <div class="action-buttons">
                                        <a class="btn bg-white btn-light mx-1px text-95" href="{{route('frontend.ticket.print',$getOrder->code)}}" target="_blank" data-title="PDF">
                                            <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                                            Export
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="container px-0 cards-print" >
                                <div class="row mt-4">
                                    <div class="col-12 col-lg-12 contents">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div>
                                                    <span class="text-sm text-grey-m2 align-middle">To:</span>
                                                    <span class="text-600 text-110 text-blue align-middle">{{$getOrder->name}}</span>
                                                </div>
                                                <div class="text-grey-m2">
                                                    <div class="my-1">
                                                        {{$getOrder->address}}
                                                    </div>
                                                    <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">{{$getOrder->phone}}</b></div>
                                                </div>
                                            </div>
                                            <!-- /.col -->

                                            <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                                <hr class="d-sm-none" />
                                                <div class="text-grey-m2">
                                                    <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                                        Invoice
                                                    </div>

                                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #{{$getOrder->code}}</div>
                                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{date('dM, Y', strtotime($getOrder->updated_at))}}</div>
                                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> 
                                                        <span class="text-600 text-90">Status:</span> 
                                                        @if($getOrder->sub_status == 'Active')
                                                        <span class="badge badge-success badge-pill px-25">{{$getOrder->sub_status}}</span>
                                                        @elseif($getOrder->sub_status == 'pending')
                                                        <span class="badge badge-warning badge-pill px-25">{{$getOrder->sub_status}}</span>
                                                        @else
                                                        <span class="badge badge-danger badge-pill px-25">{{$getOrder->sub_status}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>

                                        <div class="mt-4">
                                            <div class="row text-600 text-white bgc-default-tp1 py-25">
                                                <div class="d-none d-sm-block col-1">#</div>
                                                <div class="d-none d-sm-block col-4 col-sm-2">Image</div>
                                                <div class="col-9 col-sm-5">Description</div>
                                                <div class="d-none d-sm-block col-sm-2">Deadline</div>
                                                <div class="col-2">Amount</div>
                                            </div>
                                            <div class="text-95 text-secondary-d3">
                                                @php 
                                                    $reg_total      = 0;
                                                    $dis_total   = 0;
                                                @endphp
                                                @foreach($getOrder->Details as $details)
                                                @php 
                                                    $price = $details->medias->regular_price;
                                                    $reg_total += $price;
                                                    $discount = $details->medias->discount_price;
                                                    $dis_total += $discount;
                                                @endphp
                                                <div class="row mb-2 mb-sm-0 py-25">
                                                    <div class="d-none d-sm-block col-1">{{$loop->index+1}}</div>
                                                    <div class="d-none d-sm-block col-4 col-sm-2">
                                                        <img src="{{asset($details->medias && $details->medias->featured ? 'storage/'.$details->medias->featured->small : null)}}" style="width:60px;">
                                                    </div>
                                                    <div class="col-9 col-sm-5">
                                                        <p>{{$details->medias->title_en}}</p>
                                                    </div>
                                                    <div class="d-none d-sm-block col-2 text-95">{{ $details->deadline }}</div>
                                                    <div class="col-2 text-secondary-d2">{{ PayCurrency() }} {{ $price ? $price : 0 }}</div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <hr />
                                            <div class="row border-b-2 brc-default-l2"></div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                                    <!-- Extra note such as company or payment information... -->
                                                </div>

                                                <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                                    <div class="row my-2">
                                                        <div class="col-7 text-right">
                                                            SubTotal
                                                        </div>
                                                        <div class="col-5">
                                                            <span class="text-120 text-secondary-d1">{{ PayCurrency() }} {{ $reg_total }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="row my-2">
                                                        <div class="col-7 text-right">
                                                            Discount
                                                        </div>
                                                        <div class="col-5">
                                                            <span class="text-110 text-secondary-d1">{{ PayCurrency() }} {{ $reg_total - $dis_total }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="row my-2 align-items-center bgc-primary-l3 p-2" style="border-top:1px solid gray;">
                                                        
                                                        <div class="col-7 text-right">
                                                            Total Amount
                                                        </div>
                                                        <div class="col-5">
                                                            <span class="text-150 text-success-d3 opacity-2">{{ PayCurrency() }} {{ $dis_total }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr />

                                            <div>
                                                <span class="text-secondary-d1 text-105">Thank you for your support</span>
                                                <a href="{{route('member.auth.bucket')}}" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0"><i class="fas fa-boxes"></i> My Bucket</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.js"></script>

@endpush

@push('styles')
<style>
    .page-content{
        background-color:#424242;
        padding:15px 0px;
    }
    .contents{
        padding: 0px 43px 0px 41px;
    }
    .page-header {
        margin: 0 0 1rem;
        padding: 0px 24px 15px 24px;
        border-bottom: 1px dotted #e2e2e2;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-align: center;
        align-items: center;
    }
    .page-title {
        padding: 0;
        margin: 0;
        font-size: 18px;
        font-weight: 300;
    }
    .brc-default-l1 {
        border-color: #dce9f0!important;
    }

    .ml-n1, .mx-n1 {
        margin-left: -.25rem!important;
    }
    .mr-n1, .mx-n1 {
        margin-right: -.25rem!important;
    }
    .mb-4, .my-4 {
        margin-bottom: 1.5rem!important;
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0,0,0,.1);
    }

    .text-grey-m2 {
        color: #888a8d!important;
    }

    .text-success-m2 {
        color: #86bd68!important;
    }

    .font-bolder, .text-600 {
        font-weight: 600!important;
    }

    .text-110 {
        font-size: 110%!important;
    }
    .text-blue {
        color: #478fcc!important;
    }
    .pb-25, .py-25 {
        padding-bottom: .75rem!important;
    }

    .pt-25, .py-25 {
        padding-top: .75rem!important;
    }
    .bgc-default-tp1 {
        background-color: rgba(121,169,197,.92)!important;
    }
    .bgc-default-l4, .bgc-h-default-l4:hover {
        background-color: #f3f8fa!important;
    }
    .page-header .page-tools {
        -ms-flex-item-align: end;
        align-self: flex-end;
    }

    .btn-light {
        color: #757984;
        background-color: #f5f6f9;
        border-color: #dddfe4;
    }
    .w-2 {
        width: 1rem;
    }

    .text-120 {
        font-size: 120%!important;
    }
    .text-primary-m1 {
        color: #4087d4!important;
    }

    .text-danger-m1 {
        color: #dd4949!important;
    }
    .text-blue-m2 {
        color: #68a3d5!important;
    }
    .text-150 {
        font-size: 150%!important;
    }
    .text-60 {
        font-size: 60%!important;
    }
    .text-grey-m1 {
        color: #7b7d81!important;
    }
    .align-bottom {
        vertical-align: bottom!important;
    }
</style>

@endpush
