@extends('layout.app')

@section('title', 'Home')

@section('content')

    <body>
        <div class="home">
            @if ($reports->isEmpty())
                <p class="text-center" style="margin-right: 50px;">{{ __('messages.no_request') }}</p>
            @else
                <ul>
                    @foreach ($reports as $report)
                        @foreach ($users as $user)
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
                                    @if ($report->report === 'check_in')
                                        {{ __('messages.s4') }} {{ $user->name }} - {{ __('messages.s6') }}
                                        {{ $report->file->name }}
                                        {{ __('messages.s3') }}
                                        {{ \Carbon\Carbon::parse($report->created_at)->format('Y-m-d H:i') }}
                                    @else
                                        {{ __('messages.s4') }} {{ $user->name }} - {{ __('messages.s7') }}
                                        {{ $report->file->name }}
                                        {{ __('messages.s3') }}
                                        {{ \Carbon\Carbon::parse($report->created_at)->format('Y-m-d H:i') }}
                                    @endif
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
        :root {
            --primary-color: #abc3d8;
            --border-color: #ddd;
            --btn-color: #214368;
            --btn2-color: rgb(45, 101, 82);
            --background-color: rgb(255, 255, 255);
            --text-color: black;
        }

        /* هيدر */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: calc(100% - 260px);
            z-index: 1000;
            background-color: var(--background-color);
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
            gap: 10px;
            margin-right: auto;
        }

        .header-icons button {
            background-color: transparent;
            border: none;
            color: var(--background-color);
            font-size: 1.25rem;
            margin-left: 1rem;
            cursor: pointer;
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
            border-left: 1px transparent var(--text-color);
            ;
        }

        .sidebar-logo {
            margin: auto 0;
        }

        .sidebar-logo a {
            color: var(--text-color);
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
            color: var(--text-color);
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
            color: var(--background-color);
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

        .home {
            justify-content: center;
            text-align: right;
            margin: 0 0 0 50px;
        }

        .home h2 {
            margin-right: 30px;
            font-weight: bold;
        }

        .heading {
            font-size: 30px;
            font-weight: bold;
            color: var(--text-color);
        }

        /* ligjt and dark mode */

        body.light-mode {
            background-color: var(--background-color);
            color: var(--text-color);
        }

        body.dark-mode {
            background-color: var(--text-color);
            color: var(--background-color);
        }

        .header.dark-mode {
            background-color: var(--text-color);
            color: var(--background-color);
        }

        .header.light-mode {
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .footer.dark-mode {
            color: var(--background-color);
        }

        .footer.light-mode {
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .profile-btn a {
            color: inherit;
        }

        body.dark-mode .profile-btn a {
            color: var(--background-color);
        }

        body.light-mode .profile-btn a {
            color: var(--text-color);
        }

        #sidebar.dark-mode {
            background-color: var(--text-color);
            border-left: 2px solid var(--background-color);
        }

        #sidebar.light-mode {
            background-color: var(--background-color);
            border-left: 2px solid var(--text-color);
        }

        #sidebar.dark-mode a.sidebar-link {
            color: hwb(0 86% 9%);
        }

        #sidebar.light-mode a.sidebar-link {
            color: var(--text-color);
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
    </style>
@endsection
