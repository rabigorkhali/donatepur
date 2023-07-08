<?php

namespace App\Http\Controllers\Frontend\my\campaigns;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Voyager\Campaign;
use App\Models\Voyager\CampaignCategory;
use App\Models\Voyager\Donation;
use App\Models\Voyager\SystemErrorLog;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Throwable;

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
                'Verification Status',
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
                $btnDelete = '<a onclick="deleteBtn(' . $datumCampaign->id . ')" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                              <i class="fa fa-lg fa-fw fa-trash"></i>
                          </a>';
                $btnDetails = '<a target="_blank" href="' . route('my.campaigns.view', $datumCampaign->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
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
            dd($th);
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
            'goal_amount' => 'required|numeric|min:1000|max:10000000',
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
                $data['cover_image'] = $this->dirforDb . $this->uploadImage($this->dir, 'cover_image', true, 1280, null);
            }
            $data['public_user_id'] = $request->user->id;
            $data['anonymous'] = 0;
            Campaign::insert($data);
            Session::flash('success', 'Success! Campaign created successfully.');
            return redirect('/my/campaigns');
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }

    public function delete(Request $request)
    {
        $campaignId = $request->get('id');
        $campaign = Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->first();
        if ($campaign->cover_image) $this->removeImage($this->mainDirectory, $campaign->cover_image);

        if (!$campaign) {
            Session::flash('error', 'Campaign not found.');
            return redirect()->back();
        }
        if ($campaign->campaign_status !== 'pending') {
            Session::flash('error', 'Only campaigns with a pending status can be deleted.');
            return redirect()->back();
        }
        if ($campaign->cover_image) $this->removeImage($this->mainDirectory, $campaign->cover_image);
        Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->delete();
        Session::flash('success', 'Campaign deleted successfully.');
        return redirect()->back();
    }
    public function edit(Request $request, $campaignId)
    {
        $data['page_title'] = 'Campaign Edit';
        $data['campaignDetail'] = Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->first();
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'goal_amount' => 'required|numeric|min:1000|max:10000000',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'campaign_category_id' => 'required|exists:campaign_categories,id',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'video_url' => 'nullable|url|max:500',
            'status' => 'required|in:1,0',
            'cover_image' => 'image|min:100|max:20480', // Max file size set to 2MB (2048 kilobytes)
            'description' => 'required|string|min:100|max:20000',
        ]);


        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        try {

            $campaign = Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->first();
            if (!$campaign) {
                Session::flash('error', 'Campaign not found.');
                return redirect()->back();
            }
            $data = $request->only('title', 'goal_amount', 'start_date', 'end_date', 'campaign_category_id', 'address', 'country', 'video_url', 'status', 'description');
            if ($request->file('cover_image')) {
                if ($campaign->cover_image) $this->removeImage($this->mainDirectory, $request->cover_image);
                $data['cover_image'] = $this->dirforDb . $this->uploadImage($this->dir, 'cover_image', true, 1280, null);
            }
            Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->update($data);
            Session::flash('success', 'Success! Data saved successfully.');
            return redirect()->back();
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }
}
