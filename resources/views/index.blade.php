@extends('layouts.app')

@section('content')


<body class="main-layout">
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="head_top">
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                            <div class="full">
                                <div class="center-desk">
                                    <div class="logo">
                                        <a href="/"><img src="{{asset('assets/images/logo.png')}}"
                                                class="logo_hero ml-md-5 mt-md-5" alt="#" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                            <nav class="navigation navbar navbar-expand-md navbar-dark ">
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarsExample04" aria-controls="navbarsExample04"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarsExample04">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item">
                                            <a class="nav-link text-dark" href="/"> Home </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-dark" href="#about">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-dark" href="#contact">Contact us</a>
                                        </li>
                                    </ul>
                                    <div class="sign_btn"><a href="/login">Sign in</a></div>
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
                    <div class="row d_flex">
                        <div class="col-md-5">
                            <div class="text-bg">
                                <h1>A Destination for the Extraordinary</h1>
                                <span>Shop safe here</span>
                                <a href="/shop">Buy Now</a>
                            </div>
                        </div>
                        <div class="col-md-7 padding_right1">
                            <div class="text-img">
                                <figure><img src="{{asset('assets/images/products.png')}}" alt="#" class="hero_img" />
                                </figure>
                                <h3>01</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </header>
    <!-- end banner -->
    <!-- about -->
    <div id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>About ZSpecial</h2>
                        <span>Welcome to the special shop, where we curate a unique collection of items from around the
                            world! Our mission is to bring you a variety of special products that you won't find
                            anywhere else. From kitchen to bar accessories, special gadgets and tools to solve daily
                            problems with a limited edition collectibles, we ensure that every item in our shop is
                            special and carefully selected for its distinctiveness. Whether you're a collector, an
                            adventurer, or simply someone who appreciates the extraordinary, we offer a one-of-a-kind
                            shopping experience just for you. So come on in and let us surprise you with the wonders of
                            the world!</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2 ">
                    <div class="about_box ">
                        <figure><img src="{{asset('assets/images/about_img.png')}}" alt="#" /></figure>
                        <a class="read_more" href="#">Read more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about -->
    <!-- best -->
    <div id="" class="best">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Shop With ZSpecial</h2>
                        <span>A Destination for the Extraordinary</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="best_box">
                        <h4>Problem Solving Items</h4>
                        <p>Discover a range of problem-solving items that simplify your life. From clever gadgets to
                            innovative tools, our selection offers effective solutions for everyday challenges.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="best_box">
                        <h4>Unique and Special Items</h4>
                        <p>Uncover extraordinary finds with our unique and special items. From remarkable craftsmanship
                            to rare designs, these products are sure to make a lasting impression.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="best_box">
                        <h4>Full Money Back Guarantee</h4>
                        <p>Shop with confidence thanks to our hassle-free refund policy. If you're not satisfied with
                            your purchase, our team will assist you with a smooth return process.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end best -->
    <!-- request -->
    <div id="contact" class="request">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Request a Call back</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="black_bg">
                        <div class="row">
                            <div class="col-md-7 ">
                                <form class="main_form">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <input class="contactus" placeholder="Name" type="text" name="Name">
                                        </div>
                                        <div class="col-md-12">
                                            <input class="contactus" placeholder="Phone number" type="text"
                                                name=" Phone number">
                                        </div>
                                        <div class="col-md-12">
                                            <input class="contactus" placeholder="Email" type="text" name="Email">
                                        </div>
                                        <div class="col-md-12">
                                            <textarea class="textarea" placeholder="Message" type="text"
                                                name="Message "> Message </textarea>
                                        </div>
                                        <div class="col-sm-12">
                                            <button class="send_btn">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-5">
                                <div class="mane_img">
                                    <figure><img src="{{asset('assets/images/mane_img.jpg')}}" alt="#" /></figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end request -->
    <!-- two_box section -->
    <div class="two_box">
        <div class="container-fluid">
            <div class="row d_flex">
                <div class="col-md-6">
                    <div class="two_box_img">
                        <figure><img src="{{asset('assets/images/leptop.jpg')}}" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="two_box_img">
                        <h2><span class="offer">15% </span>0ffer everyday</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form, by injected humour, or randomised words which don't look
                            even slightly believable</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end two_box section -->
    <!-- testimonial -->
    <div class="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Testimonial</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="myCarousel" class="carousel slide testimonial_Carousel " data-ride="carousel">
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
                                                    <h3>Michl ro</h3>
                                                    <p><i class="padd_rightt0"><img
                                                                src="{{asset('assets/images/te1.png')}}"
                                                                alt="#" /></i>There are many variations of passages of
                                                        Lorem Ipsum available, but the majority have suffered alteration
                                                        in some <i class="padd_leftt0"><img
                                                                src="{{asset('assets/images/te2.png')}}" alt="#" /></i>
                                                        <br>form, by injected humour, or
                                                        randomised words which don't look even slightly believable
                                                    </p>
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
                                                    <h3>Michl ro</h3>
                                                    <p><i class="padd_rightt0"><img
                                                                src="{{asset('assets/images/te1.png')}}"
                                                                alt="#" /></i>There are many variations of passages of
                                                        Lorem Ipsum available, but the majority have suffered alteration
                                                        in some <i class="padd_leftt0"><img
                                                                src="{{asset('assets/images/te2.png')}}" alt="#" /></i>
                                                        <br>form, by injected humour, or
                                                        randomised words which don't look even slightly believable
                                                    </p>
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
                                                    <h3>Michl ro</h3>
                                                    <p><i class="padd_rightt0"><img
                                                                src="{{asset('assets/images/te1.png')}}"
                                                                alt="#" /></i>There are many variations of passages of
                                                        Lorem Ipsum available, but the majority have suffered alteration
                                                        in some <i class="padd_leftt0"><img
                                                                src="{{asset('assets/images/te2.png')}}" alt="#" /></i>
                                                        <br>form, by injected humour, or
                                                        randomised words which don't look even slightly believable
                                                    </p>
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
    <!-- end testimonial -->
    <!--  footer -->
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="cont">
                            <h3 class="text-center"> <strong class="multi"> Whatsapp Us</strong><br>
                                <a href="https://api.whatsapp.com/send/?phone=96181495312" target="_blank">ZSpecial
                                    Support
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cont">
                            <h3 class="text-center"> <strong class="multi"> Email Us</strong><br>
                                <a href="mailto:support@z-special.com" target="_blank">support@z-special.com
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="cont">
                            <h3 class="text-center"> <strong class="multi"> Call Now</strong><br>
                                <a href="tel:96181495312" target="_blank">
                                    +961 81 495 312
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>© 2023 All Rights Reserved by YellowTech</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->

    @endsection