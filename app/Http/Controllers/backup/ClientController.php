<?php

namespace App\Http\Controllers\backup;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Flash;
use App\Http\Controllers\Response;
use App\Http\Controllers\Validator;
use App\Models\Client;
use Illuminate\Http\Request;
use function dd;
use function redirect;
use function response;

class ClientController extends Controller
{


    /**
     * Display a listing of the Essayer.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

//    get all customers
    public function index(Request $request)
    {
        $clients = Client::all();

        return response()->json(['clients'=>$clients],200);
    }

    //    save a customer
    public function store(Request $request){

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
        dd($client);
        return response()->json(['client'=>$client],201);
    }

    /**
     * Show the form for editing the specified Essayer.
     *
     * @param int $id
     *
     * @return Response
     */

    //edit data
    public function edit($id)
    {
        $client = Client::find($id);

        if (empty($client)) {
            Flash::error('client non trouvé');

            return redirect(route('essayers.index'));
        }

        return ;
    }
}
