<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Voyager\PublicUser;
use App\Models\Voyager\SystemErrorLog;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Throwable;

class ProfileController extends Controller
{
    use ImageTrait;
    public $dir = "/public/uploads/public-users";
    public $mainDirectory = "/public/uploads";
    public $dirforDb = "/public/public-users/";

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('frontend.my.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $userDetails = PublicUser::findorfail(Auth::guard('frontend_users')->user()->id);
        $data = $request->except('_token', 'password', 'user', '_method');
        if ($request->file('profile_picture')) {
            if ($userDetails->profile_picture) $this->removeImage($this->mainDirectory, $userDetails->profile_picture);
            $data['profile_picture'] = $this->dirforDb . $this->uploadImage($this->dir, 'profile_picture', true, 1280, null);
        }
        PublicUser::where('id', $userDetails->id)->update($data);
        $userDetails->save($data);
        Session::flash('success', 'Success! Your action has been completed.');
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::guard('frontend_users')->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function logout(Request $request): RedirectResponse
    {
        try {
            Auth::guard('frontend_users')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return Redirect::to('/');
        } catch (Throwable $th) {
            SystemErrorLog::insert(['message' => $th->getMessage()]);
            Session::flash('error', 'Error! Something went wrong with your previous request.');
            return redirect()->back();
        }
    }
}
