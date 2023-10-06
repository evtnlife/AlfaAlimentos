@extends('layouts.header')
@section('content-header')
    <div class="container-fluid">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Categorias</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                <p>{{session('status')}}</p>
                            </div>
                        @endif
                        <table id="datatable" class="table table-bordered table-striped datatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Usuário</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            @foreach($categories as $category)
                                <tbody>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->description}}</td>
                                    <td>{{$category->User->name}}</td>
                                    <td class="table-options itens-pointer">
                                        <a data-toggle="modal" data-target="#modal-default" onclick="viewCategory({{$category}}, 1)">
                                            <i class="fas fa-2x fa-trash-alt"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#modal-default" onclick="viewCategory({{$category}}, 2)">
                                            <i class="fas fa-2x fa-eye"></i>
                                        </a>
                                        <a href="/category/edit/{{$category->id}}">
                                            <i class="fas fa-2x fa-pen-square"></i>
                                        </a>
                                    </td>
                                </tbody>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Usuário</th>
                                    <th>Opções</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </section>
        <script >
            function viewCategory(categoria, type){
                $('.modal-body').html(
                    '<ul>'+
                    '<li> <b>ID:</b> ' + categoria.id + '</li>'+
                    '<li> <b>Nome:</b> ' + categoria.name + '</li>'+
                    '<li> <b>Descrição:</b>  ' + categoria.description + '</li>'+
                    '<li> <b>Usuário que fez a última alteração:</b>  ' + categoria.user.name + '</li>'+
                    '</ul>'
                );
                //1 = Delete
                //2 = View
                if(type == 1) {
                    $('.modal-title').html("Deletar Categoria");
                    $('.delete-category').show();
                    $('#category_id').val(categoria.id);
                }
                else {
                    $('.modal-title').html("Visualizar Categoria");
                    $('.delete-category').hide();
                    $('#category_id').val(categoria.id);
                }
            }
        </script>
        <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <form method="post" action="/category/delete">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" id="category_id" value="{{$category->id}}">
                            <button type="submit" class="btn btn-danger delete-category">Deletar</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
@endsection
