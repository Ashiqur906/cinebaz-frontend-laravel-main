<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Cinebaz\Seo\Models\Seo;
use App\Models\Order;
use App\Models\OrderDetails;
use Cinebaz\Media\Models\Media;
use App\Http\Requests\MemberFV;
use Laravel\Socialite\Facades\Socialite;
use Cinebaz\Member\Traits\TPicture;
use App\Models\MediaFavorite;
use App\Models\MediaListing;
use App\Models\PlayListLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;
use Session;
use App\Http\Requests\RegistrationRequest;
use Mail;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Cache;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use TPicture;
    public function __construct()
    {
        $this->redirectTo = url()->previous();
        $this->middleware('auth:member', ['except' => ['store', 'register', 'login', 'showlogin', 'redirectToGoogle', 'handleGoogleCallback', 'redirectToFacebook', 'handleFacebookCallback', '_registerOrLoginUser', 'ForgoteStatus', 'changePassword', 'getPasswordForgote', 'forgate_password', 'getPasswordReset', 'resetPassword', 'ResetStatus']]);
    }
    public function index()
    {
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $data['seo']            = $seo;

        $data['user']       = auth('member')->user();
        $data['get_bill']   = Order::where('member_id', auth()->user()->id)
            ->where('status', 'Processing')
            ->get();
        $data['get_ticket']  = OrderDetails::where('member_id', auth()->user()->id)
            ->get();


        return view('member.profile.index')->with($data);
    }
    public function settings()
    {
        $data['user'] = auth('member')->user();
        $seo                    = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $data['seo']            = $seo;
        return view('member.profile.settings')->with($data);
    }
    public function library() 
    {   
        
        // $data['movielist']= Media::get();
        // $data['favorites']= Media::get();
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;

        $member = auth('member')->user();


        $mdata['favorites']['name'] = 'My Favourite Videos';
        $mdata['favorites']['data'] = cache()->remember('my-favorites-all-' . $member->id, 60 * 5, function () use ($member) {
            return MediaFavorite::where(['member_id' => $member->id])->get();
        });
        $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();


        $mdata['listing']['name'] = 'Wishlisted Videos';
        $mdata['listing']['data'] = cache()->remember('my-list-vedio-all-' . $member->id, 60 * 5, function () use ($member) {
            return  MediaListing::where(['member_id' => $member->id])->get();
        });
        $mdata['member']['listing'] = $mdata['favorites']['data']->pluck('media_id')->toArray();


        $mdata['lastWatch']['name'] = 'Watch history';
        $mdata['lastWatch']['data'] = cache()->remember('my-watch-history-all-' . $member->id, 60 * 5, function () use ($member) {
            return  PlayListLog::where(['member_id' => $member->id])
                ->orderBy('created_at', 'desc')
                ->get()
                ->unique('video_id');
        });



        // $mdata['member']['lastWatch'] = $mdata['favorites']['data']->pluck('media_id')->toArray();

        // dd($mdata);


        $mdata['user']       = $member;

        $mdata['get_bill']   = cache()->remember('my-bill-all-' . $member->id, 60 * 5, function () use ($member) {
            return Order::where('member_id', auth()->user()->id)
                ->where('status', 'Processing')
                ->get();
        });


        $mdata['get_ticket']  = cache()->remember('my-ticket-all-' . $member->id, 60 * 5, function () use ($member) {
            return OrderDetails::where('member_id', auth()->user()->id)
                ->get();
        });


        return view('member.profile.library')->with($mdata);
    }

    public function bucket()
    {
        $mdata['seo'] = Seo::get();
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']            = $seo;

        $member = auth('member')->user();



        $mdata['bucketList'] = cache()->remember('my-bucketList-' . $member->id, 60 * 5, function () use ($member) {
            return  OrderDetails::where('member_id', $member->id)
                ->whereHas('orders', function ($query) {
                    $query->where('status', 'Complete');
                })->paginate(10);
        });



        $mdata['user']       = auth('member')->user();

        $mdata['get_bill']   = cache()->remember('my-bill-all-' . $member->id, 60 * 5, function () use ($member) {
            return  Order::where('member_id', auth()->user()->id)
                ->where('status', 'Processing')
                ->get();
        });

        $mdata['get_ticket']  = cache()->remember('my-ticket-all-' . $member->id, 60 * 5, function () use ($member) {
            return  OrderDetails::where('member_id', auth()->user()->id)
                ->get();
        });
        return view('member.profile.my_bucket')->with($mdata);
    }

    public function plan()
    {
        $data['user'] = auth()->user();
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $data['seo']            = $seo;
        return view('member.profile.my_plan')->with($data);
    }

    public function register()
    {
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $data['seo']            = $seo;

        return view('member.register')->with($data);
    }
    public function showlogin()
    {
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $data['seo']            = $seo;

        if (auth('member')->user()) {
            return redirect()->back();
        } else {
            return view('member.member_login')->with($data);
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            //'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        $dastination = Session::get('redirectUrl');

        // Attempt to log the user in
        if (Auth::guard('member')->attempt($credentials)) {
            if ($dastination) {
                return redirect()->to($dastination);
            } else {
                return redirect()->intended('/');
            }
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
    public function logout()
    {
        Auth::guard('member')->logout();
        return redirect('/');
    }

    public function store(RegistrationRequest $request)
    {

        $attributes = [
            'name'      => $request->get('name'),
            'email'     => $request->get('email'),
            'phone'     => $request->get('phone'),
            'password'  => Hash::make($request->get('password')),
            'gender'    => $request->get('gender'),
        ];
        try {
            Member::create($attributes);
            return redirect()->route('member.auth.profile')->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
    }
    public function update(Request $request)
    {
        // return $request;
        $rules = array(
            'name'           => 'required',
            'phone'           => 'required',
            'email'         => 'required'
        );

        $this->validate($request, $rules);

        $id = $request->get('id');
        $attributes = [
            'name'          => $request->get('name'),
            'email'         => $request->get('email'),
            'phone'         => $request->get('phone'),
            'gender'        => $request->get('gender'),
            'address'       => $request->get('address')
        ];
        try {
            $existing       =  Member::findOrFail($id);
            $sumbit         =  Member::where('id', $id)->update($attributes);
            $existing->save();

            $abledata = [
                'data'          => $request,
                'able_id'       => $id,
                'able_type'     => Member::class,
            ];
            if ($request->file('image')) {
                $this->imgUpload($abledata);
            }

            return redirect()->back()->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
    }
    // Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    // Google callback
    public function handleGoogleCallback()
    {


        $user = Socialite::driver('google')->user();
        // $token =$user->token;
        // dump($token);
        // $token = 'ya29.a0ARrdaM-7WaHmk-aeAMnncAlNDwwODeiErh2PNhNVP4Y_xLqenjx_m4dU_r0PRDgHGHKfVs0p16u_yxzARB-pfNv-_-KBPUkO9tNluMNSYWj6rsD4-bvWciVsSbweweJG9see5iX-ma1vUvcoul1BA9KNdoO5';
        // $user = Socialite::driver('google')->userFromToken($token);
        // dd($user);
        $this->_registerOrLoginUser($user);
        // Return home after login
        //return redirect()->intended(route('member.auth.profile'));
        $dastination = Session::get('redirectUrl');
        if ($dastination) {
            return redirect()->to($dastination);
        } else {
            return redirect()->intended('home');
        }
    }
    // facebook login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    // facebook callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->_registerOrLoginUser($user);

        // Return home after login
        $dastination = Session::get('redirectUrl');
        if ($dastination) {
            return redirect()->to($dastination);
        } else {
            return redirect()->intended('/');
        }
    }
    protected function _registerOrLoginUser($data)
    {

        $Member = Member::where('email', $data->email)->first();
        if (!$Member) {
            $Member = new Member();
            $Member->name           = $data->name;
            $Member->email          = $data->email;
            $Member->password       = Hash::make('123456');
            $Member->gender         = 'Others';
            $Member->role           = 2;
            // $Member->provider_id    = $data->id;
            // $Member->avatar         = $data->avatar;
            $Member->save();

            $Member = Member::where('email', $data->email)->first();
        }

        $credentials = [
            'email' => $Member->email,
            'password' => '123456'
        ];
        $dastination = Session::get('redirectUrl');
        // Attempt to log the user in
        if (Auth::guard('member')->attempt($credentials)) {

            if ($dastination) {
                return redirect()->to($dastination);
            } else {
                return redirect()->intended('home');
            }
        }
    }

    public function changePassword()
    {
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $data['seo']            = $seo;
        $data['user']       = auth('member')->user();

        return View('member.change_pass')->with($data);
    }
    public function updatePassword(Request $request)
    {
        if (auth()->user()) {
            $hashedPassword = auth()->user()->password;

            if (\Hash::check($request->old_password, $hashedPassword)) {
                if ($request->new_password == $request->re_password) {
                    $update_user = Member::where('id', auth()->user()->id)
                        ->update([
                            'password'     => bcrypt($request->new_password),
                        ]);
                    Auth::guard('member')->logout();
                    return redirect('/');
                } else {
                    return 'Password doesn`t match !';
                }
            } else {
                return 'Password error !!';
            }
        }


        return $request;
    }
    public function getPasswordForgote()
    {
        return View('member.forgot_password');
    }

    public function forgate_password(Request $request)
    {


        $check = Member::where('email', $request->email)->first();
        if (!$check) {
            return response()->json([
                'massege'       => 'email doesn`t match'
            ]);
        } else {
            $dltAttempts = DB::table('password_resets')->where('email', $request->email)->delete();
        }
        $token = Str::random(64);

        $data = [
            'subject'   => 'Password Reset',
            'email'     => $request->email,
            'content'   => url('password/reset/?token=' . $token . '&&email=' . $request->email)
        ];

        try {
            Mail::send('email-template', $data, function ($message) use ($data) {
                $message->to($data['email'])
                    ->subject($data['subject']);
            });
            DB::table('password_resets')->insert([
                'email'         => $request->email,
                'token'         => $token,
                'created_at'    => Carbon::now()
            ]);
            return Redirect::to('password/forgot/status');
        } catch (\Exception $e) {
            return response()->json([
                'massege'       => 'Unsuccess Attempts'
            ], 401);
        }

        // return $request;
    }



    public function getPasswordReset(Request $request)
    {
        $token = $request->token;
        $email = $request->email;
        return View('member.reset_password', compact('token', 'email'));
    }

    public function resetPassword(ResetPasswordRequest $request)
    {

        try {
            $checkToken = DB::table('password_resets')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->get();
            if ($checkToken) {
                $attributes = [
                    'password'      => Hash::make($request->get('password')),
                ];
                $user               = Member::where('email', $request->email)->first();
                $sumbit             = Member::where('email', $request->email)->update($attributes);
                // if ($token = Auth::login($user)) {
                //     return $this->respondWithToken($token);
                // }
                return Redirect::to('password/reset/status');
            } else {
                return response()->json([
                    'massege'       => 'token doesn`t match'
                ]);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
    }

    public function ResetStatus()
    {
        return redirect()->route('frontend.index');
    }
    public function ForgoteStatus()
    {
        $status = true;

        return  view('member.forgot_password', [
            'status' =>  $status
        ]);
    }
}
