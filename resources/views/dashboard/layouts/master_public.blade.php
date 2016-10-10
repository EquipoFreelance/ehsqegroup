<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/fonts/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/select/select2.min.css')}}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/icheck/flat/green.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/js/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/js/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/js/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/js/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/js/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/css/freelanceteam/freelanceteam.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/freelanceteam/component.css') }}" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700,800' rel='stylesheet' type='text/css'>

    <!-- CSS - App -->
    @yield('custom_css')

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


        <!-- page content -->
        <div class="right_col" role="main" style="margin-left:0px">
            @yield('content')
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.min.js"></script>

<!-- daterangepicker -->
<script type="text/javascript" src="{{ URL::asset('assets/js/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/datepicker_material/js/moment-with-locales.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/datepicker_material/js/bootstrap-material-datetimepicker.js') }}"></script>

<!-- icheck -->
<script src="{{ URL::asset('assets/js/icheck/icheck.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>
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

<script src="{{ URL::asset('assets/js/bootstrap-filestyle.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/select/select2.full.js') }}"></script>

<!-- Javascript - App -->
@yield('custom_js')

<!-- pace -->
<script src="{{ URL::asset('assets/js/pace/pace.min.js') }}"></script>

</body>
</html>
