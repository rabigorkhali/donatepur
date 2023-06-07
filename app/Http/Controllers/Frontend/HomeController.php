<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Voyager\Campaign;
use Illuminate\Http\Request;


class HomeController extends FrontendBaseController
{

    public function __construct()
    {
        $this->campaigns = new Campaign();
    }

    public function viewFolder()
    {
        return $this->parentViewFolder().'.index';;
    }

    public function index(Request $request)
    {
        $data=array();
        $data['topCauses']= $this->campaigns->where('status',true)
                    ->where('is_featured',false)
                    ->where('campaign_status','accepted')
                    ->orderby('total_collection','desc')
                    ->take(6)->get();
        return $this->renderView($this->viewFolder(), $data);
    }

}