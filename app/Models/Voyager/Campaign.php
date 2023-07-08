<?php

namespace App\Models\Voyager;

use Illuminate\Database\Eloquent\Model;


class Campaign extends Model
{

    public function category()
    {
        return $this->belongsTo(CampaignCategory::class,'campaign_category_id');
    }
}
