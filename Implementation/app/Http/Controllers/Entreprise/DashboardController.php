<?php

namespace App\Http\Controllers\Entreprise;

use App\Http\Controllers\Controller;
use App\Models\Ressource;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $entreprise = auth()->user()->entreprise;
        
        $stats = [
            'annonces_actives' => Ressource::where('entreprise_id', $entreprise->id)->where('statut', 'active')->count(),
            'total_annonces' => Ressource::where('entreprise_id', $entreprise->id)->count(),
            'transactions' => Transaction::whereHas('ressource', function ($q) use ($entreprise) {
                $q->where('entreprise_id', $entreprise->id);
            })->count(),
        ];

        $annonces = Ressource::where('entreprise_id', $entreprise->id)
            ->latest()
            ->take(5)
            ->get();

        return view('entreprise.dashboard', compact('entreprise', 'stats', 'annonces'));
    }
}
