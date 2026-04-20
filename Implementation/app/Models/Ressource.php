<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ressource extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'type_ressource',
        'quantite',
        'unite',
        'etat',
        'prix_unitaire',
        'localisation',
        'photos',
        'statut',
        'entreprise_id',
        'categorie_id',
    ];

    protected $casts = [
        'photos' => 'array',
        'quantite' => 'decimal:2',
        'prix_unitaire' => 'decimal:2',
        'date_publication' => 'datetime',
    ];

    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function calculerImpactCO2(): float
    {
        return $this->quantite * 0.5;
    }

    public function scopeActives($query)
    {
        return $query->where('statut', 'active');
    }

    public function scopeParType($query, $type)
    {
        return $query->where('type_ressource', $type);
    }

    public function scopeParVille($query, $ville)
    {
        return $query->where('localisation', 'LIKE', "%{$ville}%");
    }
}
