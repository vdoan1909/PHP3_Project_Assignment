<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Khôi phục mật khẩu</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f5f5f5;">
    <div
        style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #333333; text-align: center; margin-bottom: 20px;">Yêu cầu cấp lại mật khẩu</h2>
        <p style="font-size: 16px; color: #333333; margin-bottom: 20px;">
            Chúng tôi nhận được yêu cầu cấp lại mật khẩu của bạn. Nếu bạn đã thực hiện yêu cầu này, vui lòng nhấp vào
            liên kết bên dưới để cập nhật mật khẩu của bạn.
        </p>
        <a href="{{ route('reset.password', [$token, $email]) }}"
            style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #ffffff; background-color: #007bff; text-decoration: none; border-radius: 5px; text-align: center;">
            Cập nhật mật khẩu
        </a>
    </div>
</body>

</html>
