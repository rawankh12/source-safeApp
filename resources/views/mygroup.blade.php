@extends('layout.app')

@section('title', 'Home')

@section('content')

    <body>
        <div class="home">
            <h2 class="text-right">غروباتي</h2>
            <div class="row">
                @if ($groups->isEmpty())
                    <p class="text-center" style="margin-right: 50px;">لا يوجد غروبات</p>
                @else
                    @foreach ($groups as $group)
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="card mb-3">
                                <form action="{{ route('deletegroup', ['group_id' => $group->id]) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete-icon">
                                        <img src="https://img.icons8.com/material-rounded/24/filled-trash.png"
                                            alt="filled-trash" title="حذف الغروب"
                                            style="filter: invert(33%) sepia(95%) saturate(5335%) hue-rotate(0deg) brightness(70%) contrast(120%);" />
                                    </button>
                                </form>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $group->name }}</h5>
                                    <hr class="hr">
                                    <h5 class="card-text">{{ $group->description }}</h5>
                                    {{-- @if (Auth::user()->name === $group->user_create) --}}
                                    <a href="{{ route('group.files', $group->id) }}" class="btn btn-view">
                                        رؤية الملفات
                                    </a>
                                    {{-- <a href="{{ route('invite') }}" class="btn btn-sendinvite">
                                        invite
                                    </a> --}}
                                    <button type="button" class="btn btn-sendinvite" data-toggle="modal"
                                        data-target="#inviteuserModal">دعوة</button>
                                    <form action={{ route('reportgroup', ['group_id' => $group->id]) }}
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-report">عرض التقارير</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- model for inviting user --}}
                        <div class="modal fade" id="inviteuserModal" tabindex="-1" aria-labelledby="inviteuserModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="inviteuserModalLabel">اضافة مستخدم</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('inviteuser') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="fileSelect"></label>
                                                <select class="form-control" id="userSelect" name="user_id" required>
                                                    <option value="">اختار مستخدم</option>
                                                    @php
                                                        $users = App\Models\User::where(
                                                            'id',
                                                            '!=',
                                                            Auth::user()->id,
                                                        )->get();
                                                    @endphp
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                style="margin-bottom: 20px;">اغلاق</button>
                                            <button type="submit" class="btn btn-Add">اضافة الى الغروب</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <a href="{{ route('groups.create') }}" class="floating-button" data-toggle="modal"
                data-target="#createGroupModal" title="انشاء مجموعة جديدة">
                +
            </a>
        </div>
        <!-- Modal for create group -->
        <div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="createGroupModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createGroupModalLabel">انشاء غروب جديد</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('groups.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label id="name"></label>
                                <input type="text" name="name" class="form-control" placeholder="الاسم" required>
                            </div>
                            <div class="form-group">
                                <label id="description"></label>
                                <input type="text" name="description" class="form-control" placeholder="الوصف" required>
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                style="margin-bottom: 20px;">الغاء</button>
                            <button type="submit" class="btn btn-Add">اضافة</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for search -->
        {{-- <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="searchModalLabel">search</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="GET">
                            <div class="form-group">
                                <input type="text" class="form-control" name="query" placeholder="enter.....">
                            </div>
                            <button type="submit" class="btn btn-Add">Ok ...</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

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
    </body>
@endsection
