@extends('layout.app')

@section('title', 'Home')

@section('content')

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>تفاصيل الملف</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>اسم الملف:</strong>
                        <p>{{ $file->name }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>الحالة:</strong>
                        <p>
                            @if ($group->status === 'free')
                                <span class="badge bg-success">الملف حر</span>
                            @else
                                <span class="badge bg-danger">الملف محجوز</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>صاحب الملف:</strong>
                        <p>{{ $file->user_id->name ?? 'غير معروف' }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>تاريخ الإنشاء:</strong>
                        <p>{{ $file->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>آخر تعديل:</strong>
                        <p>{{ $file->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
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
