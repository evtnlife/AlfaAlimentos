@extends('layouts.header')

@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Dados do Cliente</h3>

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
                        <form method="post" action="/client/edit">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" value="{{$id}}">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nome Completo</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{$client->name}}" placeholder="Digite seu nome">
                                    </div>
                                    <div class="form-group">
                                        <label for="document">Documento</label>
                                        <input type="text" class="form-control" id="document" name="document" disabled
                                               value="{{$client->document}}"
                                               placeholder="Documento de identificação">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Tipo do Documento</label>
                                            <select class="form-control select2 state" name="document_type" disabled
                                                    style="width: 100%;">
                                                @if($client->document_type == 0)
                                                    <option selected="selected">CPF</option>
                                                    <option>CNPJ</option>
                                                @else
                                                    <option>CPF</option>
                                                    <option selected="selected">CNPJ</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fas fa-envelope-open"></i></span>
                                            </div>
                                            <input type="email" class="form-control" name="email"
                                                   value="{{ $client->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone"
                                                   value="{{$client->phone}}"
                                                   data-inputmask='"mask": "(99) 99999-9999"'
                                                   data-mask>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2 state" name="state" style="width: 100%;">
                                            <option>Selecione um Estado</option>
                                            @foreach($states as $state)
                                                @if($client->Address->City->State->id == $state->id)
                                                    <option selected="selected"
                                                            value="{{$state->id}}">{{$state->name}}</option>
                                                @else
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <select class="form-control select2 city" name="city" style="width: 100%;">
                                            @foreach($cities as $city)
                                                @if($client->Address->City->id == $city->id)
                                                    <option selected="selected"
                                                            value="{{$city->id}}">{{$city->name}}</option>
                                                @else
                                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="district">Bairro</label>
                                        <input type="text" class="form-control" id="district" name="district"
                                               value="{{$client->Address->district}}"
                                               placeholder="Digite o bairro do cliente">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <label for="address">Endereço</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                       value="{{$client->Address->street}}"
                                                       placeholder="Digite o endereço do cliente">
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="number">Número</label>
                                                <input type="text" class="form-control" id="number" name="number"
                                                       value="{{$client->Address->number}}"
                                                       placeholder="Digite o número do endereço">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reference">Ponto de Referência</label>
                                        <input type="text" class="form-control" id="reference" name="reference"
                                               value="{{$client->Address->reference}}"
                                               placeholder="Digite um ponto de referência">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control select state" name="status"
                                                    style="width: 100%;">
                                                <option {{$client->status == 'BOM'? 'selected="selected"' : ''}}>BOM</option>
                                                <option {{$client->status == 'REGULAR'? 'selected="selected"' : ''}}>REGULAR</option>
                                                <option {{$client->status == 'RUIM'? 'selected="selected"' : ''}}>RUIM</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <label for="observation">Observação</label>
                                        <input type="text" class="form-control" id="observation" name="observation"
                                               value="{{$client->observation}}"
                                               placeholder="Digite a observação do cliente">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer pl-0">
                                <button type="submit" class="btn btn-dark">Editar Cliente</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
