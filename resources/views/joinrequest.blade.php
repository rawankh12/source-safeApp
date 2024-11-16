@extends('layout.app')

@section('title', 'Home')

@section('content')

    {{-- <div class="header">
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
    </div> --}}

    <body>
        <div class="home">
            @if ($pendingRequests->isEmpty())
                <p>No pending join requests.</p>
            @else
                <ul>
                    @foreach ($pendingRequests as $request)
                        @foreach ($request->users as $user)
                            <li
                                style="border: 1px solid black; 
                            width: 90%; 
                            margin-left: 50px;
                            margin-top: 20px;
                            padding: 10px; 
                            display: flex; 
                            justify-content: 
                            space-between; 
                            align-items: center;">
                                <div style="flex: 1;">
                                    User Name: {{ $user->name }} - Requested to join Group :
                                    {{ $request->name }}
                                    - Request Date: {{ \Carbon\Carbon::parse($request->created_at)->format('Y-m-d H:i') }}
                                </div>
                                <div class="btngroups" style="display: flex; gap: 10px;">
                                    <form
                                        action="{{ route('acceptJoinRequest', ['userId' => $user->id, 'groupId' => $request->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-Add">Accept</button>
                                    </form>
                                    <form
                                        action="{{ route('deleteJoinRequest', ['userId' => $user->id, 'groupId' => $request->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">Delete</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            @endif

            <!-- Modal for search -->
            {{-- <a href="#" class="floating-button2" data-toggle="modal" data-target="#searchModal">
                <i class="fa fa-search"></i>
            </a> --}}
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="searchModalLabel">Search</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="GET">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="query" placeholder="Enter...">
                                </div>
                                <button type="submit" class="btn btn-Add">Ok</button>
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
            @if ($errors->any())
                <div class="alert alert-danger" style="background-color: rgb(211, 231, 231); color: black;">
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
        .btngroups .btn-delete {
            background-color: #7a1b23;
            margin-top: 20px;
            color: #f6f1f1;
            margin-left: 20px;
        }
    </style>
@endsection
