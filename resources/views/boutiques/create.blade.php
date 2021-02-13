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


        <button onclick="window.history.back()" class="ui button primary"><i class="icon chevron left"></i>Retour</button>
        <br>
        <br>

            <h1>Nouvelle boutique</h1>
            <br>
        <div class="ui grid">
            <div class="row">
                <div class="column">
                    <form action="{{ route('boutiques.store') }}" method="post" class="ui form">
                        @csrf

                        <div class="field">
                            <label>Intitulé de la boutique</label>
                            <input type="text" placeholder="Intitulé (Ex: boutique zaabr)" name="libelle" required>
                        </div>
                        <div class="field">
                            <label>Adresse de la boutique</label>
                            <input type="text" placeholder="Adresse" name="adresse">
                        </div>
                        <br>
                        <button class="ui button primary" type="submit">Enregistrer</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
