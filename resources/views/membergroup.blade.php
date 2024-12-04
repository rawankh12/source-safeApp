@extends('layout.app')

@section('title', 'Home')

@section('content')

    <body>
        <div class="home">
            <h2 class="text-right">{{ __('messages.membergroup') }}</h2>
            <div class="row">
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
                                    <a href="{{ route('member.files', $group->id) }}" class="btn btn-view">
                                        {{ __('messages.viewfile') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
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

    <style>
        :root {
            /* light mood */
            --primary-color: #abc3d8;
            --border-color: #ddd;
            --btn-color: #214368;
            --btn2-color: rgb(45, 101, 82);
            --background-color: rgb(255, 255, 255);
            --text-color: black;
            --hover-colorbackground: #b0aeb4;
            --hover-color: #3b7ddd;
            --btn3-color: #44134a;
            --hr-color: rgba(66, 63, 108, 0.597);
            --btn-delete-color: #e25858;
            --btn-success-color: #28a745;
            /* Dark mode */
            --primary-color-dark: #7aa580;
            --border-color-dark: #444;
            --btn-color-dark: #3a5878;
            --btn2-color-dark: #2d5246;
            --background-color-dark: #1b1b1b;
            --text-color-dark: #f5f5f5;
            --hover-colorbackground-dark: #a4a2a2a4;
            --hover-color-dark: #5c9bff;
            --btn3-color-dark: #6b3b6b;
            --hr-color-dark: rgba(200, 200, 255, 0.3);
            --btn-delete-color-dark: #a94444;
            --btn-success-color-dark: #2ca758;
        }

        body {
            font-family: 'Poppins', sans-serif;
            direction: rtl;
            margin-right: 260px;
            width: calc(100% - 260px);
            margin-top: 100px;
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

        .modal-header .btn-close.move-right {
            position: absolute;
            right: 1rem;
            text-align: right;
        }

        /*sidebar*/
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
            border-left: 1px solid var(--text-color);
        }

        .sidebar-logo {
            margin: auto 0;
        }

        #sidebar .sidebar-logo,
        #sidebar .sidebar-link span {
            display: inline-block;
        }

        .sidebar-nav {
            padding: 1rem 0;
            flex: 1 1 auto;
        }

        #sidebar .sidebar-logo img {
            max-width: 100%;
            height: auto;
            background-color: transparent;
            transition: background-color 0.3s, box-shadow 0.3s;
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
            background-color: var(--hover-colorbackground);
            border-right: 3px solid var(--hover-color);
        }

        .sidebar-item {
            position: relative;
            margin-right: 0;
        }

        .sidebar-link.active {
            color: var(--hover-color) !important;
        }

        /*footer*/
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

        /* home */
        .container {
            margin-top: 5rem;
        }

        .title {
            text-align: right;
            position: relative;
            margin-right: 55px;
            margin-top: 15px;
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

        .heading.dark-mode {
            color: var(--text-color-dark);
        }

        .rrow {
            display: flex;
            flex-wrap: wrap;
            justify-content: right;
            text-align: center;
            margin-top: 40px;
        }

        .card {
            border-radius: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            width: 90%;
            background-color: var(--primary-color);
            margin-right: 30px;
            margin-top: 40px;
        }

        body.dark-mode .card {
            background-color: var(--primary-color-dark);
        }

        .card-title {
            color: var(--text-color);
            font-weight: bold;
            font-size: 1.25rem;
            text-align: center;
        }

        body.dark-mode .card-title {
            color: var(--text-color-dark);
        }

        .card-text {
            text-align: center;
        }

        .btn-view {
            background-color: var(--btn-color);
            border: none;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            color: var(--background-color);
        }

        body.dark-mode .btn-view {
            background-color: var(--btn-color-dark);
            color: var(--background-color-dark);
        }

        .btn-Add {
            background-color: var(--btn-color);
            border: none;
            color: var(--background-color);
            right: 0;
        }

        body.dark-mode .btn-Add {
            background-color: var(--btn-color-dark);
            color: var(--background-color-dark);
        }

        .btn-sendinvite {
            border: 2px solid var(--text-color);
            margin-top: 20px;
            color: var(--text-color);
            font-weight: bold;
            margin-right: 10px;
        }

        body.dark-mode .btn-sendinvite {
            border: 2px solid var(--text-color-dark);
            color: var(--text-color-dark);
        }

        .floating-button {
            position: fixed;
            bottom: 40px;
            left: 40px;
            width: 56px;
            height: 56px;
            background-color: var(--primary-color);
            color: var(--text-color);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            text-decoration: none;
            box-shadow: 0 2px 10px var(--text-color);
            transition: background-color 0.3s;
        }

        body.dark-mode .floating-button {
            background-color: var(--primary-color-dark);
            color: var(--text-color-dark);
            box-shadow: 0 2px 10px var(--text-color-dark);
        }

        .form-group input {
            border-radius: 20px;
            background-color: var(--primary-color);
            width: 100%;
            height: 100%;
            text-align: right;
        }

        body.dark-mode .form-group input {
            background-color: var(--primary-color-dark);
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
            border: 2px solid var(--text-color);
        }

        body.dark-mode .btn-group a {
            border: 2px solid var(--text-color-dark);
        }

        .modal-body .btn-File {
            background-color: var(--primary-color);
            color: var(--text-color);
        }

        body.dark-mode .modal-body .btn-File {
            background-color: var(--primary-color-dark);
            color: var(--text-color-dark);
        }

        .modal-body .btn-Info {
            background-color: var(--btn3-color);
            color: var(--background-color);
        }

        body.dark-mode .modal-body .btn-Info {
            background-color: var(--btn3-color-dark);
            color: var(--background-color-dark);
        }

        .modal-body .btn-Logout {
            background-color: var(--btn2-color);
            margin-top: 20px;
            color: var(--background-color);
            width: 100%;
        }

        .modal-body .btn-Reauests {
            background-color: var(--btn-color);
            margin-top: 20px;
            color: var(--background-color);
            width: 100%;
        }

        body.dark-mode .modal-body .btn-Reauests {
            background-color: var(--btn-color-dark);
            color: var(--background-color-dark);
        }

        .modal-body .btn-fileReauests {
            background-color: var(--btn-color);
            margin-top: 20px;
            color: var(--background-color);
            width: 100%;
        }

        body.dark-mode .modal-body .btn-fileReauests {
            background-color: var(--btn-color-dark);
            color: var(--background-color-dark);
        }

        #fileStatus {
            padding: 8px;
            border-radius: 20px;
            width: 100%;
            margin-bottom: 10px;
            background-color: var(--primary-color);
        }

        body.dark-mode #fileStatus {
            background-color: var(--primary-color-dark);
        }

        .card-body .btn-invite {
            background-color: var(--btn2-color);
            margin-top: 20px;
            color: var(--background-color);
            width: 100%;
        }

        body.dark-mode .card-body .btn-invite {
            background-color: var(--btn2-color-dark);
            color: var(--background-color-dark);
        }

        .card-body .fa-user {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .card-body .btn-edit {
            background-color: var(--btn-color);
            margin-top: 20px;
            color: var(--background-color);
        }

        body.dark-mode .card-body .btn-edit {
            background-color: var(--btn-color-dark);
            color: var(--background-color-dark);
        }

        .card-body .btn-report {
            background-color: var(--btn2-color);
            margin-top: 20px;
            color: var(--background-color);
            margin-right: 10px;
        }

        body.dark-mode .card-body .btn-report {
            background-color: var(--btn2-color-dark);
            color: var(--background-color-dark);
        }

        .btn-delete-icon {
            position: absolute;
            top: 10px;
            left: 10px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .btn-delete-icon img {
            width: 24px;
            height: 24px;
        }

        .card-body .btn-download {
            position: absolute;
            color: var(--text-color);
            left: 20px;
            font-size: 1.4rem;
        }

        body.dark-mode .card-body .btn-download {
            color: var(--text-color-dark);
        }

        .card-body .btn-upload {
            position: absolute;
            color: var(--text-color);
            right: 20px;
            font-size: 1.4rem;
        }

        body.dark-mode .card-body .btn-upload {
            color: var(--text-color-dark);
        }

        /*home*/
        .grid-container {
            display: flex;
            gap: 10px;
            justify-content: space-between;
            top: 50px;
            position: relative;
        }

        .text-center img {
            max-width: 80%;
            object-fit: cover;
        }

        .section {
            padding: 10px;
            background-color: var(--primary-color);
            border-radius: 20px;
            border: 1px solid var(--border-color);
            flex: 1;
            height: 300px;
        }

        body.dark-mode .section {
            background-color: var(--primary-color-dark);
            border: 1px solid var(--border-color-dark);
        }

        .section h3 {
            text-align: center;
            margin-bottom: 15px;
        }

        .grid-container .section:nth-child(n + 2) {
            grid-column: span 2;
        }

        .btn-more {
            display: block;
            margin-top: 170px;
            padding: 10px;
            text-align: center;
            color: var(--text-color);
            text-decoration: none;
            border: 1px solid var(--text-color);
            font-weight: bold;
            border-radius: 15px;
        }

        body.dark-mode .btn-more {
            color: var(--text-color-dark);
            border: 1px solid var(--text-color-dark);
        }

        /* profile */
        .grid-container-profile {
            display: flex;
            gap: 20px;
        }

        .section1 {
            padding: 10px;
            background-color: var(--primary-color);
            border-radius: 20px;
            border: 1px solid var(--border-color);
            flex: 1;
        }

        body.dark-mode .section1 {
            background-color: var(--primary-color-dark);
            border: 1px solid var(--border-color-dark);
        }

        .profile-section {
            border: 2px solid var(--border-color);
            padding: 20px;
            background-color: var(--background-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            width: 30%;
            border-radius: 20px;
            height: 37.5rem;
        }

        body.dark-mode .profile-section {
            border: 2px solid var(--border-color-dark);
            background-color: var(--background-color-dark);
        }

        .info p {
            text-align: right;
            margin-top: 30px;
        }

        .files-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 50%;
            border-radius: 20px;
            border: 1px solid var(--border-color);
        }

        body.dark-mode .files-section {
            border: 1px solid var(--border-color-dark);
        }

        .btn-more1 {
            display: block;
            margin-top: 100px;
            padding: 10px;
            text-align: center;
            color: var(--text-color);
            text-decoration: none;
            border: 1px solid var(--text-color);
            font-weight: bold;
            border-radius: 15px;
        }

        body.dark-mode .btn-more1 {
            color: var(--text-color-dark);
            border: 1px solid var(--text-color-dark);
        }

        .subsection {
            padding: 20px;
            background-color: var(--background-color);
            display: flex;
            flex-direction: column;
        }

        body.dark-mode .subsection {
            background-color: var(--background-color-dark);
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
            border: 0.5px solid var(--hr-color);
            width: 100%;
            margin-top: 10px;
        }

        body.dark-mode hr {
            border: 0.5px solid var(--hr-color-dark);
        }

        .btn-Addd {
            margin-left: 20px;
            border-radius: 10px;
            background-color: var(--btn-color);
            color: var(--background-color);
        }

        body.dark-mode .btn-Addd {
            background-color: var(--btn-color-dark);
            color: var(--background-color-dark);
        }

        /* Alert dark mood */
        body.dark-mode .alert-success {
            background-color: var(--btn-success-color);
            color: var(--background-color-dark);
        }

        body.dark-mode .alert-danger {
            background-color: var(--btn-delete-color);
            color: var(--background-color-dark);
        }

        /* header dark mood */
        .header.dark-mode {
            background-color: var(--background-color-dark);
            color: var(--text-color-dark);
        }

        .search-container.dark-mode {
            background-color: var(--background-color-dark);
            border: 1px solid var(--background-color-dark);
        }

        .search-container.dark-mode input {
            background-color: var(--background-color-dark);
            color: var(--text-color-dark);
        }

        body.dark-mode #notification-popup {
            background-color: var(--background-color-dark);
            color: var(--text-color-dark);
            border: 1px solid var(--text-color-dark);
        }

        body.dark-mode #notification-popup ul li {
            border-bottom: 1px solid var(--background-color-dark);
        }

        body.dark-mode #notification-popup ul li:hover {
            background-color: var(--background-color-dark);
        }

        .dark-mode #mode-toggle img,
        .dark-mode #profile-btn img,
        .dark-mode #search-button,
        .dark-mode #notification-icon {
            filter: brightness(0) invert(1);
        }

        /* sidebar dark mood */
        #sidebar.dark-mode {
            background-color: var(--background-color-dark);
            border-left: 2px solid var(--text-color-dark);
        }

        #sidebar.dark-mode a.sidebar-link.active {
            border-right: 3px solid var(--hover-color-dark);
        }

        #sidebar.dark-mode a.sidebar-link {
            color: var(--text-color-dark);
        }

        #sidebar.dark-mode a.sidebar-link:hover {
            background-color: var(--hover-colorbackground-dark);
            border-right: 3px solid var(--hover-color-dark);
        }

        body.dark-mode #sidebar .sidebar-link img {
            filter: invert(1) grayscale(1) brightness(1.5);
        }

        body.dark-mode #sidebar .d-flex img {
            filter: invert(1) grayscale(1) brightness(1.5);
        }

        /* footer dark mood */
        body.dark-mode .footer {
            background-color: var(--background-color-dark);
            color: var(--text-color-dark);
        }

        body.dark-mode .footer .container p {
            color: var(--text-color-dark);
        }

        /* body dark mood */
        body.dark-mode {
            background-color: var(--background-color-dark);
            color: var(--text-color-dark);
        }
    </style>
@endsection
