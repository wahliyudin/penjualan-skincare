@extends('layouts.auth')

@section('title', 'Sign In')

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
            {{-- <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-white btn-round" href="{{ route('register') }}">SIGN UP</a>
                    </li>
                </ul>
            </div> --}}
        </div>
    </nav>
@endsection

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="header">
            <div class="logo-container">
                <img src="assets/images/logo.svg" alt="">
            </div>
            <h5>Log in</h5>
        </div>
        <div class="content">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <div class="container">
                        <div class="alert-icon">
                            <i class="zmdi zmdi-block"></i>
                        </div>
                        {{ implode(', ', $errors->all(':message')) }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="zmdi zmdi-close"></i>
                            </span>
                        </button>
                    </div>
                </div>
            @endif
            <div class="input-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email"
                    name="email" value="{{ old('email') }}" required>
                <span class="input-group-addon">
                    <i class="zmdi zmdi-account-circle"></i>
                </span>
            </div>
            <div class="input-group">
                <input type="password" name="password" required placeholder="Password"
                    class="form-control @error('password') is-invalid @enderror" />
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                </span>
            </div>
        </div>
        <div class="footer text-center">
            <button type="submit" class="btn btn-primary btn-round btn-lg btn-block ">SIGN IN</button>
            <h5><a href="forgot-password.html" class="link">Forgot Password?</a></h5>
        </div>
    </form>
@endsection
