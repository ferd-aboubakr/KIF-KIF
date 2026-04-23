<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Particulier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticulierController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $particulier = $user->particulier;
        
        return view('particulier.dashboard', compact('particulier'));
    }

    public function profile()
    {
        $user = Auth::user();
        $particulier = $user->particulier;
        
        return view('particulier.profile', compact('user', 'particulier'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $particulier = $user->particulier;

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'ville' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // Update user
        $user->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
        ]);

        // Update particulier
        $particulier->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'ville' => $validated['ville'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
        ]);

        return back()->with('success', 'Profil mis à jour avec succès.');
    }
}
