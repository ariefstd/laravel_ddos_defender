@extends('layouts.auth')


@section('content')
<img class="wave" src="{{ asset('img/wave.png') }}">
<div class="container">
    <div class="img img-bz" style="margin-top: -300px;">
        <img src="{{ asset('img/bz-navbar.png') }}">
    </div>
    <div class="login-content">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <img src="{{ asset('img/user.png') }}" style="background-color: #f2f2f2; border-radius: 50px; padding: 10px 10px 10px 10px;">
            <h3 class="title">Welcome to Our Site</h3>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <input name="email" class="form-control py-4 @error('email') is-invalid @enderror" id="input_login_email" type="email" placeholder="Enter email address" value="{{ old('email') }}" autocomplete="email" />
                </div>

            </div>
            @error('email')
            <span class="invalid-feedback" style="width: 100%; font-size: 12px;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">

                    <input name="password" class="form-control py-4 @error('password') is-invalid @enderror" id="input_login_password" type="password" placeholder="Enter password" autocomplete="current-password" />

                </div>

            </div>
            @error('password')
            <span class="invalid-feedback" role="alert" style="width: 100%; font-size: 12px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <a href="{{ route('password.request') }}" class="float-right">Forgot Password?</a>

            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">

                <button class="btn btn-primary px-4" type="submit">Login</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>

</html>

@endsection