@extends('client.layout.sub-master')

@section('title')
    Thông tin học sinh
@endsection

@section('content')
    <div class="nav flex-column nav-pills admin-tab-menu overflow-auto">
        <a href="#">
            {{ Auth::User()->name }}
        </a>
        <a href="#">
            {{ Auth::User()->email }}
        </a>
        @if (Auth::User()->role == 'admin')
            <a href="{{ route('admin.index') }}">
                Vào trang quản trị
            </a>
        @endif
        <a href="{{ route('change') }}">
            Đổi mật khẩu
        </a>
    </div>

    <div class="main-content-wrapper">
        <div class="container-fluid">   
            <div class="engagement-courses table-responsive">
                <a href="{{route('client.customers.show')}}" class="btn btn-primary">Quay lại</a>

                <form method="POST" action="{{ route('password.change') }}" novalidate>
                    @csrf
                    <div class="d-flex gap-2">
                        <div style="width: 50%;" class="single-form">
                            <input id="old_password" type="password" placeholder="Mật khẩu cũ"
                                class="@error('old_password') is-invalid @enderror" name="old_password" required
                                autocomplete="old_password" autofocus>
                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div style="width: 50%;" class="single-form">
                            <input id="new_password" type="password" placeholder="Mật khẩu mới"
                                class="@error('new_password') is-invalid @enderror" name="new_password" required
                                autocomplete="new_password" autofocus>
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div style="width: 50%;" class="single-form">
                            <input id="password_confirmation" type="password" placeholder="Xác nhận mật khẩu"
                                class="@error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                required autocomplete="password_confirmation" autofocus>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="single-form">
                        <button class="btn btn-primary btn-hover-dark w-100">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('toast')
    @if (session('change_success'))
        <script>
            window.onload = function() {
                swal("Chúc mừng!", "{{ session('change_success') }}", "success");
            };
        </script>

        @php
            Session::forget('change_success');
        @endphp
    @endif
@endsection
