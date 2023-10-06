@extends('layouts.header')
@section('content-header')
    <div class="container-fluid">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Fornecedores</h3>
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
                                <th>Tipo de Documento</th>
                                <th>Documento</th>
                                <th>E-mail</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($providers as $provider)
                                <tr>
                                    <td>{{$provider->id}}</td>
                                    <td>{{$provider->name}}</td>
                                    <td>{{$provider->created_at->format( 'd-m-Y' )}}</td>
                                    <td>{{$provider->document_type}}</td>
                                    <td>{{$provider->document}}</td>
                                    <td>{{$provider->email}}</td>
                                    <td class="table-options itens-pointer">
                                        <a data-toggle="modal" data-target="#modal-default" onclick="viewProvider({{$provider}}, 1,'{{$provider->created_at->format( 'd-m-Y' )}}')">
                                            <i class="fas fa-2x fa-trash-alt"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#modal-default" onclick="viewProvider({{$provider}}, 2,'{{$provider->created_at->format( 'd-m-Y' )}}')">
                                            <i class="fas fa-2x fa-eye"></i>
                                        </a>
                                        <a href="/provider/edit/{{$provider->id}}">
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
                                <th>Tipo de Documento</th>
                                <th>Documento</th>
                                <th>E-mail</th>
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
            function viewProvider(provider, type, formatData){

                $('.modal-body').html(
                    '<ul>'+
                    '<li> <b>ID:</b> ' + provider.id + '</li>'+
                    '<li> <b>Nome:</b> ' + provider.name + '</li>'+
                    '<li> <b>Data de Criação:</b>  ' + formatData+ '</li>'+
                    '<li> <b>Descrição:</b>  ' + provider.description + '</li>'+
                    '<li> <b>Tipo de Documento:</b>  ' + provider.document_type + '</li>'+
                    '<li> <b>Documento:</b> ' + provider.document + '</li>'+
                    '<li> <b>Telefone:</b> ' + provider.phone + '</li>'+
                    '<li> <b>E-mail:</b> ' + provider.email + '</li>'+
                    '<li> <b>Responsável:</b> ' + provider.responsible + '</li>'+
                    '<li> <b>Usuário que fez a última alteração:</b> ' + provider.user.name + '</li>'+
                    '</ul>'
                );
                //1 = Delete
                //2 = View
                if(type == 1) {
                    $('.modal-title').html("Deletar Fornecedor");
                    $('.delete-provider').show();
                    $('#provider_id').val(provider.id);
                }
                else {
                    $('.modal-title').html("Visualizar Fornecedor");
                    $('.delete-provider').hide();
                    $('#provider_id').val(provider.id);
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
                    <form method="post" action="/provider/delete">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" id="provider_id">
                        <button type="submit" class="btn btn-danger delete-provider">Deletar</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

