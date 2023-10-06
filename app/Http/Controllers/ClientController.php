<?php

namespace App\Http\Controllers;

use App\Address;
use App\City;
use App\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\State;
use Illuminate\Support\Facades\Cookie;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        $clients = Client::with('Address')->whereNull('deleted_at')->where('branch_id', Cookie::get('branch_id'))->get();
        return view('clients.list')->with(['clients' => $clients,'cities' => $cities]);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClients()
    {
        $clients = Client::with('Address')->whereNull('deleted_at')->where('branch_id', Cookie::get('branch_id'))->get();
        return response()->json(['clients' => $clients], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        $clientCount = Client::where('branch_id', Cookie::get('branch_id'))->get();
        return view('clients.create')->with(['states' => $states, 'clientsCount' => count($clientCount)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestAux = $request->all();
        $validatedData = $request->validate([
            'status' => 'required',
            'observation' => '',
            'name' => 'required',
            'state' => 'required|numeric',
            'city' => 'required|numeric',
            'address' => 'required',
            'number' => 'required|numeric',
            'email' => '',
            'district' => 'required',
            'reference' => '',
            'phone' => 'required',
            'document' => ''
        ]);

        //Salva endereço
        $address = new Address();
        $address->street = $validatedData['address'];
        $address->district = $validatedData['district'];
        $address->reference = $validatedData['reference'] != null ? $validatedData['reference'] : '';
        $address->cities_id = $validatedData['city'];
        $address->number = $validatedData['number'];
        $address->save();

        //Salva cliente
        $client = new Client();
        $client->name = $validatedData['name'];
        $client->email = $requestAux['email'] != null ? $requestAux['email'] : '';
        $client->document = $requestAux['document'] != null ? $requestAux['document'] : "";
        $client->document_type = $requestAux['document_type'] != null ? $requestAux['document_type'] == "CPF" ? '0' : '1': '0';
        $client->observation = $validatedData['observation'] != null ? $validatedData['observation'] : '';
        $client->status = $validatedData['status'];
        $client->address_id = $address->id;
        $client->phone = $validatedData['phone'];

        $client->branch_id = Cookie::get('branch_id');

        $client->save();
        return redirect()->back()->with([
           'status' => "Cliente inserido com sucesso!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::where('id', $id)->with('Address')->first();
        $states = State::all();
        $cities = City::where('state_id', $client->Address->City->State->id)->get();
        return view('clients.edit', compact('client'))->with(['states' => $states, 'cities' => $cities, 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'status' => 'required',
            'observation' => '',
            'name' => 'required',
            'state' => 'required|numeric',
            'city' => 'required|numeric',
            'address' => 'required',
            'number' => 'required|numeric',
            'district' => 'required',
            'email' => '',
            'reference' => '',
            'phone' => 'required'
        ]);
        $client = Client::where('id', $validatedData['id'])->with('Address')->first();
        $client->name = $validatedData['name'];
        $client->email = $validatedData['email'] != null ? $validatedData['email'] : '';
        $client->phone = $validatedData['phone'];
        $client->observation = $validatedData['observation'] != null ? $validatedData['observation'] : '';
        $client->status = $validatedData['status'];
        $var = array([
            'street' => $validatedData['address'],
            'district' => $validatedData['district'],
            'reference' => $validatedData['reference'],
            'cities_id' => $validatedData['city'],
            'number' => $validatedData['number']
        ]);
        $client->save();
        $address = Address::where('id', $client->address_id)->first();
        $address->street = $validatedData['address'];
        $address->district = $validatedData['district'];
        $address->reference = $validatedData['reference'] != null ? $validatedData['reference'] : '';
        $address->cities_id = $validatedData['city'];
        $address->number = $validatedData['number'];
        $address->save();
        return redirect()->back()->with(['status' => 'Cliente atualizado com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required'
        ]);
        $client = Client::find($validatedData['id']);
        if($client != null){
            $client->deleted_at = Carbon::now();
            $client->save();
        }
        return redirect()->back()->with(['status' => "Cliente: ".$client->name." deletado com sucesso!"]);
    }
}
