<?php

namespace App\Http\Controllers;

use App\SaleParcel;
use Illuminate\Http\Request;

class SaleParcelController extends Controller
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
     * @param  \App\SaleParcel  $saleParcel
     * @return \Illuminate\Http\Response
     */
    public function show(SaleParcel $saleParcel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SaleParcel  $saleParcel
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleParcel $saleParcel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleParcel  $saleParcel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleParcel $saleParcel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleParcel  $saleParcel
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleParcel $saleParcel)
    {
        //
    }
}
