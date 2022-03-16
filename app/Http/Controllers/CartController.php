<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Cinebaz\Media\Models\Media;
use Cinebaz\Seo\Models\Seo;
use App\Models\Order;
use App\Models\OrderDetails;
use Cart;
use Session;

class CartController extends Controller
{
    public function index($id)
    {
        // dd($request);
        $cartCollection = Cart::getContent();
        $checkCart      = [];
        foreach ($cartCollection as $cart) {
            $checkCart[]  = $cart->associatedModel->id;
        }
        $uniqid     = Str::random(9);
        $rowId      = $uniqid;
        $Media      = Media::find($id);
        $check      = Media::where('id', $id)->whereIn('id', $checkCart)->first();
        if ($check) {
            notify()->error('Movie Already on Bucket !');
        } else {

            if (!$Media->discount_price) {
                if ($Media->regular_price) {
                    $Media->discount_price = $Media->regular_price;
                } else {
                    $Media->discount_price = 0;
                }
            }
            $getToday = date('Y-m-d H:i:s');
            $deadline = MovieDeadline();
            $new_time = date("Y-m-d H:i:s", strtotime($deadline));

            $addCart = Cart::add(array(
                'id'        => $rowId,
                'name'      => $Media->title_en,
                'price'     => $Media->discount_price,
                'quantity'  => 1,
                'attributes' => [
                    'hour'  => $new_time
                ],
                'associatedModel' => $Media
            ));

            notify()->success('Movie added on Bucket !');
        }
        $cartCollection     = Cart::getContent();
        $total_added_count     = $cartCollection->count();
        $total_price         = Cart::getTotal();
        $cart = [
            'cartCollection'     => $cartCollection,
            'total_added_count'     => $total_added_count,
            'total_price'             => $total_price,
        ];

        return View('cart.cart_items')->with($cart);
    }


    public function checkout_process(PaymentRequest $request)
    {


        $cartCollection = Cart::getContent();
        $cartTotal      = Cart::getTotal();
        $cart           = json_decode($request->get('cart_json'), true);
        $member         = auth('member')->user();
        $code           = uniqid();

        $create = new Order();
        $create->code              = null;
        $create->name              = $member->name;
        $create->payment_method    = $request->payment_type;
        $create->email             = $member->email;
        $create->phone             = $member->phone;
        $create->amount            = $cartTotal;
        $create->status            = 'Unpaid';
        $create->member_id         = $member->id;
        $create->sub_status        = 'Unpaid';
        $create->address           = $member->address;
        $create->transaction_id    = $code;
        $create->currency          = "BDT";
        $create->save();

        foreach ($cartCollection as $myCart) {
            $createChild = new OrderDetails();
            $createChild->order_id      = $create->id;
            $createChild->media_id      = $myCart->associatedModel->id;
            $createChild->price         = $myCart->associatedModel->discount_price;
            $createChild->member_id     = $member->id;
            $createChild->deadline      = $myCart->attributes->hour;
            $createChild->duration      = $myCart->associatedModel->duration;
            $createChild->status        = 'Unpaid';
            $createChild->transaction_id = $code;

            $createChild->save();
        }



        if ($request->payment_type == 1) {
            // dd('hasan');
            return redirect()->route('frontend.checkout.sslcommerz.index', $create->id);
        } else {
            return redirect()->route('frontend.checkout.nagad', $create->id);
        }
    }
    public function checkout()
    {
        $mdata['seo'] = Seo::get();
        Session::put('redirectUrl', url()->current());
        // return $cartCollection = Cart::getContent();
        return View('cart.checkout')->with($mdata);
    }
    public function delete($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }
}
