<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsFacture extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantite',
        'facture',
        'produit',
        'prix',
        'montant',
    ];
}
