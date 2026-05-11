<?php

namespace App\Http\Controllers\Entreprise;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('entreprise.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (!auth()->user()->hasRole('entreprise')) {
                Auth::logout();
                return back()->withErrors(['email' => 'Ce compte n\'est pas une entreprise.']);
            }
            
            return redirect()->route('entreprise.dashboard');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    public function showRegister()
    {
        return view('entreprise.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom_entreprise' => 'required|string|max:255',
            'ice' => 'required|string|unique:entreprises,ice',
            'secteur_activite' => 'required|string',
            'ville' => 'required|string',
            'email' => 'required|email|unique:entreprises,email|unique:users,email',
            'telephone' => 'required|string',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $entreprise = Entreprise::create([
            'nom' => $validated['nom_entreprise'],
            'ice' => $validated['ice'],
            'secteur_activite' => $validated['secteur_activite'],
            'ville' => $validated['ville'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'statut_validation' => 'en_attente',
        ]);

        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'responsable_tpm',
            'type' => 'entreprise',
            'entreprise_id' => $entreprise->id,
        ]);

        $user->assignRole('entreprise');

        Auth::login($user);

        return redirect()->route('entreprise.dashboard')->with('success', 'Inscription réussie ! Votre entreprise est en attente de validation.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
