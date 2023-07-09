@extends('layouts.app')

@section('content')


<body class="main-layout">
    @include('layouts._header')

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
    @include('layouts._footer')

    @endsection