@extends('layouts.master')

@section('header')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-5 col-sm-12">
                <h2>Dashboard
                    <small>Welcome to {{ env('APP_NAME') }}</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-7 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> {{ env('APP_NAME') }}</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
