@extends('client.layout.sub-master')

@section('title')
    Kết Quả {{ $exam->name }}
@endsection

@section('content')
    <style>
        .page-content-wrapper {
            padding-left: 0;
        }

        .result-container {
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
        }
    </style>

    <div class="d-flex justify-content-center flex-column mt-5">
        <div class="ms-5 my-3 text-center">
            <ul>
                <li>
                    <h1 class="text-center mb-4">Kết Quả Bài Thi</h1>
                </li>

                <li class="mt-3">
                    Thời gian bài thi: <strong>{{ $exam->time_limit }} Phút</strong>
                </li>
            </ul>
        </div>

        <div class="main-content-wrapper m-0 p-0 ms-5 ps-3">
            <div class="result-container">
                <h1 class="text-center mb-4">
                    {{$exam->name}}
                </h1>
                <div class="mb-3">
                    <h2 class="text-success text-center">Điểm: {{ number_format($score, 0) }} / 10</h2>
                    <p class="text-center">Tổng số câu trả lời đúng: {{ $score }}</p>
                    <p class="text-center">Tổng số câu hỏi: {{ $exam->number_of_questions }}</p>
                    <p class="text-center">Ngày làm bài: {{ $currentDate }}</p>
                </div>
                <div class="text-center">
                    <a href="{{ route('client.index') }}" class="btn btn-primary">Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
