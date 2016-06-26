<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <!-- Bootstrap core CSS -->
  <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('assets/fonts/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('assets/css/animate.min.css')}}" rel="stylesheet">
  <!-- Custom styling plus plugins -->
  <link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('assets/css/icheck/flat/green.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('assets/js/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ URL::asset('assets/js/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ URL::asset('assets/js/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ URL::asset('assets/js/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ URL::asset('assets/js/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ URL::asset('assets/css/freelanceteam/freelanceteam.css') }}" rel="stylesheet">
  <!--[if lt IE 9]>
  <script src="../assets/js/ie8-responsive-file-warning.js') }}"></script>
  <![endif]-->
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') }}"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script>
  <![endif]-->
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view md">

          <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/dashboard') }}" class="site_title bmx"><img src="{{ URL::asset('assets/images/logos/cabe.png') }}"></a>
          </div>
          <div class="clearfix"></div>


          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="{{ URL::asset(Auth::user()->avatar ) }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <h2>{{ Auth::user()->fullname }}</h2>
              <span>{{ Auth::user()->role->nom_role }}</span>
            </div>
          </div>
          <!-- /menu prile quick info -->

          @yield('sidebar_menu')

        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav role="navigation">
            <!--<div class="navbar nav_title hidden_log">
            <a href="index.html" class="site_title bmx"><img src="../../images/logos/cabe.png"></a>
          </div>-->
          <div class="nav toggle">
            <a id="menu_toggle">
              <div class="dev-page-sidebar-collapse-icon">
                <span class="line-one"></span>
                <span class="line-two"></span>
                <span class="line-three"></span>
              </div>
            </a>
          </div>
          <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="{{ URL::asset(Auth::user()->avatar ) }}" alt="">{{ Auth::user()->fullname }}
                <span class=" fa fa-angle-down"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="javascript:;"> Perfil</a>
                </li>
                <li>
                  <a href="javascript:;">
                    <span>Configuraciones</span>
                  </a>
                </li>
                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Cerrar sesión</a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        @yield('content')
      </div>
    </div>
    <!-- /page content -->

  </div>
</div>

<!-- JavaScripts -->
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>

<!-- bootstrap progress js -->
<script src="{{ URL::asset('assets/js/progressbar/bootstrap-progressbar.min.js') }}"></script>

<!-- icheck -->
<script src="{{ URL::asset('assets/js/icheck/icheck.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>

<!-- Datatables -->
<!-- <script src="{{ URL::asset('assets/js/datatables/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/tools/js/dataTables.tableTools.js') }}"></script> -->
<!-- Datatables-->

<script src="{{ URL::asset('assets/js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/buttons.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/responsive.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables/dataTables.scroller.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.validated.js') }}"></script>

<!-- Javascript - App -->
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

<!-- pace -->
<script src="{{ URL::asset('assets/js/pace/pace.min.js') }}"></script>
<script>
//DATATABE GENERADOR
$('#datatable-responsive').DataTable({
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
  "language":
  {
    "lengthMenu": "Mostrar _MENU_ registros por página",
    "zeroRecords": "Sin resultados",
    "info": "Mostrando _PAGE_ de _PAGES_",
    "infoEmpty": "No hay registros Activos",
    "infoFiltered": "(filtrada de _MAX_  entradas en total)",
    "sSearch": "Buscar :",
    "paginate": {
      "previous": "Anterior",
      "next": "Siguiente",
      "first": "Inicio",
      "last": "Final"
    }
  },
  dom: "Bfrtip",
  buttons: [
    {
      extend: "excel",
      className: "btn-sm"
    }, {
      extend: "pdf",
      className: "btn-sm"
    }, {
      extend: "print",
      text:"Imprimir",
      className: "btn-sm"
    }],
  });

  </script>

</body>
</html>
