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

        <h1>Ventes</h1>
        <i><span id="saleDate"></span></i>
        <br>
        <br>
        <div class="ui grid">
            <div class="row">
                <div class="column">
                    <form class='ui form' method='POST' action='{{ route('ventes.store') }}'>
                        @csrf

                        <div class="two fields">
                            <div class="field">
                                <label for="client">Client</label>
                                <select class='ui search selection dropdown' name="client" id="client">
                                    @foreach($clients as $client)
                                        <option value='{{$client->id}}'>{{$client->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label for="numeroFacture">Numéro</label>
                                <input type="text" id="numeroFacture" name="numeroFacture" value="{{$numero}}" required>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="ten wide field">
                                <label for="objet">Objet</label>
                                <input type="text" name="objet" id="objet" placeholder='Objet de la facture' required>
                            </div>
                            <div class="six wide field">
                                <label for="numeroClient">Numero du client</label>
                                <input type='number' name='numeroClient' id='numeroClient'
                                       placeholder='Numero du client'>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div {{--style="height: 40vh; overflow-y: scroll;"--}}>
                            <table class='ui striped celled table' id="factureTable">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Categorie</th>
                                    <th>Désignation</th>
                                    <th>Quantité</th>
                                    <th>Prix</th>
                                    <th>Montant</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <button class="ui button red icon supprimerLigne" type="button">
                                            <i class="minus icon"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <select class='ui search selection dropdown factureCategorie'
                                                name="factureCategorie[]">
                                            <option></option>
                                            @foreach($categories as $categorie)
                                                <option value='{{$categorie->id}}'>{{$categorie->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class='ui search selection dropdown factureDesignation'
                                                name="produitDesignation[]">
                                            <option></option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class='ui transparent input'>
                                            <input type='number' min='0' value='0' class='factureQuantite'
                                                   name="quantite[]">
                                        </div>
                                    </td>
                                    <td>
                                        <div class='ui transparent input'>
                                            <input type="number" name="prix[]" class="facturePrix">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="ui transparent input">
                                            <input type="text" name="montant[]" class="factureMontant" readonly>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>
                                        <div class="ui button icon primary factureBoutonAjouterDetails">
                                            <i class="add icon"></i>
                                        </div>
                                    </th>
                                    <th colspan="4">
                                        <h4>Montant</h4>
                                    </th>
                                    <th>
                                        <div class="ui transparent input">
                                            <input id="textmontant" type="number" class="montantTotal"
                                                   name="montantTotal" readonly>
                                        </div>
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <br>
                        <br>
                        <div class="ui grid">
                            <div class="row">
                                <div class="seven wide column">
                                    <div class="ui segment">
                                        <div class="inline field">
                                            <label for="fraisAnnexe">Frais annexe</label>
                                            <div class="ui transparent input">
                                                <input type="number" id="fraisAnnexe" name="fraisAnnexe"
                                                       placeholder="Frais annexe" min="0" value="0">
                                            </div>
                                        </div>
                                        <div class="inline field">
                                            <label for="montantPaye">Montant payé</label>
                                            <div class="ui transparent input">
                                                <input type="number" id="montantPaye" name="montantPaye"
                                                       placeholder="Montant payé" min="0" value="0">
                                            </div>
                                        </div>
                                        <div class="inline field">
                                            <label for="montantRestant">Montant restant</label>
                                            <div class="ui transparent input">
                                                <input type="number" id="montantRestant" name="montantRestant"
                                                       placeholder="Montant restant" min="0" value="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>

                        <button class='ui button' type='submit'>Enregister</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('select').dropdown();
            setInterval(() => {
                let date = new Date();
                $('#saleDate').text(date.toDateString() + " " + date.toLocaleTimeString());
            }, 1000);
        });
    </script>
    <script>
        const produits = @json($produits);
        const categories = @json($categories);

        $(document).ready(function () {
            $('.factureCategorie').on("change", function () {
                factureCategorieChange();
            });
            $('.factureBoutonAjouterDetails').on('click', function (e) {
                e.preventDefault();
                ajouterDetailsFacture();
            });
            $('#fraisAnnexe').on('change', function () {
                montantTotal()
            });
            $('#montantPaye').on('change', function () {
                calculer()
            });
            $('.factureDesignation').on("change", function () {
                myedit();
            });
            $('.factureQuantite').on('change', function () {
                myedit()
            });
            $('.facturePrix').on('change', function () {
                myedit2()
            });
        });

        $(document).on('click', '.supprimerLigne', function () {
            if (confirm("Suprimer?")) {
                $(this).closest('tr').remove();
                return false;
            }
        });

        function ajouterDetailsFacture() {
            $("#factureTable").append(
                "<tr>\n" +
                "<td>\n" +
                "                                        <button class=\"ui button red icon supprimerLigne\">\n" +
                "                                            <i class=\"minus icon\"></i>\n" +
                "                                        </button>\n" +
                "                                    </td>" +
                "                                    <td>\n" +
                "                                        <select class='ui search selection dropdown factureCategorie'\n" +
                "                                                name=\"factureCategorie[]\">\n" +
                "                                            <option></option>\n" +
                "                                            @foreach($categories as $categorie)\n" +
                "                                                <option value='{{$categorie->id}}'>{{$categorie->libelle}}</option>\n" +
                "                                            @endforeach\n" +
                "                                        </select>\n" +
                "                                    </td>\n" +
                "                                    <td>\n" +
                "                                        <select class='ui search selection dropdown factureDesignation'\n" +
                "                                                name=\"produitDesignation[]\">\n" +
                "                                            <option></option>\n" +
                "                                        </select>\n" +
                "                                    </td>\n" +
                "                                    <td>\n" +
                "                                        <div class='ui transparent input'>\n" +
                "                                            <input type='number' min='0' value='0' class='factureQuantite'\n" +
                "                                                   name=\"quantite[]\">\n" +
                "                                        </div>\n" +
                "                                    </td>\n" +
                "                                    <td>\n" +
                "                                        <div class='ui transparent input'>\n" +
                "                                            <input type=\"number\" name=\"prix[]\" class=\"facturePrix\">\n" +
                "                                        </div>\n" +
                "                                    </td>\n" +
                "                                    <td>\n" +
                "                                        <div class=\"ui transparent input\">\n" +
                "                                            <input type=\"text\" name=\"montant[]\" class=\"factureMontant\" readonly>\n" +
                "                                        </div>\n" +
                "                                    </td>\n" +
                "                                </tr>"
            );
            $('select').dropdown();

            $('.factureCategorie').on("change", function () {
                factureCategorieChange();
            });
            $('.factureQuantite').on('change', function () {
                myedit()
            });
            $('.facturePrix').on('change', function () {
                myedit2()
            });
            $('.factureDesignation').on("change", function () {
                myedit()
            });
            $('.factureCategorie').dropdown('setting', 'onChange', function () {
                myedit()
            });
        }

        function factureCategorieChange() {
            $('#factureTable tbody tr').each((i, td) => {
                const factureCategorieDiv = $(td).find('td .factureCategorie');
                const factureCategorieInput = $(factureCategorieDiv).find('select');
                const factureCategorie = factureCategorieInput.val();
                const factureQuantite = $(td).find('td .factureQuantite');
                factureQuantite.removeAttr('max');

                const produitList = produits.filter(p => {
                    if (p.get_produit.categorie === parseInt(factureCategorie)) return p;
                });
                if (produitList.length > 0) {
                    const factureDesignationDiv = $(td).find('td .factureDesignation');
                    const factureDesignationInput = $(factureDesignationDiv).find('select');
                    $(factureDesignationInput).find("option").remove();
                    produitList.map(p => {
                        factureDesignationInput.append($('<option>', {
                            value: p.get_produit.id,
                            text: p.get_produit.libelle
                        }));
                    });
                } else {
                    const factureDesignationDiv = $(td).find('td .factureDesignation');
                    const factureDesignationInput = $(factureDesignationDiv).find('select');
                    const factureDesignationPlaceholder = $(factureDesignationDiv).find('.text');
                    $(factureDesignationInput).find("option").remove();
                    $(factureDesignationPlaceholder).text("Aucun produit disponible");
                }
                // console.log(produitList);
            });
        }

        function myedit() {
            let textmontant = 0;
            $('#factureTable tbody tr').each((i, td) => {
                const factureMontant = $(td).find('td input.factureMontant');
                const facturePrix = $(td).find('td .facturePrix');
                // const produitId = $(td).find('td select').val();
                const factureDesignationDiv = $(td).find('td .factureDesignation');
                const factureDesignationInput = $(factureDesignationDiv).find('select');
                const produitId = $(factureDesignationInput).val();
                const quantiteInput = $(td).find('td input.factureQuantite');
                const produit = produits.find(p => p.get_produit.id === parseInt(produitId));
                const quantite = parseInt(quantiteInput.val());
                if (isNaN(quantite)) return;
                if (produit) {
                    $(quantiteInput).prop('max', produit.quantite);
                    $(factureMontant).val(produit.get_produit.prix_details);
                    $(facturePrix).removeAttr('readonly');
                    $(quantiteInput).removeAttr('readonly');
                    if (quantite > 0 && quantite < 3) {
                        $(facturePrix).val(produit.get_produit.prix_details);
                        $(factureMontant).val(produit.get_produit.prix_details * quantite);
                        textmontant = textmontant + parseInt(produit.get_produit.prix_details * quantite);
                    } else if (quantite >= 3 && quantite < 6) {
                        $(facturePrix).val(produit.get_produit.prix_semi);
                        $(factureMontant).val(produit.get_produit.prix_semi * quantite);
                        textmontant = textmontant + parseInt(produit.get_produit.prix_semi * quantite);
                    } else {
                        $(facturePrix).val(produit.get_produit.prix_gros);
                        $(factureMontant).val(produit.get_produit.prix_gros * quantite);
                        textmontant = textmontant + parseInt(produit.get_produit.prix_gros * quantite);
                    }
                }
            });
            montantTotal();
        }

        function myedit2() {
            let textmontant = 0;

            $('#factureTable tbody tr').each((i, td) => {
                // const factureMontant = $(td).find('td.factureMontant');
                const factureMontant = $(td).find('td input.factureMontant');
                const facturePrix = $(td).find('td .facturePrix');

                // const produitId = $(td).find('td select').val();
                const factureDesignationDiv = $(td).find('td .factureDesignation');
                const factureDesignationInput = $(factureDesignationDiv).find('select');
                const produitId = $(factureDesignationInput).val();

                const quantiteInput = $(td).find('td input.factureQuantite');
                const produit = produits.find(p => p.id === parseInt(produitId));
                const quantite = parseInt(quantiteInput.val());
                if (isNaN(quantite)) return;
                if (produit) {
                    $(factureMontant).val(produit.prix_details);
                    $(quantiteInput).removeAttr('readonly');
                    if (quantite > 0 && quantite < 3) {
                        $(facturePrix).removeAttr('readonly');
                        //$(facturePrix).val(produit.prix_details);
                        $(factureMontant).val(parseInt(facturePrix.val()) * quantite);
                        textmontant = textmontant + facturePrix.val() * quantite;
                        console.log('prix en details');
                    } else if (quantite >= 3 && quantite < 6) {
                        $(facturePrix).removeAttr('readonly');
                        //$(facturePrix).val(produit.prix_semi);
                        $(factureMontant).val(parseInt(facturePrix.val()) * quantite);
                        textmontant = textmontant + facturePrix.val() * quantite;
                        console.log('prix en semi');
                    } else {
                        $(facturePrix).removeAttr('readonly');
                        //$(facturePrix).val(produit.prix_gros);
                        $(factureMontant).val(parseInt(facturePrix.val()) * quantite);
                        textmontant = textmontant + facturePrix.val() * quantite;
                        console.log('prix en gros');
                    }
                }
            });
            montantTotal();
        }

        function montantTotal() {
            let montantTotal = 0;
            const fraisAnnexe = $('#fraisAnnexe').val();
            $('#factureTable tbody tr').each((i, td) => {
                const factureMontant = $(td).find('td input.factureMontant');
                montantTotal += parseInt(factureMontant.val());
            });
            montantTotal += parseInt(fraisAnnexe);

            $('#textmontant').val(montantTotal);
        }

        function calculer() {
            /*const montant = parseInt(document.getElementById("textmontant").value);
            const fraisAnnexe = parseInt(document.getElementById("textfraisAnnexe").value);
            document.getElementById("textmontant").value = montant + fraisAnnexe;
            const montantPayer = parseInt(document.getElementById("textEncaisse").value);
            document.getElementById("textRestant").value = parseInt(document.getElementById("textmontant").value) - montantPayer;*/

            // Montant restant = montant total - montant payé
            const montantTotal = $('#textmontant').val();
            const montantPaye = $('#montantPaye').val();
            $("#montantRestant").val(parseInt(montantTotal) - parseInt(montantPaye))

        }

        $('#textmontant').on('change', function () {
            calculer()
        });

        $('#textfraisAnnexe').on('change', function () {
            calculer();
        });
        $('#textEncaisse').on('change', function () {
            calculer();
        });
        $('#textRestant').on('change', function () {
            calculer();
        });

    </script>

@endsection
