<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            box-sizing: border-box;
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
            padding: 3rem .1rem;
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
                <p>Welcome to Trick loR</p>
            </header>
            <p>Dear <strong>{{ $fullName }}</strong>,</p>
            <p>Thank you so much for being a member of Trick loR.</p>
            <p>Click here to verify your email.</p>
            <p>
                <a href="{{ URL::to('/') }}/auth/verify-email?token={{ $verificationToken }}">Verify Your Email</a>
            </p>
            <p>If you have any questions or require assistance, feel free to respond to this email or reach out to our online support team through the website.</p>
            <p>Thank you for choosing Trick loR.</p>
            <p>Best regards,</p>
            <p>Trick loR</p>
        </div>
    </div>
</body>

</html>