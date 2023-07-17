<?php

namespace App\Models\Voyager;

use Illuminate\Database\Eloquent\Model;


class Withdrawal extends Model
{
    // protected $casts = [
    //     'start_date' => 'date',
    //     'end_date' => 'date',
    // ];
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }
}
