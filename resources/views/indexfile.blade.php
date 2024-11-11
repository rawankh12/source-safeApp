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
            <h2 class="text-center">Files for Group: {{ $group->name }}</h2>

            @if ($existingFiles->isEmpty())
                <p class="text-center">No files available for this group.</p>
            @else
                <div class="row">
                    @foreach ($existingFiles as $file)
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    @php
                                        $isblocked = $file->pivot->status === 'blocked';

                                    @endphp

                                    @if ($isblocked)
                                        <a href="{{ asset($file->url) }}" target="_blank" download class="btn-download">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    @else
                                        <p class="text-danger">The file must be "blocked" to download.</p>
                                    @endif
                                    <a href="#" class="btn-upload" data-toggle="modal"
                                        data-target="#uploadFileModal-{{ $file->id }}">
                                        <i class="fa fa-upload"></i>
                                    </a>
                                    <h5 class="card-title">{{ $file->name }}</h5>
                                    <p class="card-text">Status: {{ $file->pivot->status }}</p>
                                    {{-- <button type="button" class="btn btn-edit" data-toggle="modal"
                                        data-target="#editFileModal-{{ $file->id }}">Update</button> --}}
                                    <p class="card-text">URL: <a href="{{ url('/view-file/' . $file->url) }}"
                                            target="_blank" rel="noopener noreferrer">{{ $file->url }}</a></p>
                                    <form action={{ route('blockfile', ['groupid' => $group->id, 'fileid' => $file->id]) }}
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-Add">Blocke</button>
                                    </form>
                                    <form
                                        action={{ route('unblockfile', ['groupid' => $group->id, 'fileid' => $file->id]) }}
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-Add">UnBlocke</button>
                                    </form>
                                    {{-- <form
                                        action="{{ route('deletefile', ['group_id' => $group->id, 'file_id' => $file->id]) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">Delete</button>
                                    </form> --}}
                                </div>
                            </div>
                        </div>
                        <!-- Modal for uploading a file -->
                        <div class="modal fade" id="uploadFileModal-{{ $file->id }}" tabindex="-1"
                            aria-labelledby="uploadFileModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadFileModalLabel">Upload File</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form
                                            action="{{ route('uploadfile', ['group_id' => $group->id, 'file_id' => $file->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="file">Choose file to upload:</label>
                                                <input type="file" name="file" id="file" class="form-control"
                                                    required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-Add">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- Modal for creating a new file -->
            <a href="#" class="floating-button" data-toggle="modal" data-target="#createFileModal">+</a>
            <div class="modal fade" id="createFileModal" tabindex="-1" role="dialog"
                aria-labelledby="createFileModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createFileModalLabel">Add Existing File to Group</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('addToGroup') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="fileSelect">Select Files:</label>
                                    @php
                                        $userFiles = App\Models\File::where('user_id', Auth::id())->get();
                                    @endphp
                                    @foreach ($userFiles as $file)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="file_ids[]" value="{{ $file->id }}" id="file_{{ $file->id }}">
                                            <label class="form-check-label" for="file_{{ $file->id }}">
                                                {{ $file->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="group_id" value="{{ $group->id }}">
                                <button type="submit" class="btn btn-Add">Add to Group</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for search -->
            <a href="#" class="floating-button2" data-toggle="modal" data-target="#searchModal">
                <i class="fa fa-search"></i>
            </a>
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                aria-hidden="true">
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

        .btn-Add {
            background-color: #112e4c;
            border: none;
            margin-top: 20px;
            color: #f6f1f1;
        }
    </style>
@endsection
