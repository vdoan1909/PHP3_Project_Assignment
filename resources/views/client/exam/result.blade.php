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
                    {{ $exam->name }}
                </h1>
                <div class="mb-3">
                    <h2 class="text-success text-center">Điểm: {{ number_format($score, 0) }} / 10</h2>
                    <p class="text-center">Tổng số câu trả lời đúng: {{ number_format($score, 0) }}</p>
                    <p class="text-center">Tổng số câu hỏi: {{ $exam->number_of_questions }}</p>
                    <p class="text-center">Ngày làm bài: {{ $currentDate }}</p>
                </div>
                <div class="text-center">
                    <a href="{{ route('client.index') }}" class="btn btn-primary">Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </div>

    <p style="cursor: pointer" class="view-result text-center fs-4">Xem đáp án đúng</p>

    <div class="main-content-wrapper m-0 p-0 ms-5 ps-3 d-none" id="answerSection">
        <div>
            @php
                $i = 1;
            @endphp

            @foreach ($questions as $index => $question)
                <div class="mt-3">
                    <div class="quiz-question">
                        <strong>Câu: {{ $i++ }} {{ $question->name }}</strong>
                    </div>
                    <div class="quiz-options">
                        @foreach (['a', 'b', 'c', 'd'] as $option)
                            @php
                                $userAnswer = array_key_exists($question->id, $user_answer)
                                    ? $user_answer[$question->id]
                                    : null;
                            @endphp
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="{{ strtoupper($option) }}"
                                    {{ $userAnswer == strtoupper($option) ? 'checked' : '' }} disabled>
                                <label
                                    class="custom-control-label {{ $userAnswer == strtoupper($option) ? ($question->correct_answer == strtoupper($option) ? 'text-success' : 'text-danger') : '' }}">
                                    {{ $question->{'option_' . $option} }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <label class="custom-control-label text-success">
                    Đáp án đúng: <b> {{ $question->correct_answer }} </b>
                </label>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const viewResultButton = document.querySelector('.view-result');
            const answerSection = document.getElementById('answerSection');

            viewResultButton.addEventListener('click', () => {
                answerSection.classList.toggle('d-none');
            });
        });
    </script>
@endsection
