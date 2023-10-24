<?php

namespace App\Models\Voyager;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class UserPaymentGateway extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function parentPaymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class, 'payment_gateway_id')->withTrashed();
    }
}
