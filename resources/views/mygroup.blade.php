@extends('layout.app')

@section('title', 'Home')

@section('content')

    <body>
        <div class="home">
            <h2>{{ __('messages.mygroups') }}</h2>
            <div class="row">
                @if ($groups->isEmpty())
                    <p class="text-center" style="margin-right: 50px;">{{ __('messages.no_groups') }}</p>
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
                                            alt="filled-trash" title="{{ __('messages.deletefile') }}"
                                            style="filter: invert(33%) sepia(95%) saturate(5335%) hue-rotate(0deg) brightness(70%) contrast(120%);" />
                                    </button>
                                </form>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $group->name }}</h5>
                                    <hr class="hr">
                                    <h5 class="card-text">{{ $group->description }}</h5>
                                    <a href="{{ route('group.files', $group->id) }}" class="btn btn-view">
                                        {{ __('messages.viewfile') }}
                                    </a>
                                    <button type="button" class="btn btn-sendinvite" data-toggle="modal"
                                        data-target="#inviteuserModal">{{ __('messages.invite') }}</button>
                                    <form action={{ route('reportgroup', ['group_id' => $group->id]) }}
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-report">{{ __('messages.showreport') }}</button>
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
                                        <h5 class="modal-title" id="inviteuserModalLabel">{{ __('messages.adduser') }}</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('inviteuser') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="fileSelect"></label>
                                                <select class="form-control" id="userSelect" name="user_id" required>
                                                    <option value="">{{ __('messages.Chooseuser') }}</option>
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
                                                style="margin-bottom: 20px;">{{ __('messages.close') }}</button>
                                                <button type="submit" class="btn btn-Add">{{ __('messages.Addg') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <a href="{{ route('groups.create') }}" class="floating-button" data-toggle="modal"
                data-target="#createGroupModal" title="{{ __('messages.add_group') }}">
                +
            </a>
        </div>
        <!-- Modal for create group -->
        <div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="createGroupModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createGroupModalLabel">{{ __('messages.add_group') }}</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('groups.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label id="name">{{ __('messages.groupname') }}</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label id="description">{{ __('messages.description') }}</label>
                                <input type="text" name="description" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" style="margin-bottom: 17px;"
                                    data-dismiss="modal">{{ __('messages.close') }}</button>
                                <button type="submit" class="btn btn-Add">{{ __('messages.Addg') }}</button>
                            </div>
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
    </body>
@endsection
