<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'entreprises_total' => Entreprise::count(),
            'entreprises_en_attente' => Entreprise::where('statut_validation', 'en_attente')->count(),
            'entreprises_validees' => Entreprise::where('statut_validation', 'validee')->count(),
            'utilisateurs_total' => User::count(),
        ];

        $entreprises_en_attente = Entreprise::where('statut_validation', 'en_attente')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'entreprises_en_attente'));
    }

    public function entreprises()
    {
        $entreprises = Entreprise::latest()
            ->paginate(10);

        return view('admin.entreprises', compact('entreprises'));
    }

    public function validerEntreprise(Request $request, $id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->update(['statut_validation' => 'validee']);

        return back()->with('success', 'Entreprise validée avec succès.');
    }

    public function rejeterEntreprise(Request $request, $id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->update(['statut_validation' => 'rejetee']);

        return back()->with('success', 'Entreprise rejetée.');
    }

    public function suspendreEntreprise(Request $request, $id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->update(['statut_validation' => 'suspendue']);

        return back()->with('success', 'Entreprise suspendue. L\'entreprise devra contacter l\'administration pour être réactivée.');
    }

    public function deleteEntreprise(Request $request, $id)
    {
        $entreprise = Entreprise::findOrFail($id);
        
        // Delete associated resources
        $entreprise->ressources()->delete();
        
        // Delete associated users
        $entreprise->users()->delete();
        
        // Delete the enterprise
        $entreprise->delete();

        return back()->with('success', 'Entreprise supprimée définitivement.');
    }

    public function reactiverEntreprise(Request $request, $id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->update(['statut_validation' => 'validee']);

        return back()->with('success', 'Entreprise réactivée avec succès.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'required_with:new_password',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
        ]);

        // Update password if provided
        if (!empty($validated['new_password'])) {
            $request->validate([
                'current_password' => 'required|current_password',
            ]);
            
            $user->update([
                'password' => Hash::make($validated['new_password']),
            ]);
        }

        return back()->with('success', 'Profil mis à jour avec succès.');
    }
}
