<?php

namespace App\Http\Controllers;

use App\Kit;
use App\Category;
use App\KitProduct;
use App\Product;
use App\Provider;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class KitController extends Controller
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
        $kits = Kit::with('Products', 'User')->where('branch_id', Cookie::get('branch_id'))->whereNull('deleted_at')->get();
        return view('kit.list')->with(['kits' => $kits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $products = Product::where('branch_id', Cookie::get('branch_id'))->whereNull('deleted_at')->get();
        $providers = Provider::all();
        $categories = Category::all();
        $kits = Kit::where('branch_id', Cookie::get('branch_id'))->whereNull('deleted_at')->get();
        return view('kit.create')->with(['products' => $products, 'provider' => $providers, 'categories' => $categories, 'kits' => count($kits)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'total_price' => 'required',
            'total_cost' => 'required',
            'product_list' => 'required'
        ]);
        //salvar dados do kit
        $kit = new Kit();
        $kit->name = $validatedData['name'];
        $kit->description = $validatedData['description'];
        $kit->price = $validatedData['total_price'];
        $kit->cost = $validatedData['total_cost'];
        $kit->user_id = Auth::user()->id;
        $kit->branch_id = Cookie::get('branch_id');
        if ($kit->save()) {
            foreach ($request->product_list as $product) {
                $newProduct = new KitProduct();
                $newProduct->product_id = $product['id'];
                $newProduct->kit_id = $kit->id;
                $newProduct->user_id = Auth::user()->id;
                $newProduct->quantity = $product['qtd'];
                $newProduct->save();
            }
            return response()->json([
                'status' => 'kit cadastrado com sucesso!'
            ], 200);
        }
        return response()->json([
            'status' => 'Erro de cadastro!'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Kit $kit
     * @return \Illuminate\Http\Response
     */
    public function show(Kit $kit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Kit $kit
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $kit = Kit::where('id', $id)->first();
        $countKits = count(Kit::all());
        $kitProducts = KitProduct::where('kit_id', $id)->whereNull('deleted_at')->get();
        $products = Product::where('branch_id', Cookie::get('branch_id'))->whereNull('deleted_at')->whereIn('id', $kitProducts)->get();
        $otherProducts = Product::where('branch_id', Cookie::get('branch_id'))->whereNull('deleted_at')->whereNotIn('id', $kitProducts)->get();
        return view('kit.edit')->with(['kit' => $kit, 'countKits' => $countKits, 'kitProducts' => $products, 'products' => $otherProducts]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Kit $kit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kit $kit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Kit $kit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required'
        ]);
        $kit = Kit::find($validatedData['id']);
        if (isset($kit)) {
            $kit->deleted_at = Carbon::now();
            $kit->user_id = Auth::user()->id;
            $kit->save();
            return redirect()->back()->with([
                'status' => "Kit excluido com sucesso!"
            ]);
        } else {
            return redirect()->back()->with([
                'status' => "Produto não encontrado"
            ]);
        }
    }

    public function getAllKits()
    {
        $kits = Kit::where('branch_id', Cookie::get('branch_id'))->get();
        return response()->json([
            'kits' => $kits
        ], 200);
    }

    public function getKitFromId($id)
    {
        $kit = Kit::find($id);
        return response()->json([
            'kit' => $kit
        ], 200);
    }
}
