<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\NewUserRegistrationEmail;
use App\Models\Voyager\PublicUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        if (Auth::guard('frontend_users')->user()) {
            return redirect()->route('my.dashboard');
        }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $publicUser = PublicUser::where('email', trim($request->email))->first();

        if (!$publicUser) {
            Session::flash('error', 'User not found.');
            return redirect()->route('login');
        }

        $data['full_name'] = $publicUser->full_name;
        $data['email'] = $publicUser->email;
        $data['email_verify_token'] = $publicUser->email_verify_token;

        $request->authenticate();
        if ($publicUser->status !== '1' || $publicUser->status !== 1) {
            Auth::guard('frontend_users')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            Session::flash('error', 'Your account is disabled.');
            return redirect()->route('login');
        }
        if ($publicUser->is_email_verified == 0 || $publicUser->is_email_verified == '0') {
            Auth::guard('frontend_users')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            Mail::to($publicUser->email)->send(new NewUserRegistrationEmail($data));
            Session::flash('error', 'Your account is not verified. Check your email for verification link.');
            return redirect()->route('login');
        }
        $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
        return redirect()->back();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('frontend_users')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
