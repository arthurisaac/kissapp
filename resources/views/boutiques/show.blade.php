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
                <div class="four wide column">
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
                <div class="eight wide column">

                    <div class="ui statistic">
                        <div class="value">
                            {{number_format($ventesDuJour[0]->ventesDuJour) ?? 0}} FCA
                        </div>
                        <div class="label">
                            Total ventes du jour
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
                                    <th>Adresse e-mail</th>
                                    <th>Date de création</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @foreach($utilisateursDeLaBoutique as $utilisateur)
                                        <td class="collapsing">
                                            <div class="ui fitted slider checkbox">
                                                <input type="checkbox"> <label></label>
                                            </div>
                                        </td>
                                        <td>{{$utilisateur->name}}</td>
                                        <td>{{$utilisateur->email}}</td>
                                        <td>{{$utilisateur->created_at}}</td>
                                    @endforeach
                                </tr>
                                </tbody>
                                <tfoot class="full-width">
                                <tr>
                                    <th></th>
                                    <th colspan="4">
                                        <div class="ui right floated small primary labeled icon button"
                                             onclick="showModal()">
                                            <i class="user icon"></i> Ajouter un utilisateur
                                        </div>
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="ui tab" data-tab="tab-income">
                            <div class="ui large relaxed divided list">
                                <div class="item">
                                    <div class="content">
                                        <div class="header">Ventes de la journée</div>
                                        {{number_format($ventesDuJour[0]->ventesDuJour) ?? 0}} F CFA
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <div class="header">Vente de la semaine</div>
                                        {{number_format($ventesDelaSemaine[0]->ventesDelaSemaine) ?? 0}} F CFA
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <div class="header">Vente du mois</div>
                                        {{number_format($ventesDuMois[0]->ventesDuMois) ?? 0}} F CFA
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui small modal">
                <div class="header">Ajouter un utilisateur</div>
                <div class="content">
                    <div class="ui container">
                        <div class="ui grid">
                            <div class="column">
                                <form class="ui form">
                                    <div class="field">
                                        <label for="name">Nom d'utilisateur</label>
                                        <select id="name" name="utilisateur" class="ui search dropdown" required>
                                            <option></option>
                                            @foreach($utilisateurs as $utilisateur)
                                                <option value="{{$utilisateur->id}}">{{$utilisateur->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label for="boutiqueID">Boutique</label>
                                        <input type="text" name="boutiqueID" value="{{$boutique->id}}" readonly
                                               required>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="actions">
                    <div class="ui approve button">Ajouter</div>
                    <div class="ui cancel button">Annuler</div>
                </div>
            </div>
        @endif
    </div>
    <script>
        $(document).ready(function () {
            $('.pointing.menu .item').tab();
            $('select').dropdown();
        });

        function showModal() {
            $('.ui.modal')
                .modal({
                    closable: true,
                    onApprove: function () {
                        const tokenInput = '@csrf';
                        const token = $(tokenInput).val();
                        const utilisateur = $('#name').val();
                        const boutique = $('#boutiqueID').val();

                        /*$.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': token
                            }
                        });*/
                        $.ajax({
                            url: `/utilisateurs/${utilisateur}`,
                            type: 'PATCH',
                            data: {_token:'{{ csrf_token() }}', boutique: @json($boutique->id), type: 'utilisateur', _method: "PATCH"},
                            //contentType: 'application/json',
                            //dataType: 'text',
                            success: function () {
                                //window.location.reload();
                            },
                            error: function (result) {
                                alert(JSON.stringify(result));
                            }
                        });
                    }
                })
                .modal('show');
        }
    </script>
@endsection
