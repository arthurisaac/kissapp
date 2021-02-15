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


        <a href="{{route('produits.create')}}" class="ui button primary"><i class="icon add"></i> Enregistrer un
            produit dans le magasin</a>
        <br>
        <br>

        <div class="ui grid">
            <div class="row">
                <div class="column">

                    <table class="ui selectable celled table">
                        <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Libelle</th>
                            <th>Quantite</th>
                            <th>Catégorie</th>
                            <th>Prix en gros</th>
                            <th>Prix en sémi</th>
                            <th>Prix en détails</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produits as $produit)
                            <tr>
                                <td data-label="Ref">{{$produit->ref}}</td>
                                <td data-label="Libelle">{{$produit->libelle}}</td>
                                <td data-label="Quantite">{{$produit->quantite}}</td>
                                <td data-label="Catégorie">{{$produit->categorie}}</td>
                                <td data-label="Prix en gros">{{$produit->prix_gros}}</td>
                                <td data-label="Prix en sémi">{{$produit->prix_semi}}</td>
                                <td data-label="Prix en détails">{{$produit->prix_details}}</td>
                                <td data-label="Actions"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection
