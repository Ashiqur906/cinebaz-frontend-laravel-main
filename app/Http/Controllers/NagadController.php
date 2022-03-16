<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;use Sessions;use Cart;
use App\Models\Order;
use App\Models\Member;
use App\Notifications\MemberNotification;
use Mail;
class NagadController extends Controller
{

    public function checkout()
    {
        $cartTotal = Cart::getTotal();
        if($cartTotal <= 0){
            notify()->error('Your Cart is empty !');
            return redirect()->back();
        }
        date_default_timezone_set('Asia/Dhaka');

        $MerchantID = "683002007104225";
        $DateTime = Date('YmdHis');
        $amount = $cartTotal;
        $OrderId = 'TEST' . strtotime("now") . rand(1000, 10000);
        //dd($OrderId);
        $random = generateRandomString();

        $PostURL = "http://sandbox.mynagad.com:10080/remote-payment-gateway-1.0/api/dfs/check-out/initialize/" . $MerchantID . "/" . $OrderId;


        // $merchantCallbackURL = "https://localhost/Nagad_Integration-eCommerce-PHP_V2.1/merchant-callback-website.php";
        $merchantCallbackURL = route('frontend.checkout.callback');

        $SensitiveData = array(
            'merchantId' => $MerchantID,
            'datetime' => $DateTime,
            'orderId' => $OrderId,
            'challenge' => $random
        );

        $PostData = array(
            'accountNumber' => '01711428036', //Replace with Merchant Number
            'dateTime' => $DateTime,
            'sensitiveData' => EncryptDataWithPublicKey(json_encode($SensitiveData)),
            'signature' => SignatureGenerate(json_encode($SensitiveData))
        );

        $Result_Data = HttpPostMethod($PostURL, $PostData);

        if (isset($Result_Data['sensitiveData']) && isset($Result_Data['signature'])) {
            if ($Result_Data['sensitiveData'] != "" && $Result_Data['signature'] != "") {

                $PlainResponse = json_decode(DecryptDataWithPrivateKey($Result_Data['sensitiveData']), true);

                if (isset($PlainResponse['paymentReferenceId']) && isset($PlainResponse['challenge'])) {

                    $paymentReferenceId = $PlainResponse['paymentReferenceId'];
                    $randomServer = $PlainResponse['challenge'];

                    $SensitiveDataOrder = array(
                        'merchantId' => $MerchantID,
                        'orderId' => $OrderId,
                        'currencyCode' => '050',
                        'amount' => $amount,
                        'challenge' => $randomServer
                    );

                    // print_r($SensitiveDataOrder);
                    // exit;

                    $merchantAdditionalInfo = '{"Service Name": "Sheba.xyz"}';

                    $PostDataOrder = array(
                        'sensitiveData'             => EncryptDataWithPublicKey(json_encode($SensitiveDataOrder)),
                        'signature'                 => SignatureGenerate(json_encode($SensitiveDataOrder)),
                        'merchantCallbackURL'       => $merchantCallbackURL,
                        'additionalMerchantInfo'    => json_decode($merchantAdditionalInfo)
                    );

                    // print_r($SensitiveDataOrder);
                    // echo "<br>";
                    // print_r($PostDataOrder);
                    // echo "<br>";
                    // exit;
                    $OrderSubmitUrl = "http://sandbox.mynagad.com:10080/remote-payment-gateway-1.0/api/dfs/check-out/complete/" . $paymentReferenceId;
                    $Result_Data_Order = HttpPostMethod($OrderSubmitUrl, $PostDataOrder);

                    // echo json_encode($Result_Data_Order);

                    if ($Result_Data_Order['status'] == "Success") {
                        $url = json_encode($Result_Data_Order['callBackUrl']);
                        echo "<script>window.open($url, '_self')</script>";
                    } else {
                        echo json_encode($Result_Data_Order);
                    }
                } else {
                    echo json_encode($PlainResponse);
                }
            }
        }
    }
    public function callback(Request $request)
    {
        if($request['status'] == 'Aborted'){
            return redirect()->route('frontend.cart:checkout');
        }
        $user = auth('member')->user();
        $cartCollection = Cart::getContent();
        $cartTotal      = Cart::getTotal();
        $code           = uniqid();
        $payment_ref_id = $request->payment_ref_id;
        $url            = "http://sandbox.mynagad.com:10080/remote-payment-gateway-1.0/api/dfs/verify/payment/" . $payment_ref_id;
        $json           = HttpGet($url);
        $arr            = json_decode($json, true);
        $check          = Order::where('transaction_id',$payment_ref_id)->first();

        if(!$check){
            $create = DB::table('orders')
                ->insertGetId([
                    'code'          => $code,
                    'name'          => $user->name,
                    'email'         => $user->email,
                    'phone'         => $arr['clientMobileNo'],
                    'amount'        => $cartTotal,
                    'status'        => 'Pending',
                    'member_id'     => $user->id,
                    'sub_status'    => 'Active',
                    'created_at'    => $arr['orderDateTime'],
                    'updated_at'    => $arr['issuerPaymentDateTime'],
                    'address'       => $user->address,
                    'transaction_id' => $payment_ref_id,
                    'currency'      => 'BDT'
                ]);

            foreach($cartCollection as $myCart){
                $createChild = DB::table('order_details')
                    ->Insert([
                        'order_id'      => $create,
                        'media_id'      => $myCart->associatedModel->id,
                        'member_id'     => $user->id,
                        'price'         => $myCart->associatedModel->discount_price,
                        'deadline'      => $myCart->attributes->hour,
                        'duration'      => $myCart->associatedModel->duration,
                    ]);
            }

            $data = [
                'subject'   => 'Cinebaz Transection',
                'email'     => $user->email,
                'content'   => 'Your Transection has successfully done Transection Code :'.$code
            ];
            Mail::send('email-template', $data, function($message) use ($data) {
                $message->to($data['email'])
                ->subject($data['subject']);
            });

        }
        $removeCart = Cart::clear();

        
        return redirect()->route('frontend.ticket:invoice',['transaction_id'=>$payment_ref_id]);
        return json_encode($arr);
    }
}
