@extends('layout.app')

@section('title', 'Home')

@section('content')

    <body>
        <div class="home">
            <h2 class="text-right">{{ __('messages.allusers') }}</h2>
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                @if ($users->isEmpty())
                    <p class="text-center" style="margin-right: 50px;">{{ __('messages.nouser') }}</p>
                @else
                    @foreach ($users as $user)
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="card mb-4 shadow-sm">
                                <form action="#" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete-icon">
                                        <img src="https://img.icons8.com/material-rounded/24/filled-trash.png"
                                            alt="filled-trash" title="{{ __('messages.deletefile') }}"
                                            style="filter: invert(33%) sepia(95%) saturate(5335%) hue-rotate(0deg) brightness(70%) contrast(120%);" />
                                    </button>
                                </form>
                                <div class="card-body">
                                    <i class="fa fa-user"></i>
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                    <h5 class="card-text">{{ $user->email }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </body>
@endsection
