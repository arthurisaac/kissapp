<?php

namespace App\Http\Controllers;

use App\Models\Boutique;
use App\Models\ProduitBoutique;
use App\Models\StockBoutique;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BoutiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $boutiques = Boutique::all();
        return view('boutiques.index', compact('boutiques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('boutiques.create');
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
        $data = new Boutique([
            'libelle' => $request->get('libelle'),
            'adresse' => $request->get('adresse')
        ]);
        $data->save();
        return redirect('/boutiques')->with('success', 'Votre boutique a été enregisrée!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function show($id, Request $request)
    {
        $utilisateurs = User::all();
        $utilisateursDeLaBoutique = User::where('boutique', '=', $id)->get();
        $boutique = Boutique::find($id);
        $out = ProduitBoutique::where('quantite', '<', '1')->get();
        $outOfStock = count($out);
        $produits = ProduitBoutique::with('getProduit')->get();

        $ventesDuJour = DB::table('factures')
            ->selectRaw('SUM(montantTotal) as ventesDuJour')
            ->where('date', '=', date('Y-m-d'))
            ->where('boutique', '=', $id)
            ->get();
        $nombreVente = DB::table('factures')
            ->selectRaw('COUNT(*) as nombreVente')
            ->where('date', '=', date('Y-m-d'))
            ->where('boutique', '=', $id)
            ->get();
        $ventesDelaSemaine = DB::table('factures')
            ->selectRaw('SUM(montantTotal) as ventesDelaSemaine')
            ->where('date', '=', date('Y-m-d'))
            ->where('boutique', '=', $id)
            ->get();
        $ventesDuMois = DB::table('factures')
            ->selectRaw('SUM(montantTotal) as ventesDuMois')
            ->where('date', '=', date('Y-m-d'))
            ->where('boutique', '=', $id)
            ->get();

        return view('boutiques.show', compact('boutique', 'produits', 'outOfStock', 'ventesDuJour', 'nombreVente', 'ventesDelaSemaine', 'ventesDuMois', 'utilisateursDeLaBoutique', 'utilisateurs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
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
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
