<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenu',
        'date_envoi',
        'statut_lecture',
        'expediteur_id',
        'destinataire_id',
        'ressource_id',
        'transaction_id',
    ];

    protected $casts = [
        'date_envoi' => 'datetime',
        'statut_lecture' => 'boolean',
    ];

    public function expediteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'expediteur_id');
    }

    public function destinataire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'destinataire_id');
    }

    public function ressource(): BelongsTo
    {
        return $this->belongsTo(Ressource::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function marquerCommeLu(): bool
    {
        return $this->update(['statut_lecture' => true]);
    }
}
