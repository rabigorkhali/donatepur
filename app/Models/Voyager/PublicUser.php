<?php

namespace App\Models\Voyager;

use Carbon\Carbon;
use Database\Factories\UserFactory as FactoriesUserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use TCG\Voyager\Contracts\User as UserContract;
use TCG\Voyager\Tests\Database\Factories\UserFactory;
use TCG\Voyager\Traits\VoyagerUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

// class PublicUser extends Authenticatable implements UserContract
class PublicUser  extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $guard = 'admin';

    protected $table = 'public_users';


     protected $guarded = ['_token', 'id'];

     public function adminlte_image()
     {
         return  asset('public/uploads/' . giveImageName(Auth::guard('frontend_users')->user()->profile_picture, 'small')) ;
     }
 
     public function adminlte_desc()
     {
         return Auth::guard('frontend_users')->user()->full_name;
     }
 
     public function adminlte_profile_url()
     {
         return 'profile';
     }
    // protected $guarded = [];

    // public $additional_attributes = ['locale'];
    //  protected $fillable = ['username','full_name', 'mobile_number','email'];

    // public function getAvatarAttribute($value)
    // {
    //     return $value ?? config('voyager.user.default_avatar', 'users/default.png');
    // }

    // public function setCreatedAtAttribute($value)
    // {
    //     $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    // }

    // public function setSettingsAttribute($value)
    // {
    //     $this->attributes['settings'] = $value ? $value->toJson() : json_encode([]);
    // }

    // public function getSettingsAttribute($value)
    // {
    //     return collect(json_decode((string)$value));
    // }

    // public function setLocaleAttribute($value)
    // {
    //     $this->settings = $this->settings->merge(['locale' => $value]);
    // }

    // public function getLocaleAttribute()
    // {
    //     return $this->settings->get('locale');
    // }

    // protected static function newFactory()
    // {
    //     return FactoriesUserFactory::new();
    // }
}
