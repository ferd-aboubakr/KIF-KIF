<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'role',
        'type',
        'entreprise_id',
        'particulier_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_creation' => 'datetime',
    ];

    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function particulier(): BelongsTo
    {
        return $this->belongsTo(Particulier::class);
    }

    public function ressources(): HasMany
    {
        return $this->hasMany(Ressource::class);
    }

    public function transactionsAcheteur(): HasMany
    {
        return $this->hasMany(Transaction::class, 'acheteur_id');
    }

    public function transactionsVendeur(): HasMany
    {
        return $this->hasMany(Transaction::class, 'vendeur_id');
    }

    public function messagesEnvoyes(): HasMany
    {
        return $this->hasMany(Message::class, 'expediteur_id');
    }

    public function messagesRecus(): HasMany
    {
        return $this->hasMany(Message::class, 'destinataire_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function statistiques(): HasMany
    {
        return $this->hasMany(Statistique::class, 'administrateur_id');
    }

    public function isAdministrateur(): bool
    {
        return $this->role === 'administrateur';
    }

    public function isResponsableTPM(): bool
    {
        return $this->role === 'responsable_tpm';
    }

    public function isParticulier(): bool
    {
        return $this->type === 'particulier';
    }

    public function isEntreprise(): bool
    {
        return $this->type === 'entreprise';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
