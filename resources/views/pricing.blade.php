@extends('layouts.master')
@section('content')
<section class="m-profile">
    <div class="container">
        <h4 class="main-title mb-4">Pricing Plan</h4>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="sign-user_card">
                    <div class="table-responsive pricing pt-2">
                        @if(count($SubHead)>0)
                        <table id="my-table" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center prc-wrap"></th>
                                    @foreach($SubHead as $head)
                                    <th class="text-center prc-wrap">
                                        <div class="prc-box">
                                            <div class="h3 pt-4 text-white">{{$head->price}}<small> / Per {{$head->duration}}</small></div>
                                            <span class="type">{{$head->title}}</span>
                                        </div>
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($PHead as $plan)
                                <tr>
                                    <th class="text-center" scope="row">{{$plan->title}}</th>
                                    @foreach($SubHead as $head)
                                    @if($Assign::AssignHead($head->id,$plan->id))
                                    @if($Assign::AssignHead($head->id,$plan->id)->quality_id)
                                    <td class="text-center child-cell">{{$Assign::GetQuality($Assign::AssignHead($head->id,$plan->id)->quality_id)->title_en}}</td>

                                    @else
                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                    @endif
                                    @else
                                    <td class="text-center child-cell"><i class="ri-close-line i_close ri-2x"></i></td>
                                    @endif
                                    @endforeach
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="text-center"></td>
                                    @foreach($SubHead as $purchase)
                                    <td class="text-center">
                                        <a href="{{ route('member.auth.purchase', $purchase->id) }}" class="btn btn-hover mt-3">Purchase</a>
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
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

@endsection
