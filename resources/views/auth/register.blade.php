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
    @if ($errors->has('error'))
        <div class="alert alert-danger">
            {{ $errors->first('error') }}
        </div>
    @endif

    <div class="content">
        <div class="heading">Source Safe </div>
        <form id="registerForm" method="POST" action="{{ route('register') }}" class="hidden">
            @csrf
            <div class="subheading">Please enter your info to continue</div>
            <div class="form-group">
                <input id="name" type="text" placeholder="Enter your full name" class="form-control"
                    name="name" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
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
            <button type="submit">Register</button>
            <div class="register-link">
                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </form>
    </div>
</body>

</html>
<script>
    document.getElementById('registerForm').classList.remove('hidden');
</script>
