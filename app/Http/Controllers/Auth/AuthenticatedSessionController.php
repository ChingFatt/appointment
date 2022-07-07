<?php

namespace App\Http\Controllers\Auth;

use App\Models\Merchant;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create($merchant_code = null)
    {
        $merchant = Merchant::where('merchant_code', $merchant_code)->first();
        if (isset($merchant)) {
            return view('auth.login')->with(compact('merchant'));
        } else {
            return redirect()->route('landing');
        }
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user) {
            $merchant = Merchant::where('merchant_code', $request->merchant_code)->first();
        
            //to validate user only login into specific admin panel
            $request->merge([
                'merchant_id' => ($user->hasRole('admin')) ? null : $merchant->id
            ]);
        }
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
