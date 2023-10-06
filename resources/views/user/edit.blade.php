@extends('layouts.header')
@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Editando dados do funcionário: {{$user->name}}.</h3>
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
                        <form method="post" action="/user/edit">
                            {!! csrf_field() !!}
                            <div class="row">
                                <input type="hidden" id="id" name="id" value="{{$user->id}}">
                                <div class="form-group col-lg-6 mb-0">
                                    <label for="name">Nome Completo</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{$user->name}}" placeholder="Digite seu nome completo corretamente"
                                           disabled>
                                </div>
                                <div class="form-group col-lg-6 col-sm-12 col-md-12 mb-0">
                                    <div class="form-group">
                                        <label>Tipo do Documento</label>
                                        <select class="form-control select2 state" name="document_type"
                                                style="width: 100%;" disabled>
                                            <option selected="selected">CPF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fas fa-envelope-open"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="Digite o email da sua conta"
                                               value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                    <label for="document">Documento</label>
                                    <input type="text" class="form-control" id="document" name="document"
                                           value="{{$user->cpf}} " data-inputmask='"mask": "999.999.999-99"'
                                           data-mask
                                           placeholder="Documento de identificação" disabled>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                    <label for="branch_name">Filial</label>
                                    <select class="form-control state" name="branchid" style="width: 100%;">
                                        @foreach($branches as $branch)
                                            @if(\Illuminate\Support\Facades\Cookie::get('branch_id'))
                                                @if($branch->id == \Illuminate\Support\Facades\Cookie::get('branch_id'))
                                                    <option selected value="{{$branch->id}}">{{$branch->name}}</option>
                                                @else
                                                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                @endif
                                            @else
                                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                    <label for="is_adm">Tipo de Usuário</label>
                                    <select class="form-control state" name="admin"
                                            style="width: 100%;">
                                        <option value="1" selected="selected">Administrador</option>
                                        <option value="0">Funcionário</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                    <label for="password">Nova Senha</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                        </div>
                                        <input type="password" id="password" class="form-control" name="password"
                                               placeholder="Nova senha"
                                               value="">
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-6">
                                    <label for="confirm_password">Confirmar Nova Senha</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                                        </div>
                                        <input type="password" id="confirm_password" class="form-control"
                                               name="confirm_password" placeholder="Confirme sua nova senha"
                                               value="">
                                    </div>
                                </div>
                            </div>
                            <div class="card- pl-0">
                                <button type="submit" class="btn btn-dark">Redefinir Senha</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
