<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Voyager\Campaign;
use Illuminate\Http\Request;


class CampaignController extends FrontendBaseController
{

    public function __construct()
    {
        $this->campaigns = new Campaign();
    }

    public function viewFolder()
    {
        return $this->parentViewFolder().'.index';;
    }

    public function campaignDetailPage(Request $request,$id)
    {
        $data=array();
        $data['campaignDetails']= $this->campaigns
        ->where('status',true)
        ->where('campaign_status','!=','pending')
        ->where('id',$id)->first();
        return $this->renderView($this->parentViewFolder().'.donation-detail', $data);
    }

}