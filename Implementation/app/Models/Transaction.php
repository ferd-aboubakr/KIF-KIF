<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'montant_total',
        'date_transaction',
        'statut',
        'mode_paiement',
        'acheteur_id',
        'vendeur_id',
        'ressource_id',
    ];

    protected $casts = [
        'montant_total' => 'decimal:2',
        'date_transaction' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($transaction) {
            if (empty($transaction->reference)) {
                $transaction->reference = self::genererReference();
            }
        });
    }

    public function acheteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'acheteur_id');
    }

    public function vendeur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendeur_id');
    }

    public function ressource(): BelongsTo
    {
        return $this->belongsTo(Ressource::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public static function genererReference(): string
    {
        return 'TRX-' . date('Y') . '-' . strtoupper(uniqid());
    }

    public function scopeValidees($query)
    {
        return $query->where('statut', 'validee');
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }
}
