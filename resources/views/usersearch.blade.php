@extends('layout.app')

@section('title', 'Home')

@section('content')

    <body>
        <div class="home">
            <div class="row-right">
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
            </div>
            <!-- Modal for search -->
            {{-- <a href="#" class="floating-button2" data-toggle="modal" data-target="#searchModal">
                <i class="fa fa-search"></i>
            </a> --}}
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
    </style>
@endsection
