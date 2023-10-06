<?php

namespace App\Http\Controllers;

use App\KitProduct;
use Illuminate\Http\Request;

class KitProductController extends Controller
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
        //
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
     * @param  \App\KitProduct  $kitProduct
     * @return \Illuminate\Http\Response
     */
    public function show(KitProduct $kitProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KitProduct  $kitProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(KitProduct $kitProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KitProduct  $kitProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KitProduct $kitProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KitProduct  $kitProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(KitProduct $kitProduct)
    {
        //
    }
}
