<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <html lang="es">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/plain; charset=UTF-8"/>
    <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
    <title>MIMCO | www.mimco.com.pe</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css')}}">
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <link href="{{asset('Styles/style.css')}}" type="text/css" rel="stylesheet" />
    <link href="{{asset('plugins/iCheck/flat/blue.css')}}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <script src="{{asset('https://code.jquery.com/jquery-1.12.4.js')}}"></script>
    <script src="{{('https://code.jquery.com/ui/1.12.1/jquery-ui.js')}}"></script>
    <script src="{{asset('Scripts/common.js?t=170607')}}"></script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SD</b>M</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SDMimco</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <small class="bg-red">Online</small>
                  <span class="hidden-xs" name="useradd">{{ Auth::user()->name}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <p>
                      www.mimco.com.pe - Sistema de Digitalización
                      <small>www.mimco.com.pe</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <form action="{{route('logout') }}" method="post">
                        @csrf
                        <button type="submit">cerrar</button>
                      </form>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('img/avatar.png')}}" alt="" class="img-circle">
            </div>
            <div class="pull-left info">
              <span>{{ Auth::user()->name}}</span> 
            </div>
          </div>                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li> 
            @if(Auth::user()->privilegios=='1')
            <li class="treeview">
              <a href="#">
                <img src="{{asset('iconos-svg/web-management.svg')}}" width="30"/>
                <span>Gerencia</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('ordenescompra')}}">Documentos Por Aprobar</a></li>
                <li><a href="{{route('ordenesaprobadas')}}">Documentos Verificados</a></li>
                <li><a href="{{route('compras')}}">Diagrama OT Compra</a></li>
                <li><a href="{{route('pdf')}}">PDF</a></li>
              </ul>
            </li>  
            @endif
            @if( Auth::user()->privilegios=='3' || Auth::user()->privilegios=='1') 
            <li class="treeview">
            <a href="{{route('almacen')}}">
                <!--<i class="fa fa-laptop"></i>-->
                <img src="{{asset('iconos-svg/stock.svg')}}" width="25"/>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('almacen')}}"><i class="fa fa-circle-o"></i> Lista de Documentos</a></li> 
              </ul>
            </li> 
            @endif 
            @if(Auth::user()->privilegios=='5' || Auth::user()->privilegios=='1')
            <li class="treeview">
              <a href="#">
                <img src="{{asset('iconos-svg/value.svg')}}" width="30"/>
                <span>Comnercial</span> 
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('comercial')}}">Lista de Documentos</a></li>
              </ul>
            </li>
            @endif 
            @if(Auth::user()->privilegios=='4' || Auth::user()->privilegios=='1')
            <li class="treeview"> 
              <a href="#"> 
                <img src="{{asset('iconos-svg/accounting.svg')}}" width="30"/>
                <span>Contabilidad</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('facturacion')}}">Lista de Documentos</a></li>
                <li><a href="{{route('voucher-asociar')}}">Voucher</a></li>
                <li><a href="{{route('voucher')}}">Voucher a Pagar</a></li>
                <li><a href="{{route('voucher-listar')}}">Voucher Pagados</a></li>
              </ul>
            </li>
            @endif
            @if(Auth::user()->privilegios=='2' || Auth::user()->privilegios=='1')
            <li class="treeview">
              <a href="#">
                <img src="{{asset('iconos-svg/team.svg')}}" width="30"/>
                <span>G.P</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('gestion')}}">Lista de Documentos</a></li>
                <li><a href="{{route('trabajador')}}">Lista de Personal</a></li>
                <li><a href="{{route('obrero')}}">Lista de Obrero</a></li>
                <li><a href="{{route('horario')}}">Lista de Horario</a></li>
                <li><a href="{{route('reporte')}}">Reporte de Marcación</a></li>
              </ul>
            </li>  
            @endif
            @if(Auth::user()->privilegios=='1')
            <li class="treeview">
              <a href="#">
                <img src="{{asset('iconos-svg/web.svg')}}" width="30"/>
                <span>T.I</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('ti')}}">Lista de Documentos</a></li>
              </ul>
            </li>  
            @endif                                
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema de Digitalización</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido-->
                              @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0 <span style="color:red;"></span> 
        </div>
        <strong>Copyright &copy; 2019 <a href="www.mimco.com.pe">MIMCO</a>.</strong> All rights reserved.
      </footer>
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">
    <script src="{{asset('plugins/fastclick/fastclick.js')}}"></script>
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('js/jquery.timepicker.min.js')}}"></script>
    @stack('scripts') 
  </body>
</html>
