<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Voyager\Campaign;
use App\Models\Voyager\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Throwable;

class CampaignController extends FrontendBaseController
{

    public function __construct()
    {
        $this->campaigns = new Campaign();
        $this->donation = new Donation();
    }

    public function viewFolder()
    {
        return $this->parentViewFolder() . '.index';;
    }

    public function campaignDetailPage(Request $request, $id)
    {
        try {
            $data = array();
            $data['campaignDetails'] = $this->campaigns
                ->where('status', true)
                ->where('campaign_status', '!=', 'pending')
                ->where('id', $id)->first();
            $data['topDonors'] = $this->donation->wherein('payment_status', ['successful'])->where('campaign_id', $id)->where('is_verified', 1)->orderby('amount')->get();
            return $this->renderView($this->parentViewFolder() . '.donation-detail', $data);
        } catch (Throwable $th) {
            return redirect('/');
        }
    }
}
