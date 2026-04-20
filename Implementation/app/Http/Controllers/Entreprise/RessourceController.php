<?php

namespace App\Http\Controllers\Entreprise;

use App\Http\Controllers\Controller;
use App\Models\Ressource;
use Illuminate\Http\Request;

class RessourceController extends Controller
{
    public function index()
    {
        $entreprise = auth()->user()->entreprise;
        $ressources = Ressource::where('entreprise_id', $entreprise->id)
            ->latest()
            ->paginate(10);

        return view('entreprise.ressources.index', compact('ressources'));
    }

    public function create()
    {
        return view('entreprise.ressources.create');
    }

    public function store(Request $request)
    {
        $entreprise = auth()->user()->entreprise;
        
        if ($entreprise->statut_validation !== 'validee') {
            return back()->with('error', 'Votre entreprise doit être validée pour publier des annonces.');
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'type_ressource' => 'required|in:matiere_premiere,sous_produit,machine,espace_stockage',
            'quantite' => 'required|numeric|min:0',
            'unite' => 'required|string',
            'etat' => 'required|string',
            'prix_unitaire' => 'required|numeric|min:0',
            'localisation' => 'required|string',
        ]);

        $validated['entreprise_id'] = $entreprise->id;
        $validated['statut'] = 'active';

        Ressource::create($validated);

        return redirect()->route('entreprise.ressources.index')->with('success', 'Annonce publiée avec succès !');
    }
}
