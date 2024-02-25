@extends('auth.app')

@section('title')
Reset
@endsection

@section('content')
<div class="login-box py-auto">
    <form method="POST" action="{{ route('password.update') }}" class="login-form">
        @csrf
        <div class="login-form-head">
            <h4>Reset Password</h4>
        </div>
        <div class="login-form-body bg-white px-5 py-4">
            @include('admin._flash')

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-gp">
                <label for="email" class="text-dark">Email Address *</label>
                <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required
                    autocomplete="email" autofocus class="form-control border">
            </div>
            <div class="form-gp">
                <label for="password" class="text-dark">Password *</label>
                <input type="password" id="password" name="password" required class="form-control border">
            </div>
            <div class="form-gp">
                <label for="password-confirm" class="text-dark">Confirm Password *</label>
                <input type="password" id="password-confirm" name="password_confirmation" required
                    class="form-control border">
            </div>

            <div class="submit-btn-area">
                <button id="form_submit" type="submit" class="bg-primary text-white">Reset Password</button>
            </div>
        </div>
    </form>
</div>
@endsection