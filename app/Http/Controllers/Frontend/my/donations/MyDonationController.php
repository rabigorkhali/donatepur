<?php

namespace App\Http\Controllers\Frontend\my\donations;

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

class MyDonationController extends Controller
{
    use ImageTrait;

    public $dir = "/uploads/donations";
    public $mainDirectory = "/uploads";
    public $dirforDb = "/donations/";
    public $url = "my/donations";
    public $pageTitle = "Donations";
    public function __construct()
    {
        $this->model = new Donation();
    }

    public function renderView($viewFile, $data)
    {
        return view('frontend.my.donations.' . $viewFile, $data)->render();
    }

    public function index(Request $request)
    {
        try {
            $data = array();
            $data['page_title'] = $this->pageTitle;
            $data['heads'] = [
                'SN',
                'Donors Name',
                'Is Anonymous',
                'Receiver Details',
                'Mobile Number',
                'Campaign',
                'Payment Gateway',
                'Amount(Rs.)',
                'Service Fee(%)',
                'Payment Status',
                'Transaction Id',
                'Donated At',
                ['label' => 'Actions', 'no-export' => true, 'width' => 5],
            ];

            $thisAllData = Donation::where('giver_public_user_id', $request->user->id)->orderby('updated_at', 'desc')->get();
            $thisAllDataArray = [];
            $sn = 1;
            $thisArray = [];
            foreach ($thisAllData as $thisAllDataKey => $thisAllDataDatum) {
                $btnDetails = '<a target="_blank" href="' . route('my.donations.view', $thisAllDataDatum->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                               <i class="fa fa-lg fa-fw fa-eye"></i>
                           </a>';
                $thisArray = [
                    $sn,
                    $thisAllDataDatum?->giver?->username,
                    ($thisAllDataDatum?->is_anonymous)?'Yes':'No',
                    'Name: '.$thisAllDataDatum?->receiver?->username.
                    '<br> Mobile: '.$thisAllDataDatum->mobile_number
                    ,
                    $thisAllDataDatum->mobile_number,
                    $thisAllDataDatum?->campaign?->title,
                    $thisAllDataDatum?->paymentGateway?->name,
                    $thisAllDataDatum?->amount,
                    $thisAllDataDatum?->service_charge_percentage,
                    ucfirst($thisAllDataDatum?->payment_status),
                    $thisAllDataDatum?->transaction_id,
                    $thisAllDataDatum?->created_at->format('Y-m-d H:i:s'),
                    '<nobr>' . $btnDetails . '</nobr>'
                ];
                $sn = $sn + 1;
                array_push($thisAllDataArray, $thisArray);
            }
            $data['config'] = [
                'data' => $thisAllDataArray,
                'order' => [[1, 'asc']],
                'beautify' => true,
                'scrollX'=> true,
                'columns' => [
                    null, null, null,null, null, null,null, null, null,null, null,null,
                    ['orderable' => false]
                ],
            ];
            return $this->renderView('index', $data);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }


    public function view(Request $request, $thisModelId)
    {
        $data['page_title'] = $this->pageTitle.' Detail';
        $thisModelData = Donation::where('giver_public_user_id', $request->user->id)->where('id', $thisModelId)->first();
        if (!$thisModelData) {
            Session::flash('error', 'Data not found.');
            return redirect()->back();
        }
        $data['thisModelDetail'] =$thisModelData;
        return view('frontend.my.donations.view', $data);
    }
}
