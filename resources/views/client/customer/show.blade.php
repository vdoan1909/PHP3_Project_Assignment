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
    </div>

    <div class="main-content-wrapper">
        <div class="container-fluid">
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
                                                src="{{ \Storage::url($user_subject->subject->image) }}" alt="Courses"></a>
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
