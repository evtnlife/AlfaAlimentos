@extends('layouts.header')
@section('content-header')
    <div class="container-fluid">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Clientes</h3>
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
                                <th>Telefone</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>Status</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$client->id}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->phone}}</td>
                                    <td>{{$client->Address->district}}</td>
                                    @foreach($cities as $city)
                                        @if($client->Address->City->id == $city->id)
                                            <td>{{$city->name}}</td>
                                        @endif
                                    @endforeach
                                    <td class="status-align">
                                        @if($client->status == 'BOM')
                                            <i text ="testando" style="color:green; "class="fas fa-circle"></i>
                                        @elseif($client->status == 'REGULAR')
                                            <i style="color:yellow; "class="fas fa-circle"></i>
                                        @elseif($client->status == 'RUIM')
                                            <i style="color:red; "class="fas fa-circle"></i>
                                        @endif
                                    </td>
                                    <td class="table-options itens-pointer">
                                        <a data-toggle="modal" data-target="#modal-default" onclick="viewClient({{$client}}, 1)">
                                            <i class="fas fa-2x fa-trash-alt"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#modal-default" onclick="viewClient({{$client}}, 2)">
                                            <i class="fas fa-2x fa-eye"></i>
                                        </a>
                                        <a href="/client/edit/{{$client->id}}">
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
                                <th>Telefone</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>Status</th>
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
            function viewClient(cliente, type){

                    $('.modal-body').html(
                    '<ul>'+
                    '<li> <b>Nome:</b> ' + cliente.name + '</li>'+
                    '<li> <b>Telefone:</b>  ' + cliente.phone + '</li>'+
                    '<li> <b>Email:</b>  ' + cliente.email + '</li>'+
                    '<li> <b>Documento:</b>  ' + cliente.document + '</li>'+
                    '<li> <b>Tipo de Documento:</b>  ' + (cliente.document_type == 0 ? 'CPF' : 'CNPJ')  + '</li>'+
                    '<li> <b>Estado:</b>  ' + cliente.address.city.state.name + '</li>'+
                    '<li> <b>Cidade:</b>  ' + cliente.address.city.name + '</li>'+
                    '<li> <b>Bairro:</b>  ' + cliente.address.district + '</li>'+
                    '<li> <b>Referência:</b>  ' + cliente.address.reference + '</li>'+
                    '<li> <b>Rua:</b>  ' + cliente.address.street + '</li>'+
                    '<li> <b>Número:</b>  ' + cliente.address.number + '</li>'+
                    '<li> <b>Status:</b>  ' + cliente.status + '</li>'+
                    '<li> <b>Observação do Status:</b>  ' + cliente.observation + '</li>'+
                    '</ul>'
                );
                //1 = Delete
                //2 = View
                if(type == 1) {
                    $('.modal-title').html("Deletar Cliente");
                    $('.delete-client').show();
                    $('#client_id').val(cliente.id);
                }
                else {
                    $('.modal-title').html("Visualizar Cliente");
                    $('.delete-client').hide();
                    $('#client_id').val(cliente.id);
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
                        <form method="post" action="/client/delete">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" id="client_id">
                            <button type="submit" class="btn btn-danger delete-client">Deletar</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
@endsection

