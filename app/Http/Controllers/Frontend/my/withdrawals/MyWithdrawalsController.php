<?php

namespace App\Http\Controllers\Frontend\my\withdrawals;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Voyager\Campaign;
use App\Models\Voyager\CampaignCategory;
use App\Models\Voyager\Donation;
use App\Models\Voyager\PaymentGateway;
use App\Models\Voyager\SystemErrorLog;
use App\Models\Voyager\UserPaymentGateway;
use App\Models\Voyager\Withdrawal;
use App\Services\frontend\CampaignService;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Throwable;

class MyWithdrawalsController extends Controller
{
    use ImageTrait;

    public $dir = "/uploads/withdrawals";
    public $mainDirectory = "/uploads";
    public $dirforDb = "/withdrawals/";
    public $pageTitle = "Withdrawals";

    public function __construct()
    {
        $this->withdrawal = new Withdrawal();
        $this->donation = new Donation();
        $this->campaignService = new CampaignService();
    }

    public function renderView($viewFile, $data)
    {
        return view('frontend.my.withdrawals.' . $viewFile, $data)->render();
    }

    public function index(Request $request)
    {
        try {
            $data = array();
            $data['page_title'] = $this->pageTitle;
            $data['heads'] = [
                'SN',
                'Campaign',
                'Goal Amt (Rs.)',
                'Collected Amt (Rs.)',
                'Service Charge (Rs.)',
                'Net Withdrawal Amt (Rs.)',
                'Withdrawal Status',
                'Withdrawal Request Date',
                ['label' => 'Actions', 'no-export' => true, 'width' => 5],
            ];

            $thisModelDataList = Withdrawal::whereHas('campaign', function ($query) use ($request) {
                $query->where('public_user_id', $request->user->id);
            })->orderby('updated_at', 'desc')->get();
            $thisModelDataListArray = [];
            $sn = 1;
            $thisArray = [];
            foreach ($thisModelDataList as $thisModelDataListKey => $thisModelDataListDatum) {
                $btnEdit = '<a href="' . route('my.withdrawals.edit', $thisModelDataListDatum->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>';
                $btnDelete = '<a onclick="deleteBtn(' . $thisModelDataListDatum->id . ')" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                              <i class="fa fa-lg fa-fw fa-trash"></i>
                          </a>';
                $btnDetails = '<a target="_blank" href="' . route('my.withdrawals.view', $thisModelDataListDatum->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                               <i class="fa fa-lg fa-fw fa-eye"></i>
                           </a>';

                $amountDetails =   $this->campaignService->calculateAllAmount($thisModelDataListDatum->campaign_id);
                $thisArray = [
                    $sn,
                    $thisModelDataListDatum->campaign->title,
                    $thisModelDataListDatum->campaign->goal_amount,
                    $amountDetails['total_collection'] ?? 0,
                    $amountDetails['service_charge'] ?? 0,
                    $amountDetails['net_collection'] ?? 0,
                    ucfirst($thisModelDataListDatum->withdrawal_status??'N/A'),
                    ($thisModelDataListDatum->created_at)?$thisModelDataListDatum->created_at->format('Y-m-d'):'N/A',
                    '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'
                ];
                $sn = $sn + 1;
                array_push($thisModelDataListArray, $thisArray);
            }
            $data['config'] = [
                'data' => $thisModelDataListArray,
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

    public function create(Request $request)
    {
        $data['page_title'] = 'Request Withdrawal';
        $data['campaigns'] = Campaign::where('campaign_status', 'completed')->get();
        // $data['campaigns'] = Campaign::get();
        $data['paymentGateways'] = UserPaymentGateway::where('status',1)->where('public_user_id', $request->user->id)->get();
        return view('frontend.my.withdrawals.add', $data);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'campaign_id' => 'required|exists:campaigns,id',
            'user_payment_gateway_id' => 'required|exists:user_payment_gateways,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        try {

            $data = $request->only('campaign_id', 'user_payment_gateway_id');
            $paymentGateways = UserPaymentGateway::find($request->get('user_payment_gateway_id'));
            $data['withdrawal_mobile_number'] = $paymentGateways->mobile_number;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['withdrawal_status'] = 'pending';
            $data['public_user_id'] = $request->user_id;
            $amountDetails =   $this->campaignService->calculateAllAmount($request->get('campaign_id'));

            $data['withdrawal_amount'] = $amountDetails['net_collection'];
            $data['withdrawal_service_charge'] = $amountDetails['service_charge'];
            Withdrawal::insert($data);
            Session::flash('success', 'Success! Withdrawal request send successfully.');
            return redirect('/my/withdrawals');
        } catch (Throwable $th) {
            dd($th);
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }

    public function delete(Request $request)
    {
        $thisId = $request->get('id');
        $thisDataDetails = Withdrawal::where('public_user_id', $request->user->id)->where('id', $thisId)->first();
        // $thisDataDetails = Withdrawal::where('id', $thisId)->first();
        if (!$thisDataDetails) {
            Session::flash('error', 'Data not found.');
            return redirect()->back();
        }
        if ($thisDataDetails->withdrawal_status !== 'pending') {
            Session::flash('error', 'Only request with a pending status can be deleted.');
            return redirect()->back();
        }
        // $withdrawalRewuest=Withdrawal::where('id', $thisId)->delete();
        Withdrawal::where('public_user_id', $request->user->id)->where('id', $thisId)->delete();
        Session::flash('success', 'Withdrawal Request deleted successfully.');
        return redirect()->back();
    }
    public function edit(Request $request, $campaignId)
    {
        $data['page_title'] = 'Campaign Edit';
        $data['campaignDetail'] = Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->first();
        $data['campaignCategories'] = CampaignCategory::where('status', 1)->orderby('title', 'asc')->get();
        return view('frontend.my.withdrawals.edit', $data);
    }

    public function view(Request $request, $campaignId)
    {
        $data['page_title'] = 'Campaign Detail';
        $data['campaignDetail'] = Campaign::where('public_user_id', $request->user->id)->where('id', $campaignId)->first();
        return view('frontend.my.withdrawals.view', $data);
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
