
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="author" content="Mannat Themes">
        <meta name="keyword" content="">

        <title>INVENTORI | Home </title>

        <!-- Theme icon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Theme Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/slidebars.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/menu.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
        @yield('css')
    </head>

    <body class="sticky-header">
        @include('sweetalert::alert')
        <section>
            <!-- sidebar left start-->
            @include('layouts.sidebar')
            <!-- sidebar left end-->

            <!-- body content start-->
            <div class="body-content">
                <!-- header section start-->
                <div class="header-section">
                    <!--logo and logo icon start-->
                    <div class="logo">
                        <a href="index.html">
                            <span class="logo-img">
                                <img src="assets/images/logo_sm.png" alt="" height="26">
                            </span>
                            <!--<i class="fa fa-maxcdn"></i>-->
                            <span class="brand-name">Syntra</span>
                        </a>
                    </div>

                    <!--toggle button start-->
                    <a class="toggle-btn"><i class="ti ti-menu"></i></a>
                    <!--toggle button end-->

                    <!--mega menu start-->
                    <div id="navbar-collapse-1" class="navbar-collapse collapse mega-menu">

                    </div>
                    <!--mega menu end-->

                </div>
                <!-- header section end-->

                @yield('content')


                <!--footer section start-->
                <footer class="footer">
                    2018 &copy; Syntra.
                </footer>
                <!--footer section end-->


            </div>
            <!--end body content-->
        </section>

        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-migrate.js')}}"></script>
        <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('assets/js/slidebars.min.js')}}"></script>


        @yield('plugin')


        <!--app js-->
        <script src="{{asset('assets/js/jquery.app.js')}}"></script>
        @yield('js')
        <script>
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                delay: 100,
                time: 1200
                });
            });
        </script>
    </body>
</html>
