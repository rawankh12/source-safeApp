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
    <title>Source safe</title>
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
    @if ($errors->has('error'))
        <div class="alert alert-danger">
            {{ $errors->first('error') }}
        </div>
    @endif
    <img width="40" height="40" src="https://img.icons8.com/color/48/google-translate.png" alt="Switch Language"
        id="languageSwitcher">
    <div class="content">
        <div class="heading">{{ __('messages.heading') }}</div>
        <form id="registerForm" method="POST" action="{{ route('register') }}" class="hidden">
            @csrf
            {{-- <div class="subheading">Please enter your info to continue</div> --}}
            <div class="form-group">
                <input id="name" type="text" placeholder="{{ __('messages.name') }}" class="form-control"
                    name="name" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="email" type="email" placeholder="{{ __('messages.email') }}" class="form-control"
                    name="email" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="password" type="password" placeholder="{{ __('messages.password') }}" class="form-control"
                    name="password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit">{{ __('messages.Register') }}</button>
            <div class="register-link">
                <p>{{ __('messages.quess') }}<a href="{{ route('login') }}"
                        style="color: rgb(190, 209, 226);">{{ __('messages.Login') }}</a></p>
            </div>
        </form>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" style="background-color: rgb(211, 231, 231); color:black;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>

</html>
<script>
    document.getElementById('registerForm').classList.remove('hidden');
</script>
<script type="text/javascript">
    var url = "{{ route('langChange') }}";
    var currentLanguage = "{{ session()->get('language') }}";
    document.getElementById('languageSwitcher').addEventListener('click', function() {
        var nextLanguage = currentLanguage === 'ar' ? 'en' : 'ar';
        window.location.href = url + "?lang=" + nextLanguage;
    });
</script>
