<?php

namespace App\Http\Controllers\Frontend\my\campaigns;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Voyager\Campaign;
use App\Models\Voyager\CampaignCategory;
use App\Models\Voyager\Donation;
use App\Models\Voyager\SystemErrorLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Throwable;

class MyCampaignController extends Controller
{

    public function __construct()
    {
        $this->campaigns = new Campaign();
        $this->donation = new Donation();
    }

    public function renderView($viewFile, $data)
    {
        return view('frontend.my.campaigns.' . $viewFile, $data)->render();
    }

    public function index(Request $request)
    {
        try {
            $data = array();
            $data['page_title'] = 'Campaigns';
            $data['heads'] = [
                'SN',
                'Title',
                'Campaign Status',
                'Start Date',
                'End Date',
                'Goal Amount',
                'Total Collection',
                'Status',
                ['label' => 'Actions', 'no-export' => true, 'width' => 5],
            ];

                      $campaigns = Campaign::where('public_user_id', $request->user->id)->orderby('updated_at', 'desc')->get();
            $campaignList = [];

            $sn = 1;
            $thisArray = [];
            foreach ($campaigns as $keyCampaigns => $datumCampaign) {
                 $btnEdit = '<a href="' . route('my.campaigns.edit', $datumCampaign->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>';
            $btnDelete = '<a class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                              <i class="fa fa-lg fa-fw fa-trash"></i>
                          </a>';
            $btnDetails = '<a class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                               <i class="fa fa-lg fa-fw fa-eye"></i>
                           </a>';

 
                $thisArray = [
                    $sn,
                    $datumCampaign->title,
                    ucfirst($datumCampaign->campaign_status),
                    $datumCampaign->start_date,
                    $datumCampaign->end_date,
                    'Rs.' . $datumCampaign->goal_amount,
                    'Rs.' . $datumCampaign->total_collection,
                    ($datumCampaign->status) ? 'Active' : 'Inactive',
                    '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'
                ];
                $sn = $sn + 1;
                array_push($campaignList, $thisArray);
            }
            $data['config'] = [
                'data' => $campaignList,
                'order' => [[1, 'asc']],
                'beautify' => true,
                'columns' => [null, null, null, null, null, null, null, null, ['orderable' => false]],
            ];

            return $this->renderView('.index', $data);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }

    public function edit(Request $request, $campaignId)
    {
        $data['page_title'] = 'Campaign Edit';
        $data['campaignDetail']=Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->first();
        $data['campaignCategories']=CampaignCategory::where('status',1)->orderby('title','asc')->get();
        return view('frontend.my.campaigns.edit', $data);
    }
}
