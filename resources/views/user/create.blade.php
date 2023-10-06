@extends('layouts.header')
@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Dados do Funcionário</h3>
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span class="badge badge-primary">Total de Funcionários: {{$userCount}}</span>
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
                        <form method="post" action="/user/create">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nome Completo</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name')}}" placeholder="Digite seu nome">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>CPF</label>
                                        <input type="text" class="form-control" name="cpf"
                                               value="{{old('CPF')}}"
                                               data-inputmask='"mask": "999.999.999-99"'
                                               data-mask>
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
                                                   value="{{old('email')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Senha</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password"
                                                   value="{{old('password')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Tipo de Usuário</label>
                                        <select class="form-control state" name="admin"
                                                style="width: 100%;">
                                            <option value="1" selected="selected">Administrador</option>
                                            <option value="0">Funcionário</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Lista de Filiais</label>
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
                                </div>
                            </div>
                            <div class="card-footer pl-0">
                                <button type="submit" class="btn btn-dark">Cadastrar Funcionário</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

