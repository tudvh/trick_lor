<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        p {
            font-size: 1rem;
            color: #292929;
            margin: 0 0 10px 0;
        }

        strong {
            color: orangered;
        }

        a {
            display: block;
            width: fit-content;
            margin: 0 auto;
            text-decoration: none;
            background-image: linear-gradient(#ff9b76, orangered);
            color: #ffffff !important;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }

        a:hover {
            background-image: linear-gradient(orangered, orangered);
        }

        .wrapper {
            background-color: #f0f2f5;
            padding: 3rem 0.1rem;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.12);
        }

        .header {
            max-width: 300px;
            margin: 0 auto 24px;
            text-align: center;
        }

        .header img {
            max-width: 160px;
        }

        .header p {
            color: #77797c;
            margin-top: 0.25rem;
            font-size: 0.95rem;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <header class="header">
                <img src="https://cdn.discordapp.com/attachments/858695320753012789/1193420808983433297/logo-web.png" alt="Trick loR">
                <p>Reset your password</p>
            </header>
            <p>Dear <strong>{{ $fullName }}</strong>,</p>
            <p>We've received a request to reset the password for your Trick loR account. To complete the password reset process, please click on the link below and create a new, secure password.</p>
            <p>
                <a href="{{ URL::to('/') }}/auth/reset-password?token={{ $verificationToken }}">Create a New Password</a>
            </p>
            <p>Thank you for your prompt attention to this matter.</p>
            <p>Best regards,</p>
            <p>Trick loR</p>
        </div>
    </div>
</body>

</html>