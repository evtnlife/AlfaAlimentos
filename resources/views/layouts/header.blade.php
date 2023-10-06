@extends('layouts.template')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @switch(Route::current()->uri)
                    @case('client/create')
                    <div class="col-sm-6">
                        <h1 class="m-0">Clientes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/client/list">Lista de Clientes</a></li>
                            <li class="breadcrumb-item active">Cadastro de Cliente</li>
                        </ol>
                    </div>
                    @break;
                    @case('client/list')
                    <div class="col-sm-6">
                        <h1 class="m-0">Clientes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Lista de Clientes</li>
                        </ol>
                    </div>
                    @break;
                    @case('client/edit/{id}')
                    <div class="col-sm-6">
                        <h1 class="m-0">Clientes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/client/list">Lista de Clientes</a></li>
                            <li class="breadcrumb-item active">Editar Cliente</li>
                        </ol>
                    </div>
                    @break;
                    @case('branch/list')
                    <div class="col-sm-6">
                        <h1 class="m-0">Filiais</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Filiais</li>
                        </ol>
                    </div>
                    @break;
                    @case('login')
                    <div class="col-sm-6">
                        <h1 class="m-0">Login</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Login</li>
                        </ol>
                    </div>
                    @break;
                    @case('/user/modify_data')
                    <div class="col-sm-6">
                        <h1 class="m-0">Modificar Dados</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Modificar Dados</li>
                        </ol>
                    </div>
                    @break;
                    @case('schedule')
                    <div class="col-sm-6">
                        <h1 class="m-0">Agenda</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Agenda</li>
                        </ol>
                    </div>
                    @break;
                    @case('product/create')
                    <div class="col-sm-6">
                        <h1 class="m-0">Produto</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/product/list">Lista de Produtos</a></li>
                            <li class="breadcrumb-item active">Cadastro de Produto</li>
                        </ol>
                    </div>
                    @break;
                    @case('product/list')
                    <div class="col-sm-6">
                        <h1 class="m-0">Produtos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Lista de Produtos</li>
                        </ol>
                    </div>
                    @break;
                    @case('branch/edit/{id}')
                    <div class="col-sm-6">
                        <h1 class="m-0">Filiais</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/branch/list">Lista de Filiais</a></li>
                            <li class="breadcrumb-item active">Editar Filiais</li>
                        </ol>
                    </div>
                    @break;
                    @case('branch/create')
                    <div class="col-sm-6">
                        <h1 class="m-0">Filiais</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/branch/list">Lista de Filiais</a></li>
                            <li class="breadcrumb-item active">Cadastro de Filiais</li>
                        </ol>
                    </div>
                    @break;
                    @case('user/create')
                    <div class="col-sm-6">
                        <h1 class="m-0">Funcionários</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/user/list">Lista de Funcionários</a></li>
                            <li class="breadcrumb-item active">Cadastro de Funcionários</li>
                        </ol>
                    </div>
                    @break;
                    @case('user/edit/{id}')
                    <div class="col-sm-6">
                        <h1 class="m-0">Funcionários</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/user/list">Lista de Funcionários</a></li>
                            <li class="breadcrumb-item active">Editar Funcionário</li>
                        </ol>
                    </div>
                    @break;
                    @case('user/edit')
                    <div class="col-sm-6">
                        <h1 class="m-0">Modificar dados</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Modificar dados</li>
                        </ol>
                    </div>
                    @break;
                    @case('provider/create')
                    <div class="col-sm-6">
                        <h1 class="m-0">Fornecedores</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/provider/list">Lista de Fornecedores</a></li>
                            <li class="breadcrumb-item active">Cadastro de Fornecedores</li>
                        </ol>
                    </div>
                    @break;
                    @case('provider/entry')
                    <div class="col-sm-6">
                        <h1 class="m-0">Fornecedores</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Entradas do Fornecedor</li>
                        </ol>
                    </div>
                    @break;
                    @case('provider/list')
                    <div class="col-sm-6">
                        <h1 class="m-0">Fornecedores</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Lista de Fornecedores</li>
                        </ol>
                    </div>
                    @break;
                    @case('provider/edit/{id}')
                    <div class="col-sm-6">
                        <h1 class="m-0">Fornecedores</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/provider/list">Lista de Fornecedores</a></li>
                            <li class="breadcrumb-item active">Editar Fornecedor</li>
                        </ol>
                    </div>
                    @break;
                    @case('product/edit/{id}')
                    <div class="col-sm-6">
                        <h1 class="m-0">Produto</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/provider/list">Lista de Clientes</a></li>
                            <li class="breadcrumb-item active">Editar Cliente</li>
                        </ol>
                    </div>
                    @break;
                    @case('category/create')
                    <div class="col-sm-6">
                        <h1 class="m-0">Categoria</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/category/list">Lista de Categorias</a></li>
                            <li class="breadcrumb-item active">Criar Categoria</li>
                        </ol>
                    </div>
                    @break;

                    @case('kit/create')
                    <div class="col-sm-6">
                        <h1 class="m-0">Criar Kit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/kit/list">Lista de Kits</a></li>
                            <li class="breadcrumb-item active">Criar Kit</li>
                        </ol>
                    </div>
                    @break;

                    @case('kit/list')
                    <div class="col-sm-6">
                        <h1 class="m-0">Kits</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Lista de Kits</li>
                        </ol>
                    </div>
                    @break;

                    @case('kit/edit{id}')
                    <div class="col-sm-6">
                        <h1 class="m-0">Produto</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/kit/list">Lista de Kits</a></li>
                            <li class="breadcrumb-item active">Editar Cliente</li>
                        </ol>
                    </div>
                    @break;
                    @case('category/list')
                    <div class="col-sm-6">
                        <h1 class="m-0">Categorias</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Lista de Categorias</li>
                        </ol>
                    </div>
                    @break;
                    @case('category/edit/{id}')
                    <div class="col-sm-6">
                        <h1 class="m-0">Edição de Categoria</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/category/edit">Lista de Categorias</a></li>
                            <li class="breadcrumb-item active">Edição de Categorias</li>
                        </ol>
                    </div>
                    @break;
                    @case('report/collection/client')
                    <div class="col-sm-6">
                        <h1 class="m-0">Relatório de Cobranças</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Relatório de Cobranças de Clientes</li>
                        </ol>
                    </div>
                    @break;
                    @case('report/financial')
                    <div class="col-sm-6">
                        <h1 class="m-0">Relatório Financeiro</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Relatório Financeiro</li>
                        </ol>
                    </div>
                    @break;
                    @case('sale/payment')
                    <div class="col-sm-6">
                        <h1 class="m-0">Cobranças</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Cobranças</li>
                        </ol>
                    </div>
                    @break;
                    @case('user/list')
                    <div class="col-sm-6">
                        <h1 class="m-0">Funcionários</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Lista de Funcionários</li>
                        </ol>
                    </div>
                    @break;
                    @case('report/sales')
                    <div class="col-sm-6">
                        <h1 class="m-0">Lista de Vendas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Vendas</a></li>
                            <li class="breadcrumb-item active">Lista de Vendas</li>
                        </ol>
                    </div>
                    @break;
                    @case('product/damaged')
                    <div class="col-sm-6">
                        <h1 class="m-0">Produtos Danificados</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Produtos</a></li>
                            <li class="breadcrumb-item active">Produtos Danificados</li>
                        </ol>
                    </div>
                    @break;
                    @case('/report/product/damaged/list')
                    <div class="col-sm-6">
                        <h1 class="m-0">Lista de Produtos Danificados</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Produtos</a></li>
                            <li class="breadcrumb-item active">Lista Produtos Danificados</li>
                        </ol>
                    </div>
                    @break;
                @endswitch
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @yield('content-header')
@endsection
