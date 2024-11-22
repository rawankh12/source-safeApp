@extends('layout.app')

@section('title', 'Home')

@section('content')

    <body>
        <div class="home">
            <h2 class="text-right">ملفاتي المحجوزة</h2>

            @if ($files->isEmpty())
                <p class="text-center" style="margin-right: 50px;">لا يوجد ملفات محجوزة</p>
            @else
                <div class="row">
                    @foreach ($files as $file)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <a href="{{ asset($file->url) }}" target="_blank" download class="btn-download">
                                        <i class="fa fa-download"></i>
                                    </a>
                                    <a href="#" class="btn-upload" data-toggle="modal"
                                        data-target="#uploadFileModal-{{ $file->id }}">
                                        <i class="fa fa-upload"></i>
                                    </a>
                                    <h5 class="card-title">{{ $file->name }}</h5>
                                    <p class="card-text">
                                        <a href="{{ url('/view-file/' . $file->url) }}" target="_blank"
                                            rel="noopener noreferrer">{{ $file->url }}</a>
                                    </p>
                                    @foreach ($file->groups as $group)
                                        <form
                                            action="{{ route('unblockfile', ['groupId' => $group->id, 'fileId' => $file->id]) }}"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-Add">فك الحجز</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- مودال رفع الملف -->
                        <div class="modal fade" id="uploadFileModal-{{ $file->id }}" tabindex="-1"
                            aria-labelledby="uploadFileModalLabel-{{ $file->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadFileModalLabel-{{ $file->id }}">رفع ملف
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('uploadfile', ['fileId' => $file->id]) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="file-{{ $file->id }}">اختر ملفًا:</label>
                                                <input type="file" name="file" id="file-{{ $file->id }}"
                                                    class="form-control" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-Add">رفع</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
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
    <style>
        /* هيدر */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: calc(100% - 260px);
            z-index: 1000;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            transition: all 0.25s ease-in-out;
            margin-bottom: 30px;
        }

        .header-container {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .header-icons {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-right: auto;
        }

        .header-icons button {
            background-color: transparent;
            border: none;
            color: #fff;
            font-size: 1.25rem;
            margin-left: 1rem;
            cursor: pointer;
        }

        .header-icons i {
            color: hwb(0 0% 100%);
            font-size: 1.5rem;
        }

        .header-icons span {
            margin-left: 0.5rem;
        }

        body {
            font-family: 'Poppins', sans-serif;
            direction: rtl;
            margin-right: 260px;
            width: calc(100% - 260px);
            margin-top: 100px;
        }

        /* تعديل التنسيقات العامة للصفحة */
        .container {
            margin-top: 5rem;
        }

        /* Title*/
        .title {
            text-align: right;
            position: relative;
            margin-right: 55px;
            margin-top: 15px;
        }

        .modal-header .btn-close.move-right {
            position: absolute;
            right: 1rem;
            text-align: right;
        }

        #sidebar {
            width: 240px;
            min-width: 260px;
            z-index: 1;
            transition: width 0.3s;
            display: flex;
            flex-direction: column;
            right: 0;
            position: fixed;
            top: 0;
            bottom: 0;
            border-left: 1px transparent black;
        }

        .sidebar-logo {
            margin: auto 0;
        }

        .sidebar-logo a {
            color: hwb(0 7% 93%);
            font-size: 1.15rem;
            font-weight: 600;
        }

        #sidebar .sidebar-logo,
        #sidebar .sidebar-link span {
            display: inline-block;
        }

        .sidebar-nav {
            padding: 1rem 0;
            flex: 1 1 auto;
        }

        .sidebar-logo img {
            max-width: 100%;
            height: auto;
        }

        a.sidebar-link {
            padding: .625rem 0;
            color: hwb(0 7% 93%);
            display: block;
            font-size: 0.9rem;
            white-space: nowrap;
            border-right: 3px solid transparent;
            margin-right: 20px;
            text-align: right;
            margin-bottom: 30px;
        }

        .p1 {
            padding: .625rem 0;
            text-align: right;
            margin-right: 35px;
        }

        .sidebar-link i {
            font-size: 1.1rem;
            margin-left: .75rem;
            margin-right: 0;
        }

        a.sidebar-link:hover {
            background-color: #eae7f413;
            border-right: 3px solid #3b7ddd;
        }

        .sidebar-item {
            position: relative;
            margin-right: 0;
        }

        .sidebar-link.active {
            color: rgb(106, 176, 195) !important;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: calc(100% - 70px);
            color: white;
            padding: 0 20px;
            text-align: center;
            transition: all 0.25s ease-in-out;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
        }

        .mb-0 {
            height: 100px;
        }

        .footer.expand {
            width: calc(100% - 260px);
        }

        .link {
            display: flex;
            justify-content: right;
            align-items: center;
            margin-right: 50px;
        }

        .link a {
            margin: 0 20px;
            transition: transform 0.2s;
            font-size: 30px;
            color: #0c2347;
            text-decoration: none;
        }

        .link a:hover {
            transform: scale(1.3);
            color: #7aa1cb;
        }

        .home {
            justify-content: center;
            text-align: center;
            margin: 0 0 0 50px;
        }

        .home h2 {
            margin-right: 30px;
            font-weight: bold;
        }

        .heading {
            font-size: 30px;
            font-weight: bold;
            color: rgb(26, 36, 48);
        }

        .rrow {
            display: flex;
            flex-wrap: wrap;
            justify-content: left;
            text-align: center;
            margin-top: 40px;
        }

        .card {
            border-radius: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            width: 80%;
            background-color: #abc3d8;
            margin-right: 30px;
            margin-top: 40px;
        }

        .hr {
            color: #625495;
        }

        .card-title {
            color: #333;
            font-weight: bold;
            font-size: 1.25rem;
            text-align: center;
        }

        .btn-view {
            background-color: #112e4c;
            border: none;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            color: #f6f1f1;
        }

        .btn-Add {
            background-color: #112e4c;
            border: none;
            margin-top: 20px;
            color: #f6f1f1;
            right: 0;
        }

        .btn-sendinvite {
            border: 2px solid black;
            margin-top: 20px;
            color: #000000;
            font-weight: bold;
        }

        .floating-button {
            position: fixed;
            bottom: 40px;
            left: 40px;
            width: 56px;
            height: 56px;
            background-color: #7891ad;
            color: rgb(11, 11, 11);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            text-decoration: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s;
        }

        .floating-button2 {
            position: fixed;
            left: 40px;
            width: 56px;
            height: 56px;
            top: 20px;
            background-color: #7891ad;
            color: rgb(11, 11, 11);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            text-decoration: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s;
        }

        .form-group input {
            border-radius: 20px;
            background-color: #8faecf;
            width: 100%;
            height: 100%;
            text-align: right;
        }

        .form-group label {
            text-align: right;
            right: 0;
        }

        .btn-secondary {
            margin-top: 20px;
            right: 0;
        }

        .btn-group a {
            border: 2px solid black;
        }

        .modal-body .btn-File {
            background-color: #8faecf;
            color: #333;
        }

        .modal-body .btn-Info {
            background-color: #44134a;
            color: #f6f1f1;
        }

        .modal-body .btn-Logout {
            background-color: rgb(13, 86, 62);
            margin-top: 20px;
            color: #f6f1f1;
            width: 100%;
        }

        .modal-body .btn-Reauests {
            background-color: rgb(13, 50, 104);
            margin-top: 20px;
            color: #f6f1f1;
            width: 100%;
        }

        .modal-body .btn-fileReauests {
            background-color: rgb(15, 81, 85);
            margin-top: 20px;
            color: #f6f1f1;
            width: 100%;
        }

        #fileStatus {
            padding: 8px;
            border-radius: 20px;
            width: 100%;
            margin-bottom: 10px;
            background-color: #8faecf;
        }

        .card-body .btn-invite {
            background-color: rgb(76, 13, 86);
            margin-top: 20px;
            color: #f6f1f1;
            width: 100%;
        }

        .card-body .fa-user {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .card-body .btn-edit {
            background-color: #112e4c;
            margin-top: 20px;
            color: #f6f1f1;
            /* width: 100%; */
        }

        .card-body .btn-delete {
            background-color: #7a1b23;
            margin-top: 20px;
            color: #f6f1f1;
            margin-left: 20px;
        }

        .card-body .btn-download {
            position: absolute;
            color: #000000;
            left: 20px;
            font-size: 1.4rem;
        }

        .card-body .btn-upload {
            position: absolute;
            color: #000000;
            right: 20px;
            font-size: 1.4rem;
        }

        /* ligjt and dark mode */

        body.light-mode {
            background-color: #fafbfe;
            color: #000;
        }

        body.dark-mode {
            background-color: rgb(30, 40, 52);
            color: #fff;
        }

        .header.dark-mode {
            background-color: rgb(30, 40, 52);
            color: #fff;
        }

        .header.light-mode {
            background-color: #f8f9fa;
            color: hwb(0 0% 100%);
        }

        .footer.dark-mode {
            color: #fff;
        }

        .footer.light-mode {
            background-color: #f8f9fa;
            color: hwb(0 0% 100%);
        }

        .profile-btn a {
            color: inherit;
        }

        body.dark-mode .profile-btn a {
            color: #fff;
        }

        body.light-mode .profile-btn a {
            color: #000000;
        }

        #sidebar.dark-mode {
            background-color: rgb(30, 40, 52);
            border-left: 2px solid #fff;
        }

        #sidebar.light-mode {
            background-color: #f8f9fa;
            border-left: 2px solid #000;
        }

        #sidebar.dark-mode a.sidebar-link {
            color: hwb(0 86% 9%);
        }

        #sidebar.light-mode a.sidebar-link {
            color: hwb(0 7% 93%);
        }

        #sidebar.light-mode a.sidebar-link:hover {
            background-color: hwb(254 40% 28% / 0.075);
            border-right: 3px solid #3b7ddd;
        }

        #sidebar.dark-mode a.sidebar-link.active {
            border-right: 3px solid hwb(203 71% 9%);
            margin-right: 10px;
        }

        #sidebar.dark-mode a.sidebar-link:hover {
            background-color: 3px solid hwb(203 71% 9%);
            border-right: 3px solid hwb(203 71% 9%);
        }

        #sidebar.dark-mode .sidebar-logo a {
            color: hwb(0 86% 9%);
        }

        #sidebar.dark-mode #toggle-btn i {
            color: hwb(0 86% 9%);
        }

        /*home*/
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto 1fr;
            gap: 10px;
            height: 100vh;
        }

        .section {
            padding: 10px;
            background-color: #d8e4ef;
            display: flex;
            flex-direction: column;
            height: 90%;
            border-radius: 20px;
            border: 1px solid #ddd;
        }

        .section h3 {
            text-align: right;
            margin-bottom: 15px;
        }

        .section-content {
            flex: 1;
            overflow-y: auto;
            text-align: right;
            border-radius: 20px;
        }

        .item {
            padding: 5px;
            margin: 5px 0;
            background-color: #fff;
        }

        .grid-container>.section:nth-child(3) {
            grid-column: span 2;
            height: 70%;
        }

        .btn-more {
            display: block;
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            color: rgb(10, 10, 10);
            text-decoration: none;
            border: 1px solid black;
            font-weight: bold;
            border-radius: 15px;
        }

        /* profile */
        .grid-container-profile {
            display: flex;
            gap: 20px;
        }

        .profile-section {
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #fefefe;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            width: 30%;
            border-radius: 20px;
            height: 37.5rem;
        }

        .info p {
            text-align: right;
            margin-top: 30px;
        }

        .files-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 65%;
            border-radius: 20px;
            border: 1px solid #ddd;
        }

        .subsection {
            padding: 20px;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
        }

        .subsection h3 {
            text-align: right;
            margin-bottom: 15px;
        }

        .section-content {
            flex: 1;
            overflow-y: auto;
        }

        .file-item {
            display: flex;
            align-items: center;
            margin: 5px 0;
            padding: 10px 0;
        }

        hr {
            border: 0.5px solid rgba(66, 63, 108, 0.597);
            width: 100%;
            margin-top: 10px;
        }

        .btn-Addd {
            margin-left: 20px;
            border-radius: 10px;
            background-color: #0c2347;
            color: #ddd;
        }
    </style>
@endsection
