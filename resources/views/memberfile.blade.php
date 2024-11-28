@extends('layout.app')

@section('title', 'Home')

@section('content')

    <body>
        <div class="home">
            <h2 class="text-right">{{ __('messages.fileof') }} {{ $group->name }}</h2>

            @if ($existingFiles && $existingFiles->isEmpty())
                <p class="text-right" style="margin-right: 50px;">{{ __('messages.nofile') }}</p>
            @else
                <form action="{{ route('blockfile', ['groupId' => $group->id]) }}" method="POST" id="multiFileActionForm">
                    @csrf
                    <div class="row">
                        @foreach ($existingFiles as $file)
                            <div class="col-md-4" style="margin-bottom: 20px;">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <input type="checkbox" name="file_ids[]" value="{{ $file->id }}"
                                            id="file-{{ $file->id }}" class="form-check-input">
                                        <label for="file-{{ $file->id }}" class="form-check-label"></label>
                                        <h5 class="card-title">{{ $file->name }}</h5>
                                        <p class="card-text">{{ __('messages.status') }} {{ $file->pivot->status }}</p>
                                        <p class="card-text">
                                            <a href="{{ url('/view-file/' . $file->url) }}" target="_blank"
                                                rel="noopener noreferrer">{{ $file->url }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="text-left mt-4">
                            <button type="submit" class="btn btn-Addb"
                                style="margin-top: 30px;">{{ __('messages.do') }}</button>
                        </div>
                    </div>
                </form>
            @endif

            <!-- Modal for creating a new file -->
            <a href="#" class="floating-button" data-toggle="modal" data-target="#createFileModal"
                title="{{ __('messages.add_file') }}">+</a>
            <div class="modal fade" id="createFileModal" tabindex="-1" role="dialog"
                aria-labelledby="createFileModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createFileModalLabel">{{ __('messages.choose') }}</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('addToGroup') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="fileSelect">{{ __('messages.choose') }}</label>
                                    @foreach ($userFiles as $file)
                                        <div class="form-check">
                                            <input class="form-check-input custom-checkbox" type="checkbox"
                                                name="file_ids[]" value="{{ $file->id }}"
                                                id="file_{{ $file->id }}">
                                            <label class="form-check-label custom-label" for="file_{{ $file->id }}"
                                                style="margin-right: 50px;">
                                                {{ $file->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="group_id" value="{{ $group->id }}">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ __('messages.close') }}</button>
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

    <style>
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: calc(100% - 260px);
            z-index: 1000;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            transition: all 0.25s ease-in-out;
            margin-bottom: 30px;
        }

        .header-container {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .header-icons {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-right: auto;
        }

        .header-icons button {
            background-color: transparent;
            border: none;
            color: #fff;
            font-size: 1.25rem;
            margin-left: 1rem;
            cursor: pointer;
        }

        .header-icons i {
            color: hwb(0 0% 100%);
            font-size: 1.5rem;
        }

        .header-icons span {
            margin-left: 0.5rem;
        }

        body {
            font-family: 'Poppins', sans-serif;
            direction: rtl;
            margin-right: 260px;
            width: calc(100% - 260px);
            margin-top: 100px;
        }

        .container {
            margin-top: 5rem;
        }

        .title {
            text-align: right;
            position: relative;
            margin-right: 55px;
            margin-top: 15px;
        }

        .modal-header .btn-close.move-right {
            position: absolute;
            right: 1rem;
            text-align: right;
        }

        #sidebar {
            width: 240px;
            min-width: 260px;
            z-index: 1;
            transition: width 0.3s;
            display: flex;
            flex-direction: column;
            right: 0;
            position: fixed;
            top: 0;
            bottom: 0;
            border-left: 1px transparent black;
        }

        .sidebar-logo {
            margin: auto 0;
        }

        .sidebar-logo a {
            color: hwb(0 7% 93%);
            font-size: 1.15rem;
            font-weight: 600;
        }

        #sidebar .sidebar-logo,
        #sidebar .sidebar-link span {
            display: inline-block;
        }

        .sidebar-nav {
            padding: 1rem 0;
            flex: 1 1 auto;
        }

        .sidebar-logo img {
            max-width: 100%;
            height: auto;
        }

        a.sidebar-link {
            padding: .625rem 0;
            color: hwb(0 7% 93%);
            display: block;
            font-size: 0.9rem;
            white-space: nowrap;
            border-right: 3px solid transparent;
            margin-right: 20px;
            text-align: right;
            margin-bottom: 30px;
        }

        .p1 {
            padding: .625rem 0;
            text-align: right;
            margin-right: 35px;
        }

        .sidebar-link i {
            font-size: 1.1rem;
            margin-left: .75rem;
            margin-right: 0;
        }

        a.sidebar-link:hover {
            background-color: #eae7f413;
            border-right: 3px solid #3b7ddd;
        }

        .sidebar-item {
            position: relative;
            margin-right: 0;
        }

        .sidebar-link.active {
            color: rgb(106, 176, 195) !important;
        }

        #sidebar.light-mode {
            background-color: #f8f9fa;
            border-left: 1px solid #000;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: calc(100% - 70px);
            color: white;
            padding: 0 20px;
            text-align: center;
            transition: all 0.25s ease-in-out;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
        }

        .mb-0 {
            height: 100px;
        }

        .footer.expand {
            width: calc(100% - 260px);
        }

        .home {
            justify-content: center;
            text-align: center;
            margin: 0 0 0 50px;
        }

        .home h2 {
            margin-right: 30px;
            font-weight: bold;
        }

        .heading {
            font-size: 30px;
            font-weight: bold;
            color: rgb(26, 36, 48);
        }

        .card {
            border-radius: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            width: 100%;
            background-color: #abc3d8;
            margin-right: 20px;
            margin-top: 40px;
        }

        .hr {
            color: #625495;
        }

        .card-title {
            color: #333;
            font-weight: bold;
            font-size: 1.25rem;
            text-align: center;
        }

        .btn-Add {
            background-color: #112e4c;
            border: none;
            margin-top: 20px;
            color: #f6f1f1;
            right: 0;
        }

        .btn-Addb {
            background-color: #112e4c;
            border: none;
            margin-top: 20px;
            color: #f6f1f1;
            /* right: 0; */
            left: 0;
        }

        .btn-view {
            background-color: var(--btn-color);
            border: none;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            color: var(--background-color);
            border: 2px solid black;
        }

        .btn-Addcheck {
            background-color: #112e4c;
            border: none;
            color: #f6f1f1;
            margin-right: 40px;
        }

        .btn-sendinvite {
            border: 2px solid black;
            margin-top: 20px;
            color: #000000;
            font-weight: bold;
        }

        .floating-button {
            position: fixed;
            bottom: 40px;
            left: 40px;
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

        .custom-checkbox {
            margin-right: 10px !important;
        }

        .custom-label {
            margin-left: 5px !important;
            font-size: 14px;
        }

        .btn-secondary {
            margin-top: 20px;
            right: 0;
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

        .profile-btn a {
            color: inherit;
        }
    </style>
@endsection
