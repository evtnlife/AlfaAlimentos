@extends('layouts.header')
@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Dados da Filial</h3>
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span class="badge badge-primary">Total de Filiais: {{$branchCount}}</span>
                        </div>
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
                        <form method="post" action="/branch/create">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Nome </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name')}}" placeholder="Digite o nome da filial">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2 state" name="state" style="width: 100%;">
                                            <option value=" " selected="selected">Selecione um Estado</option>
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}">{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <select class="form-control select2 city" name="city" style="width: 100%;">
                                            <option selected="selected">Selecione uma Cidade</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="district">Bairro</label>
                                        <input type="text" class="form-control" id="district" name="district"
                                               value="{{old('district')}}"
                                               placeholder="Digite o bairro do cliente">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="address">Endereço</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                               value="{{old('address')}}"
                                               placeholder="Digite o endereço do cliente">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="number">Número</label>
                                        <input type="text" class="form-control" id="number" name="number"
                                               value="{{old('number')}}"
                                               placeholder="Digite o numero do endereço">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="reference">Ponto de Referência</label>
                                        <input type="text" class="form-control" id="reference" name="reference"
                                               value="{{old('reference')}}"
                                               placeholder="Digite um ponto de referência">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer pl-0">
                                <button type="submit" class="btn btn-dark">Cadastrar Filial</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

