@extends('layout.app')

@section('title', 'Profile')

@section('content')
    <div class="container mt-5 main">
        <div class="grid-container-profile">
            <div class="section profile-section">
                <i class="fa fa-user profile-icon" style="font-size: 200px; color: #0c2347;"></i>
                <div class="info">
                    <p>
                        <strong>{{ __('messages.groupname') }}</strong>
                        {{ Auth::user()->name }}
                    </p>
                    <p>
                        <strong>{{ __('messages.emailpro') }}</strong>
                        {{ Auth::user()->email }}
                    </p>
                </div>
            </div>
            <div class="section1 files-section">
                <div class="subsection" id="my-files-section">
                    <div style="display: flex; justify-content: space-between; align-items: center; direction: rtl;">
                        <h3 style="margin: 0;">{{ __('messages.myfiles') }}</h3>
                    </div>
                    <hr>
                    <div class="section-content" id="my-files-content">
                        @foreach ($files->take(2) as $file)
                            <div class="file-item" data-id="{{ $file->id }}">
                                <div>
                                    <strong>{{ $file->name }}</strong>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('user.files') }}" class="btn btn-more1">{{ __('messages.more') }}</a>
                </div>

                <div class="subsection" id="locked-files-section">
                    <div style="display: flex; justify-content: space-between; align-items: center; direction: rtl;">
                        <h3 style="margin: 0;">{{ __('messages.lockefile') }}</h3>
                    </div>
                    <hr>
                    <div class="section-content" id="locked-files-content">
                        @foreach ($lockedFiles->take(2) as $file)
                            <div class="file-item" data-id="{{ $file->id }}">
                                <div>
                                    <strong>{{ $file->name }}</strong>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('user.lockedfiles') }}" class="btn btn-more1">{{ __('messages.more') }}</a>
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
@endsection
