<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'client',
        'numeroFacture',
        'objet',
        'numeroClient',
        'fraisAnnexe',
        'montantPaye',
        'montantRestant',
        'montantTotal',
        'boutique'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];

    public function clients() {
        return $this->belongsTo(\App\Models\Client::class, 'client', 'id');
    }
}
