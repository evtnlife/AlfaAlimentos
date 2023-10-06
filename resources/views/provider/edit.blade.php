@extends('layouts.header')
@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Dados do Fornecedor</h3>
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span class="badge badge-primary">Total de Fornecedores: {{$providerCount}}</span>
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
                        <form method="post" action="/provider/edit">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" value="{{$provider->id}}">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nome Completo</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{$provider->name}}" placeholder="Digite seu nome">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="responsible">Responsável</label>
                                        <input type="text" class="form-control" id="responsible" name="responsible"
                                               value="{{$provider->responsible}}" placeholder="Digite o nome do Responsável">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tipo do Documento</label>
                                        <select class="form-control select state" name="document_type"
                                                style="width: 100%;">
                                            @if($provider->document_type == 'CPF')
                                                <option selected="selected">CPF</option>
                                                <option>CNPJ</option>
                                            @else
                                                <option selected="selected">CNPJ</option>
                                                <option>CPF</option>

                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label for="document">Documento</label>
                                            <input type="text" class="form-control" id="document" name="document"
                                                   value="{{$provider->document}}"
                                                   placeholder="Documento de identificação">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fas fa-envelope-open"></i></span>
                                            </div>
                                            <input type="email" class="form-control" name="email"
                                                   value="{{$provider->email}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="phone"
                                                   value="{{$provider->phone}}"
                                                   data-inputmask='"mask": "(99) 99999-9999"'
                                                   data-mask>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="description">Descrição</label>
                                        <input type="text" class="form-control" id="description" name="description"
                                               value="{{$provider->description}}" placeholder="Digite uma descrição">
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer pl-0">
                                <button type="submit" class="btn btn-dark">Editar Fornecedor</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

