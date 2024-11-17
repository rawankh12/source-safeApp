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
    <title>Settings</title>


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
                    <a class="active d-flex align-items fs-14 rad-6 c-black p-10" href="setting.html">
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
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="course.html">
                        <i class="fa fa-graduation-cap fa-fw"></i>
                        <span class="fs-14 ml-14 hide-mobile">Courses</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items fs-14 rad-6 c-black p-10" href="friend.html">
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
            <h1 class="p-relative">Settings</h1>
            <div class="setting-page m-20 d-grid gap-20">
                <div class="p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-10">Site control</h2>
                    <p class="mt-0 mb-20 c-grey fs-15">Control The Website If There Is maintenance</p>
                    <div class="mt-15 between-flex"style="margin-bottom: 50px">
                        <div>
                            <span>Dark Mood</span>
                            <p class="c-grey mt-5 mb-0 fs-13">change webSite To dark mood</p>
                        </div>
                        <div>
                            <label>
                                <input class="toggle-checkbox" type="checkbox" />
                                <div class="toggle-switch"></div>
                            </label>
                        </div>

                    </div>
                    <div class="mt-15 between-flex">
                        <div>
                            <span>Arbic Mood</span>
                            <p class="c-grey mt-5 mb-0 fs-13">change webSite To Arbic mood</p>
                        </div>
                        <div>
                            <label>
                                <input class="toggle-checkbox" type="checkbox" />
                                <div class="toggle-switch"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-10">General Info</h2>
                    <p class="mt-0 mb-20 c-grey fs-15">General Information About Your Account</p>
                    <div class="mb-15">
                        <label class="fs-14 c-grey d-block mb-10" for="first">Name</label>
                        <input class="b-none p-10 rad-6 d-block w-full b-ccc" type="text" id="first"
                            placeholder="First Name" value="{{ $user->name }}"disabled>
                    </div>

                    <div>
                        <label class="fs-14 c-grey d-block mb-10" for="email">Email</label>
                        <input class="email b-none p-10 rad-6 d-block w-full b-ccc mb-15" type="email" id="email"
                            placeholder="Email" value="{{ $user->email }}" disabled>
                    </div>
                    <div>
                        <label class="fs-14 c-grey d-block mb-10" for="email">change Password</label>
                        <form action="">
                            <input class="email b-none p-10 rad-6 d-block w-full b-ccc mb-15" type="email"
                                id="email" placeholder="New Password">
                            <button class="c-blue btn" href="#">Change</button>
                        </form>
                    </div>
                </div>
                {{-- <div class="p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-10">Security Info</h2>
                    <p class="mt-0 mb-20 c-grey fs-15">Security Information About Your Account</p>
                    <div class="sec-box between-flex pb-20">
                        <div>
                            <span>Password</span>
                            <p class="mt-5 c-grey mb-0 fs-13">Last Change On 17/10/2022</p>
                        </div>
                        <a class="button bg-blue c-white button-shape" href="#">Change</a>
                    </div>

                    <div class="sec-box between-flex pb-20">
                        <div>
                            <span>Tow-Factor Authentication </span>
                            <p class="mt-5 c-grey mb-0 fs-13">Enable-Disable The Feature</p>
                        </div>
                        <label>
                            <input class="toggle-checkbox" type="checkbox" />
                            <div class="toggle-switch"> </div>
                        </label>
                    </div>

                    <div class="sec-box between-flex">
                        <div>
                            <span>Devices</span>
                            <p class="mt-5 c-grey mb-0 fs-13">Check The Login Devices List</p>
                        </div>
                        <a class="bg-eee c-black button-shape" href="#">Devices</a>
                    </div>
                </div>

                <div class="social-box p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-10">Social Info</h2>
                    <p class="mt-0 mb-20 c-grey fs-15">Social Media Information</p>

                    <div class="d-flex algin-center fs-15 mb-15">
                        <i class="fa fa-twitter center-flex c-grey"></i>
                        <input class="w-full" type="text" placeholder="Twitter UserName">
                    </div>

                    <div class="d-flex algin-center fs-15 mb-15">
                        <i class="fa fa-facebook center-flex c-grey"></i>
                        <input class="w-full" type="text" placeholder="facebook UserName">
                    </div>

                    <div class="d-flex algin-center fs-15 mb-15">
                        <i class="fa fa-youtube center-flex c-grey"></i>
                        <input class="w-full" type="text" placeholder="youtube UserName">
                    </div>

                    <div class="d-flex algin-center fs-15">
                        <i class="fa fa-linkedin center-flex c-grey"></i>
                        <input class="w-full" type="text" placeholder="linkedin UserName">
                    </div>
                </div>
                <div class="widgits-control p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-10">Widgets Control</h2>
                    <p class="mt-0 mb-20 c-grey fs-15">Show/Hide Widgets</p>
                    <div class="control d-flex algin-center mb-15">
                        <input type="checkbox" id="one">
                        <label for="one">Quick Draft</label>
                    </div>

                    <div class="control d-flex algin-center mb-15">
                        <input type="checkbox" id="two">
                        <label for="two">Yearly Targets</label>
                    </div>

                    <div class="control d-flex algin-center mb-15">
                        <input type="checkbox" id="three" checked>
                        <label for="three">Tickets Statistics</label>
                    </div>

                    <div class="control d-flex algin-center mb-15">
                        <input type="checkbox" id="four">
                        <label for="four">Latest News</label>
                    </div>

                    <div class="control d-flex algin-center mb-15">
                        <input type="checkbox" id="five">
                        <label for="five">Latest Tasks</label>
                    </div>

                    <div class="control d-flex algin-center mb-15">
                        <input type="checkbox" id="six">
                        <label for="six">Top Search Items</label>
                    </div>
                </div>
                <div class="backup-control p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-10">Backup Manger</h2>
                    <p class="mt-0 mb-20 c-grey fs-15">control Backup Time And Location</p>
                    <div class="date d-flex algin-center mb-15">
                        <input type="radio" name="time" id="daily">
                        <label for="daily">Daily</label>
                    </div>
                    <div class="date d-flex algin-center mb-15">
                        <input type="radio" name="time" id="weekly">
                        <label for="weekly">Weekly</label>
                    </div>
                    <div class="date d-flex algin-center mb-15">
                        <input type="radio" name="time" id="manthly">
                        <label for="manthly">Manthly</label>
                    </div>

                    <div class="servers d-flex algin-center text-center">

                        <input type="radio" name="server" id="server-one">
                        <div class="server mb-15 rad-10 w-full">
                            <label class="d-block m-15" for="server-one">
                                <i class="fa fa-server d-block mb-10" aria-hidden="true"></i>
                                Megaman
                            </label>
                        </div>
                        <input type="radio" name="server" id="server-two" checked>
                        <div class="server mb-15 rad-10 w-full">
                            <label class="d-block m-15" for="server-two">
                                <i class="fa fa-server d-block mb-10" aria-hidden="true"></i>
                                Eskander
                            </label>
                        </div>
                        <input type="radio" name="server" id="server-three">
                        <div class="server mb-15 rad-10 w-full">
                            <label class="d-block m-15" for="server-three">
                                <i class="fa fa-server d-block mb-10" aria-hidden="true"></i>
                                Sigma
                            </label>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</body>

</html>
