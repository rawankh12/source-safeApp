<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/LoginRegister.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Source Safe</title>
    <style>
        .hidden {
            display: none;
        }

        #languageSwitcher {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <img width="40" height="40" src="https://img.icons8.com/color/48/google-translate.png" alt="Switch Language"
        id="languageSwitcher">
    <div class="content">
        <div class="heading">{{ __('messages.heading') }}</div>
        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input id="email" type="email" placeholder="{{ __('messages.email') }}"
                    class="form-control @error('email') is-invalid @enderror" name="email">
                @error('email')
                    <div class="invalid-feedback">
                        @foreach ($errors->get('email') as $message)
                            <p><strong>{{ $message }}</strong></p>
                        @endforeach
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <input id="password" type="password" placeholder="{{ __('messages.password') }}"
                    class="form-control @error('password') is-invalid @enderror" name="password">
                @error('password')
                    <div class="invalid-feedback">
                        @foreach ($errors->get('password') as $message)
                            <p><strong>{{ $message }}</strong></p>
                        @endforeach
                    </div>
                @enderror
            </div>
            <button type="submit">{{ __('messages.Login') }}</button>
            @if (session('error'))
                <div class="alert alert-danger" style="background-color: rgb(211, 231, 231); color:black;">
                    {{ session('error') }}
                </div>
            @endif
            <div class="register-link">
                <p>{{ __('messages.ques') }} <a href="{{ route('register') }}"
                        style="color: rgb(190, 209, 226);">{{ __('messages.Register') }}</a></p>
            </div>
        </form>
    </div>
</body>

</html>
<script type="text/javascript">
    var url = "{{ route('langChange') }}";
    var currentLanguage = "{{ session()->get('language') }}";
    document.getElementById('languageSwitcher').addEventListener('click', function() {
        var nextLanguage = currentLanguage === 'ar' ? 'en' : 'ar';
        window.location.href = url + "?lang=" + nextLanguage;
    });
</script>
