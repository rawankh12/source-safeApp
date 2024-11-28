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
                    <a class="active d-flex align-items fs-14 rad-6 c-black p-10" href="{{ route('adminUser') }}">
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
            <h1 class="p-relative">{{ __('messages.allusers') }}</h1>
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
                                <span>{{ $user->files_count }} {{ __('messages.allusers') }}</span>
                            </div>
                            <div class="mb-10">
                                <i class="fa fa-group fa-fw"></i>
                                <span>{{ $user->created_groups_count }} {{ __('messages.mygroups') }}</span>
                            </div>
                            <div>
                                <i class="fa fa-newspaper-o fa-fw"></i>
                                <span>{{ $user->groups_count }} {{ __('messages.membergroup') }}</span>
                            </div>
                        </div>
                        <div class="info between-flex fs-13">
                            <span class="c-crey">{{ __('messages.membergroup') }}
                                {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</span>
                            <div>
                                @if ($user->bannedUser)
                                    <a class="bg-blue c-white button-shape unBlock-user-btn disabled" href="#"
                                        data-user-id="{{ $user->id }}">
                                        {{ __('messages.Blocked') }}
                                    </a>
                                @else
                                    <a class="bg-red c-white button-shape block-user-btn" href="#"
                                        data-user-id="{{ $user->id }}">
                                        <i class="fa fa-user-times"></i>
                                        {{ __('messages.Block') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.querySelectorAll('.block-user-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const userId = this.getAttribute('data-user-id');
                    Swal.fire({
                        title: '{{ __('messages.Are') }}',
                        text: "{{ __('messages.Do') }}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, block them!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/users/${userId}/block`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    },
                                })
                                .then(response => response.json())
                                .then(data => {
                                    Swal.fire({
                                        icon: data.message.includes('successfully') ?
                                            'success' : 'error',
                                        title: data.message.includes('successfully') ?
                                            'Success' : 'Error',
                                        text: data.message,
                                    });
                                    if (data.message.includes('successfully')) {
                                        this.classList.add('disabled');
                                        this.textContent = 'Blocked';
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Something went wrong!',
                                    });
                                });
                        }
                    });
                });
            });


            document.querySelectorAll('.unBlock-user-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const userId = this.getAttribute('data-user-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you really want to unblock this user?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, unblock them!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/users/${userId}/unblock`, { // استخدام userId في المسار
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // تأمين الطلب
                                    },
                                })
                                .then(response => response.json())
                                .then(data => {
                                    Swal.fire({
                                        icon: data.message.includes('successfully') ?
                                            'success' : 'error',
                                        title: data.message.includes('successfully') ?
                                            'Success' : 'Error',
                                        text: data.message,
                                    });
                                
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Something went wrong!',
                                    });
                                });
                        }
                    });
                });
            });
        </script>


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
