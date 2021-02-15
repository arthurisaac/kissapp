@extends('base')

@section('main')

    <div class="home-header">
        <h3>Plateforme de gestion de stock</h3>
    </div>
    <div>
        <div class="home-header--bande-rouge"></div>
        <div class="home-header--bande-verte"></div>
    </div>
    <div class="home-user-logged">
        <p>Connecté en tant que {{ session()->get('user')->name }} <a href="/deconnexion" style="font-weight: bold">Déconnexion</a></p>
    </div>

<div class="home-content">
    <div class="home-row">
        <div class="home-element home-element--boutique">
            <a href="javascript:popup('/boutiques')">Boutiques</a>
        </div>
        <div class="home-element home-element--produits">
            <a href="javascript:popup('/produits')">Produits</a>
        </div>
        <div class="home-element home-element--ventes">
            <a href="javascript:popup('/ventes')">Ventes</a>
        </div>
        <div class="home-element home-element--utilisateurs">
            <a href="javascript:popup('/utilisateurs')">Utilisateurs</a>
        </div>
    </div>
</div>

@endsection
