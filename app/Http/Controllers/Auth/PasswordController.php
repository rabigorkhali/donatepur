<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Voyager\SystemErrorLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Throwable;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        try {
            if (!Hash::check($request->current_password, $request->user()->password)) {
                Session::flash('error', 'Error! Your  current password is incorrect.');
                return back()->with('status', 'password-updated');
            }
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $request->user()->update([
                'password' => Hash::make($request->get('password')),
            ]);
            Session::flash('success', 'Success! Your password has been changed.');
            return back()->with('status', 'password-updated');
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message'=>$th->getMessage()]);
            Session::flash('error', 'Error! Something went wrong with your previous request.');
            return redirect()->back();
        }
    }

    public function changePassword(Request $request)
    {
        return view('profile.change-password', [
            'user' => $request->user(),
        ]);
    }
}
