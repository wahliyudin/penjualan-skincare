@extends('layouts.auth')

@section('title', 'Sign Up')

@section('navbar')
    <nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
        <div class="container">
            <div class="navbar-translate n_logo">
                <a class="navbar-brand" href="javascript:void(0);" title="" target="_blank">Oreo</a>
                <button class="navbar-toggler" type="button">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-white btn-round" href="{{ route('login') }}">SIGN IN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="header">
            <div class="logo-container">
                <img src="assets/images/logo.svg" alt="">
            </div>
            <h5>Sign Up</h5>
            <span>Register a new membership</span>
        </div>
        <div class="content">
            <div class="input-group">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required placeholder="Enter User Name">
                <span class="input-group-addon">
                    <i class="zmdi zmdi-account-circle"></i>
                </span>
            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="input-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required placeholder="Enter Email">
                <span class="input-group-addon">
                    <i class="zmdi zmdi-email"></i>
                </span>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="input-group">
                <input type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required />
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                </span>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation"
                    required />
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                </span>
            </div>
        </div>
        <div class="footer text-center">
            <button type="submit" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">SIGN
                UP</button>
        </div>
    </form>
@endsection
