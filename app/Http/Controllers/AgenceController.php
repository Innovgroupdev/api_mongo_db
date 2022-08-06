<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use Illuminate\Http\Request;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $agences = Agence::all();
        return response()->json(['agences',$agences],'200');
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
            'libelle' => 'required|min:2',
            'adresse' => 'required|min:2',
            'tel' => 'required|min:6'
        ]);
        $agence = new Agence();
        $agence->libelle = $request->libelle;
        $agence->adresse = $request->adresse;
        $agence->tel = $request->tel;
        $agence->save();
        return response()->json(['succes','enregistrement réussi','201']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $agence = Agence::find($id);
        if (empty($agence)) {
            return response()->json(['error','agence non trouvé','404']);
        }
        return response()->json(['agence',$agence,'200']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $agence = Agence::find($id);
        if (empty($agence)) {
            return response()->json(['error','agence non trouvé','404']);
        }

        return response()->json(['agence',$agence,'200']);
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
        $agence = Agence::find($id);
        $agence->libelle = $request->libelle;
        $agence->adresse = $request->adresse;
        $agence->tel = $request->tel;
        $agence->save();
        return response()->json(['succes','agence mise à jour','201']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $agence = Agence::find($id);
        if (empty($agence)) {
            return response()->json(['error','agence non trouvé','404']);
        }
        $a = Agence::where('id',$id)->delete();
        return response()->json(['succes','suppression réussi','201']);
    }
}
