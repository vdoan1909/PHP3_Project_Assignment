@extends('client.layout.master')

@section('content')
    <div class="tab-pane fade show active" id="tabs1">
        <div class="courses-wrapper">
            <div class="row">
                <div class="header">
                    <h1>Chúc mừng {{ $user_name }}!</h1>
                </div>
                <div class="content">
                    <p>Bạn đã hoàn thành bài kiểm tra: <strong>{{ $exam_name }}</strong>.</p>
                    <p>Điểm của bạn là: <strong>{{ $score }}</strong></p>
                    <p>Cảm ơn bạn đã tham gia!</p>
                </div>
                <div class="footer">
                    <p>Đây là email tự động, vui lòng không trả lời.</p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
