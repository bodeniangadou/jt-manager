<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reportage extends Model
{
    use HasFactory;

    protected $table = 'reportages';

    protected $fillable = [
        'titre',
        'categorie',
        'duree',
        'journaliste',
        'ordre_passage',
        'resume',
        'user_id',
        'est_publie',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where('titre', 'LIKE', "%{$term}%")
                     ->orWhere('journaliste', 'LIKE', "%{$term}%");
    }

    public function scopeCategorie($query, $categorie)
    {
        if ($categorie && $categorie !== 'all') {
            return $query->where('categorie', $categorie);
        }
        return $query;
    }
}