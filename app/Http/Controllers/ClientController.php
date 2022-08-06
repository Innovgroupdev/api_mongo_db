<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

//    public function __construct(Client $client)
//    {
//        $this->model = $client;
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json(['clients',$clients],'200');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'nom' => 'required|min:2',
            'prenom' => 'required|min:2',
            'datenais' => 'required|min:6',
            'lieu' => 'required|min:2',
        ]);
        $client = new Client();
        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->datenais = $request->datenais;
        $client->lieu = $request->lieu;
        $client->save();
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
        $client = Client::find($id);
        if (empty($client)) {
            return response()->json(['error','client non trouvé','404']);
        }
        return response()->json(['client',$client,'200']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $client = Client::find($id);
        if (empty($client)) {
            return response()->json(['error','client non trouvé','404']);
        }

        return response()->json(['client',$client,'200']);
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
        $client = Client::find($id);
        $client = $request->all();
        $client->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        if (empty($client)) {
            return response()->json(['error','client non trouvé','404']);
        }
        $c = Client::where('id',$id)->delete();
        return response()->json(['succes','suppression réussi','201']);
    }
}
