@extends('auth.app')

@section('title')
| Change Passsword
@endsection

@section('content')
<div class="container">
    <a href="/profile" class="nav-link text-dark pt-4">
        <h4>
            < Profile </h4>
    </a>
    <div class="login-box">
        <form method="POST" action="/password/update" class="login-form my-3">
            @csrf
            <div class="login-form-head">
                <h4>Change Password</h4>
            </div>
            <div class="login-form-body bg-white px-5 py-4">
                @include('admin._flash')

                <div class="form-gp">
                    <label for="current_password">Current Password *</label>
                    <input type="password" id="current_password" name="current_password" required
                        class="form-control border">

                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-gp">
                    <label for="new_password">New Password *</label>
                    <input type="password" id="new_password" name="new_password" required class="form-control border">

                    @error('new_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-gp">
                    <label for="confirm_password">Confirm Password *</label>
                    <input type="password" id="confirm_password" name="confirm_password" required
                        class="form-control border">

                    @error('confirm_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="submit-btn-area">
                    <button id="form_submit" type="submit" class="bg-primary text-white">Change Password</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- login area end -->
@endsection