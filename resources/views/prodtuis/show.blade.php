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

        @if ($produit)

            <h1>{{$produit->libelle}}</h1>
            <br>
            <div class="ui grid">
                <div class="four wide column">
                    <div class="ui vertical pointing menu fluid">
                        <a class="active item">
                            Produits
                        </a>
                    </div>
                    <div class="ui left vertical dividing"></div>
                </div>
                <div class="eleven wide column">
                    <div class="ui segment">

                    </div>
                </div>
            </div>
        @endif
    </div>
    <script>
        $(document).ready(function () {
            $('.tabular.menu .item').tab();
        });
    </script>
@endsection
