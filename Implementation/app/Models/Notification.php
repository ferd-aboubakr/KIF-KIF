<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'message',
        'type_notification',
        'date_creation',
        'lue',
        'utilisateur_id',
    ];

    protected $casts = [
        'date_creation' => 'datetime',
        'lue' => 'boolean',
    ];

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function marquerCommeLue(): bool
    {
        return $this->update(['lue' => true]);
    }

    public function scopeNonLues($query)
    {
        return $query->where('lue', false);
    }
}
