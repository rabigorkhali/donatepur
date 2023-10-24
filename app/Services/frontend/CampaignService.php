<?php

namespace App\Services\frontend;

use App\Models\Voyager\Campaign;
use App\Models\Voyager\CampaignView;
use App\Models\Voyager\Donation;
use App\Models\Voyager\SystemErrorLog;
use Exception;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Throwable;

class CampaignService
{


    public function calculateAllAmount($campaignId)
    {
        try {
            $campaignData = Campaign::find($campaignId);
            $donations = Donation::select('amount', 'service_charge_percentage')->where('payment_status', 'successful')->where('campaign_id', $campaignData->id)->get();
            $totalServiceCharge = 0;
            $totalCollectedAmount = 0;
            foreach ($donations as $key => $donationsDatum) {
                $singleServiceFee = $donationsDatum->amount * ($donationsDatum->service_charge_percentage / 100);
                $totalServiceCharge = $totalServiceCharge + $singleServiceFee;
                $totalCollectedAmount = $totalCollectedAmount + $donationsDatum->amount;
            }
            $totalNetCollection = $totalCollectedAmount - $totalServiceCharge;
            $array = [];
            $array['total_collection'] = floor($totalCollectedAmount);
            $array['service_charge'] = floor($totalServiceCharge);
            $array['net_collection'] = floor($totalNetCollection);
            dd($array);
            return $array;
        } catch (Exception $th) {
            SystemErrorLog::insert(['message' => 'Campaign Service=>>>>>calculateNetAmount==>>> ' . $th->getMessage()]);
            return false;
        }
    }

    public function campaignSummary($request, $id)
    {
        try {
            $data = [];
            if ($request->user->is_superuser) {
                $campaignData = CampaignView::select('start_date', 'end_date', 'cover_image', 'goal_amount', 'summary_total_collection', 'net_amount_collection', 'summary_service_charge_amount', 'total_number_donation', 'campaign_status')
                    ->withTrashed()->where('id', $id)->first();
            } else {
                $campaignData = CampaignView::select('start_date', 'end_date', 'cover_image', 'goal_amount', 'summary_total_collection', 'net_amount_collection', 'summary_service_charge_amount', 'total_number_donation', 'campaign_status')
                   ->withTrashed() ->where('public_user_id', $request->user->id)->where('id', $id)->first();
            }

            if (!$campaignData) {
                Session::flash('error', 'Bad request.');
                return redirect()->back()->withInput();
            }
            $campaignData->summary_total_collection = priceToNprFormat($campaignData->summary_total_collection);
            $campaignData->net_amount_collection = priceToNprFormat($campaignData->net_amount_collection);
            $campaignData->summary_service_charge_amount = priceToNprFormat($campaignData->summary_service_charge_amount);
            $campaignData->goal_amount = priceToNprFormat($campaignData->goal_amount);
            $campaignData->start_date = $campaignData->start_date->format('Y-m-d');
            $campaignData->start_date_format = $campaignData->start_date->format('Y-m-d');
            $campaignData->end_date = $campaignData->end_date->format('Y-m-d');
            $campaignData->end_date_format = $campaignData->end_date->format('Y-m-d');
            $data['campaign'] = $campaignData;
            return $data;
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return false;
        }
    }
}
