<?php

namespace App\Models\Voyager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(CampaignCategory::class,'campaign_category_id');
    }
}
