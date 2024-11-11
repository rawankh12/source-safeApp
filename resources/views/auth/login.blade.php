<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/LoginRegister.css">
    <title>Source safe</title>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body>

    <div class="content">
        <div class="heading">Source Safe </div>
        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="subheading">Please enter your email and password to continue</div>
            <div class="form-group">
                <input id="email" type="email" placeholder="Enter your email" class="form-control" name="email"
                    required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="password" type="password" placeholder="Enter your password" class="form-control"
                    name="password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </form>
    </div>
</body>

</html>
