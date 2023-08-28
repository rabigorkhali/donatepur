<?php

namespace App\Models\Voyager;

use Illuminate\Database\Eloquent\Model;


class Donation extends Model
{
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    public function receiver()
    {
        return $this->belongsTo(PublicUser::class, 'receiver_public_user_id', 'id');
    }

    public function giver()
    {
        return $this->belongsTo(PublicUser::class, 'giver_public_user_id', 'id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }

    public function paymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class, 'payment_gateway_id', 'id');
    }
}
