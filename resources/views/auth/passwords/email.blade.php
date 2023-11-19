@extends('auth.app')

@section('title')
| Reset
@endsection

@section('content')
<div class="login-box py-auto">
    <form method="POST" action="{{ route('password.email') }}" class="login-form">
        @csrf
        <div class="login-form-head">
            <h4>Reset Password</h4>
        </div>
        <div class="login-form-body bg-white px-5 py-4">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="form-gp">
                <label for="email" class="text-dark">Email Address *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control border">
            </div>
            
            <div class="submit-btn-area">
                <button id="form_submit" type="submit" class="bg-primary text-white">Send Password Reset Link</button>
            </div>
        </div>
    </form>
</div>
@endsection