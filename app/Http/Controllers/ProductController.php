<?php

namespace App\Http\Controllers;

use App\Branch;
use App\DamagedProduct;
use App\Image;
use App\Product;
use App\Category;
use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
        $products = Product::with(['provider', 'category', 'user'])->whereNull('deleted_at')->where('branch_id', Cookie::get('branch_id'))->get();
        return view('product.list')->with(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $product = Product::where('branch_id', Cookie::get('branch_id'))->whereNull('deleted_at')->get();
        $categories = Category::all();
        $providers = Provider::all();
        return view('product.create')->with(['countProducts' => count($product), 'providers' => $providers, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:clients|max:50',
            'description' => 'max:100|required',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'provider' => 'required|numeric',
            'category' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);
        //salvar produto
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = (float)($validatedData['price']);
        $product->cost = (float)$validatedData['cost'];
        $product->provider_id = $validatedData['provider'];
        $product->category_id = $validatedData['category'];
        $product->quantity = (int)$validatedData['quantity'];
        $product->user_id = Auth::user()->id;
        $product->branch_id = Cookie::get('branch_id');
        $product->save();
        return redirect()->back()->with([
            'status' => "Produto cadastrado com sucesso!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = Category::all();
        $providers = Provider::all();
        $product = Product::where(['id' => $id, 'branch_id' => Cookie::get('branch_id')])->whereNull('deleted_at')->first();
        $countProducts = Product::all()->where('branch_id', Cookie::get('branch_id'))->whereNull('deleted_at');
        return view('product.edit')->with(['product' => $product, 'countProducts' => count($countProducts), 'providers' => $providers, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:clients|max:50',
            'description' => 'max:100|required',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'provider' => 'required|numeric',
            'category' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $product = Product::where('id', $request['id'])->first();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = (float)($validatedData['price']);
        $product->cost = (float)$validatedData['cost'];
        $product->provider_id = $validatedData['provider'];
        $product->category_id = $validatedData['category'];
        $product->quantity = (int)$validatedData['quantity'];
        $product->user_id = Auth::user()->id;
        $product->branch_id = Cookie::get('branch_id');
        $product->save();
        return redirect()->back()->with([
            'status' => "Produto editado com sucesso!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $validadedData = $request->validate([
            'id' => 'required'
        ]);
        $product = Product::find($validadedData['id']);
        if (isset($product)) {
            $product->deleted_at = Carbon::now();
            $product->user_id = Auth::user()->id;
            $product->update();
            return redirect()->back()->with([
                'status' => "Produto excluído com sucesso!"
            ]);
        } else {
            return redirect()->back()->with([
                'status' => "Produto não encontrado"
            ]);
        }
    }

    public function getProductFromId($id)
    {
        $product = Product::find($id);
        return response()->json([
            'product' => $product
        ], 200);
    }

    public function damaged()
    {
        $products = Product::where('branch_id', Cookie::get('branch_id'))->get();
        return view('storage.damagedProduct')->with(['products' => $products]);
    }

    public function damagedStore(Request $request)
    {
        $products = Product::where('branch_id', Cookie::get('branch_id'))->get();
        $validateData = $request->validate([
            'product' => 'required',
            'quantity' => 'required',
            'description' => 'required'
        ]);
        $product = Product::find($validateData['product']);
        if ($product) {
            if($product->quantity < $validateData['quantity'])
                return redirect()->back()->withErrors(['Quantidade superior ao existente no estoque - Qtd:'.$product->quantity]);
            $damagedProduct = new DamagedProduct();
            $damagedProduct->user_id = Auth::user()->id;
            $damagedProduct->product_id = $validateData['product'];
            $damagedProduct->branch_id = Cookie::get('branch_id');
            $damagedProduct->quantity = $validateData['quantity'];
            $damagedProduct->description = $validateData['description'];
            if ($damagedProduct->save()) {
                $product->quantity = ($product->quantity - $validateData['quantity']);
                $product->save();
                return redirect()->back()->with(['status' => 'Produto salvo com sucesso.', 'products' => $products]);
            }
        }
        return redirect()->back()->withErrors(['Falha ao salvar produto']);
    }
    public function damagedList(){
        $list_prod = DamagedProduct::with('product')->where('branch_id', Cookie::get('branch_id'))->get();
        return view('report.damagedProduct')->with(['products' => $list_prod]);
    }
}
