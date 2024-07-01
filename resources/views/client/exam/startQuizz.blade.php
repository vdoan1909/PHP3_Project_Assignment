@extends('client.layout.sub-master')

@section('title')
    {{ $exam->name }}
@endsection

@section('content')
    <style>
        .page-content-wrapper {
            padding-left: 0;
        }
    </style>

    <div class="d-flex mt-5">
        <div class="ms-3">
            <ul>
                <li>
                    Ngày làm bài: <br>
                    <strong>{{ $currentDate }}</strong>
                </li>

                <li class="mt-3">
                    Thời gian làm bài: <br>
                    <strong>{{ $exam->time_limit }} Phút</strong>
                </li>

                <li class="mt-3">
                    Thời gian còn lại: <br>
                    <h3 id="timer"></h3>
                </li>
            </ul>
        </div>

        <div class="main-content-wrapper m-0 p-0 ms-5 ps-3">
            <form class="container-fluid" action="{{ route('client.exams.finallyQuizz', $exam->slug) }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
                <div class="quiz-header">
                    <h1>{{ $exam->name }}</h1>
                </div>

                @php
                    $i = 1;
                @endphp
                @foreach ($exam->questions as $index => $question)
                    <div class="mt-3">
                        <div class="quiz-question">
                            <strong>Câu: {{ $i++ }} {{ $question->name }}</strong>
                        </div>
                        <div class="quiz-options">
                            @foreach (['a', 'b', 'c', 'd'] as $option)
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="q{{ $index }}-{{ $option }}"
                                        name="answers[{{ $question->id }}]" class="custom-control-input"
                                        value="{{ strtoupper($option) }}">
                                    <label class="custom-control-label" for="q{{ $index }}-{{ $option }}">
                                        {{ $question->{'option_' . $option} }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-success submit-btn mt-4">Nộp Bài</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const examId = {{ $exam->id }};
            const timeLimit = {{ $exam->time_limit }} * 60 * 1000;
            const timerElement = document.getElementById('timer');

            let remainingTime = localStorage.getItem(`exam_${examId}_remaining_time`);
            remainingTime = remainingTime ? parseInt(remainingTime, 10) : timeLimit;

            const saveRemainingTime = () => {
                localStorage.setItem(`exam_${examId}_remaining_time`, remainingTime);
            };

            const updateTimerDisplay = () => {
                const minutes = Math.floor(remainingTime / (1000 * 60));
                const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
                const formattedMinutes = String(minutes).padStart(2, '0');
                const formattedSeconds = String(seconds).padStart(2, '0');
                timerElement.innerHTML = `${formattedMinutes} : ${formattedSeconds}`;
            };

            const timerInterval = setInterval(() => {
                remainingTime -= 1000;
                if (remainingTime <= 0) {
                    clearInterval(timerInterval);
                    timerElement.innerHTML = "Hết giờ!";
                    localStorage.removeItem(`exam_${examId}_remaining_time`);
                } else {
                    updateTimerDisplay();
                    saveRemainingTime();
                }
            }, 1000);

            updateTimerDisplay();

            document.querySelector('.container-fluid').addEventListener('submit', (event) => {
                console.log("Form is being submitted."); // Thêm câu này vào.
                localStorage.removeItem(`exam_${examId}_remaining_time`);
            });
        });
    </script>
@endsection
