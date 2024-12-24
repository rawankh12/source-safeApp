@extends('layout.app')

@section('title', 'Home')

@section('content')

    <body>
        <div class="home">
            @if ($reports->isEmpty())
                <p class="text-center" style="margin-right: 50px;">{{ __('messages.no_report') }}</p>
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
            --primary-color-dark: #abc3d8;
            --border-color-dark: #444;
            --btn-color-dark: #c8c7c7;
            --btn2-color-dark: #c8c7c7;
            --background-color-dark: #ececec;
            --text-color-dark: #0c0c0c;
            --hover-colorbackground-dark: #a4a2a2a4;
            --hover-color-dark: #5c9bff;
            --btn3-color-dark: #6b3b6b;
            --hr-color-dark: rgba(200, 200, 255, 0.3);
            --btn-delete-color-dark: #a94444;
            --btn-success-color-dark: #2ca758;
            /*light mood*/
            --blue-color-alt: #0d69d5;
            --green-color: rgb(89, 101, 152);
            --red-color: #f44336;
            --orange-color: #f59e0b;
            --grey-color: #888;
            --whitef-color: #bec2c6c7;
            --white-color: white;
            --lightgray-color: #ddd;
            --black-color: black;
            --white-ccc-color: #ccc;
            --white-eee-color: #eee;
            --greeng-color: rgb(34 197 94 / 20%);
            --h-and-s-color: rgb(154, 164, 208);
            /*dark mood*/
            --bule-color-dark: #87a4c6;
            --blue-color-alt-dark: #395472;
            --green-color-dark: #54735f;
            --red-color-dark: #511613;
            --orange-color-dark: #5b4113;
            --grey-color-dark: #e4e3e3;
            --whitef-color-dark: #2b3741;
            --white-color-dark: rgb(78, 86, 121);
            --lightgray-color-dark: #5a1d1d;
            --black-color-dark: rgb(6, 6, 6);
            --white-ccc-color-dark: #ccc;
            --white-eee-color-dark: #eee;
            --greeng-color-dark: rgba(89, 147, 110, 0.2);
        }

        html[dir="rtl"] body {
            font-family: 'Noto Naskh Arabic', serif;
            direction: rtl;
            margin-right: 260px;
            width: calc(100% - 240px);
            margin-top: 100px;
            padding-left: 30px;
        }

        html[dir="ltr"] body {
            font-family: 'Poppins', sans-serif;
            direction: ltr;
            margin-left: 260px;
            width: calc(100% - 240px);
            margin-right: 0;
            padding-right: 30px;
            margin-top: 100px;
        }

        html[dir="rtl"] {
            font-family: 'Noto Naskh Arabic', serif;
            text-align: right;
            direction: rtl;
        }

        html[dir="ltr"] {
            font-family: 'Poppins', sans-serif;
            text-align: left;
            direction: ltr;
        }

        /* هيدر */
        html[dir="ltr"] .header {
            position: fixed;
            top: 0;
            right: 0;
            left: auto;
            width: calc(100% - 240px);
            z-index: 1000;
            background-color: var(--h-and-s-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            transition: all 0.25s ease-in-out;
            margin-bottom: 30px;
        }

        html[dir="rtl"] .header {
            position: fixed;
            top: 0;
            left: 0;
            right: auto;
            width: calc(100% - 240px);
            z-index: 1000;
            background-color: var(--h-and-s-color);
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

        html[dir="ltr"] .header-icons {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: auto;
        }

        html[dir="rtl"] .header-icons {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-right: auto;
            margin-left: 0;
        }

        html[dir="ltr"] .header-icons button {
            background-color: transparent;
            border: none;
            color: var(--background-color);
            font-size: 1.25rem;
            margin-right: 1rem;
            cursor: pointer;
        }

        html[dir="rtl"] .header-icons button {
            background-color: transparent;
            border: none;
            color: var(--background-color);
            margin-left: 1rem;
            margin-right: 0;
            font-size: 1.25rem;
            cursor: pointer;
        }

        html[dir="ltr"] .modal-header .btn-close.move-right {
            position: absolute;
            left: 1rem;
            right: auto;
            text-align: left;
        }

        html[dir="rtl"] .modal-header .btn-close.move-right {
            position: absolute;
            right: 1rem;
            left: auto;
            text-align: right;
        }

        .header img {
            border-radius: 50%;
        }

        .header .user-info {
            display: flex;
            align-items: center;
        }

        html[dir="ltr"] .header .user-info span {
            margin-left: 10px;
        }

        html[dir="rtl"] .header .user-info span {
            margin-right: 10px;
            margin-left: 0;
        }

        /*sidebar*/
        html[dir="ltr"] #sidebar {
            left: 0;
            right: auto;
            border-left: 1px solid var(--lightgray-color);
        }

        html[dir="ltr"] a.sidebar-link {
            text-align: left;
            margin-right: 0;
            margin-left: 0;
        }

        html[dir="ltr"] .sidebar-link {
            display: flex;
            align-items: center;
        }

        html[dir="ltr"] .sidebar-icon {
            order: -1;
            margin-right: 5px;
            margin-left: 0;
        }

        /* الاتجاه rtl (يمين إلى يسار) */
        html[dir="rtl"] #sidebar {
            right: 0;
            left: auto;
            border-right: 1px solid var(--lightgray-color);
        }

        html[dir="rtl"] a.sidebar-link {
            text-align: right;
            margin-right: 0;
            margin-left: 0;
            font-size: 0.9rem;
        }

        html[dir="rtl"] .sidebar-link {
            display: flex;
            align-items: center;
        }

        html[dir="rtl"] .sidebar-icon {
            order: -1;
            margin-left: 5px;
            margin-right: 0;
        }

        #sidebar {
            width: 220px;
            min-width: 240px;
            z-index: 1;
            transition: width 0.3s;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            box-shadow: 0 0 10px var(--lightgray-color);
            background-color: var(--h-and-s-color);
        }

        a.sidebar-link {
            padding: .625rem 0;
            color: var(--text-color);
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            margin-bottom: 30px;
            border-radius: 20px;
        }

        .sidebar-item {
            position: relative;
            margin-right: 0;
        }

        .sidebar-link.active {
            color: var(--hover-color) !important;
        }

        a.sidebar-link:hover {
            background-color: var(--white-color-dark);
            height: 40px;
        }

        #sidebar .sidebar-logo,
        #sidebar .sidebar-link span {
            display: inline-block;
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
            width: calc(100% - 240px);
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

        html[dir="ltr"] .title {
            text-align: left;
        }

        html[dir="rtl"] .title {
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

        html[dir="rtl"] .home {
            text-align: right;
            margin: 0 0 0 50px;
            justify-content: center;
        }

        html[dir="ltr"] .home {
            text-align: left;
        }

        html[dir="rtl"] .home h2 {
            /* margin-right: 30px; */
            font-weight: bold;
        }

        html[dir="ltr"] .home h2 {
            /* margin-left: 30px; */
            font-weight: bold;
        }

        body.dark-mode .home h2 {
            color: var(--btn2-color-dark);
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

        html[dir="ltr"] .rrow {
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
            width: 95%;
            background-color: white;
            margin-right: 30px;
            margin-top: 40px;
            border: 1px solid black;
        }

        .card1 {
            border-radius: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            width: 80%;
            background-color: white;
            margin-right: 30px;
            margin-top: 40px;
            border: 1px solid black;
        }

        body.dark-mode .card {
            background-color: var(--white-color-dark);
        }

        body.dark-mode .card1 {
            background-color: var(--white-color-dark);
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
            margin-right: 15px;
        }

        .btn-view1 {
            background-color: var(--btn-color);
            border: none;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            color: var(--background-color);
            margin-left: 120px;
        }

        html[dir="rtl"] .btn-view1 {
            background-color: var(--btn-color);
            border: none;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            color: var(--background-color);
            margin-right: 100px;
            height: 40px;
            width: 40%;
        }

        body.dark-mode .btn-view {
            background-color: var(--btn-color-dark);
            color: black;
        }

        .btn-Add {
            background-color: var(--btn-color);
            border: none;
            color: var(--background-color);
            right: 0;
        }

        body.dark-mode .btn-Add {
            background-color: var(--btn-color-dark);
            color: black;
        }

        .btn-sendinvite {
            border: 2px solid var(--text-color);
            margin-top: 20px;
            color: var(--text-color);
            font-weight: bold;
            margin-right: 5px;
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
            color: black;
        }

        .modal-body .btn-fileReauests {
            background-color: var(--btn-color);
            margin-top: 20px;
            color: var(--background-color);
            width: 100%;
        }

        body.dark-mode .modal-body .btn-fileReauests {
            background-color: var(--btn-color-dark);
            color: black;
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
            color: black;
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
            color: black;
        }

        .card-body .btn-report {
            background-color: var(--btn2-color);
            margin-top: 20px;
            color: var(--background-color);
            margin-right: 10px;
        }

        body.dark-mode .card-body .btn-report {
            background-color: var(--btn2-color-dark);
            color: black;
        }

        .card-body .btn-report1 {
            background-color: var(--btn2-color);
            margin-top: 20px;
            color: var(--background-color);
            margin-left: 100px;
        }

        html[dir="rtl"] .card-body .btn-report1 {
            background-color: var(--btn2-color);
            margin-top: 20px;
            color: var(--background-color);
            margin-right: 100px;
        }

        body.dark-mode .card-body .btn-report1 {
            background-color: var(--btn2-color-dark);
            color: black;
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

        html[dir="ltr"] .btn-delete-icon {
            position: absolute;
            top: 10px;
            right: 0;
            left: auto;
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
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .welcome,
        .tickets {
            width: 90%;
            height: 17rem;
            margin-bottom: 30px;
            padding: 50px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border: 1px solid black;
        }

        .avatar-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #ddd;
        }

        .box {
            flex: 1;
            min-width: 200px;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin: 0 10px 0 10px;
        }

        .box:hover {
            transform: scale(1.05);
        }

        .box i {
            margin-bottom: 10px;
            color: #666;
        }

        /* profile */
        .grid-container-profile {
            display: flex;
            gap: 20px;
        }

        .section1 {
            padding: 5px;
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
            height: 39.3rem;
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
            gap: 10px;
            width: 30%;
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
            padding: 10px;
            background-color: var(--background-color);
            display: flex;
            flex-direction: column;
        }

        body.dark-mode .subsection {
            background-color: var(--background-color-dark);
        }

        .subsection h3 {
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
            color: black;
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
            background-color: var(--white-color-dark);
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
        .dark-mode #search-button {
            filter: brightness(0) invert(1);
        }

        .dark-mode #notification-badge {
            background-color: yellow;
            color: black;
        }

        /* sidebar dark mood */
        #sidebar.dark-mode {
            box-shadow: 0 0 10px var(--lightgray-color-dark);
            background-color: var(--white-color-dark);
        }

        #sidebar.dark-mode a.sidebar-link.active {
            border-right: 3px solid var(--hover-color-dark);
        }

        #sidebar.dark-mode a.sidebar-link {
            color: var(--text-color);
        }

        #sidebar.dark-mode a.sidebar-link:hover {
            background-color: var(--bule-color-dark);
            border-right: 3px solid var(--hover-color-dark);
        }

        body.dark-mode #sidebar .sidebar-link img {
            filter: invert(1.5) grayscale(1.5) brightness(0.8);
        }

        body.dark-mode #sidebar .d-flex img {
            filter: invert(1.5) grayscale(1.5) brightness(0.8);
        }

        /* footer dark mood */
        body.dark-mode .footer {
            background-color: var(--whitef-color-dark);
            color: #c8c7c7;
        }

        body.dark-mode .footer .container p {
            color: #c8c7c7;
        }

        /* body dark mood */
        body.dark-mode {
            background-color: var(--whitef-color-dark);
            color: var(--text-color-dark);
        }
    </style>
@endsection
