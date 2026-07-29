<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    protected $table = 'achats';

    protected $fillable = ['quantite', 'date_achat', 'produit_id', 'acheteur_id'];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    public function acheteur()
    {
        return $this->belongsTo(Acheteur::class, 'acheteur_id');
    }
}