<?php

namespace App\Http\Controllers\Frontend\mysuperuser\withdrawals;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Jobs\SendEmailAfterWithdrawMade;
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
        return view('frontendsuperuser.my.withdrawals' . $viewFile, $data)->render();
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

            $thisModelDataList = Withdrawal::orderby('updated_at', 'desc')->get();
            $thisModelDataListArray = [];
            $sn = 1;
            $thisArray = [];
            foreach ($thisModelDataList as $thisModelDataListKey => $thisModelDataListDatum) {
                $btnDelete = '';
                $btnEdit = '';
                $btnEdit = '<a href="' . route('mysuperuser.withdrawals.edit', $thisModelDataListDatum->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-edit"></i>
            </a>';
                if ($thisModelDataListDatum->withdrawal_status == 'pending') {
                    $btnDelete = '<a onclick="deleteBtn(' . $thisModelDataListDatum->id . ')" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                              <i class="fa fa-lg fa-fw fa-trash"></i>
                          </a>';
                }

                $btnDetails = '<a target="_blank" href="' . route('mysuperuser.withdrawals.view', $thisModelDataListDatum->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                               <i class="fa fa-lg fa-fw fa-eye"></i>
                           </a>';

                $amountDetails =   $this->campaignService->campaignSummary($request, $thisModelDataListDatum->campaign_id);

                $paymentGatewayDetails = $thisModelDataListDatum->userPaymentGateway;

                $paymentGatewayName = $paymentGatewayDetails->payment_gateway_name ?? null;
                if ($paymentGatewayName) {

                    if ($paymentGatewayDetails->payment_gateway_name !== 'Bank') {
                        $paymentGatewayName .= '<br>' . $paymentGatewayDetails->mobile_number;
                    } else {
                        $paymentGatewayName .= '<br>' . $paymentGatewayDetails->bank_name;
                        $paymentGatewayName .= '<br>' . $paymentGatewayDetails->bank_account_number;
                    }
                    if ($thisModelDataListDatum->campaign) {

                        $thisCampaign = $thisModelDataListDatum->campaign;
                        $thisArray = [
                            $sn,
                            $thisCampaign->title,
                            priceToNprFormat($thisCampaign->goal_amount),
                            $amountDetails['campaign']->summary_total_collection ?? 0,
                            $amountDetails['campaign']->summary_service_charge_amount ?? 0,
                            $amountDetails['campaign']->net_amount_collection ?? 0,
                            ucfirst($thisModelDataListDatum->withdrawal_status ?? 'N/A'),
                            $paymentGatewayName,
                            ($thisModelDataListDatum->created_at) ? $thisModelDataListDatum->created_at->format('Y-m-d') : 'N/A',
                            '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'
                        ];
                        $sn = $sn + 1;
                        array_push($thisModelDataListArray, $thisArray);
                    }
                }
            }
            $data['config'] = [
                'data' => $thisModelDataListArray,
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
        $data['page_title'] = 'Request Withdrawal';
        $data['campaigns'] = Campaign::where('campaign_status', 'completed')->get();
        // $data['campaigns'] = Campaign::get();
        $data['paymentGateways'] = UserPaymentGateway::where('status', 1)->get();
        return view('frontendsuperuser.my.withdrawals.add', $data);
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
            $campaignData = CampaignView::where('campaign_status', 'completed')->find($campaignId);
            if (!$campaignData->summary_total_collection || $campaignData->summary_total_collection < 11) {
                Session::flash('error', 'The minimum fund that can be withdrawn must be greater  than Rs. 9.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if (!$campaignData) {
                Session::flash('error', 'Bad request.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $paymentGateways = UserPaymentGateway::where('id', $request->get('user_payment_gateway_id'))->first();
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
        $thisDataDetails = Withdrawal::where('withdrawal_status', 'pending')->where('id', $thisId)->first();
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
        $withdrawlDetails = Withdrawal::where('withdrawal_status', 'pending')->where('id', $thisId)->delete();
        if (!$withdrawlDetails) {
            Session::flash('error', 'Bad request.');
            return redirect()->back();
        }
        Campaign::where('id', $thisDataDetails->campaign->id)->update(['campaign_status' => 'completed']);
        Session::flash('success', 'Withdrawal Request cancelled successfully.');
        DB::commit();
        return redirect()->back();
    }
    public function edit(Request $request, $withdrawalId)
    {
        $data['page_title'] = 'Withdrawal Request Edit';
        $withdrawalDetails = Withdrawal::where('id', $withdrawalId)->where('withdrawal_status', '!=', 'completedtemp')->first();
        $data['withdrawalDetail'] = $withdrawalDetails;
        if (!$withdrawalDetails) {
            Session::flash('error', 'Bad request.');
            return redirect()->route('mysuperuser.withdrawals.list');
        }
        if (strtolower($withdrawalDetails->withdrawal_status) == 'completedtemp') {
            Session::flash('error', 'Withdrawn campaigns cannot be edited.');
            return redirect()->route('mysuperuser.withdrawals.list');
        }
        $data['campaigns'] = Campaign::where('campaign_status', 'completed')->withTrashed()->get();
        // $data['campaigns'] = Campaign::get();
        $data['paymentGateways'] = UserPaymentGateway::where('status', 1)->get();
        return $this->renderView('.edit', $data);
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
            $withdrawalDetails = Withdrawal::where('id', $id)->first();
            if (!$withdrawalDetails) {
                Session::flash('error', 'Bad request.');
                return redirect()->back();
            }
            $data['withdrawalDetails'] = $withdrawalDetails;

            $data['campaignDetail'] = CampaignView::where('id', $withdrawalDetails->campaign_id)->withTrashed()->first();

            if (!$data['campaignDetail']) {
                Session::flash('error', 'Bad request.');
                return redirect()->back();
            }
            return view('frontendsuperuser.my.withdrawals.view', $data);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }

    public function update(Request $request, $withdrawalId)
    {
        $validator = Validator::make($request->all(), [
            'campaign_id' => 'required|exists:campaigns,id',
            'withdrawal_status' => 'required|in:pending,reviewing,processing,rejected,approved,completed',
            'user_payment_gateway_id' => 'required|exists:user_payment_gateways,id',
        ]);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        try {
            $campaignId = $request->get('campaign_id');
            $userPaymentGatewayId = $request->get('user_payment_gateway_id');
            $withdrawal = Withdrawal::where('id', $withdrawalId)->where('withdrawal_status', '!=', 'completedtemp')->first();
            if (!$withdrawal) {
                Session::flash('error', 'Bad request.');
                return redirect()->back();
            }
            $data = $request->only('withdrawal_status', 'user_payment_gateway_id', 'campaign_id');
            $data['email_sent']=1;
            $campaignData = CampaignView::where('campaign_status', 'completed')->find($campaignId);
            if (!$campaignData) {
                Session::flash('error', 'Campaign deleted or not found.');
                return redirect()->back();
            }
            $userPaymentDetails = UserPaymentGateway::withTrashed()->find($userPaymentGatewayId);
            if (!$userPaymentDetails) {
                Session::flash('error', 'Payment gateway not found.');
                return redirect()->back();
            }
            if (!$campaignData->summary_total_collection || $campaignData->summary_total_collection < 11) {
                Session::flash('error', 'The minimum fund that can be withdrawn must be greater or equals to Rs. 10.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            Withdrawal::where('id', $withdrawalId)->update($data);
            /*EMAIL  */

            if ($data['withdrawal_status'] == 'completed' && $withdrawal->email_sent) {
                $mailData = [];
                $mailData['withdrawalId'] = $withdrawalId;
                $mailData['campaignDetails'] = $withdrawal->campaign;
                $mailData['userPaymentDetails'] = $userPaymentDetails;
                $mailData['receiverEmail'] = $withdrawal->campaign->owner->email;
                dispatch(new SendEmailAfterWithdrawMade($mailData));
            }
            /* EMAIL */
            Session::flash('success', 'Success! Data saved successfully.');
            return redirect()->back();
        } catch (Throwable $th) {
            dd($th);
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }
}
