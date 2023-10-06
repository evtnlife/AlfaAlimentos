@extends('layouts.header')

@section('content-header')
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Lista de kits</h3>
                    </div>
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success">
                                <p>{{session('status')}}</p>
                            </div>
                        @endif
                        <table id="datatable" class="table table-bordered datatable table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Preço de venda</th>
                                <th>Preço de custo</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($kits)>0)
                                @foreach($kits as $kit)
                                    <tr>
                                        <td>{{$kit->id}}</td>
                                        <td>{{$kit->name}}</td>
                                        <td>R${{$kit->price}}</td>
                                        <td>R${{$kit->cost}}</td>
                                        <td class="table-options itens-pointer">
                                            <a data-toggle="modal" data-target="#modal-default"
                                               onclick="viewKit({{$kit}},1)">
                                                <i class="fas fa-2x fa-trash-alt"></i>
                                            </a>
                                            <a data-toggle="modal" data-target="#modal-default"
                                               onclick="viewKit({{$kit}},2)">
                                                <i class="fas fa-2x fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Preço de venda</th>
                                <th>Preço de custo</th>
                                <th>Opções</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </section>
        <script>
            function viewKit(kit, valor) {
                let products = '';
                $.each(kit.products, function (index, value) {
                    products +=
                        '<tr>' +
                        '<td>'+value.product.name+'</td>' +
                        '<td>'+value.quantity+'</td>' +
                        '<td>R$'+value.product.price+'</td>' +
                        '<td>'+value.user.name+'</td>' +
                        '</tr>';
                });


                let body = '<ul>' +
                    '<li><b>Nome: </b>' + kit.name + '</li>' +
                    '<li><b>Descrição: </b>' + kit.description + '</li>' +
                    '<li><b>Preço: </b>R$' + kit.price + '</li>' +
                    '<li><b>Usuário: </b>' + kit.user.name + '</li>' +
                    '</ul>' +
                    '<hr/>' +
                    '<p><b>Produtos</b></p>' +
                    '<table class="table table-bordered">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Nome</th>' +
                    '<th>Quantidade</th>' +
                    '<th>Valor</th>' +
                    '<th>Usuário</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' + products + '</tbody>'+
                    '</table>';

                $('.modal-body').html(body);
                //deletar - 1
                //ver - 2
                if (valor == 1) {
                    $('.modal-title').html("Deletar Kit");
                    $('.delete-kit').show();
                    $('#kit_id').val(kit.id);
                } else {
                    $('.modal-title').html("Visualizar Kit");
                    $('.delete-kit').hide();
                    $('#kit_id').val(kit.id);
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
                        <form method="post" action="/kit/delete">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" id="kit_id">
                            <button type="submit" class="btn btn-danger delete-kit">Deletar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
