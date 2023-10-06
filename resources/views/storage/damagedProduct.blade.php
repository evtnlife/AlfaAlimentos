@extends('layouts.header')

@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Lançar produtos danificados</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                <p>{{session('status')}}</p>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                    <!-- form start -->
                        <form method="post" action="/product/damaged/store">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Produtos</label>
                                        <select class="form-control select2 product" id="product" name="product"
                                                style="width: 100%">
                                            <option selected="selected">Selecione uma Produto.</option>
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantidade</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{old('quantity')}}">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Motivo da baixa</label>
                                            <input type="text" class="form-control" id="description" name="description"
                                                   value="{{old('description')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer pl-0">
                                <button type="submit" class="btn btn-danger">Dar baixa no produto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
