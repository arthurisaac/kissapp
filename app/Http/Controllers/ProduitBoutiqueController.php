<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\ProduitBoutique;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ProduitBoutiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $produits = Produit::all();
        $boutique = $request->boutique;
        return view('boutiques.produits.create', compact('produits', 'boutique'));
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
            'produit' => 'required',
            'boutique' => 'required',
            'quantite' => 'required'
        ]);

        $stock = DB::table('produit_boutiques')
            ->where('produit', '=', $request->get('produit'))
            ->limit(1)
            ->get();

        if ($stock->isNotEmpty()) {

            $data = ProduitBoutique::find($stock[0]->id);
            $data->quantite = $stock[0]->quantite + $request->get('quantite');
            $data->save();

        } else {
            $data = new ProduitBoutique([
                'produit' => $request->get('produit'),
                'boutique' => $request->get('boutique'),
                'quantite' => $request->get('quantite'),
                'alerte' => $request->get('alerte')
            ]);
            $data->save();
        }

        $produit = Produit::find($request->get('produit'));
        if ($produit) {
            $produit->quantite = $produit->quantite - $request->get('quantite');
            $produit->save();
        }


        return redirect()->route('produit-boutique.create', '?boutique=' . $request->get('boutique'))->with('success', 'Produit enregistré !');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $produit = ProduitBoutique::with('getProduit')->find($id);
        $produits = Produit::all();
        return view('boutiques.produits.edit', compact('produits', 'produit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'boutique' => 'required',
            'quantite' => 'required'
        ]);
        $produit = ProduitBoutique::find($id);
        $produit->quantite = $request->get('quantite');
        $produit->alerte = $request->get('alerte');
        $produit->save();
        return redirect()->route('boutiques.show', $produit->boutique);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
