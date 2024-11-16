@extends('layout.app')

@section('title', 'Profile')

@section('content')
    <div class="container mt-5 main">
        <div class="grid-container-profile">
            <div class="section profile-section">
                {{-- <img alt="Profile Image" height="300" --}}
                <i class="fa fa-user profile-icon" style="font-size: 200px; color: #0c2347;"></i>
                    {{-- width="300" /> --}}
                <div class="info">
                    <p>
                        <strong>آخر تسجيل دخول:</strong>
                        17 أغسطس 2021
                    </p>
                    <p>
                        <strong>الاسم:</strong>
                        {{ Auth::user()->name }}
                    </p>
                    <p>
                        <strong>الهاتف:</strong>
                        +1 855-869-999-1236
                    </p>
                    <p>
                        <strong>البريد الإلكتروني:</strong>
                        {{ Auth::user()->email }}
                    </p>
                </div>
            </div>
            <div class="section files-section">
                <div class="subsection" id="my-files-section">
                    <div style="display: flex; justify-content: space-between; align-items: center; direction: rtl;">
                        <h3 style="margin: 0;">ملفاتي</h3>
                        <a href="{{ route('files.store') }}" class="btn btn-sm btn-Addd">إضافة
                            ملف</a>
                    </div>
                    <hr>
                    <div class="section-content" id="my-files-content">
                        @foreach ($files->take(3) as $file)
                            <div class="file-item" data-id="{{ $file->id }}">
                                <div>
                                    <strong>{{ $file->name }}</strong>
                                    {{-- <p>{{ $file->url }}</p> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('user.files') }}" class="btn btn-more">رؤية المزيد</a>
                </div>

                <div class="subsection" id="locked-files-section">
                    <div style="display: flex; justify-content: space-between; align-items: center; direction: rtl;">
                        <h3 style="margin: 0;">ملفاتي المحجوزة</h3>
                        {{-- <a href="{{ route('files.store') }}" class="btn btn-sm btn-primary" style="margin-left: 20px;">فك حجز</a> --}}
                    </div>
                    <hr>
                    <div class="section-content" id="locked-files-content">
                        @foreach ($lockedFiles->take(3) as $file)
                            <div class="file-item" data-id="{{ $file->id }}">
                                <div>
                                    <strong>{{ $file->name }}</strong>
                                    {{-- <p>{{ $file->title }}</p> <!-- Assuming you have a title field --> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('user.lockedfiles') }}" class="btn btn-more">رؤية المزيد</a>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- <body>
        <div class="rectangle-wrapper">
            <div class="home">
                <h2 class="modal-title text-center" style="margin-right: 30px; margin-bottom:20px;">My Profile </h2>
            </div>
            <div class="modal-body text-center">
                <i class="fa fa-user profile-icon" style="font-size: 80px; color: #0c2347;"></i>
                <p>{{ Auth::user()->name }}</p>
                <p>{{ Auth::user()->email }}</p>
                <a href="{{ route('user.files') }}" class="btn btn-File mb-3 d-block">My Files</a>
                <a href="{{ route('user.lockedfiles') }}" class="btn btn-Info d-block">My Locked Files</a>
                <a href="{{ route('showJoinRequests') }}" class="btn btn-Reauests d-block">Join requests</a>
                <a href="{{ route('showaddfileRequests') }}" class="btn btn-fileReauests d-block">AddFile requests</a>
                <a href="{{ route('showinviteRequests') }}" class="btn btn-fileReauests d-block">invited requests</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-Logout d-block">Logout</button>
                </form>
            </div>
          
        </div>
    </body> --}}
