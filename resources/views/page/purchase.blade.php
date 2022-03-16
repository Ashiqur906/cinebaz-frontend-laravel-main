@extends('layouts.master')
@section('content')
    <section class="m-profile">
        <div class="container">
            <h4 class="main-title mb-4">Purchase Plan</h4>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="sign-user_card">
                        <form method="POST" class="needs-validation" novalidate>
                            {{-- @dump($member) --}}
                            <div class="mb-3">
                                <div class="form-group">
                                    <label>Billing Cycle</label>
                                    <select class="form-control mb-3" id="billing_cycle">
                                        @foreach (purchaseDutation() as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table class="table table-striped table-dark">
                                <tbody>
                                    <tr>
                                        <td>Plan Name</td>
                                        <td>{{ $mdata->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>Billing Cycle</td>
                                        <td id="view_billing_cycle"></td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td id="view_total_amount">{{ $mdata->title }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="same-address">

                                <input type="hidden" value="{{ $mdata->price }}" name="amount" id="total_amount"
                                    required />
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

            function master_form() {
                var amount = $('#per_month').val();
                var months = $('#billing_cycle').val();
                var total = amount * months;
                var name = $('#billing_cycle :selected').text();
                $('#total_amount').val(total);
                $('#view_billing_cycle').html(name);
                $('#view_total_amount').html(total);
                // alert(name);

                var obj = {};
                obj.package = "{{ $mdata->id }}";
                obj.bill = months;
                //console.log(obj);
                $('#sslczPayBtn').prop('postdata', obj);
            }


            (function(window, document) {
                var loader = function() {
                    var script = document.createElement("script"),
                        tag = document.getElementsByTagName("script")[0];
                    // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                    script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(
                        7); // USE THIS FOR SANDBOX
                    tag.parentNode.insertBefore(script, tag);
                };

                window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload",
                    loader);
            })(window, document);
        </script>

    @endpush

@endsection
