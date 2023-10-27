@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{asset('assets/css/shop.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/cart.css')}}">

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
                    <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link px-3 text-dark" href="/"> Home </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3 text-dark" href="/#about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3 text-dark" href="/shop">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3 text-dark" href="/cart">Cart(<span id="cartCount">{{
                                        Helper::cart_count() }}</span>)</a>
                            </li>
                            @auth
                            <li class="nav-item">
                                <a href="/profile" class="nav-link px-3 text-dark">
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/logout" class="nav-link px-3 text-dark">
                                    Logout
                                </a>
                            </li>
                            @endauth
                        </ul>

                        @auth
                        @if (auth()->user()->role == 'admin')
                        <div class="sign_btn"><a href="/app">App</a></div>
                        @endif
                        @endauth

                        @guest
                        <div class="sign_btn"><a href="/login">Sign in</a></div>
                        @endguest
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<br>

<div class="container py-5">
    <h2 class="d-flex justify-content-center align-items-center my-5 text-info size-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill mx-3"
            viewBox="0 0 16 16">
            <path
                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </svg>
        Cart
    </h2>

    <div class="container">
        @include('admin._flash')

        <div class="row align-items-center">
            <div class="offset-md-2 col-md-8">
                <div class="cartItem row align-items-center text-center my-3">
                    <div class="col-6 p-0">
                        <h3 class="text-md">{{ ucwords('product') }}</h3>
                    </div>
                    <div class="col-2 p-0">
                        <h3 class="text-md">{{ ucwords('quantity') }}</h3>
                    </div>
                    <div class="col-2 p-0">
                        <h3 class="text-md">{{ ucwords('price') }}</h3>
                    </div>
                    <div class="col-2 p-0">
                        <h3 class="text-md">{{ ucwords('actions') }}</h3>
                    </div>
                </div>
                @forelse ($cart_items as $productID => $cart_item)
                <div class="cartItem row align-items-center text-center" id="cartItem{{ $productID }}">
                    @php
                    $product = Helper::get_product($productID);
                    @endphp

                    <div class="col-3 p-0 my-auto">
                        <img class="w-100 cart_image rounded" src="{{ asset($product->image) }}" alt="Image">
                    </div>
                    <div class="col-3 p-0 my-auto">
                        {{ ucwords($product->name) }}
                    </div>
                    <div class="col-2 p-0 my-auto">
                        {{ $cart_item['quantity'] }}
                    </div>
                    <div class="col-2 p-0 my-auto">
                        $<span id="cartItem{{ $productID }}Price">{{ number_format($product->sell_price, 2) }}</span>
                    </div>
                    <div class="col-2 p-0">
                        <a href="#" class="btn btn-danger text-dark px-2" onclick="deleteCartItem({{ $productID }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path
                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
                <hr class="my-2 border">
                @empty
                <div class="text-center my-3">
                    No Items Yet...
                </div>
                @endforelse

                <div class="row my-5 text-center">
                    <div class="offset-md-6 col-6 col-md-3">
                        Total:
                    </div>
                    <div class="col-6 col-md-3">
                        $<span id="totalPrice">{{ number_format($sub_total, 2) }}</span>
                    </div>
                </div>
                <div class="text-center">
                    <a href="/checkout" class="btn btn-info btn-rounded btn-block">Checkout</a>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function deleteCartItem(productId) {
        // Remove the cart item's HTML
        var cartItemElement = document.getElementById('cartItem' + productId);
        if (cartItemElement) {
            cartItemElement.remove();
        }

        try {
            var cart = JSON.parse(getCookie('cart'));

            // Remove the cart item from the cart object
            delete cart[productId];

            // Update the cart cookie with the new cart object
            document.cookie = 'cart=' + JSON.stringify(cart) + ';path=/';

            // Decrease cart count
            var currentCount = parseInt(document.getElementById('cartCount').innerText);
            if (currentCount > 0) {
                var newCount = currentCount - 1;
                document.getElementById('cartCount').innerText = newCount;
            }

            alert('Item removed from cart!');
        } catch (error) {
            console.log('Error deleting cart item' + error);
        }
    }

    function getCookie(name) {
        var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        if (match) return match[2];
    }
</script>

@endsection