<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Voyager\Campaign;
use App\Models\Voyager\ContactUs;
use App\Models\Voyager\Donation;
use App\Models\Voyager\Page;
use App\Models\Voyager\PaymentGateway;
use App\Models\Voyager\SliderBanner;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Throwable;
use Illuminate\Support\Facades\Validator;


class HomeController extends FrontendBaseController
{

    use ImageTrait;

    public function __construct()
    {
        $this->campaigns = new Campaign();
        $this->sliderBanner = new SliderBanner();
        $this->donation = new Donation();
    }

    public function viewFolder()
    {
        return $this->parentViewFolder() . '.index';;
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
            return redirect('/');
        }
    }

    public function index(Request $request)
    {
        try {
            $data = array();
            $data['topCauses'] = $this->campaigns->where('status', true)
                ->where('is_featured', false)
                ->wherein('campaign_status', ['accepted'])
                ->orderby('total_collection', 'desc')
                ->take(6)->get();

            $data['sliderBanners'] = $this->sliderBanner
                ->where('status', true)
                ->orderby('position', 'asc')
                ->take(3)->get();
            $data['total_campaign'] = $this->campaigns->where('status', true)->wherenotin('campaign_status', ['pending', 'rejected', 'cancelled'])->count();
            $data['total_collection'] = $this->campaigns->where('status', true)->wherenotin('campaign_status', ['pending', 'rejected', 'cancelled'])->sum('total_collection');
            $totalDonars = $this->donation->wherein('payment_status', ['successful'])->distinct('giver_public_user_id')->count();
            $data['total_donars'] = $totalDonars + $this->donation->wherein('payment_status', ['successful'])->where('is_verified', 1)->where('giver_public_user_id', null)->count();
            $data['topDonors'] = $this->donation->with('giver')->wherein('payment_status', ['successful'])->where('is_verified', 1)->orderby('amount')->get();
            return $this->renderView($this->viewFolder(), $data);
        } catch (Throwable $th) {
            dd($th);
            return redirect('/');
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
            $data = $request->except('_token');
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|email|max:255',
                'description' => 'required|string|max:255',
                'honeypot' => 'nullable|max:0', // Honeypot field should be empty
            ]);

            if ($validator->fails()) {
                // Handle validation failure (e.g., return error response)
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $resp = ContactUs::insert($data);
            if ($resp) return true;
            return false;
            return $this->renderView($this->parentViewFolder() . '.contact-us', $data);
        } catch (Throwable $th) {
            return false;
        }
    }

    public function getDonation(Request $request)
    {
        try {
            $data = $request->except('_token');
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'description' => 'required|string|max:255',
                'amount' => 'required|numeric|min:10',
                'payment_receipt' => 'mimes:jpeg,png,pdf|max:2048',
                'honeypot' => 'nullable|max:0', // Honeypot field should be empty
            ]);

            if ($validator->fails()) {
                // Handle validation failure (e.g., return error response)
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $dir = "/uploads/donations";
            if ($request->file('payment_receipt')) {
                $data['payment_receipt'] = 'donations/' . $this->uploadImage($dir, 'payment_receipt', true, 1280, null);
            }
            $paymentGateWayDetails = PaymentGateway::where('slug', 'offline')->first();
            $data['payment_gateway_id'] = $paymentGateWayDetails->id;
            $resp = Donation::insert($data);
            Session::flash('successDonation', 'Success! Your action has been completed.');
            return redirect()->back();
        } catch (Throwable $th) {
            return false;
        }
    }
}
