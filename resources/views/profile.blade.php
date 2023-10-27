@extends('auth.app')

@section('title')
| Profile
@endsection

@section('content')
<!-- login area start -->
<div class="login-area">
    <div class="container">
        <a href="/" class="nav-link text-dark pt-4">
            <h4>
                < Home </h4>
        </a>
        <div class="login-box">
            <form method="POST" action="/profile/save" class="login-form my-3">
                @csrf

                <div class="login-form-head">
                    <h4>Profile</h4>
                </div>
                <div class="login-form-body bg-white px-5 py-4">
                    @include('admin._flash')

                    <div class="form-gp">
                        <label for="name">Name *</label>
                        <input type="text" id="name" name="name" value="{{auth()->user()->name}}" required
                            autocomplete="name" class="form-control border">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-gp">
                        <label for="phone">Phone Number *</label>
                        <input type="phone" id="phone" name="phone" value="{{auth()->user()->phone}}"
                            autocomplete="phone" required class="form-control border">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-gp">
                        <label for="address">Address *</label>
                        <input type="text" id="address" name="address" value="{{auth()->user()->address}}" required
                            autocomplete="address" class="form-control border">
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit" class="bg-primary text-white">Update</button>
                    </div>
                    <div class="form-footer text-center mt-5">
                        <p class="text-muted">Change pasword?<a href="/password/edit">Click here</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- login area end -->
@endsection