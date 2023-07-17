<?php

namespace App\Services\frontend;

use App\Models\Voyager\Campaign;
use App\Models\Voyager\Donation;
use App\Models\Voyager\SystemErrorLog;
use Exception;

class CampaignService
{


    public function calculateAllAmount($campaignId)
    {
        try {
            $campaignData = Campaign::find($campaignId);
            $donations = Donation::select('amount', 'service_charge_percentage')->where('campaign_id', $campaignData->id)->get();
            $totalServiceCharge = 0;
            $totalCollectedAmount = 0;
            foreach ($donations as $key => $donationsDatum) {
                $singleServiceFee = $donationsDatum->amount * 0.07;
                $totalServiceCharge = $totalServiceCharge + $singleServiceFee;
                $totalCollectedAmount =$totalCollectedAmount+$donationsDatum->amount;
            }
            $totalNetCollection = $totalCollectedAmount - $totalServiceCharge;
            $array=[];
            $array['total_collection']=numberPriceFormat(round($totalCollectedAmount));
            $array['service_charge']=numberPriceFormat(round($totalServiceCharge));
            $array['net_collection']=numberPriceFormat(round($totalNetCollection));
            return $array;
        } catch (Exception $th) {
            SystemErrorLog::insert(['message' => 'Campaign Service=>>>>>calculateNetAmount==>>> ' . $th->getMessage()]);
            return false;
        }
    }
}
