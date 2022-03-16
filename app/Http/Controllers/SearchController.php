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
use App\Models\Season;
use Cinebaz\Genre\Models\Genre;
use Illuminate\Http\Request;
use Session;
use DB;

class SearchController extends Controller
{
    public function index()
    {
        // $dlt = DB::table('orders')
        //     ->delete();
        // $dlt = DB::table('order_details')
        //     ->delete();
        // return 1;
        Session::put('redirectUrl', url()->current());
        $seo      = new Seo() ;
        $seo->meta_title        = 'Cinebaz';
        $seo->meta_description  = 'Cinebaz';
        $seo->meta_keywords     = 'Cinebaz';
        $seo->canonical_url     = 'Cinebaz';
        $seo->seo_image         = 'Cinebaz';
        $mdata['seo']           = $seo;

        $mdata['slider'] = Banner::where(['name_id' => 1])->get();
        $mdata['secound_slider'] = Banner::inRandomOrder()->take(1)->get();
        $member = auth('member')->user();
        //dump($mdata['slider']);
        $mdata['upcoming']['name'] = 'Upcoming Movies';
        $mdata['upcoming']['data'] = Media::where('published_status', 0)
            ->inRandomOrder()
            ->take(10)
            ->get();

        $mdata['free']['name'] = 'Free Movies';
        $mdata['free']['data'] = Media::where('premium', '0')
            ->inRandomOrder()
            ->take(10)
            ->get();

        $mdata['premium']['name'] = 'Premium Movies';
        $mdata['premium']['data'] = Media::where('premium', 1)
            ->inRandomOrder()
            ->take(10)
            ->get();

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
        if ($member) {
            $mdata['history']['name'] = 'Play History';
            $mdata['history']['data'] = PlayListLog::where(['member_id' => $member->id])
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get()
                ->unique('video_id');
            $mdata['member']['history'] = $mdata['history']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['history']['name'] = null;
            $mdata['history']['data'] = null;
            $mdata['member']['history'] = [];
        }
        if ($member) {
            $mdata['sdata']['name'] = 'Suggested For You';
            $mdata['suggested']['data'] = PlayListLog::where(['member_id' => $member->id])
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get()
                ->unique('video_id');
            if ($mdata['suggested']['data']) {
                $mdata['sdata']['data'] = $mdata['suggested']['data'];
            } else {
                $mdata['sdata']['data'] = Media::orderby('id', 'DESC')
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            }

            // $mdata['member']['suggested'] = $mdata['suggested']['data']->pluck('media_id')->toArray();
        } else {
            $mdata['sdata']['name'] = 'Suggested For You';
            $mdata['sdata']['data'] = Media::orderby('id', 'DESC')
                ->inRandomOrder()
                ->take(10)
                ->get();
            $mdata['suggested']['data'] = [];
        }

        //return $mdata['member']['suggested'];
        // $mdata['suggested']['name']     = 'Suggested For You';
        // $mdata['suggested']['data']     = Media::orderby('id','DESC')->get();

        $mdata['trending']['name']      = 'Trending';
        $mdata['trending']['data']      = Tranding::where('start_date', '<=', date('Y-m-d'))
            ->where('deadline', '>=', date('Y-m-d'))
            ->inRandomOrder()
            ->take(10)
            ->get();
        if ($member) {
            $mdata['bucketList']['name'] = 'Your Bucket';
            $mdata['bucketList']['data'] = OrderDetails::where(['member_id' => $member->id])->get();
        } else {
            $mdata['bucketList']['name'] = null;
            $mdata['bucketList']['data'] = null;
        }
        $mdata['toten']['name']  = 'TopTen';
        $mdata['toten']['data']  = TopTen::where('start_date', '<=', date('Y-m-d'))
            ->where('deadline', '>=', date('Y-m-d'))
            ->inRandomOrder()
            ->take(10)
            ->get();

        $test = Media::where('id', 3)->first();
        // dd($mdata);
        $mdata['get_trand_info']        = new Tranding;
        $mdata['categories']['name']    = "Categories";
        $mdata['categories']['data']    = Category::where('page_show', 1)->get();

        return view('search')->with($mdata);
    }
}
