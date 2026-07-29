<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acheteur extends Model
{
    protected $table = 'acheteurs';

    protected $fillable = ['nom', 'email', 'telephone'];

    public function achats()
    {
        return $this->hasMany(Achat::class, 'acheteur_id');
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'achats', 'acheteur_id', 'produit_id')
                     ->withPivot('quantite', 'date_achat');
    }
}