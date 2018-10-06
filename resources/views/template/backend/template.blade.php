<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $judul }}</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/css/themes/all-themes.css" rel="stylesheet" />

    <!-- baru ada -->
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- View Css -->
    @yield('css')
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="javascript:void(0)">{{ $judul }}</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ session('nama') }}</div>
                    <div class="email">{{ session('email') }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ route('profile') }}"><i class="material-icons">person</i>Profil</a></li>
                            <li><a href="{{ route('chpass') }}"><i class="material-icons">lock</i>Ubah Password</a></li>
                            <li><a href="{{ route('foto') }}"><i class="material-icons">image</i>Ubah Foto</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="{{ route('doLogout') }}"><i class="material-icons">input</i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="active"></li>
                    @include('template.backend.menu')
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; {{ date('Y') }} <a href="javascript:void(0)">{{ $judul }}</a>.
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb align-right">
                @yield('nav')
            </ol>             
            <br>
            @yield('content')
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/js/admin.js"></script>

    <!-- baru ada -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/momentjs/moment.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.5/plugins/chartjs/Chart.bundle.js"></script>

    @if(session('alert'))
    <script type="text/javascript">
        swal('{{ session('alert')['title'] }}', '{{ session('alert')['message'] }}', '{{ session('alert')['class'] }}');
    </script>
    @endif

    <!-- View Js -->
    @yield('js')
</body>

</html>