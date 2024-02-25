@extends('auth.app')

@section('title')
Register
@endsection

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css"
    integrity="sha512-gxWow8Mo6q6pLa1XH/CcH8JyiSDEtiwJV78E+D+QP0EVasFs8wKXq16G8CLD4CJ2SnonHr4Lm/yY2fSI2+cbmw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput-jquery.min.js"
    integrity="sha512-QK4ymL3xaaWUlgFpAuxY+6xax7QuxPB3Ii/99nykNP/PlK3NTQa/f/UbQQnWsM4h5yjQoMjWUhCJbYgWamtL6g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                <input type="tel" id="phone" name="phone" value="{{ old('phone') ?? '+961' }}" autocomplete="phone"
                    required pattern="[\d\s()+-]*" class="form-control border phone_input">
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
                <p class="text-muted">Already have an account? <a href="/login" class="text-decoration-none">Login</a>
                </p>
            </div>
        </div>
    </form>
</div>
<!-- login area end -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>

<script>
    const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    var inputs = $(".phone_input");
    var instance = inputs;
    instance.intlTelInput({
        nationalMode: true,
        initialCountry: "auto",
        geoIpLookup: callback => {
            fetch("https://ipapi.co/json")
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("us"));
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.min.js"
    });

    inputs.on("blur", function() {
        $(this).parent().parent().find(".valid-msg").html("")
        console.log($(this).val())
    if ($(this).intlTelInput('isValidNumber')){
    }else{
        $(this).parent().parent().parent().find(".valid-msg").html( errorMap[$(this).intlTelInput('getValidationError')])
    }
    })
</script>
@endsection