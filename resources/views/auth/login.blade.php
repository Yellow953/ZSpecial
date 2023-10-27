@extends('auth.app')

@section('title')
| Login
@endsection

@section('content')
<div class="login-box py-auto">
    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf
        <div class="login-form-head">
            <h4>Login</h4>
        </div>
        <div class="login-form-body bg-white px-5 py-4">
            @include('admin._flash')

            <div class="form-gp">
                <label for="email" class="text-dark">Email Address *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                    autofocus class="form-control border">
            </div>
            <div class="form-gp">
                <label for="password" class="text-dark">Password *</label>
                <input type="password" id="password" name="password" required class="form-control border">
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="d-flex">
                        <input class="form-check-input border" type="checkbox" name="remember" id="remember" {{
                            old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-footer text-center my-3">
                <p class="text-muted">Don't have an account? <a href="/register">Sign up</a></p>
            </div>

            <div class="submit-btn-area">
                <button id="form_submit" type="submit" class="bg-primary text-white">Login</button>
            </div>
        </div>
    </form>
</div>
@endsection