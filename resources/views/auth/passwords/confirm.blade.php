{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('client.layout.master')

@section('title')
    Xác nhận mật khẩu
@endsection

@section('banner')
    <div class="section page-banner">

        <img class="shape-1 animation-round" src="{{ asset('theme/client/assets/images/shape/shape-8.png') }}" alt="Shape">

        <img class="shape-2" src="{{ asset('theme/client/assets/images/shape/shape-23.png') }}" alt="Shape">

        <div class="container">
            <div class="page-banner-content">
                <h2 class="title"><span>Xác nhận mật khẩu</span></h2>
            </div>
        </div>
        <div class="shape-icon-box">

            <img class="icon-shape-1 animation-left" src="{{ asset('theme/client/assets/images/shape/shape-5.png') }}"
                alt="Shape">

            <div class="box-content">
                <div class="box-wrapper">
                    <i class="flaticon-badge"></i>
                </div>
            </div>

            <img class="icon-shape-2" src="{{ asset('theme/client/assets/images/shape/shape-6.png') }}" alt="Shape">

        </div>

        <img class="shape-3" src="{{ asset('theme/client/assets/images/shape/shape-24.png') }}" alt="Shape">

        <img class="shape-author" src="{{ asset('theme/client/assets/images/author/author-11.jpg') }}" alt="Shape">

    </div>
@endsection

@section('content')
    <div class="section section-padding">
        <div class="container">
            <div class="register-login-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="register-login-images">
                            <div class="shape-1">
                                <img src="{{ asset('theme/client/assets/images/shape/shape-26.png') }}" alt="Shape">
                            </div>


                            <div class="images">
                                <img src="{{ asset('theme/client/assets/images/register-login.png') }}"
                                    alt="Register Login">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="register-login-form">
                            <h3 class="title">Xác nhận mật khẩu <span>Ngay</span></h3>

                            <div class="form-wrapper">
                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf
                                    <div class="single-form">
                                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="single-form">
                                        <button class="btn btn-primary btn-hover-dark w-100">Xác nhận mật khẩu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection