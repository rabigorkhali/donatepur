<?php

namespace App\Models\Voyager;

use Illuminate\Database\Eloquent\Model;


class UserPaymentGateway extends Model
{
    public function parentPaymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class, 'payment_gateway_id');
    }
}
