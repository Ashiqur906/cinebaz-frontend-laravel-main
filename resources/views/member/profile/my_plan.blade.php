@extends('layouts.master')
@section('content')
<!-- MainContent -->
<section class="m-profile">
    <div class="container">
        <h4 class="main-title mb-4">Pricing Plan</h4>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="sign-user_card">
                    <div class="table-responsive pricing pt-2">
                        <table id="my-table" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center prc-wrap"></th>
                                    <th class="text-center prc-wrap">
                                        <div class="prc-box">
                                            <div class="h3 pt-4 text-white">$19<small> / Per month</small></div>
                                            <span class="type">Basic</span>
                                        </div>
                                    </th>
                                    <th class="text-center prc-wrap">
                                        <div class="prc-box active">
                                            <div class="h3 pt-4 text-white">$39<small> / Per month</small></div>
                                            <span class="type">Standard</span>
                                        </div>
                                    </th>
                                    <th class="text-center prc-wrap">
                                        <div class="prc-box">
                                            <div class="h3 pt-4 text-white">$119<small> / Per month</small></div>
                                            <span class="type">Platinum</span>
                                        </div>
                                    </th>
                                    <th class="text-center prc-wrap">
                                        <div class="prc-box">
                                            <div class="h3 pt-4 text-white">$219<small> / Per month</small></div>
                                            <span class="type">Premium</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center" scope="row">New Movies</th>
                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                    <td class="text-center child-cell active"><i class="ri-check-line ri-2x"></i>
                                    </td>
                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">Streamit Special</th>
                                    <td class="text-center child-cell"><i class="ri-close-line i_close"></i></td>
                                    <td class="text-center child-cell active"><i class="ri-check-line ri-2x"></i>
                                    </td>
                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">American Tv Shows</th>
                                    <td class="text-center child-cell"><i class="ri-close-line i_close"></i></td>
                                    <td class="text-center child-cell active"><i class="ri-check-line ri-2x"></i>
                                    </td>
                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">Hollywood Movies</th>
                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                    <td class="text-center child-cell active"><i class="ri-check-line ri-2x"></i>
                                    </td>
                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">Video Quality</th>
                                    <td class="text-center child-cell">SD (480p)</td>
                                    <td class="text-center child-cell active">HD (720p)</td>
                                    <td class="text-center child-cell">FHD (1080p)</td>
                                    <td class="text-center child-cell">FHD (1080p)</td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">Ad Free Entertainment</th>
                                    <td class="text-center child-cell"><i class="ri-close-line i_close"></i></td>
                                    <td class="text-center child-cell active"><i class="ri-close-line i_close"></i>
                                    </td>
                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="ri-close-line i_close"></i></td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-hover mt-3">Purchase</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-hover mt-3">Purchase</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-hover mt-3">Purchase</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-hover mt-3">Purchase</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
