<!DOCTYPE html>
<html lang="en">

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
    <title>Files</title>


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
                    <a class="active d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminFile') }}">
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
            <h1 class="p-relative">{{ __('messages.allfiles') }}</h1>
            <div class="file-page m-20 d-flex gap-20">
                {{-- <div class="file-stats p-20 bg-white rad-10" style="border: 1px solid black;">
                    <h2 class="mt-0 mb-15 text-center-mobile">{{ __('messages.FilesStatistics') }}</h2>
                    <div class="d-flex algin-center b-eee p-10 mb-15 rad-6 fs-13">
                        <i class="blue fa fa-file-pdf-o fa-lg center-flex c-red icon"></i>
                        <div class="info ">
                            <span>{{ __('messages.CountFile') }}</span>
                            <span class="c-grey d-block mb-5">{{ $countFiles }}</span>
                        </div>
                        <div class="size c-grey">{{ $totalSizeInMb }} Mb</div>
                    </div>

                    <a class="upload fs-13 rad-6 d-block w-fit" style="border: 1px solid black;"
                        href="{{ route('download.all.files') }}">
                        <i class="fa fa-hand-pointer-o mr-10"></i>
                        {{ __('messages.UploadAllFile') }}
                    </a>
                </div> --}}
                <div class="file-content d-grid gap-20">
                    @foreach ($filesWithDetails as $fileData)
                        <div class="file bg-white p-10 rad-10" style="border: 1px solid black;">
                            <a href="{{ asset('uploads/' . $fileData['file']) }}" class="download-link" download>
                                <i class="fa fa-download p-absolute c-grey"></i>
                            </a>
                            <div class="icon text-center">
                                <img class="mt-15 mb-15" src="images/freeFile.png" alt="">
                            </div>
                            <div class="text-center fs-14 mb-10">{{ basename($fileData['file']) }}</div>
                            <p class="fs-13 c-grey"></p>
                            <div class="info between-flex mt-10 pt-10 fs-13 c-grey">
                                <span class="">{{ basename($fileData['created_at']) }}</span>
                                <span class="">{{ number_format($fileData['size_in_mb'], 2) }} Mb</span>
                            </div>
                        </div>
                    @endforeach
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
