@extends('layouts.header')
@section('content-header')
    <div class="container-fluid">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Filiais</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <input type="hidden" name="bcount" id="bcount" value="{{$branchCount}}">
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
                                <th>Data de Criação</th>
                                <th>Cidade</th>
                                <th>Estado</th>
                                <th>Status</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($branchs as $branch)
                                <tr>
                                    <input type="hidden" id="i{{$branch->id}}" value="{{$branch->deleted_at}}">
                                    <td>{{$branch->id}}</td>
                                    <td>{{$branch->Address->district}}</td>
                                    <td>{{$branch->created_at->format( 'd-m-Y' )}}</td>
                                    @foreach($cities as $city)
                                        @if($branch->Address->City->id == $city->id)
                                            <td>{{$city->name}}</td>
                                        @endif
                                    @endforeach
                                    @foreach($states as $state)
                                        @if($branch->Address->City->State->id == $state->id)
                                            <td>{{$state->name}}
                                            </td>
                                        @endif
                                    @endforeach
                                    <td><input id="{{$branch->id}}" class="switch-qb"type="checkbox" checked data-toggle="toggle" data-on="Ativada" data-off="Desativada" data-onstyle="success" data-offstyle="danger"></td>
                                    <td class="table-options itens-pointer">
                                        <a data-toggle="modal" data-target="#modal-default" onclick="viewBranch({{$branch}},'{{$branch->created_at->format( 'd-m-Y' )}}')">
                                            <i class="fas fa-2x fa-eye itens-pointer"></i>
                                        </a>
                                        <a href="/branch/edit/{{$branch->id}}">
                                            <i class="fas fa-2x fa-pen-square itens-pointer"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Data de Criação</th>
                                <th>Cidade</th>
                                <th>Estado</th>
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
                        <form method="post" action="/branch/delete">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" id="branch_id">
                            <button type="submit" class="btn btn-danger delete-branch">Deletar</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function viewBranch(branch, formatData){
            console.log(branch);
            $('.modal-body').html(
                '<ul>'+
                '<li> <b>ID:</b> ' + branch.id + '</li>'+
                '<li> <b>Nome:</b> ' + branch.name + '</li>'+
                '<li> <b>Data de Criação:</b>  ' + formatData+ '</li>'+
                '<li> <b>Cidade:</b>  ' + branch.address.city.name+ '</li>'+
                '<li> <b>Estado:</b>  ' + branch.address.city.state.name+ '</li>'+
                '<li> <b>Rua:</b>  ' + branch.address.street+ '</li>'+
                '<li> <b>Número:</b>  ' + branch.address.number+ '</li>'+
                '<li> <b>Ponto de Referência:</b>  ' + branch.address.reference+ '</li>'+
                '<li> <b>Status:</b>  ' + (branch.deleted_at == null ? 'Ativada' : 'Desativada')  +  '</li>'+
                '</ul>'
            );
            $('.modal-title').html("Visualizar Filial");
            $('.delete-branch').hide();
            $('#branch_id').val(branch.id);

        }
        (function ($) {
            'use strict';
            let count = document.getElementById('bcount').value;
            function preventDef(event) {
                event.preventDefault();
            }
            $(document).ready(function () {
                var url = "/branch/listAjax/";
                $.ajax(url, {
                    method: "GET",
                    success: function (element) {
                        element.branch.forEach(function (item) {
                          if(item.deleted_at != null){
                              $('#'+item.id).prop('checked', false).change();
                              document.getElementById(item.id).addEventListener("change",preventDef, false);
                          }
                        });
                    },
                    error: function (element) {
                        console.log(element);
                    }
                });

            });
            $('.switch-qb').change(function(e) {
                let id =  e.target.id;
                var url = "/branch/delete/"+id;
                $.ajax(url, {
                    method: "POST",
                    success: function (e) {
                        console.log(e);
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });
        })(jQuery);
    </script>
@endsection
