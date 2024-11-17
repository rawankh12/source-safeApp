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
    <title>Files</title>


</head>

<body>
    <div class="page d-flex">
        <div class="sidebar bg-white p-20 p-relative">
            <h3 class="p-relative mt-0 text-center">{{ $user->name }}</h3>
            <ul>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminHome') }}">
                        <i class="fa fa-bar-chart"></i>
                        <span class="fs-14 ml-14 hide-mobile">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminSetting') }}">
                        <i class="fa fa-gear fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">Setting</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('profile') }}">
                        <i class="fa fa-user-o fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">Profile</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('profile') }}">
                        <i class="fa fa-share-alt fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">Projects</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="course.html">
                        <i class="fa fa-graduation-cap fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">Courses</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminUser') }}">
                        <i class="fa fa-user-circle-o fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">Friends</span>
                    </a>
                </li>
                <li>
                    <a class="active d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminFile') }}">
                        <i class="fa fa-file-o fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">Files</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="plan.html">
                        <i class="fa fa-th-list"></i>
                        <span class="fs-14 ml-14 hide-mobile">Plans</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content w-full">
            <div class="head bg-white p-15 between-flex">
                <div class="search p-relative">
                    <input class="p-10" type="text" placeholder="Search">
                </div>
                <div class="icons d-flex algin-center">
                    <span class="notifcation p-relative cur-pointer ">
                        <i class="fa fa-bell fa-lg"></i>
                    </span>
                    <img src="images/avatar3.png" alt="">
                </div>
            </div>
            <h1 class="p-relative">Files</h1>
            <div class="file-page m-20 d-flex gap-20">
                <div class="file-stats p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-15 text-center-mobile">Files Statistics</h2>
                    <div class="d-flex algin-center b-eee p-10 mb-15 rad-6 fs-13">
                        <i class="blue fa fa-file-pdf-o fa-lg center-flex c-red icon"></i>
                        <div class="info ">
                            <span>Count File</span>
                            <span class="c-grey d-block mb-5">{{ $countFiles }}</span>
                        </div>
                        <div class="size c-grey">{{ $totalSizeInMb }} Mb</div>
                    </div>

                    <a class="upload bg-blue c-white fs-13 rad-6 d-block w-fit"
                        href="{{ route('download.all.files') }}">
                        <i class="fa fa-hand-pointer-o mr-10"></i>
                        Upload All File
                    </a>
                </div>
                <div class="file-content d-grid gap-20">
                    @foreach ($filesWithDetails as $fileData)
                        <div class="file bg-white p-10 rad-10 ">
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


</html>
