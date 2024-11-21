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
        {{-- <div class="main-text-section">
            <img src="/img/photo4.jpg" alt="Descriptive Alt Text" style="width: 100%;">
        </div> --}}
        <div class="grid-container">
            <!-- القسم الأول: جميع الغروبات -->
            <div class="section" id="groups-section">
                <h3>جميع الغروبات</h3>
                <hr>
                <div class="section-content" id="groups-content">
                    @foreach ($groups->take(3) as $group)
                        <div class="group-item"
                            >
                            <div class="item" data-id="{{ $group->id }}">{{ $group->name }}</div>
                            {{-- <form action="{{ route('sendrequest', ['groupid' => $group->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-Addd"> طلب
                                    انضمام</button>
                            </form> --}}
                        </div>
                    @endforeach
                </div>
                <div class="loading" style="display: none;">Loading...</div>
                <a href="{{ route('allgroups') }}" class="btn btn-more">رؤية المزيد</a>
            </div>
            <!-- القسم الثاني: جميع الفايلات -->
            <div class="section" id="files-section">
                <h3>جميع الفايلات</h3>
                <hr>
                <div class="section-content" id="files-content">
                    @foreach ($files->take(3) as $file)
                        <div class="item" data-id="{{ $file->id }}">{{ $file->name }}</div>
                    @endforeach
                </div>
                <a href="{{ route('user.files') }}" class="btn btn-more">رؤية المزيد</a>
                <div class="loading" style="display: none;">Loading...</div>
            </div>

            <!-- القسم الثالث: جميع اليوزرات -->
            <div class="section" id="users-section">
                <h3>جميع اليوزرات</h3>
                <hr>
                <div class="section-content" id="users-content">
                    @foreach ($users->take(3) as $user)
                        <div class="item" data-id="{{ $user->id }}">{{ $user->name }}</div>
                    @endforeach
                </div>
                <a href="{{ route('users') }}" class="btn btn-more">رؤية المزيد</a>
                <div class="loading" style="display: none;">Loading...</div>
            </div>
        </div>
    </div>
@endsection
