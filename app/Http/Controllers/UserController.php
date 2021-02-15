<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('utilisateurs.index', compact('users'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function auth(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $name = $request->get('name');
        $password = $request->get('password');
        $user = DB::table('users')
            ->where('name', '=', $name)
            ->where('password', '=', $password)
            ->get();
        if (count($user) > 0) {
            if ($user[0]->authorized === 0) {
                return redirect('/login')->with('error', 'Vous n\'avez pas autorisation à la plateforme ');
            }
            session(['user' => $user[0]]);
            // TODO
            if ($user[0]->role === 2) {
                return redirect('/ventes');
            }
            return redirect('/')->with('success', 'Authentification réussie');
        }
        return redirect('/login')->with('error', 'Erreur authentification');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('utilisateurs.create', compact('roles'));
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'role' => $request->get('role'),
        ]);
        $user->save();
        return redirect()->route('utilisateurs.create')->with('success', 'Utilisateur enregistré avec succès!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
        ]);

        if ($request->get('type') === 'utilisateur') {
            $user = User::find($id);
            $user->boutique = $request->get('boutique');
            $user->save();
            return Response()->json($user);
        }
        return Response()->json('no data');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateAuthorization(Request $request)
    {
        $request->validate([
            'authorization' => 'required',
            'id' => 'required',
        ]);
        $user = User::find($request->get('id'));
        $user->authorized = $request->get('authorization');
        $user->save();
        return Response()->json('updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return Response()->json("ok");
    }
}
