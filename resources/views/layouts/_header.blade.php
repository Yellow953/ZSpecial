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
                                data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" href="/"> Home </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" href="/#about">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" href="/shop">Shop</a>
                                    </li>
                                </ul>

                                @if(auth()->user())
                                @if (auth()->user()->role == 'admin')
                                <div class="sign_btn"><a href="/app">App</a></div>
                                @else
                                <div class="sign_btn"><a href="/cart">Cart ({{Helper::cart_count()}})</a></div>
                                @endif
                                @else
                                <div class="sign_btn"><a href="/login">Sign in</a></div>
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
                <div class="row d_flex">
                    <div class="col-md-5">
                        <div class="text-bg">
                            <h1 class="custom-font">A Destination for the Extraordinary</h1>
                            <span class="custom-font">Shop safely with us </span>
                            <a href="/shop">Discover Products</a>
                        </div>
                    </div>
                    <div class="d-none d-md-block col-md-7 padding_right1">
                        <div class="text-img">
                            <figure><img src="{{asset('assets/images/products.png')}}" alt="#" class="hero_img" />
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</header>
<!-- end banner -->