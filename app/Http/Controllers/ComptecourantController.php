<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Compte\Comptecourant;
use App\Models\Compteepargne;
use Illuminate\Http\Request;

class ComptecourantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $comptecourants = Comptecourant::all();
        return response()->json(['comptecourants',$comptecourants],'200');
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
            'sold' => 'required',
            'client_id' => 'required',
            'agence_id' => 'required',
        ]);
        $compte = new Compte();
        $comptecourant = new Comptecourant();
        $compte->numero = $request->numero;
        $compte->libelle = $request->libelle;
        $compte->sold = $request->sold;
        $compte->client_id = $request->client_id;
        $compte->agence_id = $request->agence_id;
        $c = $compte->save();
        $comptecourant->id = $c->id;
        $comptecourant->save();
        return response()->json(['succes','Compte créé avec succès','201']);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $comptecourant = Comptecourant::find($id);
        if (empty($comptecourant)) {
            return response()->json(['error','compte courant non trouvé','404']);
        }
        return response()->json(['comptecourant',$comptecourant,'200']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $comptecourant = Comptecourant::find($id);
        if (empty($comptecourant)) {
            return response()->json(['error','compte courant non trouvé','404']);
        }

        return response()->json(['comptecourant',$comptecourant,'200']);
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
        $comptecourant = Comptecourant::find($id);
        $comptecourant = $request->all();
        $comptecourant->save();
        return response()->json(['succes','compte courant modifié ','201']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $comptecourant = Comptecourant::find($id);
        if (empty($comptecourant)) {
            return response()->json(['error','comptecourant non trouvé','404']);
        }
        $c = Comptecourant::where('id',$id)->delete();
        return response()->json(['succes','suppression réussi','201']);
    }
}
