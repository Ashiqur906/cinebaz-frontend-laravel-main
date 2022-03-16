<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Cinebaz\Category\Models\Category;
use Cinebaz\Seo\Models\Seo;
use Cinebaz\Media\Models\Media;
use App\Models\OrderDetails;
use App\Models\MediaFavorite;
use App\Models\MediaListing;
use App\Models\MediaSimilar;
use App\Models\PlayListLog;
use App\Models\TopTen;
use App\Models\Tranding;
use App\Models\Pricing;
use App\Models\Quality;
use App\Models\SubscriptionHead;
use App\Models\PlanHead;
use App\Models\AssignPlan;


use App\Models\Member;
use Cinebaz\Notification\Models\UserNotification;
use App\Notifications\MemberNotification;

use App\Models\Season;
use Cinebaz\Genre\Models\Genre;
use Illuminate\Http\Request;
use Session;
use DB;
use Mail;
use PhpParser\Node\Stmt\Echo_;
use App\Models\Artist;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{

    public function __construct()
    {
        $this->redirectTo = url()->previous();
    }
    public function index()
    {

        $member = auth('member')->user();

        Session::put('redirectUrl', url()->current());

        $mdata['seo'] = cache()->remember('home-seo', 60 * 5, function () {
            return Seo::where('title', 'home-page')->first();
        });
        $mdata['slider'] = cache()->remember('home-slider', 60 * 5, function () {
            return Banner::where(['name_id' => 1])->get();
        });

        // dump($mdata['slider']);
        $mdata['upcoming']['name'] = 'Upcoming Movies';
        $mdata['upcoming']['data'] = cache()->remember('home-upcoming', 60 * 5, function () {
            return Media::where('is_active', 'Yes')
                ->where(function ($query) {
                    $query->whereNull('published_at');
                    $query->orWhere('published_at', '>',  \DB::raw('NOW()'));
                })
                ->inRandomOrder()
                ->take(15)
                ->with('featured')->get();
        });



        $mdata['free']['name'] = 'Free Movies';
        $mdata['free']['data'] =  cache()->remember('home-free', 60 * 5, function () {
            return Media::where('premium', '0')
                ->where('published_at', '<', \DB::raw('NOW()'))
                ->where('is_active', 'Yes')
                ->inRandomOrder()
                ->take(10)
                ->with('featured')->get();
        });
        $mdata['premium']['name'] = 'Premium Movies';
        $mdata['premium']['data'] = cache()->remember('home-premium', 60 * 5, function () {
            return Media::where('premium', 1)
                ->where('is_active', 'Yes')
                ->where('published_at', '<', \DB::raw('NOW()'))
                ->whereNotNull('video_url')
                ->inRandomOrder()
                ->take(10)
                ->with('featured')->get();
        });






        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();


            $mdata['listing']['name'] = 'Your Wishlist';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();

            $mdata['history']['name'] = 'Play History';
            $mdata['history']['data'] =  cache()->remember('my-short-history-' . $member->id, 60 * 5, function () use ($member) {
                return PlayListLog::where(['member_id' => $member->id])
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get()
                    ->unique('video_id');
            });
            $mdata['member']['history'] = $mdata['history']['data']->pluck('media_id')->toArray();

            $mdata['suggested']['name'] = 'Suggested For You';
            $mdata['suggested']['data'] =  cache()->remember('my-short-suggested-' . $member->id, 60 * 5, function () use ($member) {
                return PlayListLog::where(['member_id' => $member->id])
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get()
                    ->unique('video_id');
            });


            $mdata['bucketList']['name'] = 'My Purchase ';
            $mdata['bucketList']['data'] =  cache()->remember('my-short-bucketList-' . $member->id, 60 * 5, function () use ($member) {
                return OrderDetails::where(['member_id' => $member->id])->where('status', 'Paid')->get();
            });
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];

            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];

            $mdata['history']['name'] = null;
            $mdata['history']['data'] = null;
            $mdata['member']['history'] = [];

            $mdata['suggested']['name'] = 'Suggested For You';
            $mdata['suggested']['data'] = [];

            $mdata['bucketList']['name'] = null;
            $mdata['bucketList']['data'] = null;
        }



        // dd($mdata);

        $mdata['categories']['name']    = "Categories";
        $mdata['categories']['data']    = cache()->remember('home-categories', 60 * 5, function () {
            return Category::where('page_show', 1)->get();
        });


        return view('index')->with($mdata);
    }
    public function movies()
    {
        Session::put('redirectUrl', url()->current());
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;
        $member = auth('member')->user();


        $mdata['categories']    = Category::where('category_nature', 1)->where('page_show', 1)->get();
        $mdata['cat_slider']    = Media::where('video_nature_id', 1)
            ->inRandomOrder()
            ->take(3)
            ->get();
        // $mdata['categories'] = Category::where('menu_show', true)->get();

        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = MediaFavorite::where(['member_id' => $member->id])
                ->inRandomOrder()
                ->take(10)
                ->get();
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = MediaListing::where(['member_id' => $member->id])
                ->inRandomOrder()
                ->take(10)
                ->get();
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }
        $fdata['fdata'] = null;

        return view('category')->with($mdata);
    }
    public function upcoming()
    {
        Session::put('redirectUrl', url()->current());
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;
        $member                 = auth('member')->user();
        $mdata['categories']    = Category::where('category_nature', 1)->where('page_show', 1)->get();
        $mdata['cat_slider']    = Media::where('published_status', 0)
            ->inRandomOrder()
            ->take(3)
            ->get();
        // $mdata['categories'] = Category::where('menu_show', true)->get();

        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }
        $fdata['fdata'] = null;

        return view('upcoming')->with($mdata);
    }
    public function mediaList($id)
    {
        Session::put('redirectUrl', url()->current());
        // $mdata['seo']       = Seo::get();
        $mdata['cat']       = Category::where('slug', $id)->first();
        $mdata['seo']       = $mdata['cat']->seo;

        $member = auth('member')->user();
        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }
        return view('page.list_page')->with($mdata);
    }
    public function upcomingMediaList($id)
    {
        Session::put('redirectUrl', url()->current());
        // $mdata['seo']       = Seo::get();
        $mdata['cat']       = Category::where('slug', $id)->first();
        $mdata['seo']       = $mdata['cat']->seo;

        $member = auth('member')->user();
        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }
        return view('page.upcoming_list_page')->with($mdata);
    }
    public function TVShow()
    {
        Session::put('redirectUrl', url()->current());
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;
        $member = auth('member')->user();
        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }
        $mdata['categories']    = Category::where('category_nature', 2)->where('page_show', 1)->get();
        $mdata['cat_slider']    = Media::where('video_nature_id', 2)
            ->inRandomOrder()
            ->take(3)
            ->get();
        $fdata['fdata'] = null;
        return view('category')->with($mdata, $fdata);
    }
    public function plan()
    {
        Session::put('redirectUrl', url()->current());
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;
        //$data['competitors'] = Category::where('menu_show', '1')->get();
        //$mdata['prices'] = Pricing::all();
        $mdata['SubHead']   = SubscriptionHead::where('deleted_at', Null)->get();
        $mdata['PHead']     = PlanHead::where('deleted_at', Null)->get();
        $mdata['Assign']    = new AssignPlan();
        //dd($mdata);
        $fdata['fdata'] = null;
        return view('pricing')->with($mdata);
    }
    public function season()
    {
        Session::put('redirectUrl', url()->current());
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;

        $mdata['mdata'] = null;
        $fdata['fdata'] = null;
        return view('season')->with($mdata, $fdata);
    }
    public function series()
    {
        Session::put('redirectUrl', url()->current());
        $seo      = new Seo();
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;

        $mdata['mdata'] = null;
        $fdata['fdata'] = null;

        return view('series')->with($mdata, $fdata);
    }
    public function details(Request $request, $slug)
    {
        // $mdata['seo'] = Seo::first();
        Session::put('redirectUrl', url()->current());
        $media = Media::where(['slug' => $slug])->firstOrFail();

        $mdata['slider']                = null;
        $member                         = auth('member')->user();
        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }

        $mdata['upcoming']['name']      = 'Upcoming Movies';
        $mdata['upcoming']['data']      = Media::orderby('id', 'DESC')->get();

        $mdata['recomended']['name']    = 'Recommended';
        $mdata['recomended']['data']    = Media::whereNotNull('video_url')->orderby('id', 'DESC')->get();
        // $mdata['details'] = Media::where('id', 3)->first();

        $mdata['slider'] = null;
        $mdata['mdata'] = Media::where(['slug' => $slug])->first();
        $mdata['seo'] = ($mdata['mdata']) ?  $mdata['mdata']->seo : null;

        $mdata['similer']['name']    = 'Similer Videos';
        $mdata['similer']['data']    = MediaSimilar::where('media_id', $mdata['mdata']->id)->orderby('id', 'DESC')->get();
        //dump($mdata);
        // dd($mdata);
        if ($member) {
            $mdata['checkCart'] = OrderDetails::where('member_id', $member->id)->where('media_id', $mdata['mdata']->id)->first();
        }

        return view('page.details')->with($mdata);
    }
    public function start($slug)
    {
        // return $slug;
        Session::put('redirectUrl', url()->current());
        $member = auth('member')->user();
        $media = Media::where(['slug' => $slug])->where('published_status', 1)->firstOrFail();

        $mdata['seo'] = ($media) ? $media->seo : null;

        $mdata['last_time']     = PlayListLog::where(['video_id' => $media->id, 'member_id' =>  $member->id])->latest()->first();

        $order = OrderDetails::where(['media_id' =>  $media->id, 'member_id' => $member->id])->latest()->first();

        if ($media->video_url) {

            $mdata['video'] = $media->video_url;

            $myBucket        = OrderDetails::where('media_id', $media->id)->get();
            if (!$myBucket) {
                $myBucket    = Media::where(['slug' => $slug])->where('premium', 1)->where('published_status', 1)->first();
            }

            if ($media && $myBucket) {


                $mdata['mdata'] = $media;

                $existing = PlayListLog::where(['video_id' => $media->id, 'member_id' =>  auth('member')->user()->id])
                    ->whereDate('created_at', date('Y-m-d'))
                    ->first();
                $playlog = [
                    'video_id'      => $media->id,
                    'member_id'     => auth('member')->user()->id,
                    'ip'     => $this->getIp(),
                    'session_id'     => Session::getId(),
                    'pre_time'  => ($mdata['last_time']) ? $mdata['last_time']->last_watchtime : null,
                    'last_watchtime'    => ($existing) ? $existing->last_watchtime : (($mdata['last_time']) ? $mdata['last_time']->last_watchtime : null),
                    'order_id' => ($media->premium && $order) ? $order->id : null,
                    'is_premium' => $media->premium
                ];

                // dd($playlog);

                try {

                    // dd($playlog);


                    if ($existing) {
                        PlayListLog::where('id', $existing->id)->update($playlog);
                    } else {
                        // dd($playlog);

                        $mdata['last_time'] = PlayListLog::create($playlog);
                    }
                } catch (\Illuminate\Database\QueryException $ex) {
                    dd($ex->getMessage());
                    return redirect()->back()->withErrors($ex->getMessage())
                        ->with('myexcep', $ex->getMessage())->withInput();
                }
                // dd($mdata);
                return view('page.start')->with($mdata)->with('success', 'Successfully save changed');
            } else {
                notify()->error('Please add The media on bucket !');
                return redirect()->back();
            }
        } else {
            notify()->error('Media hasn`t published !');
            return redirect()->back();
        }
    }
    public function readNotification($id)
    {

        $notification   = DB::table('notifications')->where('id', $id)->first();
        $upData         = DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);
        $arr            = json_decode($notification->data);
        if ($arr->link) {
            return redirect()->to($arr->link);
        } else {
            return redirect()->back();
        }
    }
    public function ajax_favorite($id)
    {

        $reslul = ['click' => 'add', 'count' => null];
        $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        $media = Media::findOrFail($id);
        $user = auth('member')->user();

        $attFind = [
            'media_id' => $id,
            'member_id' => ($user) ? $user->id : null
        ];

        $existing = MediaFavorite::where($attFind)->first();

        if ($existing) {
            MediaFavorite::where($attFind)->delete();
            $reslul['click'] = 'remove';
            if (Cache::has('home-favorites-' . $user->id)) {
                Cache::forget('home-favorites-' . $user->id);
            }
            if (Cache::has('my-favorites-all-' .  $user->id)) {
                Cache::forget('my-favorites-all-' . $user->id);
            }
        } else {
            //dd($attributes);
            $insert = new MediaFavorite;

            $insert->media_id           = (int)$id;
            $insert->member_id          = ($user) ? $user->id : null;
            $insert->browser_session    = null;
            $insert->member_ip          = ($ip) ? $ip : null;

            $insert->save();

            $reslul['click'] = 'add';
            if (Cache::has('home-favorites-' . $user->id)) {
                Cache::forget('home-favorites-' . $user->id);
            }
            if (Cache::has('my-favorites-all-' .  $user->id)) {
                Cache::forget('my-favorites-all-' . $user->id);
            }
        }
        return response()->json($reslul);
        //dump($user);
        // dd($media);
    }
    public function ajax_listing($id)
    {
        $reslul = ['click' => 'add', 'count' => null];
        $ip     = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        $media  = Media::findOrFail($id);
        $user   = auth('member')->user();

        $attFind = [
            'media_id' => $id,
            'member_id' => ($user) ? $user->id : null
        ];

        $existing = MediaListing::where($attFind)->first();

        if ($existing) {
            MediaListing::where($attFind)->delete();
            $reslul['click'] = 'remove';
            if (Cache::has('my-short-listing-' . $user->id)) {
                Cache::forget('my-short-listing-' . $user->id);
            }
            if (Cache::has('my-list-vedio-all-' .  $user->id)) {
                Cache::forget('my-list-vedio-all-' . $user->id);
            }
        } else {
            $insert = new MediaListing;
            $insert->media_id = (int)$id;
            $insert->member_id = ($user) ? $user->id : null;
            $insert->browser_session = null;
            $insert->member_ip = ($ip) ? $ip : null;
            $insert->save();
            $reslul['click'] = 'add';
            if (Cache::has('my-short-listing-' . $user->id)) {
                Cache::forget('my-short-listing-' . $user->id);
            }
            if (Cache::has('my-list-vedio-all-' .  $user->id)) {
                Cache::forget('my-list-vedio-all-' . $user->id);
            }
        }
        return response()->json($reslul);
    }
    public function ajax_search(Request $request)
    {
        $data =  Media::search($request->q)->take(6)->get();
        $html = '<ul>';

        foreach ($data as $list) {
            $html .= '<li><a href="' . route('frontend.details', $list->slug) . '">';
            $html .=  $list->title_en;
            $html .=  '</a></li>';
        }
        $html .= '</ul>';
        return response()->json(['data' => $html]);
        //dd($data);
    }
    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
    public function generMediaList($slug)
    {
        Session::put('redirectUrl', url()->current());
        $mdata['seo'] = Seo::get();
        $member = auth('member')->user();
        if ($member) {
            $mdata['favorites']['name'] = 'Your Favorites';
            $mdata['favorites']['data'] = cache()->remember('home-favorites-' . $member->id, 60 * 5, function () use ($member) {
                return MediaFavorite::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['favorites'] = $mdata['favorites']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['favorites']['name'] = null;
            $mdata['favorites']['data'] = null;
            $mdata['member']['favorites'] = [];
        }

        if ($member) {
            $mdata['listing']['name'] = 'Your Listing';
            $mdata['listing']['data'] = cache()->remember('my-short-listing-' . $member->id, 60 * 5, function () use ($member) {
                return MediaListing::where(['member_id' => $member->id])
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            });
            $mdata['member']['listing'] = $mdata['listing']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['listing']['name'] = null;
            $mdata['listing']['data'] = null;
            $mdata['member']['listing'] = [];
        }
        $mdata['gener_media_list']  = Genre::where('slug', $slug)->first();
        $mdata['seo']               = $mdata['gener_media_list']->seo;

        return view('page.gener_media_list')->with($mdata);
    }



    public function savePlayHistory(Request $request)
    {
        // dd($request);

        $existing = PlayListLog::where(['video_id' => $request->media_id, 'member_id' =>  auth('member')->user()->id])
            ->whereDate('created_at', date('Y-m-d'))
            ->first();
        try {
            $playlog = [
                'video_id'      => $request->media_id,
                'member_id'     => auth('member')->user()->id,
                'ip'     => $this->getIp(),
                'session_id'     => Session::getId(),
                'last_watchtime'    => $request->last_time,
            ];
            if ($existing) {
                // dd($playlog);
                PlayListLog::where('id', $existing->id)->update($playlog);
                return response()->json([
                    'success' => true,
                    'message' => 'Timer Updated',
                ]);
            } else {
                PlayListLog::create($playlog);
                return response()->json([
                    'success' => true,
                    'message' => 'PlayLog added',
                ]);
            }
        } catch (\Illuminate\Database\QueryException $ex) {

            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    => null,
                'expires_in'    => null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
    }

    public function artistProfile($slug)
    {

        $artist = Artist::where('slug', $slug)->first();
        return view('page.artist-profile', [
            'artist' => $artist
        ]);
    }
}
