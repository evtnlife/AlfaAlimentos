@extends('layouts.header')

@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Dados de Categorias</h3>
                        <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span class="badge badge-primary">Total de Categorias: {{$categoryCount}}</span>
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
                        <form method="post" action="/category/edit">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" value="{{$category->id}}">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nome da Categoria</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{$category->name}}" placeholder="Digite o nome da categoria">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="description">Descrição</label>
                                        <textarea type="text" class="form-control desc-produto" name="description"
                                                  placeholder="Dê um breve resumo da categoria" id="description"
                                                  rows="3">{{$category->description}}
                                            </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card- pl-0">
                                <button type="submit" class="btn btn-dark">Editar Categoria</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
