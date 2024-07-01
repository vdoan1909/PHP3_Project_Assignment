@extends('client.layout.sub-master')

@section('title')
    Danh sách bài kiểm tra
@endsection

@section('content')
    <div class="nav flex-column nav-pills admin-tab-menu overflow-auto">
        @foreach ($subjects as $subject)
            <a href="{{ route('client.exams.examBySubject', $subject->slug) }}">
                {{ $subject->name }}
            </a>
        @endforeach
    </div>

    <div class="main-content-wrapper">
        <div class="container-fluid">
            <div class="message mt-8">
                <div class="message-icon">
                    <img src="{{ asset('theme/client/assets/images/menu-icon/icon-6.png') }}" alt="">
                </div>
                <div class="message-content">
                    <p>
                        Những bài kiểm tra này bao gồm đầy đủ các môn học chính như Toán, Ngữ Văn, Vật Lý, Hóa Học, Sinh
                        Học, Lịch Sử, Địa Lý và Tiếng Anh. Mỗi bài kiểm tra được biên soạn kỹ lưỡng, bám sát chương trình
                        học, nhằm giúp học sinh đánh giá đúng năng lực của mình và nhận ra những điểm cần cải thiện.
                    </p>
                </div>
            </div>

            <div class="engagement-courses table-responsive">
                <div class="courses-top">
                    <ul>
                        <li>Tên</li>
                        <li>Thời gian</li>
                        <li>Câu hỏi</li>
                    </ul>
                </div>

                <div class="courses-list">
                    <ul>
                        @foreach ($exams as $exam)
                            @php
                                $is_registered = isset($get_user_subject[$exam->subject_id]);
                                $is_completed = isset($get_user_exam[$exam->id]);
                            @endphp
                            <li>
                                <div class="courses">
                                    <div class="content">
                                        <h4 class="title">
                                            <a href="#">
                                                {{ $exam->name }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="taught">
                                    <span>
                                        {{ $exam->time_limit }} Phút
                                    </span>
                                </div>
                                <div class="student">
                                    <span>
                                        {{ $exam->number_of_questions }} Câu
                                    </span>
                                </div>
                                <div class="button">
                                    @if ($is_registered)
                                        @if ($is_completed)
                                            <a class="btn" href="{{ route('client.exams.startQuizz', $exam->slug) }}">Làm
                                                lại</a>
                                        @else
                                            <a class="btn" href="{{ route('client.exams.startQuizz', $exam->slug) }}">Làm
                                                bài</a>
                                        @endif
                                    @else
                                        <a class="btn"
                                            href="{{ route('client.subjects.detail', $exam->subject->slug) }}">Bạn chưa đăng
                                            ký?</a>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
