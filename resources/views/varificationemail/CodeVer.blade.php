<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Code Verfication</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* إعدادات التوسيط باستخدام Flexbox */
        .form-container {
            display: flex;
            justify-content: center;
            /* التوسيط الأفقي */
            align-items: center;
            /* التوسيط العمودي */
            height: 100vh;
            /* ملء الارتفاع بالكامل */
        }

        /* إعدادات إضافية لتجميل النموذج */
        form {
            background-color: #f8f8f8;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            /* تحديد عرض أقصى */
        }

        .inputCart {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
        }

        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: #5B9F71;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="form-container">

        <form action="/verCode" method="POST" id="verificationForm">
            <div style="text-align: center">
                <h2 style="color:#5B9F71;">{{ __('messages.ver') }}</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- عرض رسائل الأخطاء -->
                @if ($errors->has('error'))
                    <div class="alert alert-danger">
                        {{ $errors->first('error') }}
                    </div>
                @endif
                <input type="text" name="email" class="inputCart" placeholder="{{ __('messages.ema') }}"
                    value="{{ $user->email }}" readonly>
                <br>
                <input type="text" name="code" class="inputCart" placeholder="{{ __('messages.ver') }}" required>
            </div>
            <br>
            <button class="btn btn-success" type="submit" id="checkout-live-button">
                <i class="fa fa-check"></i>{{ __('messages.Checkout') }}
            </button>
            <a href="#" class="btn btn-danger" id="delete-button">
                <i class="fa fa-trash"></i> {{ __('messages.deleteAcount') }}
            </a>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- عنصر دائرة التحميل (يظهر عند التحقق) -->
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <div class="spinner"></div>
                <p>{{ __('messages.checkingCode') }}</p>
            </div>
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <div class="spinner"></div>
                <p>{{ __('messages.deleteAccount') }}</p> <!-- يمكنك تعديل الرسالة هنا -->
            </div>
            <br>
        </form>
    </div>
    <script>
        document.getElementById('verificationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            document.getElementById('checkout-live-button').style.display = 'none';
            document.getElementById('loadingSpinner').style.display = 'block';
            setTimeout(function() {
                document.getElementById('verificationForm').submit();
            }, 2000);
        });
        document.getElementById('delete-button').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('delete-button').style.display = 'none';
            document.getElementById('loadingSpinner').style.display = 'block';
            setTimeout(function() {
                window.location.href = document.getElementById('delete-button').href;
            }, 2000);
        });
    </script>
</body>

</html>
