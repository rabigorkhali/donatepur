<?php

namespace App\Models\Voyager;

use Illuminate\Database\Eloquent\Model;


class ContactUs extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
    ];
}
