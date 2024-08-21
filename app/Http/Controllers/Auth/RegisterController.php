<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Une autre façon de planter un middleware, que de l'injecter directement sur le route
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\RedirectIfAuthenticated::class);
    }


    /**
     * Summary of showRegistrationForm
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * Summary of register
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterFormRequest $request): RedirectResponse
    {
        // Vérification des champs
        $validated = $request->validated();

        // Haché le mot de passe
        $validated['password'] = Hash::make($validated['password']);

        //création d'un utilisateur qui a remplie les conditions
        $user = User::create($validated);

        //Authentification 
        Auth::login($user);

        // Redirection et ajout de variable de session flash avec la méthode withStatus
        // return redirect('homme)->with('status', 'Inscription réussie')
        return redirect()->route('home')->withStatus('Inscription réussie');
    }
}

