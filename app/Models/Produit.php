<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref',
        'libelle',
        'designation',
        'quantite',
        'alerte',
        'prix_gros',
        'prix_semi',
        'prix_details',
        'categorie'
    ];
}
