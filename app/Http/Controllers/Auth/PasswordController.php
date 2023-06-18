<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate( [
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->get('password')),
        ]);
        Session::flash('success', 'Success! Your password has been changed.');
        return back()->with('status', 'password-updated');
    }

    public function changePassword(Request $request)
    {
        return view('profile.change-password', [
            'user' => $request->user(),
        ]);
    }
}
