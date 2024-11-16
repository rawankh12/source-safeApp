@extends('layout.app')

@section('title', 'Home')

@section('content')
    <div class="container mt-5 main">
        <div class="grid-container">
            <!-- القسم الأول: جميع الغروبات -->
            <div class="section" id="groups-section">
                <h3>جميع الغروبات</h3>
                <div class="section-content" id="groups-content">
                    @foreach ($groups->take(3) as $group)
                        <div class="item" data-id="{{ $group->id }}">{{ $group->name }}</div>
                    @endforeach
                </div>
                <a href="{{ route('allgroups') }}" class="btn btn-more">رؤية المزيد</a>
                <div class="loading" style="display: none;">Loading...</div>
            </div>

            <!-- القسم الثاني: جميع الفايلات -->
            <div class="section" id="files-section">
                <h3>جميع الفايلات</h3>
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
