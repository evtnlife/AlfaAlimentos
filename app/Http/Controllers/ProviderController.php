<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Client;
use App\Product;
use App\Provider;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $providers = Provider::with('User')->whereNull('deleted_at')->get();
        return view('provider.list')->with(['providers' => $providers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $providerCount = Provider::all()->whereNull('deleted_at');
        return view('provider.create')->with(['providerCount' => count($providerCount)]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description'=>'required',
            'document' => 'required|unique:clients|max:50',
            'document_type' => 'required',
            'phone' => 'required',
            'email' => '',
            'responsible'=> 'required',
        ]);
        //Salva Fornecedor
        $provider = new Provider();
        $provider->name = $validatedData['name'];
        $provider->description = $request['description'];
        $provider->document = $validatedData['document'];
        $provider->document_type = $validatedData['document_type'];
        $provider->phone = $validatedData['phone'];
        $provider->email = $validatedData['email'] != null ? $validatedData['email'] : '';
        $provider->responsible = $request['responsible'];
        $provider->user_id =Auth::user()->id;
        $provider->save();
        return redirect()->back()->with([
            'status' => "Fornecedor inserido com sucesso!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $provider = Provider::where('id', $id)->first();
        $providerCount = Provider::all()->whereNull('deleted_at');
        return view('provider.edit')->with(['provider' => $provider, 'providerCount' => count($providerCount)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Provider $provider)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'document' => 'required|unique:clients|max:50',
            'document_type' => 'required',
            'phone' => 'required',
            'email' => '',
            'responsible'=>'required',
            'description'=>'required',

        ]);
        $provider = Provider::where('id', $validatedData['id'])->first();
        $provider->name = $validatedData['name'];
        $provider->description = $request['description'];
        $provider->document = $validatedData['document'];
        $provider->document_type = $validatedData['document_type'];
        $provider->phone = $validatedData['phone'];
        $provider->email = $validatedData['email'] != null ? $validatedData['email']: '';
        $provider->responsible = $request['responsible'];
        $provider->user_id =Auth::user()->id;
        $provider->save();
        return redirect()->back()->with(['status' => 'Fornecedor atualizado com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required'
        ]);
        $provider = Provider::find($validatedData['id']);
        if($provider != null){
            $provider->deleted_at = Carbon::now();
            $provider->save();
        }
        return redirect()->back()->with(['status' => "Fornecedor: ".$provider->name." deletado com sucesso!"]);
    }

    public function getQuantity($id)
    {
        $product = Product::where('id', $id)->first();
        $quantity = $product->quantity;

        return response()->json(
            [
                'quantity' => $quantity
            ],
            200
        );
    }
    public function quantityAdd(Request $request)
    {
        $validatedData = $request->validate([
            'provider' => 'required|numeric',
            'product' => 'required|numeric',
            'quantityNow' => 'required|integer',
        ]);
        $product = Product::find($validatedData['product']);
        $product->quantity = $validatedData['quantityNow'] + $product->quantity;
        $product->save();

        return redirect()->back()->with(['status' => "Quantidade de ".$validatedData["quantityNow"] ." adicionada ao estoque do produto ".$product->name." com sucesso!"]);
    }
    public function entry()
    {
        $products = Product::all()->whereNull('deleted_at')->where('branch_id', Cookie::get('branch_id'));
        $providers = Provider::all()->whereNull('deleted_at');
        return view('provider.entry')->with(['providers' => $providers,'products'=> $products]);
    }
}
