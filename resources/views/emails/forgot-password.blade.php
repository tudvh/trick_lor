<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, 'Segoe UI', Arial, sans-serif;
            color: #718096;
        }

        p {
            font-size: 1rem;
            margin-bottom: 1rem;
            overflow-wrap: break-word;
        }

        p.more {
            font-size: 0.875rem;
        }

        hr {
            margin: 25px 0;
            border-color: #e8e5ef
        }

        strong {
            color: orangered;
        }

        .btn {
            display: block;
            width: fit-content;
            margin: 1.875rem auto;
            text-decoration: none;
            background-color: orangered;
            color: #ffffff !important;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
        }

        .wrapper {
            background-color: #edf2f7;
        }

        .container {
            width: 570px;
            margin: 0 auto;

            @media (max-width: 600px) {
                width: 100%;
            }
        }

        .header {
            padding: 25px 2rem;
        }

        .header a {
            display: block;
            width: 100%;
            text-align: center;
            color: orangered;
            font-size: 1.5rem;
            text-decoration: none;
            font-weight: bold;
        }

        .content {
            background-color: #ffffff;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.12);
            padding: 2rem;
        }

        .footer {
            padding: 32px;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <a href="{{ URL::to('/') }}" target="_blank">
                    {{ config('app.name') }}
                </a>
            </div>
            <div class="content">
                <p>Hi <strong>{{ $fullName }}</strong>,</p>
                <p>We have received a request to reset the password for your Trick loR account. To complete the process,
                    please click the link below and set a new, secure password.</p>
                <a href="{{ URL::to('/') }}/auth/reset-password?token={{ $verificationToken }}" class="btn">
                    Create a New Password
                </a>
                <p>If you did not request a password reset, no further action is needed.</p>
                <p>Best regards,<br>The Trick loR Team</p>
                <hr>
                <p class="more">
                    If you're having trouble clicking the "Create a New Password" button, copy and paste the URL below
                    into your web browser: <a
                        href="{{ URL::to('/') }}/auth/reset-password?token={{ $verificationToken }}">
                        {{ URL::to('/') }}/auth/reset-password?token={{ $verificationToken }}
                    </a>
                </p>
            </div>
            <div class="footer">
                © {{ date('Y') }} Trick loR. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>
