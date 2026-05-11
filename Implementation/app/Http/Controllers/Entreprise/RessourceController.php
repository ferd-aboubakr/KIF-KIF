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
        $categories = \App\Models\Categorie::all();
        return view('entreprise.ressources.create', compact('categories'));
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

    public function edit($id)
    {
        // Find the resource manually to handle cases where it might not exist
        $ressource = Ressource::find($id);
        
        if (!$ressource) {
            return redirect()->route('entreprise.ressources.index')->with('error', 'Ressource non trouvée');
        }
        
        // Vérifier que l'utilisateur a une entreprise
        $user = auth()->user();
        if (!$user->entreprise) {
            abort(403, 'Utilisateur non associé à une entreprise');
        }
        
        $entreprise = $user->entreprise;
        
        // Vérifier que la ressource appartient à l'entreprise de l'utilisateur
        // Allow editing if entreprise_id is null (legacy data) or matches user's entreprise
        if ($ressource->entreprise_id !== null && $ressource->entreprise_id != $entreprise->id) {
            abort(403, 'Non autorisé - Cette ressource ne vous appartient pas');
        }

        $categories = \App\Models\Categorie::all();
        return view('entreprise.ressources.edit', compact('ressource', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Find the resource manually
        $ressource = Ressource::find($id);
        
        if (!$ressource) {
            return redirect()->route('entreprise.ressources.index')->with('error', 'Ressource non trouvée');
        }
        
        // Vérifier que la ressource appartient à l'entreprise de l'utilisateur
        $user = auth()->user();
        
        // Vérifier que l'utilisateur a une entreprise
        if (!$user->entreprise) {
            abort(403, 'Utilisateur non associé à une entreprise');
        }
        
        $entreprise = $user->entreprise;
        
        // Vérifier que la ressource appartient à l'entreprise de l'utilisateur
        // Allow editing if entreprise_id is null (legacy data) or matches user's entreprise
        if ($ressource->entreprise_id !== null && $ressource->entreprise_id != $entreprise->id) {
            abort(403, 'Non autorisé - Cette ressource ne vous appartient pas');
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

        $ressource->update($validated);

        return redirect()->route('entreprise.ressources.index')->with('success', 'Annonce mise à jour avec succès !');
    }

    public function destroy($id)
    {
        // Find the resource manually
        $ressource = Ressource::find($id);
        
        if (!$ressource) {
            return redirect()->route('entreprise.ressources.index')->with('error', 'Ressource non trouvée');
        }
        
        // Vérifier que la ressource appartient à l'entreprise de l'utilisateur
        $user = auth()->user();
        
        // Vérifier que l'utilisateur a une entreprise
        if (!$user->entreprise) {
            abort(403, 'Utilisateur non associé à une entreprise');
        }
        
        $entreprise = $user->entreprise;
        
        // Vérifier que la ressource appartient à l'entreprise de l'utilisateur
        // Allow editing if entreprise_id is null (legacy data) or matches user's entreprise
        if ($ressource->entreprise_id !== null && $ressource->entreprise_id != $entreprise->id) {
            abort(403, 'Non autorisé - Cette ressource ne vous appartient pas');
        }

        $ressource->delete();

        return redirect()->route('entreprise.ressources.index')->with('success', 'Annonce supprimée avec succès !');
    }
}
