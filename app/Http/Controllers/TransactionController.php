<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Compte\Comptecourant;
use App\Models\Compteepargne;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function faireRetrait(Request $request)
    {
        Validator::validate($request->all(), [
            'numero' => 'required|min:10',
            'libelle' => 'required|min:2',
            'M' => 'required',
            'sold' => 'required',
            'client_id' => 'required',
            'agence_id' => 'required',
        ]);

        $compte = Compte::where($request->numero)->get();
        $transaction = new Transaction();
        $transaction->M = $request->M;
        $compte->sold = $request->sold - $transaction->M;
        $transaction->typetransaction_id = $request->typetransaction_id;
        $compte->client_id = $request->client_id;
        $compte->agence_id = $request->agence_id;
        $transaction->save();
         $compte->save();
        return response()->json(['succes','Retrait effectué','201']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function faireDepot(Request $request)
    {
        Validator::validate($request->all(), [
            'numero' => 'required|min:10',
            'M' => 'required',
            'sold' => 'required',
            'client_id' => 'required',
            'agence_id' => 'required',
        ]);
        //$compte = new Compte();
        $compte = Compte::where($request->numero)->get();
        $transaction = new Transaction();
        $transaction->M = $request->M;
        $compte->sold = $request->sold + $transaction->M;
        $transaction->typetransaction_id = $request->typetransaction_id;
        $compte->client_id = $request->client_id;
        $compte->agence_id = $request->agence_id;
        $transaction->save();
        $c = $compte->save();
        $checkNumCourant = Comptecourant::where('id',$compte->id)->get();
        $checkNumEpargne = Compteepargne::where('id',$compte->id)->get();
        if($checkNumCourant){

        }else{
            $dec = $c->sold - $request->M;
            $compte->sold = $dec + $request->M * $checkNumEpargne->T;
            $compte->update();
        }
        return response()->json(['succes','Dépôt effectué','201']);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
