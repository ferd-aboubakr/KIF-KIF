<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Statistique extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_statistique',
        'valeur',
        'periode',
        'region',
        'secteur_activite',
        'administrateur_id',
    ];

    protected $casts = [
        'periode' => 'date',
        'valeur' => 'decimal:2',
    ];

    public function administrateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'administrateur_id');
    }

    public static function getDensiteIndustrielleParRegion(): array
    {
        return [
            'Casablanca' => 45,
            'Tanger' => 25,
            'Rabat' => 15,
            'Autres' => 15,
        ];
    }

    public static function calculerVolumeTransactions($debut, $fin)
    {
        return Transaction::whereBetween('date_transaction', [$debut, $fin])
            ->where('statut', 'validee')
            ->sum('montant_total');
    }
}
