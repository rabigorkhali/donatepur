<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Jobs\SendEmailAfterDonationMade;
use App\Jobs\SendEmailAfterDonationMadeToGiver;
use App\Mail\DonationReceivedEmail;
use App\Models\Country;
use App\Models\Voyager\Campaign;
use App\Models\Voyager\CampaignCategory;
use App\Models\Voyager\CampaignView;
use App\Models\Voyager\CampaignVisit;
use App\Models\Voyager\Category;
use App\Models\Voyager\ContactUs;
use App\Models\Voyager\Donation;
use App\Models\Voyager\Page;
use App\Models\Voyager\Partner;
use App\Models\Voyager\PaymentGateway;
use App\Models\Voyager\Post;
use App\Models\Voyager\PublicUser;
use App\Models\Voyager\Setting;
use App\Models\Voyager\SliderBanner;
use App\Models\Voyager\SystemErrorLog;
use App\Models\Voyager\Testimonial;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Throwable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Dipesh79\LaravelEsewa\LaravelEsewa;
use Cixware\Esewa\Client;
use Cixware\Esewa\Config;


class HomeController extends FrontendBaseController
{

    use ImageTrait;

    public function __construct()
    {
        $this->campaigns = new Campaign();
        $this->sliderBanner = new SliderBanner();
        $this->donation = new Donation();
        $this->dir = "/uploads/donations";
    }

    public function viewFolder()
    {
        return $this->parentViewFolder() . '.index';;
    }

    public function  setSession(Request $request, $sessionName)
    {
        session([$sessionName => $request->all()]);
    }

    public function getPage($slug)
    {
        try {
            $data = [];
            $data['pageDetails'] = Page::where('slug', $slug)->first();
            if (!$data['pageDetails']) {
                return redirect('/');
            }
            return $this->renderView($this->parentViewFolder() . '.page', $data);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);;
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
            return redirect('/');
        }
    }

    public function index(Request $request)
    {
        $views = $request->get('check-views');
        if ($views == 'donation-given') {
            return $this->renderView('email.donation-given', []);
        }
        if ($views == 'donation-receiver') {
            return $this->renderView('email.donation-receiver', []);
        }
        try {
            $data = array();
            $data['featuredCauses'] = CampaignView::where('status', true)
                ->where('is_featured', false)
                ->wherenotin('campaign_status', getCampaignStatusThatCantBeShown())
                ->orderby('summary_total_collection', 'desc')
                ->take(6)->get();

            $data['recentCauses'] = CampaignView::where('status', true)
                ->where('is_featured', false)
                ->wherenotin('campaign_status', getCampaignStatusThatCantBeShown())
                ->orderby('created_at', 'desc')
                ->paginate(6);

            $data['sliderBanners'] = $this->sliderBanner
                ->where('status', true)
                ->orderby('position', 'asc')
                ->take(3)->get();
            $data['total_campaign'] = $this->campaigns->where('status', true)->wherenotin('campaign_status', ['pending', 'rejected', 'cancelled'])->count();
            $data['total_collection'] = CampaignView::where('status', true)->wherenotin('campaign_status', ['pending', 'rejected', 'cancelled'])->sum('summary_total_collection');
            // $totalDonars = $this->donation->wherein('payment_status', ['completed'])->distinct('giver_public_user_id')->count();
            $totalDonars = $this->donation->wherein('payment_status', ['completed'])->count();
            $data['total_donars'] = $totalDonars + $this->donation->wherein('payment_status', ['completed', 'successful'])->where('is_verified', 1)->where('giver_public_user_id', null)->count();
            $data['total_public_users'] = PublicUser::where('status', 1)->count();
            $donationRaw = $this->donation->with('giver')->wherein('payment_status', ['completed'])->where('is_verified', 1)->orderby('amount', 'desc')->get();
            $topDonorsList = [];
            foreach ($donationRaw as $donationRawKey => $donationRawDatum) {
                $topDonors = [];
                $topDonors['name'] = $donationRawDatum?->giver?->name ?? $donationRawDatum->fullname;
                if ($donationRawDatum->donor_display_image) {
                    $topDonors['profile_pic'] = asset('public/uploads/') . '/' . imageName($donationRawDatum->donor_display_image, '-medium');
                } else if ($donationRawDatum?->giver?->profile_picture) {
                    $topDonors['profile_pic'] = asset('public/uploads/') . '/' . imageName($donationRawDatum?->giver?->profile_picture, '-medium');
                } else {
                    $topDonors['profile_pic'] = asset('public/uploads/static-images/images/usernotfound.png');
                }

                // $topDonors['profile_pic'] = asset('public/uploads/') . '/' . imageName($donationRawDatum?->giver?->profile_picture, '-medium');
                $topDonors['amount'] = $donationRawDatum->amount;
                $topDonors['is_anonymous'] = $donationRawDatum->is_anonymous;
                $topDonors['giver_public_user_id'] = $donationRawDatum->giver_public_user_id;
                array_push($topDonorsList, $topDonors);
            }
            $data['topDonors'] = $topDonorsList;
            $data['testimonials'] = Testimonial::where('status', 1)->get();
            $data['partners'] = Partner::get();
            return $this->renderView($this->viewFolder(), $data);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);;
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
        }
    }

    public function campaignList(Request $request)
    {
        try {
            $data = array();
            $keyword = trim($request->get('title'));
            $category = trim($request->get('category'));
            if ($category) {
                $categoryDetails = CampaignCategory::where('slug', $category)->where('status', 1)->first();
            }
            $campaignQuery = CampaignView::where('status', true);
            if ($keyword) {
                $campaignQuery = $campaignQuery->where('title', 'LIKE', '%' . $keyword . '%');
            }
            if ($category) {
                $campaignQuery = $campaignQuery->where('campaign_category_id', $categoryDetails?->id);
            }
            $campaignQuery = $campaignQuery->wherenotin('campaign_status', ['pending', 's']);
            $campaignQuery = $campaignQuery->orderby('id', 'desc')
                ->orderby('summary_total_collection', 'desc')
                ->where('campaign_status', '!=', 'pending')->where('status', 1)
                ->paginate(15);

            $data['causesList'] = $campaignQuery;
            $data['campaignCategories'] = CampaignCategory::where('status', 1)->orderby('title', 'asc')->get();
            return $this->renderView($this->parentViewFolder() . '.campaign-list', $data);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);;

            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
        }
    }

    public function postList(Request $request)
    {
        try {
            dump('testss');
            dump('testss');
            // dump('testss');
            $data = array();
            $keyword = trim($request->get('title'));
            $category = trim($request->get('category'));
            if ($category) {
                $categoryDetails = Category::where('slug', $category)->first();
            }
            $postQuery = Post::where('status', true);
            if ($keyword) {
                $postQuery = $postQuery->where('title', 'LIKE', '%' . $keyword . '%');
            }
            if ($category) {
                $postQuery = $postQuery->where('category_id', $categoryDetails?->id);
            }
            $postQuery = $postQuery->orderby('id', 'desc')
                ->where('status', 1)
                ->paginate(12);

            $data['postList'] = $postQuery;
            $data['postCategories'] = Category::orderby('name', 'asc')->get();
            return $this->renderView($this->parentViewFolder() . '.blog-list', $data);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);;            // Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
        }
    }

    public function postDetailPage(Request $request, $slug)
    {
        try {
            $data = array();
            $postDetails = Post::where('status', 'published')
                ->where('slug', $slug)->first();
            $data['postDetails'] = $postDetails;
            $data['postCategories'] = Category::orderby('name', 'asc')->get();
            $data['latestPosts'] = Post::orderby('id', 'desc')->where('status', 'PUBLISHED')->get();
            return $this->renderView($this->parentViewFolder() . '.blog-detail', $data);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);;            // Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
        }
    }

    public function contactUsView(Request $request)
    {
        $data = [];
        return $this->renderView($this->parentViewFolder() . '.contact-us', $data);
    }

    public function contactUsCreate(Request $request)
    {
        try {
            $data = $request->except('_token', 'honeypot');
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|email|max:255',
                'message' => 'required|string|max:255',
                'honeypot' => 'nullable|max:0', // Honeypot field should be empty
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                // Handle validation failure (e.g., return error response)
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $resp = ContactUs::insert($data);
            if ($resp) {
                Session::flash('success', 'Your message has been received. We will contact you soon.Thank You.');
                return redirect()->back();
            }
            Session::flash('error', 'Error! Something went wrong. Pleas try again or contact our support team.');
            return redirect()->back();
            // return false;
            // return $this->renderView($this->parentViewFolder() . '.contact-us', $data);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);;            // Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
            return false;
        }
    }

    public function getDonation(Request $request)
    {
        $data = $request->except('_token');
        $insertData = $request->except('_token', 'campaign_slug', 'payment_mode', 'payment_gateway', 'payment_gateway_dynamic');
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'amount' => 'required|numeric|min:10|max:1000000',
            'description' => 'required|string|max:500|min:10',
            'payment_receipt' => 'required|image|max:4048',
            // 'payment_receipt' => 'required_if:payment_gateway,bank|mimes:jpeg,png,pdf|max:2048',
            // 'payment_gateway' => 'required',
            'mobile_number' => 'required|string|min:5|max:15',
            'payment_gateway_dynamic' => 'required|string|max:15',
            // 'mobile_number' => 'required_if:payment_gateway,bank|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {

            $campaignDetails = CampaignView::where('id', $data['campaign_id'])->where('status', 1)->first();
            if (!$campaignDetails) {
                Session::flash('error', 'Error! Campaign not found.');
                return redirect()->back();
            }

            if ($campaignDetails->campaign_status !== 'running') {
                Session::flash('error', 'Error! Only active campaigns can receive donation.');
                return redirect()->back();
            }

            if ($campaignDetails->end_date < date('Y-m-d')) {
                Session::flash('error', 'Sorry. This campaign has expired.');
                return redirect()->back();
            }

            $paymentGateWayDetails = PaymentGateway::where('slug', 'bank')->first();
            $insertData['payment_gateway_id'] = $paymentGateWayDetails->id;
            $insertData['campaign_id'] = $campaignDetails->id;
            $insertData['receiver_public_user_id'] = $campaignDetails->public_user_id;
            $insertData['giver_public_user_id'] = Auth::guard('frontend_users')->user()?->id ?? null;
            $insertData['created_at'] = date('Y-m-d H:i:s');
            $insertData['transaction_id'] = 'testest';
            $insertData['service_charge_percentage'] = 7;
            $insertData['payment_status'] = 'pending';
            $insertData['is_anonymous'] = 0;
            $insertData['is_verified'] = 0; //by system admin manually
            if ($request->file('payment_receipt')) {
                $insertData['payment_receipt'] = 'donations/' . $this->uploadImageSingle($this->dir, 'payment_receipt', true, 600, null);
            }
            $resp = Donation::create($insertData);

            /* send mail */
            $mailData = [];
            $mailData['donationId'] = $resp->id;
            $mailData['campaignDetails'] = $campaignDetails;
            $mailData['donationData'] = $insertData;
            $mailData['donationReceiverEmail'] = $campaignDetails->owner->email;
            dispatch(new SendEmailAfterDonationMade($mailData));

            // Mail::to($campaignDetails->owner->email)->send(new DonationReceivedEmail($mailData));
            /* send mail */


            /* SEND EMAIL GIVER */
            $mailData = [];
            $mailData['donationId'] = $resp->id;
            $mailData['campaignDetails'] = $campaignDetails;
            $mailData['donationData'] = $insertData;
            $mailData['donationGiverEmail'] = $insertData['email'] ?? '';
            if ($mailData['donationGiverEmail']) {
                dispatch(new SendEmailAfterDonationMadeToGiver($mailData));
            }
            /* SEND EMAIL GIVER */
            Session::flash('success', 'Thank You for your kindness. Your donation has been successfully received. Please wait for the verification.');
            return redirect()->back();
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);;            // Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
            Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
            return redirect()->back();
        }
    }

    public function campaignDetailPage(Request $request, $slug)
    {
        try {
            $data = array();
            $campaignDetails = CampaignView::where('status', true)
                ->where('campaign_status', '!=', 'pending')
                ->where('slug', $slug)->first();

            if (!$campaignDetails) {
                Session::flash('error', 'Bad request.');
                return redirect()->route('campaignList');
            }
            $data['campaignDetails'] = $campaignDetails;
            $data['countries'] = Country::orderby('name', 'asc')->get();
            $data['paymentGateways'] = PaymentGateway::orderby('position', 'asc')->where('status', 1)->where('show_in_frontend', 1)->get();
            $topDonorsList = [];
            $donationRaw = $this->donation->with('giver')->where('campaign_id', $campaignDetails->id)->wherein('payment_status', ['completed', 'stopped'])->where('is_verified', 1)->orderby('amount', 'desc')->get();
            foreach ($donationRaw as $donationRawKey => $donationRawDatum) {
                $topDonors = [];
                $topDonors['name'] = $donationRawDatum?->giver?->name ?? $donationRawDatum->fullname;
                if ($donationRawDatum->donor_display_image) {
                    $topDonors['profile_pic'] = asset('public/uploads/') . '/' . imageName($donationRawDatum->donor_display_image, '-medium');
                } else if ($donationRawDatum?->giver?->profile_picture) {
                    $topDonors['profile_pic'] = asset('public/uploads/') . '/' . imageName($donationRawDatum?->giver?->profile_picture, '-medium');
                } else {
                    $topDonors['profile_pic'] = asset('public/uploads/static-images/images/usernotfound.png');
                }


                $topDonors['amount'] = $donationRawDatum->amount;
                $topDonors['is_anonymous'] = $donationRawDatum->is_anonymous;
                $topDonors['donation_date'] = $donationRawDatum->created_at->format('Y-M-d');
                $topDonors['giver_public_user_id'] = $donationRawDatum->giver_public_user_id;
                array_push($topDonorsList, $topDonors);
            }
            $data['topDonors'] = $topDonorsList;
            return $this->renderView($this->parentViewFolder() . '.campaign-detail', $data);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);;            // Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
        }
    }

    public function khaltiPaymentVerification(Request $request)
    {
        //hit the khalit server

        try {
            $userCurrent = Auth::guard('frontend_users')->user() ?? null;
            /* validation */
            $dataRequest = $request->all();
            $paymentGateWayDetails = PaymentGateway::where('slug', 'khalti')->where('status', 1)->first();
            $campaignDetails = CampaignView::where('status', 1)->where('id', $dataRequest['campaign_id'])->first();

            if (!$campaignDetails) {
                $data['type'] = 'error';
                $data['msg'] = 'Campaign not found.';
                return $data;
            }

            if ($campaignDetails->campaign_status !== 'running') {
                $data['type'] = 'error';
                $data['msg'] = 'Error! Only active campaigns can receive donation.';
                return $data;
            }

            if ($campaignDetails->end_date < date('Y-m-d')) {
                $data['type'] = 'error';
                $data['msg'] = 'Error! This campaign has expired.';
                return $data;
            }

            if (!$paymentGateWayDetails) {
                $data['type'] = 'error';
                $data['msg'] = 'Invalid payment gateway.';
                return $data;
            }
            /* validation */
            $args = http_build_query(array(
                'token' => $request->input('trans_token'),
                'amount' => $request->input('amount')
            ));
            $url = getPaymentConfigs('khalti')['initiation_url'] ?? '';
            # Make the call using API.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $headers = ['Authorization: Key ' . getPaymentConfigs('khalti')['private_key']];
            // $headers = ['Authorization: Key ' . env('KHALTI_SECRET_KEY')];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            // Response
            $response = curl_exec($ch);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $response = json_decode($response);
            curl_close($ch);

            /* LOG */
            $form_data = $request->input('form_data');
            $formDataArray = [];
            foreach ($form_data as $item) {
                $formDataArray[$item['name']] = $item['value'];
            }

            if ($status_code == 200) {
                /* donateaoro */
                $insertData = [];
                $insertData['amount'] = $response->amount / 100;
                $insertData['fullname'] = trim($formDataArray['fullname'] ?? 'error');
                $insertData['mobile_number'] = trim($formDataArray['mobile_number'] ?? 'error');
                $insertData['country'] = trim($formDataArray['country'] ?? 'error');
                $insertData['email'] = trim($formDataArray['email'] ?? 'error');
                $insertData['address'] = trim($formDataArray['address'] ?? 'error');
                $insertData['description'] = trim($formDataArray['description'] ?? 'error');
                $insertData['payment_gateway_id'] = $paymentGateWayDetails->id;
                $insertData['campaign_id'] = $request->input('campaign_id');
                $insertData['receiver_public_user_id'] = $campaignDetails->public_user_id;
                $insertData['giver_public_user_id'] = $userCurrent?->id ?? null;
                $insertData['created_at'] = date('Y-m-d H:i:s');
                $insertData['transaction_id'] = $response->idx ?? null;
                $insertData['service_charge_percentage'] = 7;
                $insertData['payment_status'] = strtolower($response?->state?->name ?? '');
                $insertData['is_anonymous'] = 0;
                $insertData['created_at'] = date('Y-m-d H:i:s');
                $insertData['updated_at'] = date('Y-m-d H:i:s');
                $insertData['payment_gateway_all_response'] = json_encode($response);
                $insertData['is_verified'] = 1; //by system admin manually
                $resp = Donation::create($insertData);
                $data['type'] = 'success';
                $data['msg'] = 'Thank You for your kindness. Your donation has been successfully received. Please wait for the verification.';

                /* send mail */
                $mailData = [];
                $mailData['donationId'] = $resp->id;
                $mailData['campaignDetails'] = $campaignDetails;
                $mailData['donationData'] = $insertData;
                $mailData['donationReceiverEmail'] = $campaignDetails->owner->email;
                dispatch(new SendEmailAfterDonationMade($mailData));
                /* send email */

                /* SEND EMAIL GIVER */
                $mailData = [];
                $mailData['donationId'] = $resp->id;
                $mailData['campaignDetails'] = $campaignDetails;
                $mailData['donationData'] = $insertData;
                $mailData['donationGiverEmail'] = $insertData['email'] ?? '';
                if ($mailData['donationGiverEmail']) {
                    dispatch(new SendEmailAfterDonationMadeToGiver($mailData));
                }
                /* SEND EMAIL GIVER */

                return $data;
                /* donateaoro */
            }
            $data['type'] = 'error';
            $data['msg'] = 'Sorry. Something went wrong. Please try again later or contact our support team.';
            return $data;
        } catch (Throwable $th) {
            // return $this->renderView($this->parentViewFolder() . '.errorpage', []);
            // Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
            // return redirect()->back();
            $data['type'] = 'error';
            $data['msg'] = 'Something went wrong';
            SystemErrorLog::insert(['message' => 'khalti verification' . $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);;
            return $data;
        }
    }

    // public function esewaPaymentSuccess(Request $request)
    // {
    //     try {
    //         $dataResponse = $request->all();

    //         /* validation */
    //         $data = [
    //             'amt' => $dataResponse['amt'],
    //             'rid' => $dataResponse['refId'],
    //             'pid' => $dataResponse['oid'],
    //             'scd' => 'EPAYTEST'
    //         ];
    //         $url = "https://uat.esewa.com.np/epay/transrec";
    //         $curl = curl_init($url);
    //         curl_setopt($curl, CURLOPT_POST, true);
    //         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    //         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //         $response = curl_exec($curl);
    //         curl_close($curl);
    //         $data['payment_gateway']='esewa';
    //         $data['payment_verification']='failed';
    //         //convert xml response to array
    //         $response = json_decode(json_encode(simplexml_load_string($response)), TRUE);
    //         $response_code = trim(strtolower($response['response_code'])); //remove whitespaces
    //         $verified = 0;
    //         if (strcmp($response_code, 'success') == 0) {
    //             $verified = 1;
    //         }
    //         if ($verified) {
    //             /* SEND EMAIL GIVER */
    //             $data['payment_gateway'] = 'esewa';
    //             $data['payment_verification'] = 'success';
    //             Session::flash('success', 'Thank You for your kindness. Your donation has been successfully received. Please wait for the verification.');
    //             return redirect()->back()->with(['esewaCheckSuccessData'=>$data]);;
    //         } else {
    //             Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
    //             return redirect()->back()->with(['esewaCheckSuccessData'=>$data]);;
    //         }
    //     } catch (Throwable $th) {
    //         $data['payment_gateway']='esewa';
    //         $data['payment_verification']='failed';
    //         SystemErrorLog::insert(['message' => $th->getMessage(),'created_at' => date('Y-m-d H:i:s')]);;
    //         Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
    //         return redirect()->back()->with(['esewaCheckSuccessData'=>$data]);;
    //     }
    // }

    public function esewaPaymentInitiateV2(Request $request)
    {
        try {
            $amount = trim($request->get('amount'));
            $pid = trim($request->get('pid'));
            $campaign = trim($request->get('campaign_id'));
            $campaignDetails = CampaignView::where('status', 1)->where('id', $campaign)->first();
            session(['esewaDonateformData' => $request->all()]);
            $successUrl = route('esewaSuccess');
            $failureUrl = route('esewaFailure') . '?campaign=' . $campaign;
            if (setting('site.is_dev_or_live') == 'dev') {
                $config = new Config($successUrl, $failureUrl);
            } else {
                $config = new Config($successUrl, $failureUrl, getPaymentConfigs('esewa')['public_key']);
            }
            $esewa = new Client($config);
            // $esewa->process('P101W20dfdf1', 100, 15, 80, 50);
            $esewa->process($pid, $amount, 0, 0, 0);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);
            Session::flash('error', 'Sorry. Your recent transaction had an issue. Please try again later or contact our support team.');
            // return redirect()->route('campaignDetailPage', ['slug' => $campaignDetails->slug]);
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
        }
    }

    public function esewaPaymentSuccess(Request $request)
    {
        try {
            $userCurrent = Auth::guard('frontend_users')->user() ?? null;
            $dataResponse = $request->all();
            if (!session('esewaDonateformData')) {
                Session::flash('error', 'Error! Bad Request.');
                return redirect()->back();
            }
            $formDataArray = session('esewaDonateformData');
            /* validation */
            $paymentGateWayDetails = PaymentGateway::where('slug', 'esewa')->where('status', 1)->first();
            $campaignDetails = CampaignView::where('status', 1)->where('id', $formDataArray['campaign_id'])->where('campaign_status', 'running')->first();
            if (!$campaignDetails) {
                Session::flash('error', 'This campaign cannot accept donation.');
                return redirect()->back();
            }

            $donationDuplicateEntryCheck = Donation::where('payment_gateway_id', $paymentGateWayDetails->id)->where('transaction_id', $dataResponse['refId'])->first();

            if ($donationDuplicateEntryCheck) {
                Session::flash('success', 'Thank You for your kindness. Your donation has been successfully received. Please wait for the verification.');
                return redirect()->route('campaignDetailPage', ['slug' => $campaignDetails->slug]);
            }

            if ($campaignDetails->campaign_status !== 'running') {
                Session::flash('error', 'Error! Only active campaigns can receive donation.');
                return redirect()->back();
            }

            if ($campaignDetails->end_date < date('Y-m-d')) {

                Session::flash('error', 'Error! This campaign has expired.');
                return redirect()->back();
            }

            if (!$paymentGateWayDetails) {
                Session::flash('error', 'Invalid payment gateway.');
                return redirect()->back();
            }
            /* validation */
            $dataSuccessResponseFromEsewa = [
                'amt' => $dataResponse['amt'],
                'rid' => $dataResponse['refId'],
                'pid' => $dataResponse['oid'],
                'scd' => 'EPAYTEST'
            ];

            $url = getPaymentConfigs('esewa')['callback_url'] ?? '';
            // $url = "https://uat.esewa.com.np/epay/transrec";
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $dataSuccessResponseFromEsewa);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);

            //convert xml response to array
            $response = json_decode(json_encode(simplexml_load_string($response)), TRUE);
            $response_code = trim(strtolower($response['response_code'])); //remove whitespaces
            $verified = 0;
            $status = 'pending';
            if (strcmp($response_code, 'success') == 0) {
                $status = 'completed';
                $verified = 1;
            } else {
                $status = 'pending';
                $verified = 1;
            }

            if ($verified) {
                /* donateaoro */
                $insertData = [];
                $insertData['amount'] = $dataResponse['amt'];
                $insertData['fullname'] = trim($formDataArray['fullname']);
                $insertData['mobile_number'] = trim($formDataArray['mobile_number']);
                $insertData['country'] = trim($formDataArray['country']);
                $insertData['email'] = trim($formDataArray['email']);
                $insertData['address'] = trim($formDataArray['address']);
                $insertData['description'] = trim($formDataArray['description']);
                $insertData['payment_gateway_id'] = $paymentGateWayDetails->id;
                $insertData['campaign_id'] = $formDataArray['campaign'];
                $insertData['receiver_public_user_id'] = $campaignDetails->public_user_id;
                $insertData['giver_public_user_id'] = $userCurrent->id ?? null;
                $insertData['created_at'] = date('Y-m-d H:i:s');
                $insertData['transaction_id'] = $dataResponse['refId'] ?? null;
                $insertData['service_charge_percentage'] = 7;
                $insertData['payment_status'] = 'completed';
                $insertData['is_anonymous'] = 0;
                $insertData['payment_gateway_all_response'] = json_encode($response);
                $insertData['is_verified'] = 1; //by system admin manually
                $resp = Donation::create($insertData);
                /* send mail */
                $mailData = [];
                $mailData['donationId'] = $resp->id;
                $mailData['campaignDetails'] = $campaignDetails;
                $mailData['donationData'] = $insertData;
                $mailData['donationReceiverEmail'] = $campaignDetails->owner->email;
                dispatch(new SendEmailAfterDonationMade($mailData));
                /* send email */

                /* SEND EMAIL GIVER */
                $mailData = [];
                $mailData['donationId'] = $resp->id;
                $mailData['campaignDetails'] = $campaignDetails;
                $mailData['donationData'] = $insertData;
                $mailData['donationGiverEmail'] = $insertData['email'] ?? '';
                if ($mailData['donationGiverEmail']) {
                    dispatch(new SendEmailAfterDonationMadeToGiver($mailData));
                }
                /* SEND EMAIL GIVER */
                session()->forget('esewaDonateformData');
                Session::flash('success', 'Thank You for your kindness. Your donation has been successfully received. Please wait for the verification.');
                return redirect()->route('campaignDetailPage', ['slug' => $campaignDetails->slug]);
            }
            Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
            return redirect()->route('campaignDetailPage', ['slug' => $campaignDetails->slug]);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);
            Session::flash('error', 'Sorry. Your recent transaction had an issue. Please try again later or contact our support team.');
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
            // return redirect()->route('campaignDetailPage', ['slug' => $campaignDetails->slug]);
        }
    }

    public function esewaPaymentFailure(Request $request)
    {
        try {
            $dataResponse = $request->all();
            if ($dataResponse['campaign'] ?? null) {
                $campaignDetails = CampaignView::where('status', 1)->where('id', $dataResponse['campaign'])->first();
                if (!$campaignDetails) {
                    return $this->renderView($this->parentViewFolder() . '.errorpage', []);
                }
                SystemErrorLog::insert(['message' => 'Esewa Failure on Donations for campaign id' . $campaignDetails->id . 'by' . $request?->user?->id]);
                Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
                if ($dataResponse['campaign'] ?? null) {
                    return redirect()->route('campaignDetailPage', ['slug' => $campaignDetails->slug]);
                }
            }
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);;
            Session::flash('error', 'Sorry. Something went wrong. Please try again later or contact our support team.');
            return $this->renderView($this->parentViewFolder() . '.errorpage', []);
        }
    }

    function saveLocation(Request $request)
    {
        try {
            $data = [];
            $data['ip'] = $request->input('ip');
            $data['latitude'] = $request->input('latitude') ?? null;
            $data['longitude'] = $request->input('longitude') ?? null;
            $data['campaign_id'] = $request->input('campaign_id') ?? null;
            $data['created_at'] = date('Y-m-d H:i:s');
            $currentDateTime = now(); 
            $oneHourAgo = $currentDateTime->subHour(); 
            $ifExists = CampaignVisit::where('ip', $data['ip'])->where('campaign_id', $data['campaign_id'])->where('created_at', '>=', $oneHourAgo)->count();
            if (!$ifExists) {
                CampaignVisit::insert($data);
            }
            return 'true';
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);;
            return 'false';
        }
    }

    function syncExpiredCampaigns(Request $request)
    {
        try {
            Campaign::wheredate('end_date', '<', date('Y-m-d'))->wherein('campaign_status', ['running', 'stopped'])->update(['campaign_status' => 'completed']);
            return 'true';
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage(), 'created_at' => date('Y-m-d H:i:s')]);;
            dump($th);
            return 'false';
        }
    }
}
