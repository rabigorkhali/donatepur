<?php

namespace App\Models\Voyager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignView extends Model
{
    use SoftDeletes;

    protected $table = 'campaigns_summary_view';

    protected $dates = ['end_date','start_date'];

    public function category()
    {
        return $this->belongsTo(CampaignCategory::class,'campaign_category_id');
    }

    public function owner()
    {
        return $this->belongsTo(PublicUser::class,'public_user_id');
    }
}
