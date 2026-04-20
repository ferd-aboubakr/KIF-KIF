<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use App\Models\User;
use Illuminate\Http\Request;

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
        $entreprises = Entreprise::where('statut_validation', 'en_attente')
            ->latest()
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
}
