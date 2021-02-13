<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $produits = Produit::all();
        return view('prodtuis.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('prodtuis.create', compact('categories'));
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
            'categorie' => 'required',
            'ref' => 'required',
            'libelle' => 'required',
            'quantite' => 'required'
        ]);
        $data = new Produit([
            'ref' => $request->get('ref'),
            'libelle' => $request->get('libelle'),
            'designation' => $request->get('designation'),
            'quantite' => $request->get('quantite'),
            'alerte' => $request->get('alerte'),
            'prix_gros' => $request->get('prix_gros'),
            'prix_semi' => $request->get('prix_semi'),
            'prix_details' => $request->get('prix_details'),
            'categorie' => $request->get('categorie')
        ]);
        $data->save();
        return redirect('/produits')->with('success', 'Produit enregistré !');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ProduitController $produitController
     * @return Response
     */
    public function show(ProduitController $produitController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ProduitController $produitController
     * @return Response
     */
    public function edit(ProduitController $produitController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\ProduitController $produitController
     * @return Response
     */
    public function update(Request $request, ProduitController $produitController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ProduitController $produitController
     * @return Response
     */
    public function destroy(ProduitController $produitController)
    {
        //
    }
}
