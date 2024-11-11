@extends('layout.app')

@section('title', 'Home')

@section('content')

    <div class="header">
        <div class="link">
            <a href="{{ route('home') }}">
                <i class="fa fa-home"></i>
            </a>
            <a href="{{ route('profile') }}">
                <i class="fa fa-user"></i>
            </a>
            <a href="{{ route('users') }}">
                <i class="fa fa-users"></i>
            </a>
        </div>
    </div>

    <body>
        <div class="rectangle-wrapper">
            <div class="home">
                <h2 class="modal-title text-center" style="margin-right: 30px; margin-bottom:20px;">My Profile </h2>
            </div>
            <div class="modal-body text-center">
                <i class="fa fa-user profile-icon" style="font-size: 80px; color: #0c2347;"></i>
                <p>{{ Auth::user()->name }}</p>
                <p>{{ Auth::user()->email }}</p>
                <a href="{{ route('user.files') }}" class="btn btn-File mb-3 d-block">My Files</a>
                <a href="{{ route('user.lockedfiles') }}" class="btn btn-Info d-block">My Locked Files</a>
                <a href="{{ route('showJoinRequests') }}" class="btn btn-Reauests d-block">Join requests</a>
                <a href="{{ route('showaddfileRequests') }}" class="btn btn-fileReauests d-block">AddFile requests</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-Logout d-block">Logout</button>
                </form>
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
        </div>
    </body>

    <style>
        .rectangle-wrapper {
            border: 1px solid #0c2347;
            padding: 70px;
            border-radius: 8px;
            margin: 20px auto;
            width: 50%;
            height: 100%;
        }
    </style>
@endsection
