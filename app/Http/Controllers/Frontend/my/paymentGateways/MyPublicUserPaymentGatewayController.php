<?php

namespace App\Http\Controllers\Frontend\my\paymentGateways;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Voyager\Campaign;
use App\Models\Voyager\CampaignCategory;
use App\Models\Voyager\Donation;
use App\Models\Voyager\PaymentGateway;
use App\Models\Voyager\SystemErrorLog;
use App\Models\Voyager\UserPaymentGateway;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Throwable;

class MyPublicUserPaymentGatewayController extends Controller
{
    use ImageTrait;

    public $dir = "/uploads/user-payment-gateways";
    public $mainDirectory = "/uploads";
    public $dirforDb = "/user-payment-gateways/";
    public $url = "my/payment-gateways";
    public function __construct()
    {
        $this->publicUserPayment = new UserPaymentGateway();
    }

    public function renderView($viewFile, $data)
    {
        return view('frontend.my.payment-gateways.' . $viewFile, $data)->render();
    }

    public function index(Request $request)
    {
        try {
            $data = array();
            $data['page_title'] = 'Payment Gateways';
            $data['heads'] = [
                'SN',
                'Payment Gateway',
                'Mobile Number',
                'Bank Name',
                'Bank Account Number',
                'Status',
                ['label' => 'Actions', 'no-export' => true, 'width' => 5],
            ];

            $paymentGateways = UserPaymentGateway::where('public_user_id', $request->user->id)->orderby('updated_at', 'desc')->get();
            $paymentGatewaysList = [];

            $sn = 1;
            $thisArray = [];
            foreach ($paymentGateways as $paymentGatewayskey => $paymentGatewaysDatum) {

                $btnDelete = '<a onclick="deleteBtn(' . $paymentGatewaysDatum->id . ')" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                              <i class="fa fa-lg fa-fw fa-trash"></i>
                          </a>';
                $btnDetails = '<a target="_blank" href="' . route('my.payment.gateways.view', $paymentGatewaysDatum->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                               <i class="fa fa-lg fa-fw fa-eye"></i>
                           </a>';

                $thisArray = [
                    $sn,
                    $paymentGatewaysDatum?->payment_gateway_name,
                    $paymentGatewaysDatum->mobile_number,
                    $paymentGatewaysDatum->bank_name ?? 'N/A',
                    $paymentGatewaysDatum->bank_account_number ?? 'N/A',
                    ($paymentGatewaysDatum->status) ? 'Active' : 'Inactive',
                    '<nobr>'  . $btnDelete . $btnDetails . '</nobr>'
                ];
                $sn = $sn + 1;
                array_push($paymentGatewaysList, $thisArray);
            }
            $data['config'] = [
                'data' => $paymentGatewaysList,
                'order' => [[1, 'asc']],
                'beautify' => false,
                'buttons' => [
                    [
                        'extend' => 'excel',
                        'className' => 'd-none' // Hide the export button
                    ]
                ],
                'columns' => [
                    null, null, null, null, null, null,
                    ['orderable' => false]
                ],
            ];
            return $this->renderView('.index', $data);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }

    public function create(Request $request)
    {
        $data['page_title'] = 'Payment Gateway Add';
        $data['parentPaymentGateways'] = PaymentGateway::where('status', 1)->orderby('name', 'asc')->get();
        return view('frontend.my.payment-gateways.add', $data);
    }
    public function store(Request $request)
    {
        /* TEST CASES */
        /* 
        -user's phone number and payment gateway should not be same at a time--done
        -above validation doesnt count for deleted_at=null--done
        -bank with same name or account number cannot be added--done
        */
        /* END TEST CASES */
        $validator = Validator::make($request->all(), [
            'mobile_number' => ['required', 'regex:/^\d{10}$/'],
            'payment_gateway_name' => 'required|exists:payment_gateways,name',
            'status' => 'required|in:1,0',
            'bank_name' => 'required_if:payment_gateway_name,Bank',
            'bank_account_number' => 'required_if:payment_gateway_name,Bank',
            'bank_address' => 'required_if:payment_gateway_name,Bank',
            'qr_code' => 'nullable|image|min:10|max:5480', // Max file size set to 2MB (2048 kilobytes)
            'detail' => 'required|max:500',

        ]);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        try {
            $data = $request->only('mobile_number', 'bank_name', 'payment_gateway_name', 'status', 'detail', 'bank_account_number', 'bank_name', 'bank_address','swift_code');
            $countPaymentGateway = UserPaymentGateway::where('public_user_id', $request->user->id)->count();
            if ($countPaymentGateway >= 3) {
                Session::flash('error', 'You can only add upto 3 payment gateways.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->file('qr_code')) {
                $data['qr_code'] = $this->dirforDb . $this->uploadImage($this->dir, 'qr_code', true, 1280, null);
            }

            $paymentGatewayDetails = PaymentGateway::where('name', $request->get('payment_gateway_name'))->first();
            $alreadyExists = UserPaymentGateway::where('public_user_id', $request->user->id)
                ->where('mobile_number', $data['mobile_number'])
                ->where('payment_gateway_name', $paymentGatewayDetails->name)
                ->where('bank_account_number', $data['bank_account_number'])
                ->where('bank_name', $data['bank_name'])
                ->whereNull('deleted_at')
                ->count();
            if ($alreadyExists) {
                Session::flash('error', 'Payment gateway already added.');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['payment_gateway_name'] = $paymentGatewayDetails->name;
            $data['public_user_id'] = $request->user->id;
            UserPaymentGateway::insert($data);
            Session::flash('success', 'Success! Payment gateway installed successfully.');
            return redirect($this->url);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }

    public function delete(Request $request)
    {
        $thisModelId = $request->get('id');
        $thisModelData = UserPaymentGateway::where('public_user_id', $request->user->id)->where('id', $thisModelId)->first();
        // if ($thisModelData->qr_code) $this->removeImage($this->mainDirectory, $thisModelData->qr_code);

        if (!$thisModelData) {
            Session::flash('error', 'Data not found.');
            return redirect()->back();
        }
        UserPaymentGateway::where('public_user_id', $request->user->id)->where('id', $thisModelId)->delete();
        Session::flash('success', 'Data deleted successfully.');
        return redirect()->back();
    }

    public function view(Request $request, $thisModelId)
    {
        $thisModelData = UserPaymentGateway::where('public_user_id', $request->user->id)->where('id', $thisModelId)->first();
        if (!$thisModelData) {
            Session::flash('error', 'Data not found.');
            return redirect()->back();
        }
        $data['page_title'] = 'Payment Gateway Detail';
        $data['thisModelDetail'] = UserPaymentGateway::where('public_user_id', $request->user->id)->where('id', $thisModelId)->first();
        return view('frontend.my.payment-gateways.view', $data);
    }
}
