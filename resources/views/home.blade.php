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
            <div class="section" id="groups-section">
                <h3>{{ __('messages.all') }}</h3>
                <hr>
                {{-- <div class="section-content" id="groups-content">
                    @foreach ($groups->take(3) as $group)
                        <div class="group-item"
                            >
                            <div class="item" data-id="{{ $group->id }}">{{ $group->name }}</div>
                        </div>
                    @endforeach
                </div> --}}
                <a href="{{ route('allgroups') }}" class="btn btn-more">{{ __('messages.more') }}</a>
            </div>
            <div class="section" id="files-section">
                <h3>{{ __('messages.allfiles') }}</h3>
                <hr>
                {{-- <div class="section-content" id="files-content">
                    @foreach ($files->take(3) as $file)
                        <div class="item" data-id="{{ $file->id }}">{{ $file->name }}</div>
                    @endforeach
                </div> --}}
                <a href="{{ route('user.files') }}" class="btn btn-more">{{ __('messages.more') }}</a>
            </div>
            <div class="section" id="users-section">
                <h3>{{ __('messages.allusers') }}</h3>
                <hr>
                {{-- <div class="section-content" id="users-content">
                    @foreach ($users->take(3) as $user)
                        <div class="item" data-id="{{ $user->id }}">{{ $user->name }}</div>
                    @endforeach
                </div> --}}
                <div class="section_footer">
                    <a href="{{ route('users') }}" class="btn btn-more">{{ __('messages.more') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
