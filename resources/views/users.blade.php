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
        <div class="home">
            <h2 class="text-center">Users</h2>
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                @if ($users->isEmpty())
                    <p>There's no users</p>
                @else
                    @foreach ($users as $user)
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <i class="fa fa-user"></i>
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                    <h5 class="card-text">{{ $user->email }}</h5>
                                    <a href="{{ route('invite') }}" class="btn btn-invite">
                                        invite
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Modal for search -->
            <a href="#" class="floating-button2" data-toggle="modal" data-target="#searchModal">
                <i class="fa fa-search"></i>
            </a>
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="searchModalLabel">search</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('search') }}" method="GET">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="query" placeholder="enter.....">
                                </div>
                                <button type="submit" class="btn btn-Add">Ok ...</button>
                            </form>
                        </div>
                    </div>
                </div>
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
