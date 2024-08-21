<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\RedirectIfAuthenticated::class)->except('logout');
        $this->middleware(\App\Http\Middleware\Authenticate::class)->only('logout');
    }

    /**
     * Summary of showLoginForm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLoginForm(): View
    {
        return view('Auth.login');
    }

    /** login in acount
     * Summary of login
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentiales = $request->validated();

        // (bool) $request->remember, casting $request->remember in bool
        if (Auth::attempt($credentiales, (bool) $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // When error
        return back()->withErros([
            'email' => 'identifiant incorect'
        ])->onlyInput('email');
    }


    /**
     * Summary of logout
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        // Suppression de session qui authentifie l'utilisateur
        Auth::logout();

        // Suppression de tous les contenus liés à cette session
        $request->session()->invalidate();

        // Régéneration de nouvelle token csrf
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
