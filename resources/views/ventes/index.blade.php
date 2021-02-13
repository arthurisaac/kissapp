@extends('base')

@section('main')

    <br>
    <br>
    <div class="ui container">

        @if ($errors->any())
            <div class="ui error message">
                <i class="close icon"></i>
                <div class="header">
                    Il y avait quelques erreurs avec votre soumission
                </div>
                <ul class="list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br/>
        @endif

        @if(session()->get('success'))
            <div class="ui message success">
                <div class="header">
                    Information !
                </div>
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif

        @if(session()->get('error'))
            <div class="ui message">
                <div class="header">
                    Erreur !
                </div>
                <p>{{ session()->get('error') }}</p>
            </div>
        @endif

        <bouton onclick="popup( '{{ route('ventes.create') }}', 'Enregistrement ventes')" class="ui button primary">
            <i class="icon add"></i>
            Enregistrer vente
        </bouton>
        <br>
        <br>

        <div class="ui card orange">
            <div class="content">
                <div class="header">Revenu de la journée</div>
                <div class="meta">
                    <a>{{$nombreVente[0]->nombreVente}} ventes</a>
                </div>
                <div class="description">
                    <h1>{{$ventesDuJour[0]->ventesDuJour ?? 0}} FCA</h1>
                </div>
            </div>
            <div class="extra content"><span class="right floated"></span>
                <span><i class="newspaper icon"></i> <a href="#">Voir plus</a> </span>
            </div>
        </div>

        <div class="ui grid">
            <div class="four wide column">
                <div class="ui vertical pointing menu fluid">
                    <a class="item active" data-tab="tab-income">
                        Factures
                    </a>
                    <a class="item" data-tab="tab-products">
                        produits
                        @if (intval($outOfStock) > 0 )
                            <div class="ui red label">{{$outOfStock}}</div>
                        @endif
                    </a>
                </div>
                <div class="ui left vertical dividing"></div>
            </div>
            <div class="eleven wide column">
                <div class="ui segment">
                    <div class="ui tab active" data-tab="tab-income">
                        <table class="ui table celled">
                            <thead>
                            <tr>
                                <th>Numero facture</th>
                                <th>Numero client</th>
                                <th>Montant total</th>
                                <th>Montant payé</th>
                                <th>Montant restant</th>
                                <th>Enregistré le</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($factures as $facture)
                                <tr>
                                    <td>{{$facture->numeroFacture}}</td>
                                    <td>{{$facture->numeroClient}}</td>
                                    <td>{{$facture->montantTotal}}</td>
                                    <td>{{$facture->montantPaye}}</td>
                                    <td>{{$facture->montantRestant}}</td>
                                    <td>{{$facture->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="ui tab" data-tab="tab-products">
                        <table class="ui celled table">
                            <thead>
                            <tr>
                                <th>Ref</th>
                                <th>Libelle</th>
                                <th>Quantite</th>
                                <th>Prix en gros</th>
                                <th>Prix en sémi</th>
                                <th>Prix en détails</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($produits as $produit)
                                <tr class="{{$produit->quantite < 1 ? 'negative' : ''}}">
                                    <td data-label="Ref">{{$produit->getProduit->ref ?? 'Produit supprimé'}}</td>
                                    <td data-label="Libelle">{{$produit->getProduit->libelle ?? 'Produit supprimé'}}</td>
                                    <td data-label="Quantite">{{$produit->quantite ?? 'Quantité inexistante'}}</td>
                                    <td data-label="Prix en gros">{{$produit->getProduit->prix_gros ?? 'Prix non disponible'}}</td>
                                    <td data-label="Prix en sémi">{{$produit->getProduit->prix_semi ?? 'Prix non disponible'}}</td>
                                    <td data-label="Prix en détails">{{$produit->getProduit->prix_details ?? 'Prix non disponible'}}</td>
                                    <td data-label="Actions" class="collapsing">
                                        <button class="ui icon small button primary">
                                            <i class="eye icon"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('select').dropdown();
            $('.pointing.menu .item').tab();
        });
    </script>

@endsection
