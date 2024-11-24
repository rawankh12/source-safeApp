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
                                    <p class="card-text"> <a href="{{ url('/view-file/' . $file->url) }}" target="_blank"
                                            rel="noopener noreferrer">{{ $file->url }}</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Modal for creating a new file -->
            <a href="#" class="floating-button" data-toggle="modal" data-target="#createFileModal"
                title="انشاء ملف جديدة">+</a>
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    style="margin-bottom: 20px;">الغاء</button>
                                <button type="submit" class="btn btn-Add">اضافة</button>
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
