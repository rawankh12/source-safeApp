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
            <h2 class="text-center">My Groups</h2>
            @if (Auth::check())
                <p style="margin-top: 40px;">Welcome, {{ Auth::user()->name }}</p>
            @else
                <p style="margin-top: 40px;">You are not logged in.</p>
            @endif

            <div class="btn-group mb-4" role="group" aria-label="Group buttons">
                <a href="{{ route('home') }}" class="btn">All Groups</a>
                <a href="{{ route('mygroup') }}" class="btn" style="margin-left: 20px;">My Groups</a>
                <a href="{{ route('membergroup') }}" class="btn btn-toggle" id="member-groups" style="margin-left: 20px;">
                    Groups I am a member of </a>
            </div>

            <div class="row">
                @if ($groups->isEmpty())
                    <p>There's no groups</p>
                @else
                    @foreach ($groups as $group)
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $group->name }}</h5>
                                    <hr class="hr">
                                    <h5 class="card-text">{{ $group->description }}</h5>
                                    {{-- @if (Auth::user()->name === $group->user_create) --}}
                                    <a href="{{ route('group.files', $group->id) }}" class="btn btn-view">
                                        View Files
                                    </a>
                                    {{-- <a href="{{ route('invite') }}" class="btn btn-sendinvite">
                                        invite
                                    </a> --}}
                                    <button type="button" class="btn btn-sendinvite" data-toggle="modal"
                                        data-target="#inviteuserModal">invite</button>

                                    <form action={{ route('deletegroup', ['group_id' => $group->id]) }} method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- model for inviting user --}}
                        <div class="modal fade" id="inviteuserModal" tabindex="-1"
                            aria-labelledby="inviteuserModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="inviteuserModalLabel">Add user from the list</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form
                                            action="{{ route('inviteuser') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="fileSelect"></label>
                                                <select class="form-control" id="userSelect" name="user_id" required>
                                                    <option value="">Select user</option>
                                                    @php
                                                        $users = App\Models\User::where('id', '!=', Auth::user()->id)->get();
                                                    @endphp
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                                            <button type="submit" class="btn btn-Add">Add to Group</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <a href="{{ route('groups.create') }}" class="floating-button" data-toggle="modal"
                data-target="#createGroupModal">
                +
            </a>
        </div>

        <!-- Modal for create group -->
        <div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="createGroupModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createGroupModalLabel">Create New Group</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('groups.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label id="name">Name:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label id="description">Description:</label>
                                <input type="text" name="description" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-Add">Add Group</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                        <form action="#" method="GET">
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
        @if ($errors->any())
            <div class="alert alert-danger" style="background-color: rgb(211, 231, 231); color:black;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </body>
@endsection
