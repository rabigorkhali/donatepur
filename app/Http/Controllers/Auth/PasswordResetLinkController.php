<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PublicUserPasswordResetMail;
use App\Models\PublicUserPasswordReset;
use App\Models\Voyager\PublicUser;
use App\Models\Voyager\SystemErrorLog;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;
use DB;
use Throwable;
use Illuminate\Support\Facades\Mail;


class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function verifyEmail($token, $email)
    {
        try {
            $tokenExists = PublicUser::where('email', $email)->first();
            if ($tokenExists->is_email_verified == 1) {
                Session::flash('error', 'This email has been already verified.');
                return redirect()->route('login');
            }
            if ($tokenExists->email_verify_token !== $token) {
                Session::flash('error', 'Invalid token. Try again.');
                return redirect()->route('login');
            }
            $data['email_verified_at']=date('Y-m-d H:i:s');
            $data['is_email_verified']=1;
            PublicUser::where('email', $email)->update($data);
            Session::flash('success', 'Your account has been verified. Please login.');
            return redirect()->route('login');
        } catch (Throwable $th) {
            DB::rollback();
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        $token = Str::uuid();
        $email = $request->get('email');
        $checkPublicUserPassword = PublicUserPasswordReset::where('email', $email)->wheredate('created_at', date('Y-m-d'))->count();
        if ($checkPublicUserPassword > 6) {
            Session::flash('error', 'You have requested more than 5 times. Please try again tomorrow.');
            return redirect()->route('login');
        }
        PublicUserPasswordReset::create(['token' => $token, 'email' => $request->get('email')]);
        Mail::to($request->only('email'))->send(new PublicUserPasswordResetMail($token));
        Session::flash('success', 'Password reset link sent successfully.');
        return redirect()->route('login');
    }

    public function createResetForm(Request $request)
    {
        $data['email'] = $request->email;
        $data['token'] = $request->route('token');
        return view('auth.reset-password', $data);
    }

    public function storeResetForm(Request $request)
    {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => ['required', 'confirmed', 'min:6'],
            ]);
            try {
            $token = $request->get('token');
            $password = $request->get('password');
            $email = $request->get('email');

            DB::begintransaction();
            $checkPublicUserPassword = PublicUserPasswordReset::where('email', $email)->wheredate('created_at', date('Y-m-d'))->count();
            if ($checkPublicUserPassword > 6) {
                Session::flash('error', 'You have requested more than 5 times. Please try again tomorrow.');
                return redirect()->route('password.reset',$token);
            }
            $checkPublicUserPassword = PublicUserPasswordReset::where('token', $token)->wheredate('created_at', date('Y-m-d'))->count();
            if (!$checkPublicUserPassword) {
                Session::flash('error', 'Invalid token. Please try again.');
                return redirect()->route('password.reset',$token);
            }
            PublicUserPasswordReset::where('email', $email)->delete();
            PublicUser::where('email', $email)->update(['password' => Hash::make($password)]);
            Session::flash('success', 'Password changed successfully.');
            DB::commit();
            return redirect()->route('login');
        } catch (Throwable $th) {
            DB::rollback();
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            return redirect()->route('frontend.error.page');
        }
    }
}
