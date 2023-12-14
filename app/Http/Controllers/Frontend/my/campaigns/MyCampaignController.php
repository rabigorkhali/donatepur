<?php

namespace App\Http\Controllers\Frontend\my\campaigns;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Voyager\Campaign;
use App\Models\Voyager\CampaignCategory;
use App\Models\Voyager\CampaignView;
use App\Models\Voyager\Donation;
use App\Models\Voyager\SystemErrorLog;
use App\Services\frontend\CampaignService;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Throwable;
use DB;

class MyCampaignController extends Controller
{
    use ImageTrait;

    public $dir = "/uploads/campaigns";
    public $mainDirectory = "/uploads";
    public $dirforDb = "/campaigns/";
    public function __construct()
    {
        $this->campaigns = new Campaign();
        $this->donation = new Donation();
        $this->campaignService = new CampaignService();
    }

    public function renderView($viewFile, $data)
    {
        return view('frontend.my.campaigns.' . $viewFile, $data)->render();
    }
    function forceWithdraw(Request $request)
    {
        try {
            $campaignId = $request->get('id');
            $campaign = Campaign::where('id', $campaignId)->where('public_user_id', $request->user->id)->first();
            if (!$campaign) {
                Session::flash('error', 'Campaign not found.');
                return redirect()->back();
            }
            if ($campaign->campaign_status !== 'running') {
                Session::flash('error', 'Only running campaigns can be force withdrawn.');
                return redirect()->back();
            }
            Campaign::where('id', $campaignId)->update(['end_date' => date('Y-m-d')]);
            Session::flash('success', 'Your campaign will end on ' . date('Y-m-d') . '. You will be able to request withdrawal from tomorrow.');
            return redirect()->back();
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }
    public function index(Request $request)
    {
        try {
            /* TESTCASE */
            /* 
            -show delete btn only for campaign_status=pending
            */
            /* TESTCASE */
            $data = array();
            $data['page_title'] = 'Campaigns';
            $data['heads'] = [
                'SN',
                'Title',
                'Verification Status',
                'Start Date',
                'Created Date',
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
                $btnDelete = '';
                $btnEdit = '';
                $btnForceEnd = '';
                $btnWithdraw = '';

                if (strtolower($datumCampaign->campaign_status == 'pending')) {
                    $btnEdit = '<a href="' . route('my.campaigns.edit', $datumCampaign->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>';
                }
                if (strtolower($datumCampaign->campaign_status == 'pending')) {
                    $btnDelete = '<a onclick="deleteBtn(' . $datumCampaign->id . ')" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                              <i class="fa fa-lg fa-fw fa-trash"></i>
                          </a>';
                }

                $btnDetails = '<a target="_blank" href="' . route('my.campaigns.view', $datumCampaign->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="View Details">
                               <i class="fa fa-lg fa-fw fa-eye"></i>
                           </a>';

                $btnViewInSite = '<a target="_blank" href="' . route('campaignDetailPage', $datumCampaign->slug) . '" class="btn btn-xs btn-info text-white mx-1 shadow" title="Navigate to website.">
                           <i class="fa fa-lg fa-fw fa-info-circle"></i> View in site.
                       </a>';

                if (strtolower($datumCampaign->campaign_status) == 'completed') {
                    $btnWithdraw = '<a  target="_blank"  class="btn btn-xs btn-primary text-white mx-1 shadow" href="'.route('my.withdrawals.create').'" title="Withdraw fund.">
                        <i class="fa fa-lg fa-fw fa-money"></i>Withdraw
                    </a>';
                }
                if (strtolower($datumCampaign->campaign_status) == 'running') {
                    if ($datumCampaign->end_date == date('Y-m-d')) {
                    } else {
                        $btnForceEnd = '<a onclick="forceWithdrawBtn(' . $datumCampaign->id . ')" target="_blank"  class="btn btn-xs btn-primary text-white mx-1 shadow" title="End campaign and force enable withdraw.">
                        <i class="fa fa-lg fa-fw fa-money"></i>Force withdraw
                    </a>';
                    }
                }
                $thisArray = [
                    $sn,
                    substr($datumCampaign->title, 0, 50),
                    ucfirst($datumCampaign->campaign_status),
                    $datumCampaign->start_date,
                    ($datumCampaign->created_at) ? $datumCampaign->created_at->format('Y-m-d') : '',
                    $datumCampaign->end_date,
                    priceToNprFormat($datumCampaign->goal_amount),
                    priceToNprFormat($datumCampaign->total_collection),
                    ($datumCampaign->status) ? 'Active' : 'Inactive',
                    '<nobr>' . $btnEdit . $btnDelete . $btnDetails . $btnViewInSite . $btnForceEnd .$btnWithdraw. '</nobr>'
                ];
                $sn = $sn + 1;
                array_push($campaignList, $thisArray);
            }
            $data['config'] = [
                'data' => $campaignList,
                // 'order' => [[1, 'asc']],
                'scrollX' => true,
                'beautify' => true,
                'columns' => [null, null, null, null, null, null, null, null, null, ['orderable' => false]],
            ];

            return $this->renderView('.index', $data);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }

    public function create(Request $request)
    {
        $data['page_title'] = 'Campaign Add';
        $data['campaignCategories'] = CampaignCategory::where('status', 1)->orderby('title', 'asc')->get();
        return view('frontend.my.campaigns.add', $data);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'goal_amount' => 'required|numeric|min:1000|max:1000000',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'campaign_category_id' => 'required|exists:campaign_categories,id',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'video_url' => 'nullable|url|max:500',
            'status' => 'required|in:1,0',
            'cover_image' => 'required|image|min:100|max:20480', // Max file size set to 2MB (2048 kilobytes)
            'description' => 'required|string|min:100|max:20000',
        ]);


        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        try {
            $data = $request->only('title', 'goal_amount', 'start_date', 'end_date', 'campaign_category_id', 'address', 'country', 'video_url', 'status', 'description');
            if ($request->file('cover_image')) {
                $data['cover_image'] = $this->dirforDb . $this->uploadImageForCampaign($this->dir, 'cover_image', true, 1280, null);
            }
            $slug = replaceSpacesWithDash(strtolower($request->get('title')));
            $data['public_user_id'] = $request->user->id;
            $data['anonymous'] = 0;
            $data['campaign_status'] = 'pending';
            $data['created_at'] = date('Y-m-d H:i:s');
            DB::beginTransaction();
            $campaignCreateResponse = Campaign::insertGetId($data);
            $slugExists = Campaign::where('slug', $slug)->count();
            if ($slugExists) {
                $data['slug'] = $slug . '-' . $campaignCreateResponse;
            } else {
                $data['slug'] = $slug;
            }
            Campaign::where('id', $campaignCreateResponse)->update(['slug' => $data['slug']]);
            Session::flash('success', 'Success! Campaign created successfully.');
            DB::commit();
            return redirect('/my/campaigns');
        } catch (Throwable $th) {
            DB::rollback();
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }

    public function delete(Request $request)
    {
        /* TEST CASES */
        /* 
        - Delete pending campaign only
         */
        /* TEST CASES */
        $campaignId = $request->get('id');
        $campaign = Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->first();
        if (!$campaign) {
            Session::flash('error', 'Campaign not found.');
            return redirect()->back();
        }
        if ($campaign->campaign_status !== 'pending') {
            Session::flash('error', 'Only campaigns with a pending status can be deleted.');
            return redirect()->back();
        }
        if ($campaign->cover_image) $this->removeImageCampaign($this->mainDirectory, $campaign->cover_image);
        Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->delete();
        Session::flash('success', 'Campaign deleted successfully.');
        return redirect()->back();
    }
    public function edit(Request $request, $campaignId)
    {
        $data['page_title'] = 'Campaign Edit';
        $campaignDetails = Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->first();
        $data['campaignDetail'] = $campaignDetails;
        if (!$campaignDetails) {
            Session::flash('error', 'Bad request.');
            return redirect()->route('my.campaigns.list');
        }
        if (strtolower($campaignDetails->campaign_status) !== 'pending') {
            Session::flash('error', 'Only pending campaigns can be edited.');
            return redirect()->route('my.campaigns.list');
        }
        $data['campaignCategories'] = CampaignCategory::where('status', 1)->orderby('title', 'asc')->get();
        return view('frontend.my.campaigns.edit', $data);
    }

    public function view(Request $request, $campaignId)
    {
        $data['page_title'] = 'Campaign Detail';
        $data['campaignDetail'] = Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->first();
        return view('frontend.my.campaigns.view', $data);
    }

    public function update(Request $request, $campaignId)
    {
        $campaign = Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->where('campaign_status', 'pending')->first();
        if (!$campaign) {
            Session::flash('error', 'Bad request.');
            return redirect()->route('my.campaigns.list');
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|min:10',
            'goal_amount' => 'required|numeric|min:1000|max:10000000',
            'start_date' => 'required|date|after_or_equal:' . $campaign->start_date,
            'end_date' => 'required|date|after:start_date',
            'campaign_category_id' => 'required|exists:campaign_categories,id',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'video_url' => 'nullable|url|max:500',
            'status' => 'required|in:1,0',
            'cover_image' => 'image|min:50|max:10480', // Max file size set to 2MB (2048 kilobytes)
            'description' => 'required|string|min:100|max:2000',
        ]);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        try {


            if (strtolower($campaign->campaign_status) !== 'pending') {
                Session::flash('error', 'Only pending campaign can be updated.');
                return redirect()->route('my.campaigns.list');
            }
            $data = $request->only('title', 'goal_amount', 'start_date', 'end_date', 'campaign_category_id', 'address', 'country', 'video_url', 'status', 'description');
            if ($request->file('cover_image')) {
                if ($campaign->cover_image) $this->removeImageCampaign($this->mainDirectory, $campaign->cover_image);
                $data['cover_image'] = $this->dirforDb . $this->uploadImageForCampaign($this->dir, 'cover_image', false, 1280, null);
            }
            $slug = replaceSpacesWithDash(strtolower($request->get('title')));
            $slugExists = Campaign::where('slug', $slug)->count();
            if ($slugExists) {
                $data['slug'] = $slug . '-' . $campaignId;
            } else {
                $data['slug'] = $slug;
            }
            $data['updated_at'] = date('Y-m-d H:i:s');
            Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->update($data);
            Session::flash('success', 'Success! Data saved successfully.');
            return redirect()->route('my.campaigns.list')->withInput();
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }

    public function campaignSummary(Request $request, $id)
    {
        try {

            return $this->campaignService->campaignSummary($request, $id);
            $data = [];
            $campaignData = CampaignView::select('start_date', 'end_date', 'cover_image', 'goal_amount', 'summary_total_collection', 'net_amount_collection', 'summary_service_charge_amount', 'total_number_donation', 'campaign_status')
                ->where('public_user_id', $request->user->id)->where('id', $id)->first();
            if (!$campaignData) {
                Session::flash('error', 'Bad request.');
                return redirect()->back()->withInput();
            }
            $campaignData->summary_total_collection = priceToNprFormat($campaignData->summary_total_collection);
            $campaignData->net_amount_collection = priceToNprFormat($campaignData->net_amount_collection);
            $campaignData->summary_service_charge_amount = priceToNprFormat($campaignData->summary_service_charge_amount);
            $campaignData->goal_amount = priceToNprFormat($campaignData->goal_amount);
            $data['campaign'] = $campaignData;
            return $data;
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }
}
