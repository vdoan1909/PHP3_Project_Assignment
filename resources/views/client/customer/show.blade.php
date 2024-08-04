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
            <form method="POST" action="{{ route('client.customers.update.customer') }}" novalidate>
                @csrf
                <div class="d-flex gap-2">
                    <div style="width: 50%;" class="single-form">
                        <input id="name" type="text" placeholder="Tên người dùng"
                            class="@error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}"
                            required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div style="width: 50%;" class="single-form">
                        <input id="email" type="email" placeholder="Email"
                            class="@error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}"
                            required autocomplete="email" autofocus readonly>
                        @error('email')
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

            <div class="engagement-courses table-responsive">
                <div class="courses-list">
                    <h3 class="text-center mb-3">Bài kiểm tra đã hoàn thành</h3>

                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Tên Bài Thi</th>
                                <th scope="col">Số Câu Hỏi</th>
                                <th scope="col">Giới Hạn Thời Gian (Phút)</th>
                                <th scope="col">Điểm</th>
                                <th scope="col">
                                    <a class="text-success"
                                        href="{{ Route('client.customers.export', Auth::user()->id) }}">
                                        Tải kết quả
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($get_user_exam))
                                @foreach ($get_user_exam as $user_exam)
                                    <tr>
                                        <td>{{ $user_exam->exam->name }}</td>
                                        <td>{{ $user_exam->exam->number_of_questions }}</td>
                                        <td>{{ $user_exam->exam->time_limit }}</td>
                                        <td>{{ $user_exam->score }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="engagement-courses table-responsive">
                <div class="courses-list">
                    <h3 class="text-center mb-3">Môn học đã đăng ký</h3>

                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Tên Môn Học</th>
                                <th scope="col">Ảnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($get_user_subject))
                                @foreach ($get_user_subject as $user_subject)
                                    <tr>
                                        <td>{{ $user_subject->subject->name }}</td>
                                        <td>
                                            <img style="height: 100px;"
                                                src="{{ \Storage::url($user_subject->subject->image) }}"
                                                alt="Courses"></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
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
