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
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5 main">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="title">{{ __('messages.all') }}</h1>
            </div>
        </div>
        <div class="rrow">
            @if ($groups->isEmpty())
            <p class="text-center" style="margin-right: 50px;">{{ __('messages.no_groups') }}</p>
            @else
                @foreach ($groups as $group)
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $group->name }}</h5>
                                <hr class="hr">
                                <h5 class="card-text">{{ $group->description }}</h5>
                                <form
                                action="{{ route('sendrequest', ['groupid' => $group->id]) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="btn btn-invite">{{ __('messages.sendinvite') }}</button>
                            </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <a href="{{ route('groups.create') }}" class="floating-button" data-toggle="modal" data-target="#createGroupModal" title="انشاء مجموعة جديدة">
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
                            <label id="name">الاسم:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label id="description">الوصف:</label>
                            <input type="text" name="description" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-Add">اضافة غروب</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
