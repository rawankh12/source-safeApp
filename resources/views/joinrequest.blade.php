@extends('layout.app')

@section('title', 'Home')

@section('content')

    <body>
        <div class="home">
            @if ($pendingRequests->isEmpty())
                <p class="text-center" style="margin-right: 50px;">{{ __('messages.no_request') }}</p>
            @else
                <ul>
                    @foreach ($pendingRequests as $request)
                        @foreach ($request->users as $user)
                            <li
                                style="border: 1px solid black; 
                            width: 90%; 
                            margin-left: 50px;
                            margin-top: 20px;
                            padding: 10px; 
                            display: flex; 
                            justify-content: 
                            space-between; 
                            align-items: center;">
                                <div style="flex: 1;">
                                    {{ __('messages.s4') }} {{ $user->name }} - {{ __('messages.s5') }}
                                    {{ $request->name }}
                                    {{ __('messages.s3') }}
                                    {{ \Carbon\Carbon::parse($request->created_at)->format('Y-m-d H:i') }}
                                </div>
                                <div class="btngroups" style="display: flex; gap: 10px;">
                                    <form
                                        action="{{ route('acceptJoinRequest', ['userId' => $user->id, 'groupId' => $request->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-Add">{{ __('messages.yes') }}</button>
                                    </form>
                                    <form
                                        action="{{ route('deleteJoinRequest', ['userId' => $user->id, 'groupId' => $request->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">{{ __('messages.no') }}</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" style="background-color: rgb(211, 231, 231); color: black;">
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
        .btngroups .btn-delete {
            background-color: #7a1b23;
            color: #f6f1f1;
            margin-left: 20px;
        }
    </style>
@endsection
