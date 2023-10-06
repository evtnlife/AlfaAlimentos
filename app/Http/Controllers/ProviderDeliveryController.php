<?php

namespace App\Http\Controllers;

use App\ProviderDelivery;
use Illuminate\Http\Request;

class ProviderDeliveryController extends Controller
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
     * @param  \App\ProviderDelivery  $providerDelivery
     * @return \Illuminate\Http\Response
     */
    public function show(ProviderDelivery $providerDelivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProviderDelivery  $providerDelivery
     * @return \Illuminate\Http\Response
     */
    public function edit(ProviderDelivery $providerDelivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProviderDelivery  $providerDelivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProviderDelivery $providerDelivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProviderDelivery  $providerDelivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProviderDelivery $providerDelivery)
    {
        //
    }
}
