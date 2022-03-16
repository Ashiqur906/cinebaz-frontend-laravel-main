<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Cart;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\SubscriptionHead;

class SslCommerzPaymentController extends Controller
{



    public function index(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $post_data = array();
        $post_data['total_amount'] = $order->amount; # You cant not pay less than 10
        $post_data['currency'] = $order->currency;
        $post_data['tran_id'] = $order->transaction_id; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = ($order->name) ? $order->name : 'N/A';
        $post_data['cus_email'] = ($order->email) ? $order->email : 'N/A';
        $post_data['cus_add1'] = ($order->address) ? $order->address : "N/A";
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = ($order->phone) ? $order->phone : 'N/A';
        $post_data['cus_fax'] = "";


        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "";
        $post_data['ship_add1'] = "";
        $post_data['ship_add2'] = "";
        $post_data['ship_city'] = "";
        $post_data['ship_state'] = "";
        $post_data['ship_postcode'] = "";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";


        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";
        // dd($post_data);

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $order->status = 'Pending';
        $order->save();
        $orderDetails = $order->details;
        foreach ($orderDetails as $detail) {
            $detail->status = 'Pending';
            $detail->save();
        }

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        // dd($request);
        echo "Transaction is Successful";
        // dd(auth('member')->check());
        $tran_id = $request->tran_id;
        $amount =  $request->currency_amount;
        $currency = $request->currency_type;

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = Order::where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->firstOrFail();



        if ($order_detials->status == 'Pending') {

            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {

                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                 Here you can also sent sms or email for successfull transaction to customer
                */
                // dd($order_detials);
                $this->update($tran_id, 'Complete');

                echo "<br >Transaction is successfully Completed";
                $removeCart = Cart::clear();
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $this->update($tran_id, 'Failed');

                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }

        return redirect()->route('member.auth.profile');
    }

    public function fail(Request $request)
    {
        $tran_id = $request->tran_id;


        $order_detials = Order::where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->firstOrFail();
        if ($order_detials->status == 'Pending') {

            $this->update($tran_id, 'Failed');

            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->tran_id;

        $order_detials = Order::where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->firstOrFail();



        if ($order_detials->status == 'Pending') {
            $this->update($tran_id, 'Canceled');


            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        $tran_id = $request->input('tran_id');

        if ($request->tran_id) #Check transation id is posted or not.
        {

            #Check order status in order tabel against the transaction id or order id.
            $order_details = Order::where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->firstOrFail();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $this->update($tran_id, 'Complete');

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $this->update($tran_id, 'Failed');

                    echo "validation Fail";
                }
            } else if ($order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

    private function update($tran_id, $status)
    {

        $order_update = Order::where('transaction_id', $tran_id)
            ->update(['status' => $status]);

        $details_update = OrderDetails::where('transaction_id', $tran_id)
            ->update(['status' => $status]);
    }
}
