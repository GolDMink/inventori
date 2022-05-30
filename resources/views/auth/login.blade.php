
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mannat Themes">
        <meta name="keyword" content="">

        <title>HALAMAN LOGIN</title>

        <!-- Theme icon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Theme Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/slidebars.min')}}.css" rel="stylesheet">
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/menu.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    </head>

    <body class="sticky-header">
        <section class=" bg-primary">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="wrapper-page">
                            <div class="account-pages">
                                <div class="account-box">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="card-title text-center">
                                                {{-- <img src="assets/images/logo_sm_2.png" alt="" class=""> --}}
                                                <h5 class="mt-3"><b>Selamat Datang</b></h5>
                                                <p>Silahkan Masukan Email dan Password dengan benar</p>
                                            </div>
                                            <form class="form mt-5 contact-form" action="{{route('login')}}" method="POST">
                                                @csrf
                                                <div class="form-group ">
                                                    <div class="col-sm-12">
                                                        <input name="username" class="form-control form-control-line" type="text" placeholder="Username" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-sm-12">
                                                        <input name="password" class="form-control form-control-line" type="password" placeholder="Password" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-sm-12">
                                                        <select name="level" id="level" class="form-control">
                                                            <option value="1">Admin</option>
                                                            <option value="2">Petugas</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-12 mt-4">
                                                        <button class="btn btn-primary btn-block" type="submit">Log In</button>
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-migrate.js')}}"></script>
        <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('assets/js/slidebars.min.js')}}"></script>


        <!--app js-->
        <script src="{{asset('assets/js/jquery.app.js')}}"></script>
    </body>
</html>
