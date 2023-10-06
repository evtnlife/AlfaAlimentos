@extends('layouts.header')

@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Dados do Cliente</h3>
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span class="badge badge-primary">Total de Clientes: {{$clientsCount}}</span>
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
                        <form method="post" action="/client/create">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nome Completo</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name')}}" placeholder="Digite seu nome">
                                    </div>
                                    <div class="form-group">
                                        <label for="document">Documento</label>
                                        <input type="text" class="form-control" id="document" name="document"
                                               value="{{old('document')}}"
                                               placeholder="Documento de identificação">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Tipo do Documento</label>
                                            <select class="form-control select2 state" name="document_type"
                                                    style="width: 100%;">
                                                <option selected="selected">CPF</option>
                                                <option>CNPJ</option>
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
                                                   value="{{old('email')}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone"
                                                   value="{{old('phone')}}"
                                                   data-inputmask='"mask": "(99) 99999-9999"'
                                                   data-mask>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2 state" name="state" style="width: 100%;">
                                            <option selected="selected">Selecione um Estado</option>
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}">{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <select class="form-control select2 city" name="city" style="width: 100%;">
                                            <option selected="selected">Selecione uma Cidade</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="district">Bairro</label>
                                        <input type="text" class="form-control" id="district" name="district"
                                               value="{{old('district')}}"
                                               placeholder="Digite o bairro do cliente">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <label for="address">Endereço</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                       value="{{old('address')}}"
                                                       placeholder="Digite o endereço do cliente">
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="number">Número</label>
                                                <input type="text" class="form-control" id="number" name="number"
                                                       value="{{old('number')}}"
                                                       placeholder="Digite o número do endereço">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reference">Ponto de Referência</label>
                                        <input type="text" class="form-control" id="reference" name="reference"
                                               value="{{old('reference')}}"
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
                                                <option selected="selected">BOM</option>
                                                <option>REGULAR</option>
                                                <option>RUIM</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <label for="observation">Observação</label>
                                        <input type="text" class="form-control" id="observation" name="observation"
                                               value="{{old('observation')}}"
                                               placeholder="Digite a observação do cliente">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer pl-0">
                                <button type="submit" class="btn btn-dark">Cadastrar Cliente</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
