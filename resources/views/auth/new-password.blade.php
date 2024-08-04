@extends('client.layout.master')

@section('title')
    Đăng ký
@endsection

@section('banner')
    <div class="section page-banner">
        <!-- Your existing banner code -->
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
                            <h3 class="title">Mật Khẩu <span>Mới</span></h3>
                            <div class="form-wrapper">

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('reset.password.post') }}" novalidate>
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="email" value="{{ $email }}">

                                    <div class="single-form">
                                        <input id="password" type="password" placeholder="Mật khẩu"
                                            class="@error('password') is-invalid @enderror" name="password"
                                            value="{{ old('password') }}" required autocomplete="password" autofocus>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="single-form">
                                        <input id="password_confirmation" type="password" placeholder="Xác nhận mật khẩu"
                                            class="@error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" value="{{ old('password_confirmation') }}" required
                                            autocomplete="password_confirmation" autofocus>
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="single-form">
                                        <button class="btn btn-primary btn-hover-dark w-100">Cập nhật</button>
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
