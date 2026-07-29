<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = 'produits';

    protected $fillable = ['nom', 'prix', 'stock', 'description', 'categorie_id'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function achats()
    {
        return $this->hasMany(Achat::class, 'produit_id');
    }

    public function acheteurs()
    {
        return $this->belongsToMany(Acheteur::class, 'achats', 'produit_id', 'acheteur_id')
                     ->withPivot('quantite', 'date_achat');
    }
}