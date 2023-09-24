<?php

namespace App\Http\Controllers\Frontend\my\withdrawals;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Voyager\Campaign;
use App\Models\Voyager\CampaignCategory;
use App\Models\Voyager\CampaignView;
use App\Models\Voyager\Donation;
use App\Models\Voyager\PaymentGateway;
use App\Models\Voyager\SystemErrorLog;
use App\Models\Voyager\UserPaymentGateway;
use App\Models\Voyager\Withdrawal;
use App\Services\frontend\CampaignService;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            /* TEST */
            /* DELETE ONLY IF WITHDRAWALSTATUS IS PENDING */
            /* END TEST */
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
                'Payment Gateway',
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
                $btnDelete = '';
                if ($thisModelDataListDatum->withdrawal_status == 'pending') {
                    $btnDelete = '<a onclick="deleteBtn(' . $thisModelDataListDatum->id . ')" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                              <i class="fa fa-lg fa-fw fa-trash"></i>
                          </a>';
                }

                $btnDetails = '<a target="_blank" href="' . route('my.withdrawals.view', $thisModelDataListDatum->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                               <i class="fa fa-lg fa-fw fa-eye"></i>
                           </a>';

                $amountDetails =   $this->campaignService->campaignSummary($request, $thisModelDataListDatum->campaign_id);
                $paymentGatewayDetails = $thisModelDataListDatum->userPaymentGateway->payment_gateway_name;
                if ($thisModelDataListDatum->userPaymentGateway->payment_gateway_name !== 'Bank') {
                    $paymentGatewayDetails .= '<br>' . $thisModelDataListDatum->userPaymentGateway->mobile_number;
                } else {
                    $paymentGatewayDetails .= '<br>' . $thisModelDataListDatum->userPaymentGateway->bank_name;
                    $paymentGatewayDetails .= '<br>' . $thisModelDataListDatum->userPaymentGateway->bank_account_number;
                }

                $thisArray = [
                    $sn,
                    $thisModelDataListDatum->campaign->title,
                    priceToNprFormat($thisModelDataListDatum->campaign->goal_amount),
                    $amountDetails['campaign']->summary_total_collection ?? 0,
                    $amountDetails['campaign']->summary_service_charge_amount ?? 0,
                    $amountDetails['campaign']->net_amount_collection ?? 0,
                    ucfirst($thisModelDataListDatum->withdrawal_status ?? 'N/A'),

                    $paymentGatewayDetails,
                    ($thisModelDataListDatum->created_at) ? $thisModelDataListDatum->created_at->format('Y-m-d') : 'N/A',
                    '<nobr>' . $btnDelete . $btnDetails . '</nobr>'
                ];
                $sn = $sn + 1;
                array_push($thisModelDataListArray, $thisArray);
            }
            $data['config'] = [
                'data' => $thisModelDataListArray,
                // 'order' => [[1, 'asc']],
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
        $data['page_title'] = 'Request Withdrawal';
        $data['campaigns'] = Campaign::where('campaign_status', 'completed')
            ->where('public_user_id', $request->user->id)->get();
        // $data['campaigns'] = Campaign::get();
        $data['paymentGateways'] = UserPaymentGateway::where('status', 1)->where('public_user_id', $request->user->id)->get();
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
            /* TEST CASES */
            /* 
            - Already withdrwal requested shouldnt be stored.-done
            - Completed campaign can only be stored.-done
            - Check if campaign belongs to login user.-done
            - Check if payment gateways belongs to login user.-done            
            - Change to campaign_status to withdraw processing.-done            
            */
            /* END TEST CASES */
            $data = $request->only('campaign_id', 'user_payment_gateway_id');
            $campaignId = $request->get('campaign_id');
            $alreadyInwithdrawal = Withdrawal::where('campaign_id', $campaignId)->first();
            if ($alreadyInwithdrawal) {
                Session::flash('error', 'Bad request. Withdrawal request already made.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $campaignData = CampaignView::where('campaign_status', 'completed')->where('public_user_id', $request->user->id)->find($campaignId);
            if (!$campaignData->summary_total_collection || $campaignData->summary_total_collection < 11) {
                Session::flash('error', 'The minimum fund that can be withdrawn must be greater  than Rs. 9.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if (!$campaignData) {
                Session::flash('error', 'Bad request.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $paymentGateways = UserPaymentGateway::where('public_user_id', $request->user->id)->where('id', $request->get('user_payment_gateway_id'))->first();
            if (!$paymentGateways) {
                Session::flash('error', 'Payment gateway invalid.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['withdrawal_mobile_number'] = $paymentGateways->mobile_number;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['withdrawal_status'] = 'pending';
            $data['public_user_id'] = $request->user->id;

            $data['withdrawal_amount'] = $campaignData->net_amount_collection;
            $data['withdrawal_service_charge'] = $campaignData->summary_service_charge_amount;
            // $data['bank_name'] = $paymentGateways->bank_name;
            // $data['bank_account_number'] = $paymentGateways->bank_account_number;
            // $data['bank_account_address'] = $paymentGateways->bank_account_address;
            DB::beginTransaction();
            Withdrawal::insert($data);
            Campaign::where('id', $campaignId)->update(['campaign_status' => 'withdrawal-processing']);
            DB::commit();
            Session::flash('success', 'Success! Withdrawal request sent successfully.');
            return redirect('/my/withdrawals');
        } catch (Throwable $th) {
            DB::rollback();
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }

    public function delete(Request $request)
    {
        /* TEST CASE */
        /* 
        - Delete only pending withdrawal request
        - Check withdrawal belongs to valid user
        */
        /* TEST CASE */
        DB::beginTransaction();
        $thisId = $request->get('id');
        $thisDataDetails = Withdrawal::where('public_user_id', $request->user->id)
            ->where('withdrawal_status', 'pending')->where('id', $thisId)->first();
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
        $withdrawlDetails = Withdrawal::where('public_user_id', $request->user->id)->where('withdrawal_status', 'pending')->where('id', $thisId)->delete();
        if (!$withdrawlDetails) {
            Session::flash('error', 'Bad request.');
            return redirect()->back();
        }
        Campaign::where('id', $thisDataDetails->campaign->id)->update(['campaign_status' => 'completed']);
        Session::flash('success', 'Withdrawal Request cancelled successfully.');
        DB::commit();
        return redirect()->back();
    }

    public function view(Request $request, $id)
    {
        try {

            /* TEST CASES */
            /* 
            -CHECK belongs to users
            */
            /* TEST CASES */
            $data['page_title'] = $this->pageTitle;
            $withdrawalDetails = Withdrawal::where('id', $id)->where('public_user_id', $request->user->id)->first();
            if (!$withdrawalDetails) {
                Session::flash('error', 'Bad request.');
                return redirect()->back();
            }
            $data['withdrawalDetails'] = $withdrawalDetails;
            $data['campaignDetail'] = CampaignView::where('public_user_id', $request->user->id)->where('id', $withdrawalDetails->campaign_id)->first();
            if (!$data['campaignDetail']) {
                Session::flash('error', 'Bad request.');
                return redirect()->back();
            }
            return view('frontend.my.withdrawals.view', $data);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
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
