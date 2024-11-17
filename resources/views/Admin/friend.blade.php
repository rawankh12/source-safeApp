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
    <title>Friends</title>


</head>

<body>
    <div class="page d-flex">
        <div class="sidebar bg-white p-20 p-relative">
            <h3 class="p-relative mt-0 text-center">Khader</h3>
            <ul>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="main.html">
                        <i class="fa fa-bar-chart"></i>
                        <span class="fs-14 ml-14 hide-mobile">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="setting.html">
                        <i class="fa fa-gear fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">Setting</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="porfile.html">
                        <i class="fa fa-user-o fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">Profile</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="Project.html">
                        <i class="fa fa-share-alt fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">Projects</span>
                    </a>
                </li>
                <li>
                    <a class=" d-flex align-items fs-14 rad-6 c-black p-10" href="course.html">
                        <i class="fa fa-graduation-cap fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">Courses</span>
                    </a>
                </li>
                <li>
                    <a class="active d-flex align-items fs-14 rad-6 c-black p-10" href="friend.html">
                        <i class="fa fa-user-circle-o fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">Friends</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="file.html">
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
            <h1 class="p-relative">Friends</h1>
            <div class="friend-page d-grid p-relative gap-20 m-20">
                @foreach ($allUsers as $user)
                    <div class="friend bg-white rad-6 p-20 p-relative">
                        <div class="text-center">
                            <img class="rad-half mt-10 mb-10 w-100 h-100" src="images/avatar2.png" alt="">
                            <h4 class="m-0">{{ $user->name }}</h4>
                            <p class="mt-5 mb-0 c-grey fs-13">{{ $user->email }}</p>
                        </div>
                        <div class="icons fs-14 p-relative">
                            <div class="mb-10">
                                <i class="fa fa-file fa-fw"></i>
                                <span>{{ $user->files_count }} Files</span>
                            </div>
                            <div class="mb-10">
                                <i class="fa fa-group fa-fw"></i>
                                <span>{{ $user->created_groups_count }} My Groups</span>
                            </div>
                            <div>
                                <i class="fa fa-newspaper-o fa-fw"></i>
                                <span>{{ $user->groups_count }} Groups Join</span>
                            </div>
                        </div>
                        <div class="info between-flex fs-13">
                            <span class="c-crey">Joined
                                {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</span>
                            <div>
                                <a class="bg-blue c-white button-shape" href="porfile.html">
                                    <i class="fa fa-block-user"></i>
                                    Block
                                </a>
                                <a class="bg-red c-white button-shape ml-14" href="#">
                                    <i class="fa fa-trash-o"></i>
                                    Remive
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
</body>


</html>
