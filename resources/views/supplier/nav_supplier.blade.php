<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Supplier</title>

    <!-- CSS for styling -->

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/boxicons.min.css') }}" rel="stylesheet">


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min copy.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/50f71fe9b3.js') }}"></script>

    <!-- Custom Styles -->
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            height: 100%;
            background-color: #111827;
            color: #fff;
            position: fixed;
            overflow-y: auto;
            transition: width 0.3s;
            padding-top: 20px;
            left: 0;
            top: 0;

        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 20px 10px;
            cursor: pointer;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        .sidebar ul li ul a:hover {
            background: #2563eb;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            transition: margin-left 0.3s, width 0.3s;
        }

        .navbar {
            background: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-right {
            display: flex;
            gap: 20px;
        }

        .navbar-right a {
            border-radius: 5px;
            text-decoration: none;
        }

        .navbar-right a:hover {
            background-color: #ddd;
            /* Adjust as needed */
        }



        .navbar .navbar-left {
            display: flex;
            flex: 1;
            align-items: center;
        }

        .navbar .navbar-right ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .navbar .navbar-right ul li {
            margin-left: 20px;
        }

        .content {
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        .sidebar ul li.active {
            background: #2563eb;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center py-3">My Dashboard</h3>
        <ul>
            <li class="sidebar-item">
                <a href="{{ route('supplier.home') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>




            <li class="sidebar-item">
                <a href="{{ route('supplier.reorder') }}">
                    <i class="fa-solid fa-bars-staggered"></i>
                    Reorder Request</a>
            </li>
            <li class="sidebar-item">
                </a>
            </li>

        </ul>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <nav class="navbar navbar-expand px-3 border-bottom">
            <div class="navbar">
                <div class="navbar-left">
                    <a class="navbar-brand" href="#">My Dashboard</a>
                </div>
                <div class="navbar-right">
                    <ul>
                        @php
                        $notifications = auth()->user()->unreadNotifications;
                        @endphp

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
                                <i class="far fa-bell"></i>
                                <span class="badge bg-warning">{{ $notifications->count() }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                @forelse ($notifications as $notification)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('supplier.notifications.read', $notification->id) }}">
                                        {{ $notification->data['message'] }}
                                    </a>
                                </li>
                                @empty
                                <li><span class="dropdown-item">No notifications</span></li>
                                @endforelse
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('supplier.notification') }}">View
                                        All</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{ route('profile.index') }}"><i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a></li>


                        <div>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                        class="fas fa-sign-out-alt"></i> Logout</a></li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </ul>
                </div>
            </div>
        </nav>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"> Home </a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
        <main class="content px-3 py-2">

            <div class="container-fluid">

                <div class="mb-3">
                    <div class="mt-4">

                        @yield('content')
                    </div>

                </div>

            </div>
        </main>
    </div>
</body>