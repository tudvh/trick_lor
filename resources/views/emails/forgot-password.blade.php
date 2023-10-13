<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        p {
            font-size: 1rem;
            color: #000;
        }

        strong {
            color: orangered;
        }

        a {
            display: block;
            width: fit-content;
            margin: 0 auto;
            text-decoration: none;
            font-size: 1rem;
            background-color: orangered;
            color: #ffffff !important;
            padding: 6px 12px;
            border-radius: 5px;
        }

        a:hover {
            background-color: #cc3700;
        }

        header {
            width: 300px;
            margin: 0 auto;
            text-align: center;
            border-bottom: 1px solid orangered;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        header h1 {
            color: orangered;
            margin: 0;
            font-weight: bold;
        }

        header p {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Trick loR</h1>
            <p>Đặt lại mật khẩu</p>
        </header>
        <p>Xin chào <strong>{{ $fullName }}</strong></p>
        <p>Bạn đã yêu cầu đặt lại mật khẩu cho tài khoản Trick loR của bạn. Để hoàn tất quá trình này, vui lòng nhấp vào ô dưới đây để tạo mật khẩu mới.</p>
        <a href="{{ URL::to('/') }}/auth/reset-password?code={{ $verificationToken }}">Đặt lại mật khẩu mới</a>
        <p>Cảm ơn bạn đã sử dụng Trick loR!</p>
        <p>Trân trọng, Đội ngũ Trick loR</p>
    </div>
</body>

</html>