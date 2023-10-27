@extends('auth.app')

@section('title')
| Register
@endsection

@section('content')
<div class="login-box py-5">
    <form method="POST" action="{{ route('register') }}" class="login-form">
        @csrf
        <div class="login-form-head">
            <h4>Register</h4>
        </div>
        <div class="login-form-body bg-white px-5 py-4">
            @include('admin._flash')

            <div class="form-gp">
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                    class="form-control border">
            </div>
            <div class="form-gp">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                    class="form-control border">
            </div>
            <div class="form-gp">
                <label for="phone">Phone Number *</label>
                <input type="phone" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="phone" required
                    class="form-control border">
            </div>
            <div class="form-gp">
                <label for="address">Address *</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" autocomplete="address"
                    required class="form-control border">
            </div>
            <div class="form-gp">
                <label for="password">Password *</label>
                <input type="password" id="password" name="password" required class="form-control border">
            </div>
            <div class="form-gp">
                <label for="password_confirmation">Password Confirmation *</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="form-control border">
            </div>
            <div class="submit-btn-area">
                <button id="form_submit" type="submit" class="bg-primary text-white">Register</button>
            </div>
            <div class="form-footer text-center mt-5">
                <p class="text-muted">Already have an account? <a href="/login">Login</a></p>
            </div>
        </div>
    </form>
</div>
<!-- login area end -->
@endsection