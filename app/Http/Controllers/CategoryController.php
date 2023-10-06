<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
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
        $categories = Category::with('User')->whereNull('deleted_at')->get();
        return view('category.list')->with(['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categoryCount = Category::all()->whereNull('deleted_at');
        return view('category.create')->with(['categoryCount' => count($categoryCount)]);
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
            'description' => 'required'
        ]);
        //Salva categoria
        $category = new Category();
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];
        $category->user_id = Auth::user()->getAuthIdentifier();
        $category->save();
        return redirect()->back
        ()->with([
            'status' => "Categoria inserida com sucesso!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categoryCount = Category::whereNull('deleted_at')->get();
        $category = Category::where('id', $id)->first();

        return view('category.edit')->with([
            'category' => $category,
            'categoryCount' => count($categoryCount)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'id'=>'required',
        ]);
        //Salva categoria
        $category = Category::find($validatedData['id']);
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];

        $category->save();
        return redirect()->back()->with(['status' => 'Categoria atualizado com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required'
        ]);
        $category = Category::find($validatedData['id']);
        if($category != null){
            $category->deleted_at = Carbon::now();
            $category->save();
        }
        return redirect()->back()->with(['status' => "A Categoria ".$category->name." foi deletada com sucesso!"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductsFromCategory($id){
        $products = Product::where('branch_id', Cookie::get('branch_id'))->where('category_id', $id)->get();
        return response()->json(
            [
                'products' => $products,
                'branch_id' => Cookie::get('branch_id')
            ],
            200
        );
    }
}
