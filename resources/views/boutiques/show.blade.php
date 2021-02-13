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

        <button onclick="window.history.back()" class="ui button primary"><i class="icon chevron left"></i>Retour
        </button>
        <br>
        <br>

        @if ($boutique)

            <h1>{{$boutique->libelle}}</h1>
            <br>
            <div class="ui grid">
                <div class="column">
                    <div class="ui card">
                        <div class="content">
                            <a class="header">Stock</a>
                            <div class="meta">
                                <span class="date">{{count($produits)}} produits</span>
                            </div>
                            <div class="description"></div>
                        </div>
                        <div class="ui bottom attached button"
                             onclick="popup('{{route('produit-boutique.create', 'boutique=' . $boutique->id)}}', '$boutique->id')">
                            <i class="add icon"></i>
                            Ajouter des produits
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui grid">
                <div class="four wide column">
                    <div class="ui vertical pointing menu fluid">
                        <a class="item active" data-tab="tab-products">
                            produits
                            @if (intval($outOfStock) > 0 )
                                <div class="ui red label">{{$outOfStock}}</div>
                            @endif
                        </a>
                        <a class="item" data-tab="tab-access">
                            Acces
                        </a>
                        <a class="item" data-tab="tab-income">
                            Revenu
                        </a>
                    </div>
                    <div class="ui left vertical dividing"></div>
                </div>
                <div class="eleven wide column">
                    <div class="ui segment">
                        <div class="ui tab active" data-tab="tab-products">
                            {{--TODO
                            <form action="{{route('boutiques.show', $boutique->id)}}">
                                 <div class="ui action input">
                                     <input type="search" name="searchProduct">
                                     <button class="ui primary right labeled icon button" type="submit">
                                         <i class="search icon"></i>
                                         Rechercher
                                     </button>
                                 </div>
                             </form>--}}


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
                                            <button class="ui icon small button secondary"
                                                    onclick="window.location.href = '{{route('produit-boutique.edit', $produit->id)}}'">
                                                <i class="edit icon"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="ui tab" data-tab="tab-access">
                            <h2>Utilisateur ayant accès à la boutique</h2>
                            <table class="ui compact celled definition table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Nom d'utilisateur</th>
                                    <th>Date d'ajout</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--<tr>
                                    <td class="collapsing">
                                        <div class="ui fitted slider checkbox">
                                            <input type="checkbox"> <label></label>
                                        </div>
                                    </td>
                                    <td>John Lilki</td>
                                    <td>September 14, 2013</td>
                                    <td>jhlilk22@yahoo.com</td>
                                    <td>No</td>
                                </tr>--}}
                                </tbody>
                                <tfoot class="full-width">
                                <tr>
                                    <th></th>
                                    <th colspan="4">
                                        <div class="ui right floated small primary labeled icon button">
                                            <i class="user icon"></i> Ajouter un utilisateur
                                        </div>
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="ui tab" data-tab="tab-income">
                            income
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script>
        $(document).ready(function () {
            $('.pointing.menu .item').tab();
        });
    </script>
@endsection
