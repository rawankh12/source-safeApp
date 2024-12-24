<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/master.css">
    <link rel="stylesheet" href="Css/framwork.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500&display=swap">
    <link rel="stylesheet" href="Css/normalize.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/js/script.js"></script>
    <title>Settings</title>
</head>

<body>
    <div class="page d-flex">
        <div class="sidebar p-20 p-relative">
            <h3 class="p-relative mt-0 text-center">{{ $user->name }}</h3>
            <ul>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminHome') }}">
                        <i class="fa fa-bar-chart"></i>
                        <span class="fs-14 ml-14 hide-mobile">{{ __('messages.home') }}</span>
                    </a>
                </li>
                <li>
                    <a class="active d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminSetting') }}">
                        <i class="fa fa-gear fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">{{ __('messages.Setting') }}</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('profileAdmin') }}">
                        <i class="fa fa-user-o fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">{{ __('messages.profile') }}</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('project') }}">
                        <i class="fa fa-share-alt fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">{{ __('messages.all') }}</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminUser') }}">
                        <i class="fa fa-user-circle-o fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">{{ __('messages.allusers') }}</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminFile') }}">
                        <i class="fa fa-file-o fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">{{ __('messages.allfiles') }}</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content w-full">
            <div class="head p-15 between-flex">
                <div class="search p-relative">
                    <input class="p-10" type="text" placeholder="Search">
                </div>
                <div class="icons d-flex algin-center">
                    <span class="notifcation p-relative cur-pointer ">
                        <i class="fa fa-bell fa-lg"></i>
                    </span>
                    {{-- <img src="images/avatar3.png" alt=""> --}}
                    <form action="{{ route('logout') }}" method="POST" onsubmit="return confirmlogout(event)">
                        @csrf
                        <button id="profile-btn" class="logout-btn" type="submit">
                            <img width="30" height="30" src="https://img.icons8.com/sf-regular/48/exit.png"
                                alt="exit" />
                        </button>
                    </form>
                    <!-- زر تبديل الوضع -->
                    <button id="mode-toggle" class="theme-btn">
                        <img width="30" height="30" src="https://img.icons8.com/ios/50/sun.png" alt="sun" />
                    </button>
                </div>
            </div>
            <h1 class="p-relative">{{ __('messages.Setting') }}</h1>
            <div class="setting-page m-20 d-grid gap-20">
                <div class="p-201 rad-10">
                    <h2 class="mt-0 mb-10">{{ __('messages.Setting') }}</h2>
                    <p class="mt-0 mb-20 c-grey fs-15">{{ __('messages.control') }}</p>
                    {{-- <div class="mt-15 between-flex"style="margin-bottom: 50px">
                        <div>
                            <span>{{ __('messages.DarkMood') }}</span>
                            <p class="c-grey mt-5 mb-0 fs-13">{{ __('messages.changewebSite') }}</p>
                        </div>
                        <div>
                            <label>
                                <input class="toggle-checkbox" type="checkbox" />
                                <div class="toggle-switch" id="mode-toggle"></div>
                            </label>
                        </div>
                    </div> --}}
                    <div class="mt-15 between-flex">
                        <div>
                            <span>{{ __('messages.ArbicMood') }}</span>
                            <p class="c-grey mt-5 mb-0 fs-13">{{ __('messages.ToArbic') }}</p>
                        </div>
                        <div>
                            <label>
                                <input class="toggle-checkbox" type="checkbox" />
                                <div class="toggle-switch" id="languageSwitcher"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="p-201 rad-10">
                    <h2 class="mt-0 mb-10">{{ __('messages.GenralInformation') }}</h2>
                    {{-- <p class="mt-0 mb-20 c-grey fs-15">General Information About Your Account</p> --}}
                    <div class="mb-15">
                        <label class="fs-14 c-grey d-block mb-10" for="first">{{ __('messages.groupname') }}</label>
                        <input class="b-none p-10 rad-6 d-block w-full b-ccc" type="text" id="first"
                            placeholder="First Name" value="{{ $user->name }}"disabled>
                    </div>

                    <div>
                        <label class="fs-14 c-grey d-block mb-10" for="email">{{ __('messages.emailpro') }}</label>
                        <input class="email b-none p-10 rad-6 d-block w-full b-ccc mb-15" type="email" id="email"
                            placeholder="Email" value="{{ $user->email }}" disabled>
                    </div>
                    <div>
                        <label class="fs-14 c-grey d-block mb-10"
                            for="email">{{ __('messages.changePassword') }}</label>
                        <form action="">
                            <input class="email b-none p-10 rad-6 d-block w-full b-ccc mb-15" type="email"
                                id="email" placeholder="{{ __('messages.NewPassword') }}">
                            <button class="c-blue btn" href="#">{{ __('messages.Change') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    var url = "{{ route('langChange') }}";
    var currentLanguage = "{{ session()->get('language') }}";

    // تغيير اللغة
    document.getElementById('languageSwitcher').addEventListener('click', function() {
        var nextLanguage = currentLanguage === 'ar' ? 'en' : 'ar';
        document.body.setAttribute('dir', nextLanguage === 'ar' ? 'rtl' : 'ltr');
        window.location.href = url + "?lang=" + nextLanguage;
    });
    // تبديل الثيم
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggleBtn = document.getElementById('mode-toggle');
        const themeIcon = themeToggleBtn.querySelector('img');
        const body = document.body;
        const sidebar = document.getElementById('sidebar');
        const header = document.querySelector('.header');
        const footer = document.querySelector('.footer');

        // استرداد الثيم المحفوظ
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            applyTheme(savedTheme);
        } else {
            applyTheme('light'); // الوضع الافتراضي
        }

        // تبديل الثيم عند النقر
        themeToggleBtn.addEventListener('click', function() {
            const currentTheme = body.classList.contains('dark-mode') ? 'dark' : 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            applyTheme(newTheme);
            localStorage.setItem('theme', newTheme); // حفظ الثيم الجديد
        });

        // تابع لتطبيق الثيم
        function applyTheme(theme) {
            if (theme === 'dark') {
                body.classList.add('dark-mode');
                body.classList.remove('light-mode');
                if (sidebar) {
                    sidebar.classList.add('dark-mode');
                    sidebar.classList.remove('light-mode');
                }

                if (header) {
                    header.classList.add('dark-mode');
                    header.classList.remove('light-mode');
                }

                if (footer) {
                    footer.classList.add('dark-mode');
                    footer.classList.remove('light-mode');
                }

                themeIcon.src = 'https://img.icons8.com/ios/50/moon-symbol.png'; // أيقونة الوضع الليلي
            } else {
                body.classList.add('light-mode');
                body.classList.remove('dark-mode');

                if (sidebar) {
                    sidebar.classList.add('light-mode');
                    sidebar.classList.remove('dark-mode');
                }

                if (header) {
                    header.classList.add('light-mode');
                    header.classList.remove('dark-mode');
                }

                if (footer) {
                    footer.classList.add('light-mode');
                    footer.classList.remove('dark-mode');
                }

                themeIcon.src = 'https://img.icons8.com/ios/50/sun.png'; // أيقونة الوضع النهاري
            }
        }
    });
</script>
<style>
    .logout-btn {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
    }

    .logout-btn img {
        display: block;
    }

    .theme-btn {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
    }

    .theme-btn img {
        display: block;
    }
</style>

</html>
