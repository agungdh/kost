<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $judul }}</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/favicon.ico" type="image/x-icon">
<!-- Jquery Core Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/jquery/jquery.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/css/themes/all-themes.css" rel="stylesheet" />

    <!-- baru ada -->
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/lightbox/ekko-lightbox.css">
    
    <!-- Light Gallery Plugin Css -->
    <link href="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
<!-- Light Gallery Plugin Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/light-gallery/js/lightgallery-all.js"></script>
    <script type="text/javascript">
    $('#aniimated-thumbnials').lightGallery({
        thumbnail: true,
        selector: 'a'
    });
    </script>
    <script type="text/javascript">
        state = {
            login: {{ session('login') ? 'true' : 'false' }},
            @if(session('login'))
            userid: {{session('id')}},
            level: '{{session('level')}}',
            @endif
        };
    </script>

    <!-- geolocation -->
    <script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else { 
            swal('ERROR !!!', "Geolocation is not supported by this browser.", 'error');
        }
    }

    function showPosition(position) {
        $("#lat").val(position.coords.latitude);
        $("#lng").val(position.coords.longitude);
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                swal('ERROR !!!', "User denied the request for Geolocation.", 'error');
                break;
            case error.POSITION_UNAVAILABLE:
                swal('ERROR !!!', "Location information is unavailable.", 'error');
                break;
            case error.TIMEOUT:
                swal('ERROR !!!', "The request to get user location timed out.", 'error');
                break;
            case error.UNKNOWN_ERROR:
                swal('ERROR !!!', "An unknown error occurred.", 'error');
                break;
        }
    }
    </script>

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
                <a class="navbar-brand" href="{{ route('root') }}">{{ $judul }}</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            @if(session('login') == true)
            <div class="user-info">
                <div class="image">
                    @php
                    if (file_exists(storage_path('app/public/profilephoto/' . session('id')))) {
                        $url = asset('storage/profilephoto/' . session('id'));
                    } else {
                        $url = asset('assets/AdminBSBMaterialDesign-1.0.7/images/user.png');
                    }
                    @endphp
                    <img src="{{ $url }}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ session('nama') }}</div>
                    <div class="email">{{ session('email') }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ route('profile') }}"><i class="material-icons">person</i>Profil</a></li>
                            <li><a href="{{ route('chpass') }}"><i class="material-icons">lock</i>Ubah Password</a></li>
                            <li><a href="{{ route('chemail') }}"><i class="material-icons">mail</i>Ubah Email</a></li>
                            <li><a href="{{ route('foto') }}"><i class="material-icons">image</i>Ubah Foto</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="{{ route('doLogout') }}"><i class="material-icons">input</i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    
                    <li class="active"></li>
                    
                    <li>
                        <a href="{{ route('root') }}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="material-icons">{{ session('login') ? 'dashboard' : 'person'}}</i>
                            <span>{{ session('login') ? 'Dashboard' : 'Login'}}</span>
                        </a>
                    </li>
                    
                    @if(session('login') == true)
                    @include('template.backend.menu')
                    @endif

                    <li>
                        <a href="{{ route('metodePembayaran') }}">
                            <i class="material-icons">attach_money</i>
                            <span>Metode Pembayaran</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('hubungiKami') }}">
                            <i class="material-icons">local_phone</i>
                            <span>Hubungi Kami</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('tentangKami') }}">
                            <i class="material-icons">people</i>
                            <span>Tentang Kami</span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; {{ date('Y') }} <a href="{{url('/')}}">{{ $judul }}</a>.
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

    
    <script type="text/javascript" src="{{asset('assets')}}/lightbox/ekko-lightbox.min.js"></script>
    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/node-waves/waves.js"></script>


    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/flot-charts/jquery.flot.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/js/admin.js"></script>

    <!-- baru ada -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script type="text/javascript">
        $('.datatable').DataTable({
            responsive: true
        });
    </script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/momentjs/moment.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/chartjs/Chart.bundle.js"></script>
    <script src="{{ asset('assets') }}/bower_components/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(".select2").select2();
    </script>
    <script src="{{ asset('assets') }}/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
    <script type="text/javascript">
        $( '.uang' ).mask('000.000.000.000.000.000', {
            reverse: true
        });    
    </script>
    <script type="text/javascript">
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
    </script>


    
    <!-- Ckeditor -->
    <script src="{{ asset('assets') }}/AdminBSBMaterialDesign-1.0.7/plugins/ckeditor/ckeditor.js"></script>

    
    @if(session('alert'))
    <script type="text/javascript">
        swal('{{ session('alert')['title'] }}', '{{ session('alert')['message'] }}', '{{ session('alert')['class'] }}');
    </script>
    @endif

    <!-- View Js -->
    @yield('js')
</body>

</html>