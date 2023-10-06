@extends('layouts.header')

@section('content-header')
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Produtos</h3>
                    </div>
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
                                <th>Preço de custo</th>
                                <th>Preço de venda</th>
                                <th>Quantidade</th>
                                <th>Categoria</th>
                                <th>Fornecedor</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($products) > 0)
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>R${{$product->cost}}</td>
                                        <td>R${{$product->price}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>{{$product->Category->name}}</td>
                                        <td>{{$product->Provider->name}}</td>

                                        <td class="table-options itens-pointer">
                                            <a data-toggle="modal" data-target="#modal-default" onclick="viewProduct({{$product}},1)">
                                                <i class="fas fa-2x fa-trash-alt"></i>
                                            </a>
                                            <a data-toggle="modal" data-target="#modal-default" onclick="viewProduct({{$product}},2)">
                                                <i class="fas fa-2x fa-eye"></i>
                                            </a>
                                            <a href="/product/edit/{{$product->id}}">
                                                <i class="fas fa-2x fa-pen-square"></i>
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
                                <th>Preço de custo</th>
                                <th>Preço de venda</th>
                                <th>Quantidade</th>
                                <th>Categoria</th>
                                <th>Fornecedor</th>
                                <th>Opções</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <script>
            function viewProduct(produto, valor){
                $('.modal-body').html(
                    '<ul>'+
                    '<li><b>Nome: </b>' + produto.name + '</li>'+
                    '<li><b>Preço de Custo: </b>R$' + produto.cost + '</li>'+
                    '<li><b>Preço de Venda: </b>R$' + produto.price + '</li>'+
                    '<li><b>Quantidade: </b>' + produto.quantity + '</li>'+
                    '<li><b>Categoria: </b>' + produto.category.name + '</li>'+
                    '<li><b>Fornecedor: </b>' + produto.provider.name + '</li>'+
                    '<li><b>Descrição: </b>' + produto.description + '</li>'+
                    '<li><b>Usuário que fez a última alteração: </b>'+ produto.user.name+ '</li>'+
                    '</ul>'
                );
                //deletar - 1
                //ver - 2
                if(valor == 1){
                    $('.modal-title').html("Deletar Produto");
                    $('.delete-product').show();
                    $('#product_id').val(produto.id);
                }
                else{
                    $('.modal-title').html("Visualizar Produto");
                    $('.delete-product').hide();
                    $('#product_id').val(produto.id);
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
                        <form method="post" action="/product/delete">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" id="product_id">
                            <button type="submit" class="btn btn-danger delete-product">Deletar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
