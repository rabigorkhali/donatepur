<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

// use App\Services\System\Auth0GuzzleRequestService;

class frontendAuth  extends Middleware
{

    public function __construct()
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('frontend_users')->check()) {
            Auth::guard('frontend_users')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        }
        $request = $this->addUserToRequest($request);
        return $next($request);
    }

    private function addUserToRequest($request)
    {
        $user = Auth::guard('frontend_users')->user();
        $request->merge(['user' => $user]);
        $request->setUserResolver(function () use ($user) {
            return $user;
        });
        Auth::guard('frontend_users')->setUser($user);

        return $request;
    }
}
