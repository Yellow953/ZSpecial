@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('assets/css/shop.css')}}">

<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                <div class="full">
                    <div class="center-desk">
                        <div class="logo">
                            <a href="/"><img src="{{asset('assets/images/logo.png')}}" class="logo_shop" alt="#" /></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                <nav class="navigation navbar navbar-expand-md navbar-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
                        aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse custom_header_bg" id="navbarsExample04">
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
                        @if(auth()->user() && auth()->user()->role == 'admin')
                        <div class="sign_btn"><a href="/app">App</a></div>
                        @else
                        <div class="sign_btn"><a href="/login">Sign in</a></div>
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<br><br><br><br><br>

<h3 class="heading">ZSpecial's Products</h3>

<div class="container d-flex justify-content-center">
    <div class="custom_header_bg" style="width:fit-content;">
        <ul class="mx-auto d-flex justify-content-center">
            <li><a class="nav-link text-dark {{(request()->query('search') == null) ? 'cat-active' : '' }}"
                    href="/shop">All</a></li>
            @foreach ($categories as $category)
            <li><a class="nav-link text-dark {{(Str::contains(request()->query('search'), $category->id)) ? 'cat-active' : '' }}"
                    href="/shop?search={{$category->id}}">{{ucfirst($category->name)}}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="container">
    <div class="row product">
        @forelse ($products as $product)
        <div class="col-md-4 mb-3">
            <div class="card rounded-20">
                <div class="ccc">
                    <p class="text-center"><img src="{{$product->image}}" class="imw"></p>

                </div>
                <div class="card-body">
                    <h5 class="text-center">{{ucfirst($product->name)}}</h5>

                    <div class="text-center">
                        <button type="button" class="btn btn-primary mt-4 px-4 py-2 rounded-20" data-toggle="modal"
                            data-target="#exampleModal{{$product->id}}">
                            View
                        </button>
                    </div>

                    <section class="modals">
                        <div class="modal fade" id="exampleModal{{$product->id}}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2>{{ucwords($product->name)}}</h2>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body py-0 px-4">

                                        <img src="{{$product->image}}" class="img-modal">

                                        <p class="text-right text-success mx-4">
                                            Price : {{number_format($product->sell_price, 2)}}$
                                        </p>

                                        @if($product->description)
                                        <p class="my-3 text-center">
                                            {{$product->description}}
                                        </p>
                                        @endif

                                        @if ($product->facebook_link || $product->instagram_link)
                                        <p class="text-dark font-italic">Check it on Social Media: </p>
                                        <div class="links">
                                            <div class="link">
                                                <a href="{{$product->instagram_link}}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                        fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                                    </svg>

                                                </a>
                                            </div>
                                            <div class="link">
                                                <a href="{{$product->facebook_link}}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                        fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                                    </svg>

                                                </a>
                                            </div>
                                        </div>
                                        @endif


                                        <form action="" method="post" enctype="multipart/form-data" class="w-100 my-2">
                                            @csrf
                                            <div class="w-100 d-flex justify-content-end">
                                                <input type="number" name="quantity" id="quantity"
                                                    class="form-control input-field quantity-field" value="1" step="1">

                                                <button type="submit" class="btn btn-primary mx-2">Add to
                                                    Cart</button>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <div class="text-center">
                No Products Found ...
            </div>
        </div>
        @endforelse
    </div>
</div>

@include('layouts._footer')

@endsection