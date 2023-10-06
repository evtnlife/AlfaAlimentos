@extends('layouts.header')

@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Cadastrar kit</h3>
                        <div class="card-tools">
                            <span class="badge badge-primary">Total de kits: {{$kits}}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success kit-alert">

                        </div>
                        @if(session('status'))
                            <div class="alert alert-success">
                                <p>{{session('status')}}</p>
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="kit-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name">Nome do kit</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                       placeholder="Nome do kit"/>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="description">Descrição</label>
                                        <input type="text" class="form-control" id="description" name="description"
                                               placeholder="Descrição do Kit"/>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Produtos do kit</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="category">Categoria</label>
                                        <select class="form-control select2 category" id="category" style="width: 100%">
                                            <option selected="selected">Selecione uma categoria.</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="product">Produtos</label>
                                        <select class="form-control select2 products" name="product"
                                                style="width: 100%">
                                            <option selected="selected">Selecione um Produto.</option>
                                        </select>
                                        <span id="products-error" class="error invalid-feedback">Selecione um Produto.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <hr/>
                                    <h5>Produto Selecionado</h5>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="product_id">ID</label>
                                        <input type="number" disabled class="product_id form-control"
                                               id="product_id">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="cost">Custo do Produto</label>
                                        <input class="form-control cost" disabled id="cost">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="price">Valor de Venda</label>
                                        <input class="form-control price" disabled id="price">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="quantity_storage">Qtd. em Estoque</label>
                                        <input class="form-control quantity_storage" disabled id="quantity_storage">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="quantity">Qtd. a adicionar</label>
                                        <input type="number" class="form-control quantity" min="1" id="quantity">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="d-flex pt-3 m-1">
                                        <button class="btn btn-dark mt-2 btn-add-product" style="width: 100%">Adicionar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #e9ecef;">
                                            <h3 class="card-title"><b>Lista de Produtos já adicionados no kit</b></h3>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-responsive table-bordered">
                                                <thead>
                                                <tr>
                                                    <th style="min-width: 100px">ID</th>
                                                    <th style="width: 100%">Nome do Produto</th>
                                                    <th style="min-width: 100px">Quantidade</th>
                                                    <th style="min-width: 160px">Custo</th>
                                                    <th style="min-width: 160px">Valor Venda</th>
                                                    <th style="min-width: 60px">#</th>
                                                </tr>
                                                </thead>
                                                <tbody class="product-data">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <hr/>
                                    <h5>Detalhes finais do Kit</h5>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="qtdProd">Qtd. de Produtos no Kit</label>
                                        <input type="number" class="form-control" id="qtdProd" name="qtdProd" disabled
                                               step="0.01" min="0.01"/>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="total_cost">Preço de custo total</label>
                                        <input type="number" class="form-control" id="total_cost" name="cost" disabled
                                               step="0.01" min="0.01"/>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="total_price">Preço de venda</label>
                                        <input type="number" class="form-control" id="total_price" step="0.01"
                                               min="0.01"
                                               name="price"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-dark btn-cadastrar" style="width: 300px">Cadastrar kit
                                    </button>
                                </div>
                                <div class="col-lg-6">
                                    <div class="alert alert-danger errors">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function ($) {
            'use strict';
            $(document).ready(function () {
                $('.errors').hide();
                $('.kit-alert').hide();
            });
            $('.btn-cadastrar').click(function () {
                MontaObjetoKit();
            });

            //Evento Click de adicionar produto na tabela de produtos
            $('.btn-add-product').click(function () {
                let product = {
                    id: $('.product_id').val(),
                    qtd: $('.quantity').val(),
                    price: $('.price').val(),
                    cost: $('.cost').val(),
                    name: $('.products').select2('data')[0] != null ? $('.products').select2('data')[0].text : "",
                };
                if(product.id === "" || product.name === "") {
                    $(".invalid-feedback").html("Selecione um produto");
                    $('.products').addClass('is-invalid');
                    return;
                }
                if (product.qtd === "" && product.id !== "" ) {
                    $(".invalid-feedback").html("Quantidade invalida");
                    $('.products').addClass('is-invalid');
                    return;
                }
                let listProduct = ProductTableToArray();
                if (listProduct.length > 0) {
                    let insertionControl = true;
                    $.each(listProduct, function () {
                        if (this.id === product.id) {
                            if (parseInt(this.qtd) + parseInt(product.qtd) > $('.quantity_storage').val()) {
                                $('.invalid-feedback').html('Quantidade não disponivel em estoque.');
                                $('.products').addClass('is-invalid');
                                $('.products').val(0).trigger('change');
                                insertionControl = false;
                            } else {
                                this.qtd = parseInt(this.qtd) + parseInt(product.qtd);
                                insertionControl = false;
                            }
                        }
                    });
                    if (insertionControl) {
                        listProduct.push(product);
                    }
                } else {
                    listProduct = [];
                    if (parseInt(product.qtd) > $('.quantity_storage').val()) {
                        $('.invalid-feedback').html('Quantidade não disponivel em estoque.');
                        $('.products').addClass('is-invalid');
                        $('.products').val(0).trigger('change');
                        return;
                    }
                    listProduct.push(product);
                }
                let body_data = '';
                let total = 0.00;
                $.each(listProduct, function () {
                    body_data += ' <tr><td>' + this.id + '</td>\n' +
                        '<td>' + this.name + '</td>\n' +
                        '<td>' + this.qtd + '</td>\n' +
                        '<td>' + this.cost + '</td>\n' +
                        '<td>' + this.price + '</td>\n' +
                        '<td><i class="fas fa-trash remove-product" style="color:black"></i></td></tr>';
                });

                $('.product-data').html(body_data);
                $('.price').attr('value', '');
                $('.cost').attr('value', '');
                $('.quantity').val(1);
                $('.quantity_storage').attr('value', '');
                $('.product_id').attr('value', '');
                $('.products').val(0).trigger('change');
                calculaTotalEmProdutos();
            });

            //Evento change do select de categoria
            $('.category').change(function () {
                var id = $(this).val();
                $('.products').empty().trigger("change");
                var newOption = new Option("Selecione um Produto.", "");
                $('.products').append(newOption).trigger('change');
                $.ajax({
                    url: "/api/product/category/" + id,
                    method: "GET",
                    success: function (element) {
                        element.products.forEach(function (item) {
                            newOption = new Option(item.name, item.id);
                            $('.products').append(newOption).trigger('change');
                        });
                        $('.price').attr('value', '');
                        $('.quantity_storage').attr('value', '');
                        $('.product_id').attr('value', '');
                    },
                    error: function (element) {
                        console.log(element);
                    }
                });
            });

            /**
             * Evento change do select de produtos
             */
            $('.products').change(function () {
                var id = $(this).val();
                if (id != null && id !== "") {
                    $.ajax({
                        url: "/api/product/" + id,
                        method: "GET",
                        success: function (element) {
                            if (element.product != null) {
                                $('.price').attr('value', element.product.price);
                                $('.cost').attr('value', element.product.cost);
                                $('.quantity_storage').attr('value', element.product.quantity);
                                $('.product_id').attr('value', element.product.id);
                            } else {
                                $('.price').attr('value', "");
                                $('.quantity_storage').attr('value', "");
                                $('.product_id').attr('value', "");
                                $('.cost').attr('value', "");
                            }
                        },
                        error: function (element) {
                            console.log(element);
                        }
                    });
                }
            });

            /**
             * Evento click de remover um produto da tabela
             */
            $('table').on('click', '.remove-product', function () {
                $(this).closest('tr').remove();
            });

            /**
             * Transforma tabela de produtos em um array tipado
             */
            function ProductTableToArray() {
                let productList = [];
                $('.product-data > tr').each(function (index, value) {
                    let product = {
                        id: 0,
                        name: '',
                        qtd: 0,
                        cost: 0,
                        price: 0
                    };
                    let counter = 0;
                    $(this).find('td').each(function () {
                        switch (counter++) {
                            case 0:
                                product.id = $(this).text();
                                break;
                            case 1:
                                product.name = $(this).text();
                                break;
                            case 2:
                                product.qtd = $(this).text();
                                break;
                            case 3:
                                product.cost = $(this).text();
                                break;
                            case 4:
                                product.price = $(this).text();
                                break;
                        }
                    });
                    productList.push(product);
                });
                return productList;
            }

            /**
             *Calcula total na janela
             */
            function calculaTotalEmProdutos() {
                let produtos = ProductTableToArray();
                let custo = 0;
                let total = 0;
                let qtdProduct = 0;
                $.each(produtos, function () {
                    custo += (parseInt(this.qtd) * parseFloat(this.cost));
                    total += (parseInt(this.qtd) * parseFloat(this.price));
                    qtdProduct += parseInt(this.qtd);
                });
                $('#total_price').val(total);
                $('#total_cost').val(custo);
                $('#qtdProd').val(qtdProduct);
            }

            /**
             * Envia requisição para o servidor
             * @return {void}
             */
            function MontaObjetoKit() {
                var obj = {
                    product_list: ProductTableToArray(),
                    total_cost: $('#total_cost').val(),
                    total_price: $('#total_price').val(),
                    name: $('#name').val(),
                    description: $('#description').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                };
                console.log(obj);
                if (ConsisteObjetoKit(obj)) {
                    //Esconde erros se existir
                    $('.errors').hide();
                    $.ajax({
                        url: "/kit/create",
                        method: "post",
                        data: obj,
                        success: function (element) {
                            console.log(element);
                            $('.kit-body').hide();
                            $('.kit-alert').show().html(element.status);
                        },
                        error: function (element) {
                            console.log(element);
                        }
                    });
                }
            }

            /**
             * Valida inputs antes de permitir envio para o servidor.
             * Também é responsavel pela exibição das mensagens de erro na janela
             * @return {boolean}
             */
            function ConsisteObjetoKit(obj) {
                let errors = [];
                let htmlstring = "<ul>";
                if (obj.name === "") {
                    errors.push("De um nome para o Kit.");
                }
                if(obj.description === "") {
                    errors.push("Digite uma descrição para o Kit.");
                }
                if (obj.product_list.length === 0) {
                    errors.push("Você deve adicionar ao menos um produto ao kit");
                }
                $.each(errors, function (item, value) {
                    htmlstring += "<li>" + this + "</li>";
                });
                htmlstring += "</ul>";
                $('.errors').html(htmlstring);
                $('.errors').show();
                return errors.length <= 0;
            }
        })(jQuery);
    </script>
@endsection
