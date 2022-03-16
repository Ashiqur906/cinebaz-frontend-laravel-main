<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\SubscriptionHead;
use PDF;
use App\Http\Requests\PaymentRequest;

class TicketController extends Controller
{


    public function invoice(Request $request)
    {

        $getOrder   = Order::where('transaction_id', $request->transaction_id)->first();
        return view('cart.invoice', compact('getOrder'));
    }
    public function sslPay($payment_type)
    {
        $plan = SubscriptionHead::findOrFail(1);
        $mdata['mdata']   = $plan;
        $mdata['member']   = auth('member')->user();
        return View('ticket.index')->with($mdata);
    }

    public function invoicePrint($code)
    {
        $config = [
            'format' => [250, 300],
            'margin_header' => 5,
            'margin_footer' => 5,
            'margin_left' => 10,
            'margin_right' => 10
        ];


        $data['getOrder'] = Order::where('code', $code)->first();
        $pdf = PDF::loadView('cart.pdf',  $data, [], $config);
        return $pdf->stream('document.pdf');
    }
}
