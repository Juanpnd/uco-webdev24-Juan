<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(180deg, #F0F8FF 0%, #60B2FF 100%);
        }

        .login-card {
            background: white;
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 450px;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .login-title {
            font-size: 40px;
            font-weight: 700;
            color: #000;
            margin-bottom: 15px;
            text-align: center;
        }

        .input-field {
            width: 100%;
            padding: 16px;
            background-color: #F5F5F5;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            color: #666;
        }

        .input-field::placeholder {
            color: #999;
        }

        .login-button {
            width: 100%;
            padding: 16px;
            background-color: #60B2FF;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin: 10px 0;
        }

        .register-text {
            text-align: center;
            color: #333;
            font-size: 14px;
            margin: 15px 0 30px 0;
        }

        .register-text a {
            color: #60B2FF;
            text-decoration: none;
            font-weight: 500;
            margin-left: 5px;
            cursor: pointer;
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .logo img {
            width: 60px;
            height: auto;
        }

        .logo-text {
            font-size: 24px;
            color: #60B2FF;
            font-style: italic;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h1 class="login-title">Login</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email Input -->
            <input type="email" name="email" class="input-field" id="email" placeholder="Enter your email" required>

            <!-- Password Input -->
            <input type="password" name="password" class="input-field" id="password" placeholder="Enter your password" required>

            <!-- Remember Me Checkbox -->
           

            <!-- Login Button -->
            <button type="submit" class="login-button">Login</button>

            <!-- Registration and Forgot Password Links -->
            <div class="register-text">
                <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
            </div>
        </form>

        <!-- Optional Logo (if needed) -->
        {{-- <div class="logo">
            <img src="path_to_logo.png" alt="Logo">
            <span class="logo-text">Your App</span>
        </div> --}}
    </div>
</body>
</html>
