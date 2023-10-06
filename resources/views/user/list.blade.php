@extends('layouts.header')
@section('content-header')
    <div class="container-fluid">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Funcionários</h3>
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
                                <th>Data de  Criação</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->created_at->format( 'd-m-Y' )}}</td>
                                    <td>{{$user->cpf}}</td>
                                    <td>{{$user->email}}</td>
                                    @if($user->admin==1)
                                        <td>Administrador</td>
                                    @else
                                        <td>Funcionário</td>
                                    @endif
                                    <td class="table-options itens-pointer">
                                        <a data-toggle="modal" data-target="#modal-default" onclick="viewUser({{$user}}, 1,'{{$user->created_at->format( 'd-m-Y' )}}')">
                                            <i class="fas fa-2x fa-trash-alt"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#modal-default" onclick="viewUser({{$user}}, 2,'{{$user->created_at->format( 'd-m-Y' )}}')">
                                            <i class="fas fa-2x fa-eye"></i>
                                        </a>
                                        <a href="/user/edit/{{$user->id}}">
                                            <i class="fas fa-2x fa-pen-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Data de  Criação</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Tipo</th>
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
        <script>
            function viewUser(user, type, formatData){
                $('.modal-body').html(
                    '<ul>'+
                    '<li> <b>ID:</b> ' + user.id + '</li>'+
                    '<li> <b>Nome:</b> ' + user.name + '</li>'+
                    '<li> <b>Data de Criação:</b>  ' + formatData+ '</li>'+
                    '<li> <b>CPF:</b>  ' + user.cpf + '</li>'+
                    '<li> <b>E-mail:</b>  ' + user.email + '</li>'+
                    '<li> <b>Tipo:</b>  ' + (user.admin == 1 ? 'Administrador' : 'Funcionário')  + '</li>'+
                    '<li> <b>Filial:</b> ' + user.branch.name + '</li>' +
                    '</ul>'
                );
                //1 = Delete
                //2 = View
                if(type == 1) {
                    $('.modal-title').html("Deletar Funcionário");
                    $('.delete-user').show();
                    $('#user_id').val(user.id);
                }
                else {
                    $('.modal-title').html("Visualizar Funcionário");
                    $('.delete-user').hide();
                    $('#user_id').val(user.id);
                }
            }
        </script>
    </div>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form method="post" action="/user/delete">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" id="user_id">
                        <button type="submit" class="btn btn-danger delete-user">Deletar</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

