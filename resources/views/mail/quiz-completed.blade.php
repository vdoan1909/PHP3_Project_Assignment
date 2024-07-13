<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chúc mừng {{ $user_name }}!</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <div style="background-color: #f5f5f5; padding: 20px;">
        <div style="background-color: #fff; max-width: 600px; margin: 0 auto; padding: 20px;">
            <div style="text-align: center; margin-bottom: 20px;">
                <h1 style="margin: 0; font-size: 24px; color: #333;">Chúc mừng {{ $user_name }}!</h1>
            </div>
            <div style="margin-bottom: 20px;">
                <p style="margin: 0 0 10px 0; font-size: 16px; color: #333;">Bạn đã hoàn thành bài kiểm tra: <strong
                        style="color: #007bff;">{{ $exam_name }}</strong>.</p>
                <p style="margin: 0 0 10px 0; font-size: 16px; color: #333;">Điểm của bạn là: <strong
                        style="color: #007bff;">{{ $score }}</strong></p>
                <p style="margin: 0; font-size: 16px; color: #333;">Cảm ơn bạn đã tham gia!</p>
            </div>
            <div style="margin-top: 20px; border-top: 1px solid #ddd; padding-top: 20px;">
                <p style="margin: 0; font-size: 14px; color: #999;">Đây là email tự động, vui lòng không trả lời.</p>
            </div>
        </div>
    </div>
</body>

</html>
