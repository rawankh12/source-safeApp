@extends('layout.app')

@section('title', 'Home')

@section('content')

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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5 main">
        <div class="grid-container">
            <div class="welcome rad-10 txt-c-mobile block-mobile">
                <div class="intro p-20 d-flex space-between bg-eee">
                    <div>
                        <h2 class="m-0">{{ __('messages.welcome') }}</h2>
                        <p class="c-grey mt-5">{{ Auth::user()->name }}</p>
                    </div>
                </div>
                <div class="avatar-container text-center mt-20">
                    <img src="images/avatar3.png" alt="" class="avatar">
                </div>
                <div class="body p-20 d-flex text-center mt-20 block-mobile">
                    <div>{{ Auth::user()->name }}
                        <span class="d-block c-grey fs-14 mt-10">{{ Auth::user()->name }}</span>
                    </div>
                    <div>{{ __('messages.emailpro') }}
                        <span class="d-block c-grey fs-14 mt-10">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </div>
            <div class="tickets p-20 rad-10">
                <div class="statistics-container d-flex justify-content-around gap-20 flex-wrap">
                    <div class="box p-20 rad-10 fs-13 c-grey text-center" style="cursor: pointer;"
                        onclick="window.location.href='{{ route('users') }}';">
                        <i class="fa fa-user fa-3x m-auto"></i>
                        {{ __('messages.allusers') }}
                    </div>
                    <div class="box p-20 rad-10 fs-13 c-grey text-center" style="cursor: pointer;"
                        onclick="window.location.href='{{ route('user.files') }}';">
                        <i class="fa fa-file fa-2x mb-10 c-red"></i>
                        {{ __('messages.allfiles') }}
                    </div>
                    <div class="box p-20 rad-10 fs-13 c-grey text-center" style="cursor: pointer;"
                        onclick="window.location.href='{{ route('allgroups') }}';">
                        <i class="fa fa-layer-group fa-2x mb-10 c-green"></i>
                        {{ __('messages.all') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
