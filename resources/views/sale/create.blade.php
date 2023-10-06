@extends('layouts.header')

@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Venda</h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success sale-alert">
                        </div>
                        <div class="container-fluid sale-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="client">Cliente</label>
                                        <select class="form-control select2 client" name="client" style="width: 100%">
                                            <option>Selecione um cliente.</option>
                                            @foreach($clients as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                        </select>
                                        <a class="btn btn-primary mt-2" href="/client/create"> Adicionar Cliente</a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="category">Categoria</label>
                                        <select class="form-control select2 category" id="category" style="width: 100%">
                                            <option value="0" selected="selected">Selecione uma categoria.</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <div style="width: 10%" class="d-block">
                                                <label for="product_id">ID</label>
                                                <input type="number" disabled class="form-control product_id"
                                                       id="product_id"
                                                       style="width: 100%">
                                            </div>
                                            <div style="width: 90%">
                                                <label for="product" class="product_label">Produtos</label>
                                                <select id="products" class="form-control select2 products"
                                                        name="product" style="width: 100%">
                                                </select>
                                                <span id="products-error" class="error invalid-feedback">Selecione um Produto.</span>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button class="btn btn-primary mt-2 btn-add-product">Adicionar Produto
                                            </button>
                                            <div class="mt-2 pl-2">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="rbKit" name="rbProductType" value="true">
                                                    <label for="rbKit">
                                                        Kit
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="rbProduct" name="rbProductType"
                                                           value="false"
                                                           checked="checked">
                                                    <label for="rbProduct">
                                                        Produto
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="valor">Valor</label>
                                        <input class="form-control price" disabled name="valor">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="quantity">Qtd. em Estoque</label>
                                        <input type="number" class="form-control quantity_storage" disabled
                                               name="quantity">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="quantity">Quantidade</label>
                                        <input type="number" class="form-control quantity" name="quantity" value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header" style="background-color: #e9ecef;">
                                            <h3 class="card-title"><b>Lista de Produtos</b></h3>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-responsive table-bordered">
                                                <thead>
                                                <tr>
                                                    <th style="min-width: 160px">Produto/Kit ID</th>
                                                    <th style="min-width: 120px">É Kit?</th>
                                                    <th style="width: 100%">Nome do Produto</th>
                                                    <th style="min-width: 60px">Quantidade</th>
                                                    <th style="min-width: 160px">Valor Unidade</th>
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
                                    <div class="card">
                                        <div class="card-header" style="background-color: #e9ecef;">
                                            <h3 class="card-title"><b>Detalhes da Compra</b></h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <h4>Desconto</h4>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label for="product">Tipo de Desconto</label>
                                                            <div class="form-group clearfix">
                                                                <div class="icheck-primary d-inline">
                                                                    <input type="radio" id="rbFixo"
                                                                           name="rbDiscountType" value="true"
                                                                           checked="true">
                                                                    <label for="rbFixo">
                                                                        Fixo
                                                                    </label>
                                                                </div>
                                                                <div class="icheck-primary d-inline">
                                                                    <input type="radio" id="rbPorcentagem"
                                                                           name="rbDiscountType" value="false">
                                                                    <label for="rbPorcentagem">
                                                                        Porcentagem
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label for="discount">Desconto</label>
                                                            <input type="number" name="discount" min="0" value="0"
                                                                   class="form-control discount"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <h4>Tipo de Pagamento</h4>
                                                    <label for="payment_type">Forma de Pagamento</label>
                                                    <select class="form-control payment-method" style="width: 100%">
                                                        <option value="0">Selecione a forma de Pagamento</option>
                                                        <option value="AV">A vista</option>
                                                        <option value="CC">Cartão de Crédito</option>
                                                        <option value="PA">Parcelado</option>
                                                        <option value="EP">Entrada + Parcelado</option>
                                                    </select>
                                                    <hr/>
                                                    <h4 class="PA-Header" style="display: none">Parcelamento</h4>
                                                    <h4 class="EP-Header" style="display: none">Parcelamento com
                                                        Entrada</h4>
                                                    <div class="form-group EP col-lg-12" style="display: none">
                                                        <label>Valor de Entrada</label>
                                                        <input type="number" class="form-control entrada "
                                                               name="entrada"
                                                               min="0.01" step="0.01">
                                                    </div>
                                                    <div class="form-group PA col-lg-12" style="display: none">
                                                        <label>Quantidade de Vezes</label>
                                                        <input type="number" class="form-control qtd_parcels"
                                                               name="qtd_parcels">
                                                    </div>
                                                    <div class="form-group PA col-lg-12" style="display: none">
                                                        <label>Data de Início:</label>
                                                        <input class="filter form-control" type="date" id="InicialDate" name="dth_ini"
                                                               value="01/01/2020"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <h4>Detalhes da compra</h4>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Item</th>
                                                            <th scope="col">Valor</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">Total em Produtos</th>
                                                            <td class="total_without_discount"></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Total desconto</th>
                                                            <td class="total_discount"></td>
                                                        </tr>
                                                        <tr class="EP" style="display: none">
                                                            <th scope="row">Valor entrada</th>
                                                            <td class="total_valor_entrada"></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Total a pagar</th>
                                                            <td class="total_with_discount"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="alert alert-danger errors">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <button type="submit" class="btn btn-dark btn-vender">Concluir Venda</button>
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
                var newOption = new Option("Selecione um Produto.", "0");
                $('.products').append(newOption).trigger('change');
                $('.errors').hide();
                $('.sale-alert').hide();
            });

            //Evento change do input de desconto
            $(".discount").change(function () {
                calculaTotalEmProdutos();
            });
            //Evento change do input de entrada
            $(".entrada").change(function () {
                calculaTotalEmProdutos();
            });

            $("#rbFixo").click(function () {
                $('#rbPorcentagem').removeAttr('checked');
                $('#rbFixo').attr('checked', 'checked');
                calculaTotalEmProdutos();
            });
            $("#rbPorcentagem").click(function () {
                $('#rbFixo').removeAttr('checked');
                $('#rbPorcentagem').attr('checked', 'checked');
                calculaTotalEmProdutos();
            });

            //Evento click de troca de produtoo para kit
            $('#rbKit').click(function () {
                $('#rbProduct').removeAttr('checked');
                $('#rbKit').attr('checked', 'checked');
                $('.product_label').html('Kits');
                $('.invalid-feedback').html('Selecione um Kit');

                $('.category').attr('disabled', 'disabled');
                $('.category').val(0).trigger('change');
                $('.products').empty().trigger("change");
                var newOption = new Option("Selecione um Kit.", "0");
                $('.products').append(newOption).trigger('change');
                $.ajax({
                    url: "/api/kit/all",
                    method: "GET",
                    success: function (element) {
                        element.kits.forEach(function (item) {
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

            //Evento click de troca de kit para produto
            $('#rbProduct').click(function () {
                $('#rbKit').removeAttr('checked');
                $('#rbProduct').attr('checked', 'checked');
                $('.product_label').html('Produtos');
                $('.invalid-feedback').html('Selecione um Produto');
                $('.products').empty().trigger("change");
                var newOption = new Option("Selecione um Produto.", "0");
                $('.products').append(newOption).trigger('change');
                $('.category').val(0).trigger('change');
                $('.category').removeAttr('disabled');
            });

            //Evento Click de adicionar produto na tabela de produtos
            $('.btn-add-product').click(function () {
                let product = {
                    id: $('.product_id').val(),
                    qtd: $('.quantity').val(),
                    price: $('.price').val(),
                    name: $('.products').select2('data')[0].text,
                    isKit: $('#rbKit').attr('checked') !== undefined ? "Sim" : "Não"
                };

                if (product.id === "" || product.qtd === "" || product.price === "") {
                    $('.products').addClass('is-invalid');
                    if ($('#rbProduct').attr('checked') !== undefined) {
                        $('.invalid-feedback').html('Selecione um Produto');
                    } else {
                        $('.invalid-feedback').html('Selecione um Kit');
                    }
                    return;
                } else {
                    $('.products').removeClass('is-invalid');
                }
                let listProduct = ProductTableToArray();
                if (listProduct.length > 0) {
                    let insertionControl = true;
                    $.each(listProduct, function () {
                        if (this.id === product.id && this.isKit === product.isKit) {
                            if (parseInt(this.qtd) + parseInt(product.qtd) > $('.quantity_storage').val() && !product.isKit) {
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
                    if (parseInt(product.qtd) > $('.quantity_storage').val() && !product.isKit) {
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
                        '<td>' + this.isKit + '</td>\n' +
                        '<td>' + this.name + '</td>\n' +
                        '<td>' + this.qtd + '</td>\n' +
                        '<td>' + this.price + '</td>\n' +
                        '<td><i class="fas fa-trash remove-product" style="color:black"></i></td></tr>';
                });

                $('.product-data').html(body_data);
                $('.price').attr('value', '');
                $('.quantity').val(1);
                $('.quantity_storage').attr('value', '');
                $('.product_id').attr('value', '');
                $('.products').val(0).trigger('change');
                calculaTotalEmProdutos();
            });

            //Evento change do metodo de pagemento
            $('.payment-method').change(function () {
                //Reset Form
                $(".EP").hide();
                $(".PA").hide();
                $(".EP-Header").hide();
                $(".PA-Header").hide();

                // Show Inputs
                if ($(this).val() == "EP")
                    $(".EP").show();
                if ($(this).val() == "PA" || $(this).val() == "EP")
                    $(".PA").show();

                //Show Headers
                if ($(this).val() == "EP")
                    $(".EP-Header").show();
                else if ($(this).val() == "PA")
                    $(".PA-Header").show();
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
                    if ($('#rbProduct').attr('checked') !== undefined) {
                        $.ajax({
                            url: "/api/product/" + id,
                            method: "GET",
                            success: function (element) {
                                if (element.product != null) {
                                    $('.price').attr('value', element.product.price);
                                    $('.quantity_storage').attr('value', element.product.quantity);
                                    $('.product_id').attr('value', element.product.id);
                                } else {
                                    $('.price').attr('value', "");
                                    $('.quantity_storage').attr('value', "");
                                    $('.product_id').attr('value', "");
                                }
                            },
                            error: function (element) {
                                console.log(element);
                            }
                        });
                    } else {
                        $.ajax({
                            url: "/api/kit/" + id,
                            method: "GET",
                            success: function (element) {
                                if (element.kit != null) {
                                    $('.price').attr('value', element.kit.price);
                                    $('.quantity_storage').attr('value', element.kit.quantity);
                                    $('.product_id').attr('value', element.kit.id);
                                } else {
                                    $('.price').attr('value', "");
                                    $('.quantity_storage').attr('value', "");
                                    $('.product_id').attr('value', "");
                                }
                            },
                            error: function (element) {
                                console.log(element);
                            }
                        });
                    }
                }
            });

            /**
             * Evento click de remover um produto da tabela
             */
            $('table').on('click', '.remove-product', function () {
                $(this).closest('tr').remove();
                calculaTotalEmProdutos();
            });

            /**
             * Evento click de registrar venda
             */
            $('.btn-vender').click(function () {
                MontaObjetoVenda();
            });

            /**
             * Transforma tabela de produtos em um array tipado
             */
            function ProductTableToArray() {
                let productList = [];
                $('.product-data > tr').each(function (index, value) {
                    let product = {
                        id: 0,
                        isKit: '',
                        name: '',
                        qtd: 0,
                        price: 0
                    };
                    let counter = 0;
                    $(this).find('td').each(function () {
                        switch (counter++) {
                            case 0:
                                product.id = $(this).text();
                                break;
                            case 1:
                                product.isKit = $(this).text();
                                break;
                            case 2:
                                product.name = $(this).text();
                                break;
                            case 3:
                                product.qtd = $(this).text();
                                break;
                            case 4:
                                product.price = $(this).text();
                                break;
                        }
                    });
                    productList.push(product);
                    console.log(productList);
                });
                return productList;
            }

            /**
             *Calcula total na janela
             */
            function calculaTotalEmProdutos() {
                let perc_type = $('#rbFixo').attr('checked') === undefined ? '%' : '$';
                let perc_amount = $('.discount').val();
                let produtos = ProductTableToArray();
                let total_discount = 0;
                let total_without_discount = 0;
                let total_with_discount = 0;
                let total_valor_entrada = parseFloat($('.entrada').val() == "" ? 0 : $('.entrada').val());
                $.each(produtos, function () {
                    total_without_discount += (parseInt(this.qtd) * parseFloat(this.price));
                });
                //Calc porcentagem
                if (perc_amount !== undefined) {
                    if (parseFloat(perc_amount) > 0) {
                        if (perc_type === '%')
                            total_discount = total_without_discount * parseFloat(perc_amount) / 100;
                        else
                            total_discount = parseFloat(perc_amount);
                    }
                }
                total_with_discount = total_without_discount - total_discount - total_valor_entrada;

                $('.total_with_discount').text("R$ " + total_with_discount.toFixed(2));
                $('.total_discount').text('R$ ' + total_discount.toFixed(2));
                $('.total_valor_entrada').text('R$ ' + total_valor_entrada.toFixed(2));
                $('.total_without_discount').text("R$ " + total_without_discount.toFixed(2));
            }

            /**
             * Envia requisição para o servidor
             * @return {void}
             */
            function GetDay(date){
                var dateAux = new Date(date);
                var day = dateAux.getDate()+1;
                return day;
            }
            function MontaObjetoVenda() {
                var obj = {
                    client_id: $('.client').val(),
                    product_list: ProductTableToArray(),
                    discount: $('.discount').val(),
                    discount_type: $('#rbPorcentagem').attr('checked') ? "%" : "$",
                    payment_type: $('.payment-method').val(),
                    valor_entrada: $('.entrada').val(),
                    qtd_parcelas: $('.qtd_parcels').val(),
                    dth_cobranca: GetDay($('#InicialDate').val()),
                    inicial_date: $('#InicialDate').val(),
                    _token: $('meta[name="csrf-token"]'). attr('content')
                };
                console.log(obj);
                if (ConsisteObjetoVenda(obj)) {

                    //Esconde erros se existir
                    $('.errors').hide();
                    $.ajax({
                        url: "/api/sale",
                        method: "post",
                        data: obj,
                        success: function (element) {
                            console.log(element);
                            $('.sale-body').hide();
                            $('.sale-alert').show().html(element.status);
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
            function ConsisteObjetoVenda(obj) {
                let errors = [];
                let htmlstring = "<ul>";
                if (obj.client_id <= 0 || obj.client_id === "Selecione um cliente.") {
                    errors.push("Você deve selecionar um cliente.");
                }
                if (obj.payment_type == 0) {
                    errors.push("Você deve selecionar a forma de pagamento.");
                } else {
                    if (obj.payment_type === "PA" || obj.payment_type === "EP") {
                        if (parseInt($(".qtd_parcels").val() == "" ? 0 : $(".qtd_parcels").val()) === 0) {
                            errors.push("Você deve informar a quantidade de parcelas.");
                        }
                        if (parseInt($('.payment_day').val() == "" ? 0 : $('.payment_day').val()) === 0) {
                            errors.push("Você deve informar o dia de cobrança.");
                        }
                    }
                    if (obj.payment_type === "EP") {
                        if (parseInt($('.entrada').val() == "" ? 0 : $('.entrada').val()) === 0) {
                            errors.push("Você deve informar o valor de entrada.");
                        }
                    }
                }
                if (obj.product_list.length === 0) {
                    errors.push("Você deve adicionar ao menos um produto a compra");
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
