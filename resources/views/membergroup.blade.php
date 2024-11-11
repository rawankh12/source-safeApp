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
            <h2 class="text-center">Groups</h2>
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
                                    <a href="{{ route('member.files', $group->id) }}" class="btn btn-view">
                                        View Files
                                    </a>
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
    <style>
        .header {
            padding: 20px 0;
        }

        .link {
            display: flex;
            justify-content: right;
            align-items: center;
            margin-right: 50px;
        }

        .link a {
            margin: 0 20px;
            transition: transform 0.2s;
            font-size: 30px;
            color: #0c2347;
            text-decoration: none;
        }

        .link a:hover {
            transform: scale(1.3);
            color: #7aa1cb;
        }

        .home {
            justify-content: left;
            text-align: left;
            margin: 0 0 0 50px;
        }

        .heading {
            font-size: 30px;
            font-weight: bold;
            color: rgb(26, 36, 48);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: left;
            text-align: center;
            margin-top: 40px;
        }

        .card {
            border-radius: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            width: 70%;
            background-color: #8faecf;
        }

        .hr {
            color: #625495;
        }

        .card-title {
            color: #333;
            font-weight: bold;
            font-size: 1.25rem;
        }

        .btn-view {
            background-color: #112e4c;
            border: none;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            color: #f6f1f1;
        }

        .btn-Add {
            background-color: #112e4c;
            border: none;
            margin-top: 20px;
            color: #f6f1f1;
        }

        .floating-button {
            position: fixed;
            bottom: 40px;
            right: 40px;
            width: 56px;
            height: 56px;
            background-color: #7891ad;
            color: rgb(11, 11, 11);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            text-decoration: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s;
        }

        .floating-button2 {
            position: fixed;
            left: 40px;
            width: 56px;
            height: 56px;
            top: 20px;
            background-color: #7891ad;
            color: rgb(11, 11, 11);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            text-decoration: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s;
        }

        .form-group input {
            border-radius: 20px;
            background-color: #8faecf;
            width: 100%;
            height: 100%;
        }

        .modal-footer .btn-secondary {
            margin-top: 20px;
        }

        .btn-group a {
            border: 2px solid black;
        }

        .modal-body .btn-File {
            background-color: #8faecf;
            color: #333;
        }

        .modal-body .btn-Info {
            background-color: #44134a;
            color: #f6f1f1;
        }

        .modal-body .btn-Logout {
            background-color: rgb(13, 86, 62);
            margin-top: 20px;
            color: #f6f1f1;
            width: 100%;
        }

        #fileStatus {
            padding: 8px;
            border-radius: 20px;
            width: 100%;
            margin-bottom: 10px;
            background-color: #8faecf;
        }

        .card-body .btn-invite {
            background-color: rgb(76, 13, 86);
            margin-top: 20px;
            color: #f6f1f1;
            width: 100%;
        }

        .card-body .fa-user {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .card-body .btn-edit {
            background-color: #112e4c;
            margin-top: 20px;
            color: #f6f1f1;
            /* width: 100%; */
        }

        .card-body .btn-delete {
            background-color: #7a1b23;
            margin-top: 20px;
            color: #f6f1f1;
            margin-left: 20px;
        }

        .card-body .btn-download {
            position: absolute;
            color: #000000;
            left: 20px;
            font-size: 1.4rem;
        }

        .card-body .btn-upload {
            position: absolute;
            color: #000000;
            right: 20px;
            font-size: 1.4rem;
        }
    </style>
@endsection
