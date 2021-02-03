<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('title')</title>
    <script type="text/javascript">
        const site_url = "<?= url('') ?>";
    </script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link href="{{ asset('adminlte/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminlte/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Sweet Alert --->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.css') }}">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />


    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}">
    </script>
    <script src="{{ asset('js/super.js') }}"></script>
    <!-- Webcam -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        @include('layouts.navbar')
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">{{ strtoupper(Request::segment(1)) }}</a>
                                </li>
                                @for ($i = 2; $i <= count(Request::segments()); $i++) <li class="breadcrumb-item">
                                    <a href="{{ URL::to(implode('/', array_slice(Request::segments(), 0, $i, true))) }}">
                                        {{ strtoupper(Request::segment($i)) }}
                                    </a>
                                    </li>
                                    @endfor
                            </ol>

                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
                <div class="container-fluid">
                    @include('sweetalert::alert')
                    @yield('content')
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content-wrapper -->
        </div>
    </div>
    @include('layouts.footer')
    <!-- modal konfirmasi hapus data -->
    <div class="modal fade" id="modal-delete-data" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">
                        <center><span class="fa fa-question-circle"></span> Konfirmasi</center>
                    </h4>
                </div>
                <form action="" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-times"></span> Batal</button>
                        <button type="submit" class="btn btn-danger"><span class="fa fa-trash"></span> Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script src="{{ asset('js/alacarte.js') }}"></script>
    <script src="{{ asset('js/simple.money.format.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- datatable Responsive examples -->
    <script src="{{ asset('adminlte/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    <!-- FILE INPUT -->
    <script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('adminlte/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/raphael/raphael.min.js ') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- Moment.js -->
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.js') }}"></script>

    <script>
        // var site_url = '<?= url('
        // ') ?>';
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            /* FUNGSI TOMBOL DELETE DATA */
            $('#modal-delete-data').on('show.bs.modal', function(e) {
                var this_elem = $(this);
                var relTarget = $(e.relatedTarget);
                this_elem.find("form").attr('action', relTarget.attr('href'));
                this_elem.find(".modal-body").html(
                    '<center><p>Yakin akan menghapus data ?</p></center>');
            }); /*Konfirmasi Delete*/
        });

    </script>

    <script>
        $(function() {
            $(".datepicker").datepicker({
                autoclose: true,
                todayHighlight: true
            });

            $(".datepicker_month").datepicker({
                format: "mm-yyyy",
                viewMode: "months",
                minViewMode: "months"
            });

            $(".datepicker_year").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });


        });
        $(function() {
                $('.daterange').daterangepicker({
                    locale: {
                    format: 'YYYY-MM-DD'
                    }
                });
            });
    </script>
    @yield('javascripts')

</body>

@stack('modals')

</html>
