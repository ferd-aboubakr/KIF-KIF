<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Particulier extends Model
{
    use HasFactory;

    protected $table = 'particuliers';

    protected $fillable = [
        'nom',
        'prenom',
        'ville',
        'telephone',
        'email',
    ];

    protected $casts = [
        'date_inscription' => 'datetime',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'particulier_id');
    }
}
