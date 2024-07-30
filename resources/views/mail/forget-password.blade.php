<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>Chúng tôi nhận được yêu cầu cấp lại mật khẩu của bạn</p>

    <a href="{{ route('reset.password', [$token, $email]) }}">Cập nhật mật khẩu</a>
</body>

</html>
