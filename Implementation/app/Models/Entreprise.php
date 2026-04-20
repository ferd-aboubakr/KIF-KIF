<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'ice',
        'secteur_activite',
        'ville',
        'email',
        'telephone',
        'statut_validation',
    ];

    protected $casts = [
        'date_creation' => 'datetime',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function ressources(): HasMany
    {
        return $this->hasMany(Ressource::class);
    }

    public function isValidee(): bool
    {
        return $this->statut_validation === 'validee';
    }

    public function scopeValidees($query)
    {
        return $query->where('statut_validation', 'validee');
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut_validation', 'en_attente');
    }
}
