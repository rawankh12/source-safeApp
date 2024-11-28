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
                    <a class="active d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('profileAdmin') }}">
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
                    <form action="{{ route('logout') }}" method="POST" onsubmit="return confirmlogout(event)">
                        @csrf
                        <button id="profile-btn" class="logout-btn" type="submit">
                            <img width="30" height="30" src="https://img.icons8.com/sf-regular/48/exit.png"
                                alt="exit" />
                        </button>
                    </form>
                </div>
            </div>
            <h1 class="p-relative">{{ __('messages.profile') }}</h1>
            <div class="profile-page p-20">
                <div class="overview bg-white rad-10 d-flex algin-center">
                    <div class="avater-box p-20 text-center">
                        <img class="mb-10 rad-hlef" src="images/avatar3.png" alt="">
                        <h3 class="m-0">{{ $user->name }}</h3>
                        <div class="level rad-6 bg-eee p-relative">
                            <span style="width:70%"></span>
                        </div>
                    </div>

                    <div class="info-box w-full text-center-mobile">
                        <div class="box p-20 d-flex algin-center">
                            <h4 class="fs-15 m-0 w-full c-grey">{{ __('messages.GenralInformation') }}</h4>
                            <div class="fs-14">
                                <span class="c-grey">{{ __('messages.groupname') }} </span>
                                <span>{{ $user->name }}</span>
                            </div>
                            {{-- <div class="fs-14">
                                <span class="c-grey">Gender: </span>
                                <span>Male</span>
                            </div> --}}
                            <div class="fs-14">
                                <span class="c-grey">{{ __('messages.emailpro') }} </span>
                                <span>{{ $user->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
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
</style>

</html>
