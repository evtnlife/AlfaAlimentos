<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Alfa Alimentos</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/custom.css')}}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{asset('/plugins/fullcalendar/main.css')}}">

    <link rel="stylesheet" href="{{asset('/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/bootstrap-toggle/css/bootstrap2-toggle.min.css')}}">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            @if(Auth::check())
                @if(Auth::user()->admin)
                    <li class="nav-item d-none d-sm-inline-block">
                        <form action="/branch/change" method="post" id="branch">
                            {!! csrf_field() !!}
                            <select class="nav-link" name="branch_id" onchange="$('#branch').submit()">
                                @foreach($branches as $branch)
                                    @if(\Illuminate\Support\Facades\Cookie::get('branch_id'))
                                        @if($branch->id == \Illuminate\Support\Facades\Cookie::get('branch_id'))
                                            <option selected value="{{$branch->id}}">{{$branch->name}}</option>
                                        @else
                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endif
                                    @else
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </form>
                    </li>
                @endif
            @endif
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="/img/AdminLTELogo.png" alt="Alfa Alimentos Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Alfa Alimentos</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @if(Auth::check())
                        <li class="nav-item {{Request::is('schedule') ? 'menu-open' :''}}">
                            <a href="/schedule" class="nav-link {{Request::is('schedule') ? 'active' :''}}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                    Minha Agenda
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{Request::is('sale') ? 'menu-open' :''}}">
                            <a href="/sale" class="nav-link {{Request::is('sale') ? 'active' :''}}">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>
                                    Registrar Venda
                                    <span class="right badge badge-danger">$</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{Request::is('sale/payment') ? 'menu-open' :''}}">
                            <a href="/sale/payment"
                               class="nav-link {{Request::is('sale/payment') ? 'active' :''}}">
                                <i class="nav-icon fas fa-money-bill-wave"></i>
                                <p>
                                    Registrar Cobrança
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{Request::is('client/*') ? 'menu-open' :''}}">
                            <a href="#" class="nav-link  {{Request::is('client/*') ? 'active' :''}}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Clientes
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/client/list"
                                       class="nav-link {{Request::is('client/list') ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lista de Clientes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/client/create"
                                       class="nav-link {{Request::is('client/create') ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cadastrar Cliente</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{Request::is('user/*') ? 'menu-open' :''}}">
                            <a href="#" class="nav-link {{Request::is('user/*') ? 'active' :''}}">
                                <i class="nav-icon fas fa-sign-in-alt"></i>
                                <p>
                                    Minha Conta
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item {{Request::is('user/edit') ? 'active' : ''}}">
                                    <a href="/user/edit" class="nav-link {{Request::is('user/edit') ? 'active' :''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Modificar Dados</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('logout') }}" class="nav-link"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sair</p>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @if(Auth::user()->admin)
                            <li class="brand-link" style="border-bottom: 1px solid #4b545c;">
                                <i class="fas fa-user-shield admin"></i>
                                <span class="brand-text font-weight-light">Administração</span>
                            </li>
                            <li class="nav-item {{Request::is('product/*') || Request::is('kit/*') ? 'menu-open' :''}}">
                                <a href="#"
                                   class="nav-link {{Request::is('product/*') || Request::is('kit/*') ? 'active' :''}}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Estoque
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/kit/list"
                                           class="nav-link {{Request::is('kit/list') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Cestas/Kits</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/kit/create"
                                           class="nav-link {{Request::is('kit/create') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Criar Cestas/Kits</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/product/list"
                                           class="nav-link  {{Request::is('product/list') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Produtos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/product/create"
                                           class="nav-link  {{Request::is('product/create') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Criar Produto</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/product/damaged"
                                           class="nav-link  {{Request::is('product/damaged') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Baixa em Produto</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{Request::is('category/*') ? 'menu-open' :''}}">
                                <a href="#" class="nav-link {{Request::is('category/*') ? 'active' :''}}">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>
                                        Categorias
                                        <i class="right fas fa-angle-left"></i>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/category/list"
                                           class="nav-link  {{Request::is('category/list') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Categorias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/category/create"
                                           class="nav-link {{Request::is('category/create') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Criar Categoria</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{Request::is('report/*') ? 'menu-open' :''}}">
                                <a href="#" class="nav-link {{Request::is('report/*') ? 'active' :''}}">
                                    <i class="nav-icon fas fa-poll"></i>
                                    <p>
                                        Relatórios
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/report/financial" class="nav-link {{Request::is('report/financial') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Financeiro</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/report/collection/client" class="nav-link {{Request::is('report/collection/client') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Cobranças</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/report/sales" class="nav-link {{Request::is('report/sales') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Vendas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/report/product/damaged/list" class="nav-link {{Request::is('report/product/damaged/list') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Produtos danificados</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{Request::is('branch/*') ? 'menu-open' :''}}">
                                <a href="#" class="nav-link  {{Request::is('branch/*') ? 'active' :''}}">
                                    <i class="nav-icon fas fa-map-signs"></i>
                                    <p>
                                        Filiais
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item ">
                                        <a href="/branch/list"
                                           class="nav-link {{Request::is('branch/list') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de filiais</p>
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="/branch/create"
                                           class="nav-link {{Request::is('branch/create') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Criar Filial</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{Request::is('user/*') ? 'menu-open' :''}}">
                                <a href="#" class="nav-link  {{Request::is('user/*') ? 'active' :''}}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Funcionários
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item ">
                                        <a href="/user/list"
                                           class="nav-link {{Request::is('user/list') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de funcionários</p>
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="/user/create"
                                           class="nav-link {{Request::is('user/create') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Criar Funcionários</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{Request::is('provider/*') ? 'menu-open' :''}}">
                                <a href="#" class="nav-link  {{Request::is('provider/*') ? 'active' :''}}">
                                    <i class="nav-icon fas fa-truck"></i>
                                    <p>
                                        Fornecedores
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item ">
                                        <a href="/provider/entry"
                                           class="nav-link {{Request::is('provider/entry') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Entradas de Fornecedor</p>
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="/provider/list"
                                           class="nav-link {{Request::is('provider/list') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lista de Fornecedores</p>
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="/provider/create"
                                           class="nav-link {{Request::is('provider/create') ? 'active' :''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Criar Fornecedor</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        @endif
                    @else
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-sign-in-alt"></i>
                                <p>
                                    Acessar
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/login" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Login</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/password/reset" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Esqueci minha senha</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2020-2020 <a href="https://www.qbweb.com.br">qbWeb Solutions</a>.</strong>
        All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->
<script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/plugins/inputmask/dist/jquery.inputmask.js')}}"></script>
<script src="{{asset('/plugins/inputmask/dist/bindings/inputmask.binding.js')}}"></script>
<script src="{{asset('/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script src="{{asset('/js/pages/dashboard3.js')}}"></script>
<script src="{{asset('/js/adminlte.min.js')}}"></script>
<script src="{{asset('/js/demo.js')}}"></script>
<script src="{{asset('/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('/plugins/fullcalendar/main.js')}}"></script>
<script src="{{asset('/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('/js/schedule.js')}}"></script>
<script src="{{asset('/js/luiz.js')}}"></script>
<script src="{{asset('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('/plugins/bootstrap-toggle/js/bootstrap-toggle.js')}}"></script>

<script src="{{asset('/js/custom.js')}}"></script>
@yield('scripts')
</body>
</html>
