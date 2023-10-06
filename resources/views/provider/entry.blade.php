@extends('layouts.header')
@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Entrada de Produtos</h3>
                        <!-- /.card-tools -->
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
                        <form method="post" action="/provider/quantityAdd">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Fornecedor</label>
                                        <select class="form-control select2 provider" name="provider" style="width: 100%;">
                                            <option value=" " selected="selected">Selecione um Fornecedor</option>
                                            @foreach($providers as $provider)
                                                <option value="{{$provider->id}}">{{$provider->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Produto</label>
                                        <select class="form-control select2 product" id="product" name="product" style="width: 100%;">
                                            <option value=" " selected="selected">Selecione um Produto</option>
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="quantityOld">Quantidade Atual</label>
                                        <input disabled="true" type="text" class="form-control" id="quantityOld" name="quantityOld"
                                               value="{{old('quantityOld')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="quantityNow">Quantidade a ser adicionada</label>
                                        <input type="text" class="form-control" id="quantityNow" name="quantityNow"
                                               value="{{old('quantityNow')}}" placeholder="Digite a quantidade a ser adicionada">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer pl-0">
                                <button type="submit" class="btn btn-dark">Adicionar Quantidade</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        (function ($) {
            'use strict';
            $(document).ready(function () {

            });
            $('#product').change(function () {
                var id = $(this).val();

                $.ajax({
                    url: "/provider/getQuantity/" + id,
                    method: "GET",
                    success: function (element) {
                        $('#quantityOld').attr('value', element.quantity);
                    },
                    error: function (element) {
                        console.log(element);
                    }
                });
            });

        })(jQuery);
    </script>
@endsection
