<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Client;
use App\Models\DetailsFacture;
use App\Models\Facture;
use App\Models\ProduitBoutique;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class VenteController extends Controller
{
    // TODO: remplacer par l'id de la boutique récuperée à la session (connexion)
    const boutique = 1;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ventesDuJour = DB::table('factures')
            ->selectRaw('SUM(montantTotal) as ventesDuJour')
            ->where('date', '=', date('Y-m-d'))
            ->where('boutique', '=', self::boutique)
            ->get();
        $nombreVente = DB::table('factures')
            ->selectRaw('COUNT(*) as nombreVente')
            ->where('date', '=', date('Y-m-d'))
            ->where('boutique', '=', self::boutique)
            ->get();

        $factures = Facture::all()
            ->where('boutique', '=', self::boutique);
        $out = ProduitBoutique::all()
            ->where('quantite', '<', '1')
            ->where('boutique', '=', self::boutique);

        $outOfStock = count($out);
        $produits = ProduitBoutique::with('getProduit')
            ->where('boutique', '=', self::boutique)
            ->get();

        return view('ventes.index', compact('ventesDuJour','nombreVente', 'factures', 'outOfStock', 'produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $numero = DB::table('factures')->max('id') + 1 . date('dmYHis');
        $categories = Categorie::all();
        $clients = Client::all();
        $produits = ProduitBoutique::with('getProduit')->get();
        $date = date('Y-m-d');
        return view('ventes.create', compact('clients', 'numero', 'produits', 'categories', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'montantTotal' => 'required'
        ]);

        $data = new Facture([
            'date' => date('Y-m-d'),// $request->get('date'),
            'client' => $request->get('client'),
            'numeroFacture' => $request->get('numeroFacture'),
            'objet' => $request->get('objet'),
            'numeroClient' => $request->get('numeroClient'),
            'fraisAnnexe' => $request->get('fraisAnnexe'),
            'montantPaye' => $request->get('montantPaye'),
            'montantRestant' => $request->get('montantRestant'),
            'montantTotal' => $request->get('montantTotal'),
            'boutique' => self::boutique
        ]);
        $data->save();

        $quantite = $request->get('quantite');
        $produits = $request->get('produitDesignation');
        $prix = $request->get('prix');
        $montant = $request->get('montant');

        for($i = 0; $i < count($produits); $i++) {
            $details = new DetailsFacture([
                'facture' => $data->id,
                'quantite' => $quantite[$i],
                'produit' => $produits[$i],
                'prix' => $prix[$i],
                'montant' => $montant[$i]
            ]);
            $details->save();

            $stock = DB::table('produit_boutiques')
                ->where('produit', '=', $produits[$i])
                ->where('boutique', '=', self::boutique)
                ->limit(1)
                ->get();

            if ($stock->isNotEmpty()) {
                $produit = ProduitBoutique::find($stock[0]->id);
                $produit->quantite = $stock[0]->quantite - $quantite[$i];
                $produit->save();
            }
        }

        return redirect()->route('ventes.create')->with('success', 'Facture enregistrée');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
