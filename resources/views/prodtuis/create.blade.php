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
            <div class="ui message">
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

        <h1>Enregistrement d'un produit</h1>
        <br>
        <div class="ui grid">
            <div class="row">
                <div class="ten wide column">
                    <form action="{{ route('produits.store') }}" method="post" class="ui form">
                        @csrf

                        <div class="field">
                            <label>Choisir catégorie du produit</label>
                            <select name="categorie" class="ui search dropdown" required>
                                <option></option>
                                @foreach($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label>Référence du produit</label>
                            <input type="text" placeholder="Référence" name="ref" required>
                        </div>
                        <br>
                        <div class="field">
                            <label>Libellé (nom du produit)</label>
                            <input type="text" placeholder="Libellé" name="libelle" required>
                        </div>
                        <div class="field">
                            <label>Désignation</label>
                            <input type="text" placeholder="Désignation" name="designation">
                        </div>
                        <div class="field">
                            <label>Quantite</label>
                            <input type="text" placeholder="Quantite" name="quantite" required>
                        </div>
                        <div class="field">
                            <label>Alerte stock</label>
                            <input type="number" min="1" value="2" name="alerte" required>
                        </div>
                        <div class="field">
                            <label>Prix en gros</label>
                            <input type="number" min="0" value="0" name="prix_gros">
                        </div>
                        <div class="field">
                            <label>Prix en sémi</label>
                            <input type="number" min="0" value="0" name="prix_semi">
                        </div>
                        <div class="field">
                            <label>Prix en détails</label>
                            <input type="number" min="0" value="0" name="prix_details">
                        </div>
                        <br>
                        <button class="ui button primary" type="submit">Enregistrer</button>
                    </form>
                </div>
                <div class="six wide column">
                    <div class="ui segment">
                        <h2>Catégorie</h2>
                        <form action="{{route('categories.store')}}" method="post" class="ui form">
                            @csrf
                            <div class="field">
                                <label>Nouvelle catégorie</label>
                                <input type="text" placeholder="Nom de la nouvelle catégorie" name="libelle">
                            </div>
                            <button class="ui button primary">Enregistrer catégorie</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('select').dropdown();
        });

    </script>

@endsection
