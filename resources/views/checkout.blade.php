@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{asset('assets/css/shop.css')}}">
<style>
    .card {
        border: solid 1px #ccc;
    }
</style>

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

<br><br><br>

<div class="container-fluid py-4">
    <h2 class="text-center text-primary my-5 text-uppercase">Checkout</h2>
    <form action="/checkout" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-content-center">
            <div class="p-4 card col-md-4">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <span class="my-0">{{ ucwords(auth()->user()->name) }}</span>
                        </div>
                    </li>
                    <hr>

                    @foreach ($cart_items as $id => $quantity)
                    @php
                    $product = Helper::get_product($id);
                    @endphp

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <span class="my-0">{{ ucwords($product->name) }}</span>
                        </div>
                        <span class="text-muted">{{ number_format($quantity['quantity']) }}pcs</span>
                        <span class="text-muted">${{ number_format($product->sell_price, 2) }}</span>
                    </li>
                    @endforeach
                    <hr>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Sub Total (USD)</span>
                        <span>
                            $<span id="subtotal">{{ number_format($sub_total, 2) }}</span>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <span class="my-0">Promo code</span>
                        <span id="promoValue">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <span>
                            $<span id="total">{{ number_format($total, 2) }}</span>
                        </span>
                    </li>
                </ul>
                <br>
                <div class="d-flex">
                    <input type="text" class="form-control my-auto" placeholder="Promo code" name="promo" id="promo"
                        value="">
                    <a id="apply" class="btn btn-secondary btn-redeem text-white my-auto">Redeem</a>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary btn-block text-dark">Order</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function () {
        $('#apply').click(function () {
            const promoCode = $('#promo').val();
            
            $.ajax({
                method: 'POST',
                url: '{{ route("check_promo") }}',
                data: { promo: promoCode, _token: '{{ csrf_token() }}' },
                success: function (response) {
                    if (response.exists) {
                        let promoValue = response.value;
                        const subtotal = parseFloat($('#subtotal').text().replace(/\$/g, '').replace(/,/g, ''));
                        const total = calculateNewTotal(subtotal, promoValue);

                        $('#promo').hide();
                        $('#apply').hide();
                        $('.promo-value').show();
                        promoValue *= 100;
                        $('#promoValue').text(promoValue.toString() + "%");
                        
                        $('#total').text(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    } else {
                        alert('Invalid promo code.');
                    }
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });

        function calculateNewTotal(subtotal, promoValue) {
            const newTotal = subtotal - (subtotal * promoValue);
            return newTotal; 
        }
    });
</script>
@endsection