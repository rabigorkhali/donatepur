<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NewUserRegistrationEmail;
use App\Models\User;
use App\Models\Voyager\PublicUser;
use App\Models\Voyager\SystemErrorLog;
use App\Providers\RouteServiceProvider;
use App\Traits\ImageTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Throwable;
use DB;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    use ImageTrait;
    public $dir = "/uploads/public-users";
    public $mainDirectory = "/uploads";
    public $dirforDb = "/public-users/";
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('authsuperuser.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $publicUser = PublicUser::where('email', trim($request->email))->withTrashed()->first();
        if ($publicUser && $publicUser->deleted_at) {
            Session::flash('error', 'Your account has been deleted. Please contact our support team for inquiry.');
            return redirect()->route('login');
        }

        $request->validate([
            'profile_picture' => ['required', 'image', 'max:25000'],
            'full_name' => ['required', 'string', 'max:100'],
            'term_and_condition' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:public_users'],
            'password' => ['required', 'confirmed', 'max:100', 'min:6'],
        ]);
        try {
            DB::begintransaction();
            $data = [];
            $data['full_name'] = $request->full_name;
            $data['email'] = $request->email;
            // $data['username'] = $request->email;
            $token = Str::uuid();
            $data['email_verify_token']=$token;
            $data['status']=1;
            $data['is_email_verified']=0;
            $data['password'] = Hash::make($request->password);
            if ($request->file('profile_picture')) {
                $data['profile_picture'] = $this->dirforDb . $this->uploadImage($this->dir, 'profile_picture', true, 300, null);
            }
            $user = PublicUser::create($data);
            Mail::to($request->only('email'))->send(new NewUserRegistrationEmail($data));
            DB::commit();
            Session::flash('success', 'Account created successfullyy. Please check your email for verification before login.');
            return redirect()->route('login');
            /* Auth::guard('frontend_users')->login($user, true);
            return redirect(RouteServiceProvider::HOME); */
        } catch (Throwable $th) {
            DB::rollback();
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            Session::flash('error', 'Error! Something went wrong with your previous request.');
            return redirect()->back();
        }
    }
}