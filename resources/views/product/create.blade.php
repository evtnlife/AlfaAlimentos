@extends('layouts.header')

@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Cadastrar produto</h3>
                        <div class="card-tools">
                            <span class="badge badge-primary">Total de produtos: {{$countProducts}}</span>
                        </div>
                    </div>
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
                            <form method="post" action="/product/create" enctype="multipart/form-data">

                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Produto</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="Nome do produto"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Preço de venda</label>
                                            <input type="number" class="form-control" step="0.01" min="0.01" id="price" name="price"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="cost">Preço de custo</label>
                                            <input type="number" class="form-control" step="0.01" min="0.01" id="cost"
                                                   name="cost"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity">Quantidade</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity"
                                                   placeholder="Quantidade em estoque"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="provider">Fornecedor</label>
                                            <select class="custom-select select2 form-control-border" id="provider" name="provider">
                                                <option value=" ">Selecione...</option>
                                                @foreach($providers as $provider)
                                                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Categoria</label>
                                            <select class="custom-select select2 form-control-border" id="category" name="category">
                                                <option value=" ">Selecione...</option>
                                                @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Descrição</label>
                                            <textarea class="form-control desc-produto" id="description" name="description"
                                                      placeholder="Características do produto"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-dark">Cadastrar</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
