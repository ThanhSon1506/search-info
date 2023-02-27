<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông tin liên hệ</title>
</head>
<body>
    <p><b>Tên người gửi:</b> {{ $data['contact_name'] }} </p>
    <p><b>Số điện thoại:</b> {{ $data['contact_phone'] }} </p>
    <p><b>Email:</b> {{ $data['contact_email'] }} </p>
    <p><b>Nội dung:</b> {{ $data['contact_content'] }} </p>
</body>
</html>