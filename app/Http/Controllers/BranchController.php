<?php

namespace App\Http\Controllers;

use App\Address;
use App\Branch;
use App\Cidades;
use App\City;
use App\Client;
use App\Endereco;
use App\Estados;
use App\State;
use App\User;
use App\UserDado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
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
        $states = State::all();
        $cities = City::all();
        $branchs = Branch::all();
        return view('branch.list', compact('branchs'))->with(['states' => $states, 'cities' => $cities, 'branchCount' => count($branchs)]);
    }
    public function listAjax()
    {
        $branch = Branch::all();
        return response()->json([
            'branch' => $branch
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        $branchCount = Branch::all();
        return view('branch.create')->with(['states' => $states, 'branchCount' => count($branchCount)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'state' => 'required|numeric',
            'city' => 'required|numeric',
            'address' => 'required',
            'number' => 'required|numeric',
            'district' => 'required',
            'reference' => 'required',
        ]);
        //Salva endereço
        $address = new Address();
        $address->street = $validatedData['address'];
        $address->district = $validatedData['district'];
        $address->reference = $validatedData['reference'];
        $address->cities_id = $validatedData['city'];
        $address->number = $validatedData['number'];
        $address->save();

        //Salva Filial
        $branch = new Branch();
        $branch->name = $validatedData['name'];
        $branch->address_id = $address->id;
        $branch->save();
        return redirect()->back()->with([
            'status' => "Filial inserida com sucesso!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::where('id', $id)->with('Address')->first();
        $states = State::all();
        $cities = City::where('state_id', $branch->Address->City->State->id)->get();
        $branchCount = Branch::all();
        return view('branch.edit', compact('branch'))->with(['states' => $states, 'cities' => $cities, 'branchCount' => count($branchCount)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'state' => 'required|numeric',
            'city' => 'required|numeric',
            'address' => 'required',
            'number' => 'required|numeric',
            'district' => 'required',
            'reference' => 'required',
        ]);
        $branch = Branch::where('id', $validatedData['id'])->with('Address')->first();
        $branch->name = $validatedData['name'];
        $var = array([
            'street' => $validatedData['address'],
            'district' => $validatedData['district'],
            'reference' => $validatedData['reference'],
            'cities_id' => $validatedData['city'],
            'number' => $validatedData['number']
        ]);
        $branch->save();
        $address = Address::where('id', $branch->address_id)->first();
        $address->street = $validatedData['address'];
        $address->district = $validatedData['district'];
        $address->reference = $validatedData['reference'];
        $address->cities_id = $validatedData['city'];
        $address->number = $validatedData['number'];
        $address->save();
        return redirect()->back()->with(['status' => 'Filial atualizada com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::find($id);
        if ($branch != null) {
            if($branch->deleted_at == null){
                $branch->deleted_at = Carbon::now();
                $branch->save();
            }else{
                $branch->deleted_at = null;
                $branch->save();
            }
        }
        return redirect()->back()->with(['status' => "Filial: . desabilitada com sucesso!"]);
    }

    public function change(Request $request)
    {
        $request = $request->all();
        return redirect()->back()->withCookie(cookie('branch_id', $request['branch_id']));
    }
}
