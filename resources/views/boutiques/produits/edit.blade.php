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
                <i class="close icon"></i>
                <div class="header">
                    Information !
                </div>
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif

        @if(session()->get('error'))
            <div class="ui message">
                <i class="close icon"></i>
                <div class="header">
                    Erreur !
                </div>
                <p>{{ session()->get('error') }}</p>
            </div>
        @endif

        @if($produit)
            <h1>Approvisionnement de la boutique</h1>
            <br>
            <form action="{{ route('produit-boutique.update', $produit->id) }}" method="post" class="ui form">
                @csrf
                @method('PATCH')

                <input type="hidden" name="boutique" value="{{$produit->boutique}}" required>
                <div class="ui segment">

                    <h3>{{$produit->getProduit->libelle ?? $produit->id}}</h3>
                    <p>{{$produit->getProduit->ref}}</p>
                    <br>
                    {{--<div class="field">
                        <label>Produits du magasin</label>
                        <select name="produit" class="ui search dropdown" required id="produit">
                            <option value="{{$produit->id}}"></option>
                            @foreach($produits as $produit)
                                <option value="{{$produit->id}}">{{$produit->libelle}}</option>
                            @endforeach
                        </select>
                    </div>--}}
                    <div class="field quantite">
                        <div class="two fields">
                            <div class="fourteen wide field">
                                <label>Quantite</label>
                                <input type="number" min="{{$produit->quantite}}" placeholder="Quantite" name="quantite" value="{{$produit->quantite}}" required
                                       id="quantite">
                            </div>
                            <div class="two wide field">
                                <label>Stock restant</label>
                                <input type="number" id="restant" value="{{$produit->getProduit->quantite}}" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="field">
                        <label>Alerte stock</label>
                        <input type="number" min="1" value="{{$produit->alerte}}" name="alerte" >
                    </div>
                    <button class="ui button primary" id="save">Enregistrer</button>
                </div>

            </form>
        @endif
    </div>
    <script>
        $(document).ready(function () {
            $('select')
                .dropdown()
            ;
            $('.message .close')
                .on('click', function () {
                    $(this)
                        .closest('.message')
                        .transition('fade')
                    ;
                })
            ;

            // let produits = @json($produits);
            let quantite_global = @json($produit->getProduit->quantite);
            let quantite_actuelle = @json($produit->quantite)


            $('#quantite').on('change', function () {
                const quantite = parseInt($(this).val());
                const restant = parseInt($("#restant").val());
                if (isNaN(quantite) || isNaN(restant)) return;

                const actuelle = quantite - parseInt(quantite_actuelle);
                $("#restant").val(parseInt(quantite_global) - actuelle);

                if (actuelle > quantite_global) {
                    $('.quantite').addClass('error');
                    $("#save").attr('disabled', 'true');
                } else {
                    $('.quantite').removeClass('error');
                    $("#save").removeAttr('disabled', 'false');
                }
            })

        });
    </script>
@endsection
