<?php

namespace App\Models\Voyager;

use Illuminate\Database\Eloquent\Model;


class Donation extends Model
{

    public function publicUser()
    {
       //return $this->belongsTo('App\Models\Voyager\Donation','public_user_id','id');
    return $this->belongsTo(PublicUser::class,'public_user_id','id');
    }
    
}
