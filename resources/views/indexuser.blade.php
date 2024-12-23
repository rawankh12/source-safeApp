@extends('layout.app')

@section('title', 'Home')

@section('content')

    <body>
        <div class="home">
            <h2 class="text-right">{{ __('messages.myfiles') }}</h2>

            @if ($Files->isEmpty())
                <p class="text-right" style="margin-right: 50px;">{{ __('messages.nofile') }}</p>
            @else
                <div class="row">
                    @foreach ($Files as $file)
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="card1 mb-4 shadow-sm">
                                <div class="card-body">
                                    <img width="30" height="30" src="https://img.icons8.com/carbon-copy/100/file.png"
                                        alt="file" />
                                    <h5 class="card-title">{{ $file->name }}</h5>
                                    <p class="card-text"> <a href="{{ url('/view-file/' . $file->url) }}" target="_blank"
                                            rel="noopener noreferrer">{{ $file->url }}</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <a href="#" class="floating-button" data-toggle="modal" data-target="#createFileModal"
                title="{{ __('messages.add_file') }}">+</a>
            <div class="modal fade" id="createFileModal" tabindex="-1" role="dialog"
                aria-labelledby="createFileModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createFileModalLabel">{{ __('messages.add_file') }}</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="fileName" style="text-align: right;">{{ __('messages.groupname') }}</label>
                                    <input type="text" class="form-control" id="fileName" name="name"
                                        placeholder="{{ __('messages.placeholder') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="fileUpload" style="text-align: right;">{{ __('messages.file') }}</label>
                                    <input type="file" class="form-control" id="fileUpload" name="file" required>
                                </div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    style="margin-bottom: 20px;">{{ __('messages.close') }}</button>
                                <button type="submit" class="btn btn-Add">{{ __('messages.Addg') }}</button>
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

@endsection
