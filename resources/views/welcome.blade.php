<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>{{ config('app.name', 'Laravel') }} | Welcome</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('assets_home') }}/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('assets_home') }}/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('assets_home') }}/css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('assets_home') }}/images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets_home') }}/css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    {{-- <div class="loader_bg">
        <div class="loader"><img src="{{ asset('assets_home') }}/images/loading.gif" alt="#" /></div>
    </div> --}}
    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="head_top">
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                            <div class="full">
                                <div class="center-desk w-100">
                                    <div class="logo">
                                        <a href="index.html"><img src="{{ asset('assets_home') }}/images/logo.png"
                                                alt="#" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                            <nav class="navigation navbar navbar-expand-md navbar-dark">
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarsExample04" aria-controls="navbarsExample04"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarsExample04">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item">
                                            {{-- <a class="nav-link" href="#contact">Contact us</a> --}}
                                        </li>
                                    </ul>
                                    @if (Route::has('login'))
                                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                            @auth
                                                <div class="sign_btn">
                                                    <a href="{{ route('dashboard.index') }}"
                                                        class="text-sm btn btn-info text-gray-700 dark:text-gray-500 underline bordered">Home</a>
                                                </div>
                                            @else
                                                <div class="sign_btn">
                                                    <a href="{{ route('login') }}">Sign in</a>

                                                    @if (Route::has('register'))
                                                        <a href="#"
                                                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"></a>
                                                    @endif
                                                </div>
                                            @endauth
                                        </div>
                                    @endif
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end header inner -->
            <!-- end header -->
            <!-- banner -->
            <section class="banner_main">
                <div class="container-fluid">
                    <div class="banner_bg">
                        <div class="row d_flex">
                            <div class="col-xl-6 col-lg-6 col-md-12 padding_right1">
                                <div class="text_box_color">
                                    <div class="text-bg">
                                        <h1>RAM Water<br></h1>
                                        <strong>Agen Resmi AQUA</strong>
                                        <br>
                                        <br>
                                        {{-- <span>Landing Page 2019</span> --}}
                                        <a class="btn btn-success" href="#number">Hubungi Kami</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 padding_right1">
                                <div class="text-img">
                                    <figure><img src="{{ asset('assets_home') }}/images/top_img.png" alt="#" />
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </header>
    <!-- end banner -->
    <!-- feature -->
    <div id="feature" class="feature">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>AQUA <strong class="pink"> Home Service </strong></h2>
                        <span>Komitmen kami untuk menyajikan kebaikan alam untuk kebaikan hidup setiap hari bersama
                            dengan ibu-ibu rumah tangga
                            sebagai dutakebaikan AQUA.<br>
                            Penuhi kebutuhan hidrasi rumah anda dengan kemurnian AQUA.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2 ">
                    <div class="feature_box ">
                        <figure><img src="{{ asset('assets_home') }}/images/feature_img.png" alt="#" /></figure>
                        {{-- <a class="read_more" href="#">Read more</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- feature -->
    <!-- amezing -->
    <div id="" class="amezing">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="amezing_box">
                        <div class="titlepage">
                            <h2>Produk <strong class="pink"> <br> Unggulan Kami </strong></h2>
                        </div>
                        <div class="can">
                            <span>01</span>
                            <h4>Sumber Air Terlindungi</h4>
                        </div>
                        <div class="can">
                            <span>02</span>
                            <h4>Kemasan AQUA Galon Ramah Lingkungan</h4>
                        </div>
                        <p>RAM Water AQUA selalu memastikan kualitas airnya tetap terjaga di setiap prosesnya. Mulai
                            dari memilih
                            sumber air terbaik, proses pengemasan dengan standar mutu tinggi dan menjaga kemurniannya
                            hingga sampai di tangan Ibu. </p>
                        {{-- <a class="read_more" href="#">Hubungi Kami</a> --}}
                        {{-- <div class="text-bg"> --}}
                        <a class="btn btn-info mt-3" href="#number">Hubungi Kami</a>
                        {{-- </div> --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="amezing_box">
                        <figure><img src="{{ asset('assets_home') }}/images/can.png"></figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end amezing -->
    <!-- customer -->
    <div class="customer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Konsumen <strong class="pink"> Kami </strong></h2>
                        {{-- <span> nostrud exercitation ullamco laboris nisi ut aliquip e ea commodo consequat. Duis aute
                            irure dolor in reprehenderit in voluptate velit </span> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="myCarousel" class="carousel slide customer_Carousel " data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="container">
                                    <div class="carousel-caption ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="test_box">
                                                    <p>ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                                        minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                                        aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                        reprehenderit in voluptate velit ipsum dolor sit amet,
                                                        consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                                        nostrud exercitation ullamco laboris nisi ut aliquip e ea
                                                        commodo consequat. Duis aute irure dolor in reprehenderit in
                                                        voluptate velit </p>
                                                    <div class="customar_box">
                                                        <div class="veni">
                                                            <i><img src="{{ asset('assets_home') }}/images/costomar.png"
                                                                    alt="#" /></i>
                                                            <h4> veniam, quis </h4>
                                                        </div>
                                                        <i class="padd_rightt0"><img
                                                                src="{{ asset('assets_home') }}/images/cost.png"
                                                                alt="#" /></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="test_box">
                                                    <p>ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                                        minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                                        aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                        reprehenderit in voluptate velit ipsum dolor sit amet,
                                                        consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                                        nostrud exercitation ullamco laboris nisi ut aliquip e ea
                                                        commodo consequat. Duis aute irure dolor in reprehenderit in
                                                        voluptate velit </p>
                                                    <div class="customar_box">
                                                        <div class="veni">
                                                            <i><img src="{{ asset('assets_home') }}/images/costomar.png"
                                                                    alt="#" /></i>
                                                            <h4> veniam, quis </h4>
                                                        </div>
                                                        <i class="padd_rightt0"><img
                                                                src="{{ asset('assets_home') }}/images/cost.png"
                                                                alt="#" /></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="test_box">
                                                    <p>ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                                        minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                                        aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                        reprehenderit in voluptate velit ipsum dolor sit amet,
                                                        consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                                        nostrud exercitation ullamco laboris nisi ut aliquip e ea
                                                        commodo consequat. Duis aute irure dolor in reprehenderit in
                                                        voluptate velit </p>
                                                    <div class="customar_box">
                                                        <div class="veni">
                                                            <i><img src="{{ asset('assets_home') }}/images/costomar.png"
                                                                    alt="#" /></i>
                                                            <h4> veniam, quis </h4>
                                                        </div>
                                                        <i class="padd_rightt0"><img
                                                                src="{{ asset('assets_home') }}/images/cost.png"
                                                                alt="#" /></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end customer -->
    <!-- request -->
    <div class="request">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Hubungi <strong class="pink"> Kami</strong></h2>
                        {{-- <span> Hubungi </span> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="social_infomision" id="number">
                        <li><a href="#"><img src="{{ asset('assets_home') }}/images/call.png"
                                    alt="#" />(+62)85719920659</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    {{-- <ul class="social_infomision">
                        <li><a href="#"><img src="{{ asset('assets_home') }}/images/email.png"
                                    alt="#" />(+1)1234567890</a></li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- end request -->
    <!--  footer -->
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="cont">
                            <h3>RAM Water Sukabumi</h3>
                            {{-- <span> amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                nisi ut aliquip e ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                voluptate velit </span>
                            <ul class="social_icon">
                                <li> <a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li> <a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>RAM Armalia <a href="https://ramarmalia.com/"></a> | © 2022 IT for RAM Water.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="{{ asset('assets_home') }}/js/jquery.min.js"></script>
    <script src="{{ asset('assets_home') }}/js/popper.min.js"></script>
    <script src="{{ asset('assets_home') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets_home') }}/js/jquery-3.0.0.min.js"></script>
    <script src="{{ asset('assets_home') }}/js/plugin.js"></script>
    <!-- sidebar -->
    <script src="{{ asset('assets_home') }}/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{ asset('assets_home') }}/js/custom.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>

</html>
