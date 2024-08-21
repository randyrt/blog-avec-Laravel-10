<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
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
     * @return void
     */
    public function register(Request $request)
    {
        // Vérification des champs
        $validated = $request->validate([
            'name' => ['required', 'string', 'between:2, 200'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

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

