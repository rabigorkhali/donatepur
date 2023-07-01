<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class PublicUserPasswordReset extends Model
{
    protected $table = 'password_reset_public_user';
    protected $guarded = ['_token', 'id'];

    public function uniqueId()
    {
        return  Str::uuid();
    }
}
