<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Voyager\Campaign;
use App\Models\Voyager\Donation;
use App\Models\Voyager\SliderBanner;
use Illuminate\Http\Request;


class HomeController extends FrontendBaseController
{

    public function __construct()
    {
        $this->campaigns = new Campaign();
        $this->sliderBanner = new SliderBanner();
        $this->donation = new Donation();
    }

    public function viewFolder()
    {
        return $this->parentViewFolder() . '.index';;
    }

    public function index(Request $request)
    {
        $data = array();
        $data['topCauses'] = $this->campaigns->where('status', true)
            ->where('is_featured', false)
            ->where('campaign_status', 'accepted')
            ->orderby('total_collection', 'desc')
            ->take(6)->get();

        $data['sliderBanners'] = $this->sliderBanner
            ->where('status', true)
            ->orderby('position', 'asc')
            ->take(3)->get();

        $data['total_campaign'] = $this->campaigns->where('status', true)->wherenotin('campaign_status', ['pending', 'rejected', 'cancelled'])->count();
        $data['total_collection'] = $this->campaigns->where('status', true)->wherenotin('campaign_status', ['pending', 'rejected', 'cancelled'])->sum('total_collection');
        $totalDonars = $this->donation->wherein('payment_status', ['successful'])->distinct('public_user_id')->count();
        $data['total_donars'] = $totalDonars + $this->donation->wherein('payment_status', ['successful'])->where('is_verified', 1)->where('public_user_id', null)->count();
        $data['topDonors'] = $this->donation->with('publicUser')->wherein('payment_status', ['successful'])->where('is_verified', 1)->orderby('amount_received')->get();
       
        return $this->renderView($this->viewFolder(), $data);
    }
}
