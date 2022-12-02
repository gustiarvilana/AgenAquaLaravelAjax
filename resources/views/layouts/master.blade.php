<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RAM Water | @yield('title', 'title belum diisi')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('assets') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    {{-- <link rel="stylesheet" href="{{ asset('assets') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> --}}
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    @stack('css')
</head>

{{-- <body class="hold-transition sidebar-mini layout-fixed sidebar-collapse"> --}}

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
                height="60" width="60">
        </div> --}}

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <p>{{ session('no_sp') ? 'sp ' . session('no_sp') : '' }}</p>
                    <p class="_id_pembelian">{{ session('id_pembelian') ?? session('id_pembelian') }}</p>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <div>
                            <i class="far fa-user mr-1"></i> Hallo,
                            {{ Auth::user() ? Auth::user()->name : 'Kamu belum Login' }}
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <center>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-flat"> Keluar</button>
                            </form>
                        </center>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title', 'title belum diisi')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title', 'title belum diisi')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            @include('layouts.footer')
        </footer>
        {{-- sweet alert --}}
        {{-- @include('sweetalert::alert') --}}
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets') }}/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets') }}/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    {{-- <script src="{{ asset('assets') }}/plugins/jqvmap/jquery.vmap.min.js"></script> --}}
    {{-- <script src="{{ asset('assets') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> --}}
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    {{-- <script src="{{ asset('assets') }}/plugins/overlayScrollbars/js/jquery.overlayScrhartollbars.min.js"></script> --}}
    <!-- AdminLTE App -->
    <script src="{{ asset('assets') }}/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('assets') }}/dist/js/demo.js"></script> --}}
    <!-- AdminLTE @yield('title', 'title belum diisi') demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('assets') }}/dist/js/pages/dashboard.js"></script> --}}
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $('#id_kota').on('change', function() {
                $.ajax({
                    url: '{{ route('get_kecamatan') }}',
                    method: 'GET',
                    data: {
                        id: $(this).val()
                    },
                    success: function(response) {
                        $('#id_kecamatan').empty()

                        $.each(response, function(id, name) {
                            console.log(id, name)
                            $('#id_kecamatan').append(
                                '<option value="' + id + '">' + name +
                                ' </option>')
                        })
                    }
                })
            });
            $('#id_kecamatan').on('change', function() {
                $.ajax({
                    url: '{{ route('get_kelurahan') }}',
                    method: 'GET',
                    data: {
                        id: $(this).val()
                    },
                    success: function(response) {
                        $('#id_kelurahan').empty()

                        $.each(response, function(id, name) {
                            console.log(id, name)
                            $('#id_kelurahan').append(
                                '<option value="' + id + '">' + name +
                                ' </option>')
                        })
                    }
                })
            });
        });
    </script>

    @stack('js')
</body>

</html>
