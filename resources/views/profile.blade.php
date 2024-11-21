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
                        {{-- <form action="{{ route('files.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-Addd"> إضافة
                                ملف</button>
                        </form> --}}
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
