<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>

    <!-- Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            /* Beautiful gradient background */
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #333;
        }

        .container {
            max-width: 600px;
            padding: 50px 40px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-in-out;
        }

        .icon {
            font-size: 70px;
            margin-bottom: 10px;
            animation: float 3s ease-in-out infinite;
        }

        .error-code {
            font-size: 140px;
            font-weight: 800;
            line-height: 1;
            /* Gradient Text Effect */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .error-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2d3748;
        }

        .error-message {
            font-size: 16px;
            color: #718096;
            margin-bottom: 35px;
            line-height: 1.6;
        }

        .btn-home {
            display: inline-block;
            padding: 14px 35px;
            font-size: 16px;
            font-weight: 600;
            color: #ffffff;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(118, 75, 162, 0.3);
        }

        .btn-home:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(118, 75, 162, 0.4);
        }

        /* Animations */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Mobile Responsiveness */
        @media (max-width: 480px) {
            .error-code {
                font-size: 100px;
            }

            .error-title {
                font-size: 22px;
            }

            .container {
                padding: 30px 20px;
                width: 90%;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="icon">🚀</div>
        <h1 class="error-code">404</h1>
        <h2 class="error-title">Oops! Page Not Found</h2>
        <p class="error-message">
            It looks like you’ve come to the wrong place! The page you’re looking for has either been deleted or its link has been changed.
        </p>

        <!-- Laravel Blade URL helper to redirect to home page -->
        <a href="{{ url('/') }}" class="btn-home">Back to Homepage</a>
    </div>

</body>

</html>
