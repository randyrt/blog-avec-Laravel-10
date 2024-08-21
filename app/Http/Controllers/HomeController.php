<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\View\View;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->Middleware(\App\Http\Middleware\Authenticate::class);
    }

    /**
     * Summary of index
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('home.index');
    }

    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => [
                'required',
                'string',
                function (string $attribute, mixed $value, Closure $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail("Le :attribute est invalide");
                    }
                }
            ],
            "password" => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user->update([
            "password" => Hash::make($validated['password'])
        ]);

        return to_route('home')->with('status', 'Le mot de passe a été bien modifié');
    }
}

