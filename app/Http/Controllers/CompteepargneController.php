<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Compteepargne;
use Illuminate\Http\Request;

class CompteepargneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $compteepargnes = Compteepargne::all();
        return response()->json(['compteepargnes',$compteepargnes],'200');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Validator::validate($request->all(), [
            'numero' => 'required|min:10',
            'libelle' => 'required|min:2',
            'M' => 'required',
            'sold' => 'required',
            'client_id' => 'required',
            'agence_id' => 'required',
        ]);
        $compte = new Compte();
        $compteepargne = new Compteepargne();
        $compte->numero = $request->numero;
        $compte->libelle = $request->libelle;
        $compte->M = $request->M;
        $compte->sold = $request->sold;
        $compte->client_id = $request->client_id;
        $compte->agence_id = $request->agence_id;
        $c = $compte->save();
        $compteepargne->_id = $c->id;
        $compteepargne->T = $request->T;
        $compteepargne->save();
        return response()->json(['succes','Compte créé avec succès','201']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $compteepargne = Compteepargne::find($id);
        if (empty($comptecourant)) {
            return response()->json(['error','compte épargne non trouvé','404']);
        }
        return response()->json(['compteepargne',$compteepargne,'200']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $compteepargne = Compteepargne::find($id);
        if (empty($comptecourant)) {
            return response()->json(['error','compte épargne non trouvé','404']);
        }

        return response()->json(['compteepargne',$compteepargne,'200']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $compteepargne = Compteepargne::find($id);
        if (empty($compteepargne)) {
            return response()->json(['error','compte épargne non trouvé','404']);
        }
        $c = $compteepargne::where('id',$id)->delete();
        return response()->json(['succes','suppression réussi','201']);
    }
}
