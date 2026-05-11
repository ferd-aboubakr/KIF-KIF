<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ressource;
use App\Models\Categorie;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $categorie = $request->input('category');
        $ville = $request->input('ville');

        $resources = Ressource::with(['entreprise', 'categorie'])
            ->where('statut', 'active')
            ->whereHas('entreprise', function ($query) {
                $query->where('statut_validation', 'validee');
            })
            ->when($query, function ($q) use ($query) {
                $q->where('titre', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->when($categorie, function ($q) use ($categorie) {
                $q->where('categorie_id', $categorie);
            })
            ->when($ville, function ($q) use ($ville) {
                $q->where('localisation', $ville);
            })
            ->latest()
            ->paginate(12);

        $categories = Categorie::whereNull('parent_id')->get();
        $villes = Ressource::distinct('localisation')->pluck('localisation')->filter();

        return view('marketplace.index', [
            'resources' => $resources,
            'categories' => $categories,
            'villes' => $villes,
        ]);
    }

    public function show($id)
    {
        $ressource = Ressource::with(['entreprise', 'categorie'])
            ->findOrFail($id);

        return view('marketplace.show', compact('ressource'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $categorie = $request->input('category');
        $ville = $request->input('ville');

        $resources = Ressource::with(['entreprise', 'categorie'])
            ->where('statut', 'active')
            ->whereHas('entreprise', function ($query) {
                $query->where('statut_validation', 'validee');
            })
            ->when($query, function ($q) use ($query) {
                $q->where('titre', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->when($categorie, function ($q) use ($categorie) {
                $q->where('categorie_id', $categorie);
            })
            ->when($ville, function ($q) use ($ville) {
                $q->where('localisation', $ville);
            })
            ->latest()
            ->paginate(12);

        $categories = Categorie::whereNull('parent_id')->get();
        $villes = Ressource::distinct('localisation')->pluck('localisation')->filter();

        return view('marketplace.index', [
            'resources' => $resources,
            'categories' => $categories,
            'villes' => $villes,
        ]);
    }
}
