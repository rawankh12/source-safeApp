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
    <script src="/js/script.js"></script>
    <title>DashBoard</title>


</head>

<body>
    <div class="page d-flex">
        <div class="sidebar p-20 p-relative">
            <h3 class="p-relative mt-0 text-center">{{ $user->name }}</h3>
            <ul>
                <li>
                    <a class="active d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminHome') }}">
                        <i class="fa fa-bar-chart"></i>
                        <span class="fs-14 ml-14 hide-mobile">{{ __('messages.home') }}</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminSetting') }}">
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
            <h1 class="p-relative">{{ __('messages.home') }}</h1>
            <div class="wrapper d-grid gap-20">
                <div class="welcome rad-10 txt-c-mobile block-mobile">
                    <div class="intro p-20 d-flex space-between bg-eee">
                        <div>
                            <h2 class="m-0">{{ __('messages.welcome') }}</h2>
                            <p class="c-grey mt-5">{{ $user->name }}</p>
                        </div>
                        <img class="hide-mobile" src="img/Website Creator-bro (1).png" alt="">
                    </div>
                    <img src="images/avatar3.png" alt="" class="avatar">
                    <div class="body p-20 d-flex text-center mt-20 block-mobile">
                        <div>{{ $user->name }} <span class="d-block c-grey fs-14 mt-10">{{ $user->name }}</span>
                        </div>
                        <div>{{ __('messages.emailpro') }} <span
                                class="d-block c-grey fs-14 mt-10">{{ $user->email }}</span></div>
                    </div>
                </div>
                <div class="tickets p-20 rad-10">
                    <h2 class="mt-0 mb-10 ">{{ __('messages.FilesStatistics') }}</h2>
                    {{-- <p class="c-grey mt-0 mb-20 fs-15">EveryThing About Support</p> --}}
                    <div class="d-flex text-center gap-20 f-wrap">
                        <div class="box p-20 rad-10 fs-13 c-grey">
                            <i class="fa fa-user fa-3x m-auto"></i>
                            <span class="d-block c-black fw-bold fs-25 mb-5">{{ $allUser }}</span>
                            {{ __('messages.allusers') }}
                        </div>
                        <div class="box p-20 rad-10 fs-13 c-grey">
                            <i class="fa fa-file fa-2x mb-10 c-red"></i>
                            <span class="d-block c-black fw-bold fs-25 mb-5">{{ $files }}</span>
                            {{ __('messages.allfiles') }}
                        </div>
                        <div class="box p-20 rad-10 fs-13 c-grey">
                            <i class="fa fa-group fa-2x mb-10 c-green"></i>
                            <span class="d-block c-black fw-bold fs-25 mb-5">{{ $groups }}</span>
                            {{ __('messages.all') }}
                        </div>
                    </div>
                </div>
                <div class="latest-uplods p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-20">{{ __('messages.LatestUplods') }}</h2>
                    <ul class="m-0">
                        <li class="between-flex pb-10 mb-10">
                            <div class="d-flex algin-center">
                                <img class="mr-10" src="images/pdf.png" alt="" style="width:40px">
                                <div>
                                    <span class="d-block">My-File.pdf</span>
                                    <span class="fs-15 c-grey">Kahder</span>
                                </div>
                            </div>
                            <div class="bg-eee fs-13 button-shape">2.9mb</div>
                        </li>
                        <li class="between-flex pb-10 mb-10">
                            <div class="d-flex algin-center">
                                <img class="mr-10" src="images/avi.png" alt="" style="width:40px">
                                <div>
                                    <span class="d-block">My-Video-file.avi</span>
                                    <span class="fs-15 c-grey">Ali</span>
                                </div>
                            </div>
                            <div class="bg-eee fs-13 button-shape">4.5mb</div>
                        </li>
                        <li class="between-flex pb-10 mb-10">
                            <div class="d-flex algin-center">
                                <img class="mr-10" src="images/psd.png" alt="" style="width:40px">
                                <div>
                                    <span class="d-block">My-psd-file.pdf</span>
                                    <span class="fs-15 c-grey">Admin</span>
                                </div>
                            </div>
                            <div class="bg-eee fs-13 button-shape">7.4mb</div>
                        </li>
                        <li class="between-flex pb-10 mb-10">
                            <div class="d-flex algin-center">
                                <img class="mr-10" src="images/zip.png" alt="" style="width:40px">
                                <div>
                                    <span class="d-block">My-zip.pdf</span>
                                    <span class="fs-15 c-grey">Eskander</span>
                                </div>
                            </div>
                            <div class="bg-eee fs-13 button-shape">1.3mb</div>
                        </li>
                        <li class="between-flex pb-10 mb-10">
                            <div class="d-flex algin-center">
                                <img class="mr-10" src="images/eps.jpg" alt="" style="width:40px">
                                <div>
                                    <span class="d-block">My-Eps.pdf</span>
                                    <span class="fs-15 c-grey">Ahmad</span>
                                </div>
                            </div>
                            <div class="bg-eee fs-13 button-shape">8.7mb</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
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
