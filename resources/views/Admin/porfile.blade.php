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
    <title>Profile</title>


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
                    <a class="active d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('profile') }}">
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
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminFile') }}">
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
            <h1 class="p-relative">Profile</h1>
            <div class="profile-page p-20">
                <div class="overview bg-white rad-10 d-flex algin-center">
                    <div class="avater-box p-20 text-center">
                        <img class="mb-10 rad-hlef" src="images/avatar3.png" alt="">
                        <h3 class="m-0">Kahder Eskander</h3>
                        <p class="c-grey mb-10">level 10</p>
                        <div class="level rad-6 bg-eee p-relative">
                            <span style="width:70%"></span>
                        </div>
                        <div class="rating mt-10 mb-10">
                            <i class="fa fa-star c-orange fs-13"></i>
                            <i class="fa fa-star c-orange fs-13"></i>
                            <i class="fa fa-star c-orange fs-13"></i>
                            <i class="fa fa-star c-orange fs-13"></i>
                            <i class="fa fa-star c-orange fs-13"></i>
                        </div>
                        <p class="c-grey m-0 fs-13">550 Rating</p>
                    </div>

                    <div class="info-box w-full text-center-mobile">
                        <div class="box p-20 d-flex algin-center">
                            <h4 class="fs-15 m-0 w-full c-grey">Genral Information</h4>
                            <div class="fs-14">
                                <span class="c-grey">Full Name: </span>
                                <span>Khader Eskander</span>
                            </div>
                            <div class="fs-14">
                                <span class="c-grey">Gender: </span>
                                <span>Male</span>
                            </div>
                            <div class="fs-14">
                                <span class="c-grey">Contry: </span>
                                <span>Syria</span>
                            </div>
                            <div class="fs-14">
                                <label>
                                    <input class="toggle-checkbox" type="checkbox" />
                                    <div class="toggle-switch"></div>

                                </label>
                            </div>
                        </div>
                        <div class="box p-20 d-flex algin-center">
                            <h4 class="fs-15 m-0 w-full c-grey">Personal Information</h4>
                            <div class="fs-14">
                                <span class="c-grey">Email: </span>
                                <span>Khader@gmail.com</span>
                            </div>
                            <div class="fs-14">
                                <span class="c-grey">Phone: </span>
                                <span>+963930668517</span>
                            </div>
                            <div class="fs-14">
                                <span class="c-grey">Date Of Brath: </span>
                                <span>17/3/2001</span>
                            </div>
                            <div class="fs-14">
                                <label>
                                    <input class="toggle-checkbox" type="checkbox" />
                                    <div class="toggle-switch"></div>

                                </label>
                            </div>
                        </div>
                        <div class="box p-20 d-flex algin-center">
                            <h4 class="fs-15 m-0 w-full c-grey">Job Information</h4>
                            <div class="fs-14">
                                <span class="c-grey">Title: </span>
                                <span>FrontEnd Develpoer</span>
                            </div>
                            <div class="fs-14">
                                <span class="c-grey">Program Language: </span>
                                <span>React.js</span>
                            </div>
                            <div class="fs-14">
                                <span class="c-grey">Year Of Experience: </span>
                                <span>2 Year</span>
                            </div>
                            <div class="fs-14">
                                <label>
                                    <input class="toggle-checkbox" type="checkbox" />
                                    <div class="toggle-switch"></div>

                                </label>
                            </div>
                        </div>
                    </div>




                </div>
                <div class="othere-data d-flex gap-20">
                    <div class="skills-card mt-20 bg-white rad-10 ">
                        <h2 class="ml-14 ">My Skills</h2>
                    <p class="c-grey mt-0 mb-20 ml-14 fs-15">Complete Skills List</p>
                    <ul>
                        <li><span>HTML</span></li>
                        <li><span>Css</span></li>
                        <li><span>JavaScript</span></li>
                        <li><span>REact.js</span></li>
                        <li><span>PHP</span></li>
                        <li><span>Laravel</span></li>
                    </ul>
                    </div>

                    <div class="activities mt-20 bg-white rad-10 ">
                        <h2 class="ml-14">Latest Activities</h2>
                    <p class="c-grey mt-0 mb-20 ml-14 fs-15">Latest Activities Done By The User</p>
                    <div class="activity d-flex algin-center text-center-mobile">
                        <img src="images/desicon3.png" alt="">
                        <div class="info">
                            <span class="d-block mb-10">Store</span>
                            <span class="c-grey ">Bought The Mastring React Course</span>
                        </div>
                        <div class="date">
                            <span class="time d-block mb-10">18:15</span>
                            <span class="c-grey ">Yesterday</span>
                        </div>
                    </div>
                    <div class="activity d-flex algin-center text-center-mobile">
                        <img src="images/icon05.png" alt="">
                        <div class="info">
                            <span class="d-block mb-10">Academy</span>
                            <span class="c-grey ">Got The React Certificate</span>
                        </div>
                        <div class="date">
                            <span class="time d-block mb-10">10:15</span>
                            <span class="c-grey ">Yesterday</span>
                        </div>
                    </div>
                    <div class="activity d-flex algin-center text-center-mobile">
                        <img src="images/icon06.png" alt="">
                        <div class="info">
                            <span class="d-block mb-10">Badges</span>
                            <span class="c-grey ">Unlocked The 10 Skills Badges</span>
                        </div>
                        <div class="date">
                            <span class="time d-block mb-10">18:15</span>
                            <span class="c-grey ">Yesterday</span>
                        </div>
                    </div>
                    <div class="activity d-flex algin-center text-center-mobile">
                        <img src="images/desicon3.png" alt="">
                        <div class="info">
                            <span class="d-block mb-10">Store</span>
                            <span class="c-grey ">Bought The Mastring React Course</span>
                        </div>
                        <div class="date">
                            <span class="time d-block mb-10">18:15</span>
                            <span class="c-grey ">Yesterday</span>
                        </div>
                    </div>

                    </div>
                </div>




            </div>
        </div>
    </div>

</body>

</html>