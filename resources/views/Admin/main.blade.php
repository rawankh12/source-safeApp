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
    <title>DashBoard</title>


</head>

<body>
    <div class="page d-flex">
        <div class="sidebar bg-white p-20 p-relative">
            <h3 class="p-relative mt-0 text-center">{{ $user->name }}</h3>
            <ul>
                <li>
                    <a class="active d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminHome') }}">
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
            <h1 class="p-relative">DashBord</h1>
            <div class="wrapper d-grid gap-20">
                <div class="welcome bg-white rad-10 txt-c-mobile block-mobile">
                    <div class="intro p-20 d-flex space-between bg-eee">
                        <div>
                            <h2 class="m-0">Welcome</h2>
                            <p class="c-grey mt-5">{{ $user->name }}</p>
                        </div>
                        <img class="hide-mobile" src="images/welcome.png" alt="">
                    </div>
                    <img src="images/avatar3.png" alt="" class="avatar">
                    <div class="body p-20 d-flex text-center mt-20 block-mobile">
                        <div>Kahder Eskander <span class="d-block c-grey fs-14 mt-10">Devloper</span></div>
                        <div>email <span class="d-block c-grey fs-14 mt-10">{{ $user->email }}</span></div>
                        <div>$8500 <span class="d-block c-grey fs-14 mt-10">Earnd </span></div>
                    </div>
                    <a href="profile.html" class="visit d-block fs-14 bg-blue c-white w-fit button-shape">Profile</a>
                </div>
                <div class="tickets p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-10 ">Statistics</h2>
                    <p class="c-grey mt-0 mb-20 fs-15">EveryThing About Support</p>
                    <div class="d-flex text-center gap-20 f-wrap">
                        <div class="box p-20 rad-10 fs-13 c-grey">
                            <i class="fa fa-user c-blue fa-3x m-auto"></i>
                            <span class="d-block c-black fw-bold fs-25 mb-5">{{ $allUser }}</span>
                            user
                        </div>
                        <div class="box p-20 rad-10 fs-13 c-grey">
                            <i class="fa fa-file fa-2x mb-10 c-red"></i>
                            <span class="d-block c-black fw-bold fs-25 mb-5">{{ $files }}</span>
                            File
                        </div>
                        <div class="box p-20 rad-10 fs-13 c-grey">
                            <i class="fa fa-group fa-2x mb-10 c-green"></i>
                            <span class="d-block c-black fw-bold fs-25 mb-5">{{ $groups }}</span>
                            Groups
                        </div>
                        <div class="box p-20 rad-10 fs-13 c-grey">
                            <i class="fa fa-window-close-o fa-2x mb-10 c-red"></i>
                            <span class="d-block c-black fw-bold fs-25 mb-5">100</span>
                            Deleted
                        </div>
                    </div>
                </div>
                <div class="quaick-draft p-20 rad-10  bg-white">
                    <h2 class="mt-0 mb-10">Quaick Draft </h2>
                    <p class="mt-0 mb-20 fs-15 c-grey"> Write a Draft For Your</p>
                    <form action="">
                        <input class="d-block rad-6 p-10 mb-20 bg-eee w-full b-none tras-3" type="text"
                            placeholder="Title">
                        <textarea class="d-block rad-6 p-10 mb-20 bg-eee w-full b-none" placeholder="Your Thought"></textarea>
                        <input type="submit" value="Send"
                            class="save button-shape d-block bg-blue c-white w-fit fs-14 b-none">
                    </form>
                </div>
                <div class="targets p-20 rad-10 bg-white">
                    <h2 class="mt-0 mb-10">Yeraly Targets</h2>
                    <p class="mt-0 mb-20 c-grey fs-15">Targets of The Year</p>
                    <div class="targets-row mb-20 blue center-flex">
                        <div class="icon center-flex">
                            <i class="fa fa-dollar c-blue fa-3x m-auto"></i>
                        </div>
                        <div class="details">
                            <span class="fs-14 c-grey">Money</span>
                            <span class="d-block mt-5 mb-10 fw-bold">$20.000</span>
                            <div class="progress p-relative">
                                <span class="bg-blue blue" style="width: 55%;">
                                    <span class="bg-blue">55%</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="targets-row mb-20 orange center-flex">
                        <div class="icon center-flex">
                            <i class="fa fa-code c-orange fa-3x m-auto"></i>
                        </div>
                        <div class="details">
                            <span class="fs-14 c-grey">Projects</span>
                            <span class="d-block mt-5 mb-10 fw-bold">24</span>
                            <div class="progress p-relative">
                                <span class="bg-orange orange" style="width: 45%;">
                                    <span class="bg-orange">45%</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="targets-row mb-20 green center-flex">
                        <div class="icon center-flex">
                            <i class="fa fa-user c-green fa-3x m-auto"></i>
                        </div>
                        <div class="details">
                            <span class="fs-14 c-grey">Team</span>
                            <span class="d-block mt-5 mb-10 fw-bold">12</span>
                            <div class="progress p-relative">
                                <span class="bg-green green" style="width: 75%;">
                                    <span class="bg-green">75%</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="latest-news p-20 bg-white rad-10 text-center-mobile">
                    <h2 class="mt-0 mb-20">Latest News</h2>
                    <div class="news-row d-flex algin-center">
                        <img src="images/newspaper.jpg" alt="">
                        <div class="info">
                            <h3>Created SASS Section</h3>
                            <p class="m-0 fs-14 c-grey ">New SASS Example & Tutorials</p>
                        </div>
                        <div class="button-shape bg-eee fs-13 lable">3 Days Ago</div>
                    </div>
                    <div class="news-row d-flex algin-center">
                        <img src="images/news-2.png" alt="">
                        <div class="info">
                            <h3>Changes The Design</h3>
                            <p class="m-0 fs-14 c-grey ">A Brand New Wibsite Design</p>
                        </div>
                        <div class="button-shape bg-eee fs-13 lable">5 Days Ago</div>
                    </div>
                    <div class="news-row d-flex algin-center">
                        <img src="images/news-3.jpg" alt="">
                        <div class="info">
                            <h3>Team Increased</h3>
                            <p class="m-0 fs-14 c-grey ">3 Devlpoer Joind The Team</p>
                        </div>
                        <div class="button-shape bg-eee fs-13 lable">7 Days Ago</div>
                    </div>
                    <div class="news-row d-flex algin-center">
                        <img src="images/news-4.jpg" alt="">
                        <div class="info">
                            <h3>Added Payment Gateway</h3>
                            <p class="m-0 fs-14 c-grey ">Money New Payment Gateway Added</p>
                        </div>
                        <div class="button-shape bg-eee fs-13 lable">Now</div>
                    </div>
                </div>
                <div class="tasks p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-20">Latest Tasks</h2>
                    <div class="tasks-row d-flex between-flex ">
                        <div class="info">
                            <h3 class="mt-0 mb-5 fs-15 ">Record One New Video</h3>
                            <p class="m-0 c-grey">Record Python Create Exe Projects</p>
                        </div>
                        <i class="fa fa-trash-o delete"></i>
                    </div>
                    <div class="tasks-row d-flex between-flex ">
                        <div class="info">
                            <h3 class="mt-0 mb-5 fs-15 ">Write Article</h3>
                            <p class="m-0 c-grey">Write Low Level vs High Level Languages</p>
                        </div>
                        <i class="fa fa-trash-o delete"></i>
                    </div>
                    <div class="tasks-row d-flex algin-center between-flex ">
                        <div class="info">
                            <h3 class="mt-0 mb-5 fs-15 ">Finish</h3>
                            <p class="m-0 c-grey">Publish Academy Programming Project</p>
                        </div>
                        <i class="fa fa-trash-o delete"></i>
                    </div>
                    <div class="tasks-row d-flex between-flex done">
                        <div class="info">
                            <h3 class="mt-0 mb-5 fs-15 ">Attend The Meeting </h3>
                            <p class="m-0 c-grey">Attend The Project Business Analysis Meeting</p>
                        </div>
                        <i class="fa fa-trash-o delete "></i>
                    </div>
                    <div class="tasks-row d-flex between-flex ">
                        <div class="info">
                            <h3 class="mt-0 mb-5 fs-15 ">Finish Lesson</h3>
                            <p class="m-0 c-grey">Finish Teaching Flex Box</p>
                        </div>
                        <i class="fa fa-trash-o delete"></i>
                    </div>
                </div>
                <div class="search-item p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-20">Top Search Items</h2>
                    <div class="items-head d-flex mb-10 space-between c-grey">
                        <div>Keyword</div>
                        <div>Search Count</div>
                    </div>
                    <div class="items d-flex space-between pt-15 pb-15">
                        <span>Programming</span>
                        <span class="bg-eee fs-13 button-shape">200</span>
                    </div>
                    <div class="items d-flex space-between pt-15 pb-15">
                        <span>PHP</span>
                        <span class="bg-eee fs-13 button-shape">150</span>
                    </div>
                    <div class="items d-flex space-between pt-15 pb-15">
                        <span>Html</span>
                        <span class="bg-eee fs-13 button-shape">500</span>
                    </div>
                    <div class="items d-flex space-between pt-15 pb-15">
                        <span>JavaScript</span>
                        <span class="bg-eee fs-13 button-shape">100</span>
                    </div>
                    <div class="items d-flex space-between pt-15 pb-15">
                        <span>React</span>
                        <span class="bg-eee fs-13 button-shape">450</span>
                    </div>
                </div>

                <div class="latest-uplods p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-20">Latest Uplods</h2>
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
                                <img class="mr-10" src="images/dll.png" alt="" style="width:40px">
                                <div>
                                    <span class="d-block">My-dll-file.pdf</span>
                                    <span class="fs-15 c-grey">Dado</span>
                                </div>
                            </div>
                            <div class="bg-eee fs-13 button-shape">0.9mb</div>
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
                <div class="latest-projects p-relative p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-20">Last Projects Progress</h2>
                    <ul class="m-0 p-relative">
                        <li class="mb-25 d-flex algin-center done">Got The Project</li>
                        <li class="mb-25 d-flex algin-center done">Started The Project</li>
                        <li class="mb-25 d-flex algin-center done">The Project About To Finish</li>
                        <li class="mb-25 d-flex algin-center current">Test The Project</li>
                        <li class="mb-25 d-flex algin-center">Finish Project & Get Money</li>
                    </ul>
                    <img class="lunch-icon hide-mobile" src="images/project.jpg" alt="">
                </div>
                <div class="reminders p-relative p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-20">Reminders</h2>
                    <ul class="m-0">
                        <li class="d-flex algin-center mt-15">
                            <span class="key bg-blue mr-15 d-block rad-hlef"></span>
                            <div class="pl-15 blue">
                                <p class="fs-14 fw-bold mt-0 mb-5">Check My Tasks List</p>
                                <span class="fs-13 c-grey">29/10/2022 - 12:00AM</span>
                            </div>
                        </li>
                        <li class="d-flex algin-center mt-15">
                            <span class="key bg-blue mr-15 d-block rad-hlef"></span>
                            <div class="pl-15 green">
                                <p class="fs-14 fw-bold mt-0 mb-5">Check My Project</p>
                                <span class="fs-13 c-grey">19/10/2022 - 12:00AM</span>
                            </div>
                        </li>
                        <li class="d-flex algin-center mt-15">
                            <span class="key bg-blue mr-15 d-block rad-hlef"></span>
                            <div class="pl-15 orange">
                                <p class="fs-14 fw-bold mt-0 mb-5">Call All My Clients</p>
                                <span class="fs-13 c-grey">09/11/2022 - 12:00AM</span>
                            </div>
                        </li>
                        <li class="d-flex algin-center mt-15">
                            <span class="key bg-blue mr-15 d-block rad-hlef"></span>
                            <div class="pl-15 red">
                                <p class="fs-14 fw-bold mt-0 mb-5">Finish The Devloper Workshop</p>
                                <span class="fs-13 c-grey">20/10/2022 - 12:00AM</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="latest-post p-relative p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-20">Latest Post</h2>
                    <div class="top d-flex algin-center">
                        <img class="avatar mr-15" src="images/avatar3.png" alt="">
                        <div class="info">
                            <span class="d-block mb-5 fw-bold">Kahder Eskander</span>
                            <span class="c-grey">About 3 Hours Ago</span>
                        </div>
                    </div>
                    <div class="post-content txt-c-mobile pt-20 pb-20 mt-20 mb-20">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sunt inventore doloribus dignissimos
                        totam modi. Veniam placeat minima nisi libero excepturi modi tempore.</div>
                    <div class="post-stats between-flex c-grey">
                        <div>
                            <i class="fa fa-heart"></i>
                            <span>1.8K</span>
                        </div>
                        <div>
                            <i class="fa fa-comments-o"></i>
                            <span>500</span>
                        </div>
                    </div>
                </div>
                <div class="social-media p-relative p-20 bg-white rad-10">
                    <h2 class="mt-0 mb-20">Social Media Stats</h2>
                    <div class="box twitter p-15 p-relative mb-10 between-flex">
                        <i class="fa fa-twitter fa-2x c-white center-flex h-full"></i>
                        <span>90K Follower </span>
                        <a class="fs-13 c-white button-shape" href="#">Follow</a>
                    </div>
                    <div class="box facebook p-15 p-relative mb-10 between-flex">
                        <i class="fa fa-facebook fa-2x c-white center-flex h-full"></i>
                        <span>2M Like</span>
                        <a class="fs-13 c-white button-shape" href="#">Like</a>
                    </div>
                    <div class="box youtube p-15 p-relative mb-10 between-flex">
                        <i class="fa fa-youtube fa-2x c-white center-flex h-full"></i>
                        <span>1M Subs </span>
                        <a class="fs-13 c-white button-shape" href="#">Subscribe</a>
                    </div>
                    <div class="box linkedin p-15 p-relative mb-10 between-flex">
                        <i class="fa fa-linkedin fa-2x c-white center-flex h-full"></i>
                        <span>70K Follower</span>
                        <a class="fs-13 c-white button-shape" href="#">Follow</a>
                    </div>
                </div>
            </div>
            <div class="projects p-20 bg-white rad-10 m-20">
                <h2 class="mt-0 mb-20">Projects</h2>
                <div class="responiseve-table">
                    <table class="fs-15 w-full">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Finish Date</td>
                                <td>Client</td>
                                <td>Price</td>
                                <td>Team</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ministry Wikipedia</td>
                                <td>10 Mau 2022</td>
                                <td>Ministry</td>
                                <td>$5300</td>
                                <td>
                                    <img src="images/avatar3.png" alt="">
                                    <img src="images/avatar5.png" alt="">
                                    <img src="images/avatar6.jpeg" alt="">
                                    <img src="images/avatar7.png" alt="">
                                </td>
                                <td>
                                    <span class="lable button-shape bg-orange c-white fs-13">Pending</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Wibsite</td>
                                <td>23 mar 2022</td>
                                <td>Mool</td>
                                <td>$300</td>
                                <td>
                                    <img src="images/avatar5.png" alt="">
                                    <img src="images/avatar6.jpeg" alt="">
                                </td>
                                <td>
                                    <span class="lable button-shape bg-green c-white fs-13">Check</span>
                                </td>
                            </tr>
                            <tr>
                                <td>School System</td>
                                <td>12 May 2023</td>
                                <td>School</td>
                                <td>$1500</td>
                                <td>
                                    <img src="images/avatar3.png" alt="">
                                    <img src="images/avatar5.png" alt="">
                                </td>
                                <td>
                                    <span class="lable button-shape bg-red c-white fs-13">Sending</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Example</td>
                                <td>30 Des 2022</td>
                                <td>Example</td>
                                <td>$500</td>
                                <td>
                                    <img src="images/avatar3.png" alt="">
                                    <img src="images/avatar6.jpeg" alt="">
                                </td>
                                <td>
                                    <span class="lable button-shape bg-grey c-white fs-13">Delete</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>


</html>
