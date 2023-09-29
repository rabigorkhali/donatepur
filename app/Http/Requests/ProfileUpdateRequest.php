<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\Voyager\PublicUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100', Rule::unique('public_users')->ignore($this->user()->id)],
            'username' => ['required', 'string', 'max:50', Rule::unique('public_users')->ignore($this->user()->id)],
            'country' => ['required', 'string', 'max:50', 'in:nepal,india'],
            'address' => ['required', 'string', 'max:100'],
            'mobile_number' => ['required', 'string', 'max:15', 'min:6'],
            'mobile_number_secondary' => ['string', 'max:15', 'min:6'],
            'landline_number' => ['string', 'max:15', 'min:6'],
            'date_of_birth' => ['required', 'date', 'before:' . \Carbon\Carbon::now()->subYears(16)->format('Y-m-d')],
            'profile_picture' => ['nullable','image', 'max:40960']
        ];
        
    }
}
