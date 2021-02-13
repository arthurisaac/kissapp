<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategorieController extends Controller
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
    public function create()
    {
        //
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
            'libelle' => 'required'
        ]);

        $data = new Categorie([
            'libelle' => $request->get('libelle')
        ]);
        $data->save();
        return redirect()->route('produits.create')->with('success', 'Catégorie enregistrée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategorieController  $categorieController
     * @return Response
     */
    public function show(CategorieController $categorieController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategorieController  $categorieController
     * @return Response
     */
    public function edit(CategorieController $categorieController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\CategorieController  $categorieController
     * @return Response
     */
    public function update(Request $request, CategorieController $categorieController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategorieController  $categorieController
     * @return Response
     */
    public function destroy(CategorieController $categorieController)
    {
        //
    }
}
