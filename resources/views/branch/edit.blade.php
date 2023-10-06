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
                        <form method="post" action="/branch/edit">
                            <input type="hidden" name="id" value="{{$branch->id}}">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Nome </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{$branch->name}}" placeholder="Digite seu nome">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2 state" name="state" style="width: 100%;">
                                            <option >Selecione um Estado</option>
                                            @foreach($states as $state)
                                                @if($branch->Address->City->State->id == $state->id)
                                                    <option selected="selected"
                                                            value="{{$state->id}}">{{$state->name}}</option>
                                                @else
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <select class="form-control select2 city" name="city" style="width: 100%;">
                                            <option>Selecione uma Cidade</option>
                                            @foreach($cities as $city)
                                                @if($branch->Address->City->id == $city->id)
                                                    <option selected="selected"
                                                            value="{{$city->id}}">{{$city->name}}</option>
                                                @else
                                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="district">Bairro</label>
                                        <input type="text" class="form-control" id="district" name="district"
                                               value="{{$branch->Address->district}}"
                                               placeholder="Digite o bairro do cliente">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="address">Endereço</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                               value="{{$branch->Address->street}}"
                                               placeholder="Digite o endereço do cliente">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="number">Número</label>
                                        <input type="text" class="form-control" id="number" name="number"
                                               value="{{$branch->Address->number}}"
                                               placeholder="Digite o numero do endereço">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="reference">Ponto de Referência</label>
                                        <input type="text" class="form-control" id="reference" name="reference"
                                               value="{{$branch->Address->reference}}"
                                               placeholder="Digite um ponto de referência">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer pl-0">
                                <button type="submit" class="btn btn-dark">Editar Filial</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

