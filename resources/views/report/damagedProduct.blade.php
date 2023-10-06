@extends('layouts.header')

@section('content-header')
    <div class="container-fluid">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Produtos Danificados</h3>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped datatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Motivo</th>
                                <th>Data</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->product->name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->created_at->format( 'd-m-Y' )}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
