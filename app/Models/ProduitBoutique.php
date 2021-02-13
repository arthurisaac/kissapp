<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitBoutique extends Model
{
    use HasFactory;
    protected $fillable = [
        'produit',
        'boutique',
        'quantite',
        'alerte'
    ];

    public function getProduit() {
        return $this->belongsTo(\App\Models\Produit::class, 'produit', 'id');
    }

}
