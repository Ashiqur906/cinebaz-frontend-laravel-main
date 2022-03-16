<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\AssignPlan;
use App\Models\PlanHead;
use App\Models\Pricing;
use App\Models\Purchase;

use Cinebaz\Seo\Traits\TSeo;
use App\Models\Member;
use Validator;
use App\Models\SubscriptionHead;
use Session;

class PurchaseController extends Controller  
{

    public function __construct()
    {
        $this->middleware('auth:member');
    }
    public function Index($id)
    {

        $plan = SubscriptionHead::findOrFail($id);
        // dd($plan);

        // dd($id);
        $mdata['mdata']   = $plan;
        $mdata['member']   = auth('member')->user();

        return view('page.purchase')->with($mdata);
    }
    public function Index2($id)
    {

        //dd($id);
        return auth('web')->user()->id;
        try {
            $create = new Purchase();

            $create->member_id          = auth('web')->user()->id;
            $create->subscription_id    = $id;
            $create->purchase_date      = date('Y-m-d');
            $create->deadline           = $request->quality_id;
            $create->status             = $request->quality_id;

            $create->save();

            return redirect()->back()->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {

            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
    }
}
