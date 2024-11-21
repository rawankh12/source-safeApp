@extends('layout.app')

@section('title', 'Home')

@section('content')

    <body>
        <div class="home">
            <h2 class="text-right">ملفاتي</h2>

            @if ($Files->isEmpty())
                <p class="text-right" style="margin-right: 50px;">لا يوجد ملفات</p>
            @else
                <div class="row">
                    @foreach ($Files as $file)
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $file->name }}</h5>
                                    <p class="card-text">حالة الملف: free</p>
                                    <p class="card-text"> <a href="{{ url('/view-file/' . $file->url) }}" target="_blank"
                                            rel="noopener noreferrer">{{ $file->url }}</a></p>
                                    {{-- <form action={{ route('blockfile', ['groupid' => $group->id, 'fileid' => $file->id]) }}
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-Add">reserve</button>
                                    </form> --}}
                                    {{-- <form
                                        action={{ route('deletefile', ['group_id' => $group->id, 'file_id' => $file->id]) }}
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">Delete</button>
                                    </form> --}}
                                </div>
                            </div>
                        </div>
                        <!-- Modal for editing file -->
                        {{-- <div class="modal fade" id="editFileModal-{{ $file->id }}" tabindex="-1"
                            aria-labelledby="editFileModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editFileModalLabel">Edit File</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="text-align: left;">
                                        <form
                                            action="{{ route('updatefile', ['group_id' => $group->id, 'id' => $file->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label>Name:</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $file->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="fileStatus">Choose file type:</label>
                                                <select id="fileStatus" name="status" class="form-control" required>
                                                    <option value="free" {{ $file->status == 'free' ? 'selected' : '' }}>
                                                        Free</option>
                                                    <option value="blocked"
                                                        {{ $file->status == 'blocked' ? 'selected' : '' }}>blocked</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-Add">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    @endforeach
                </div>
            @endif

            <!-- Modal for creating a new file -->
            <a href="#" class="floating-button" data-toggle="modal" data-target="#createFileModal" title="انشاء ملف جديدة">+</a>
            <div class="modal fade" id="createFileModal" tabindex="-1" role="dialog"
                aria-labelledby="createFileModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createFileModalLabel">انشا ملف جديد</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="fileName" style="text-align: right;">الاسم:</label>
                                    <input type="text" class="form-control" id="fileName" name="name"
                                        placeholder="ادخل اسم الملف" required>
                                </div>
                                <div class="form-group">
                                    <label for="fileUpload" style="text-align: right;">الملف:</label>
                                    <input type="file" class="form-control" id="fileUpload" name="file" required>
                                </div>
                                {{-- <div class="form-group">
                                <label for="groupSelect">Choose Group:</label>
                                <select class="form-control" id="groupSelect" name="group_id" required>
                                    @foreach (auth()->user()->groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    style="margin-bottom: 20px;">الغاء</button>
                                <button type="submit" class="btn btn-Add">اضافة</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for search -->
            {{-- <a href="#" class="floating-button2" data-toggle="modal" data-target="#searchModal">
                <i class="fa fa-search"></i>
            </a> --}}
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="searchModalLabel">Search</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="GET">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="query" placeholder="Enter...">
                                </div>
                                <button type="submit" class="btn btn-Add">Ok</button>
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
        </div>
    </body>

@endsection
