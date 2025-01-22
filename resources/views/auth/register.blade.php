<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

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

        .register-card {
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

        .register-title {
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

        .register-button {
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
    <div class="register-card">
        <h1 class="register-title">Register</h1>
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Full Name -->
            <input type="text" name="name" class="input-field" id="name" placeholder="Enter your full name" required value="{{ old('name') }}">

            <!-- Email -->
            <input type="email" name="email" class="input-field" id="email" placeholder="Enter your email" required value="{{ old('email') }}">

            <!-- Password -->
            <input type="password" name="password" class="input-field" id="password" placeholder="Create a password" required>

            <!-- Confirm Password -->
            <input type="password" name="password_confirmation" class="input-field" id="password_confirmation" placeholder="Confirm your password" required>

            <!-- Register Button -->
            <button type="submit" class="register-button">Register</button>

            <!-- Login Redirect -->
            <div class="register-text">
                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            </div>
        </form>
    </div>
</body>
</html>