<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Admin Panel</title>

    <!-- CSS for styling -->

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/50f71fe9b3.js" crossorigin="anonymous"></script>

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
                <a href="{{ route('admin.home') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse" aria-expanded="false"><i class="fas solid fa-file-lines pe-2"></i>
                    Event Management
                </a>
                <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ route('events.index') }}" class="sidebar-link" id="page01">Events</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('events.create') }}" class="sidebar-link" id="page01">Book an Event</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                    Users
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ route('customers.index') }}" class="sidebar-link">Customers</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('employee.index') }}" id="emp_reg" class="sidebar-link">Employee Registration</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#services" data-bs-toggle="collapse" aria-expanded="false"><i class="fas fa-clipboard-list"></i>
                    Services
                </a>
                <ul id="services" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{route('services.index')}}">Catering</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('services.invitation.index')}}">Invitation</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('services.decoration.index')}}">Decoration</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('services.entertainment.index')}}">Entertainment</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('venues.index')}}">
                    <i class="fa fa-map-marker pe-2"></i>
                    venues
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-box-archive pe-2"></i>
                    Products
                </a>
                <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ route('products.gift') }}">Gifts</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('products.wrapping') }}">Wrapping Paper</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('products.bouquet') }}">Bouquet</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="{{route('admin.order')}}">
                    <!-- mainly date and time for order history -->
                    <i class="fa-solid fa-list-check"></i>
                    Orders </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('admin.feeds')}}">
                    <!-- mainly date and time for order history -->
                    <i class="fa-solid fa-comments"></i>
                    Feed Backs </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('calendar')}}">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    Calender
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#">
                    <!-- mainly date and time for order history -->
                </a>
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
                        <!-- Notification Dropdown -->

                        @if (Auth::check() && Auth::user()->role === 'admin') <!-- Check if user is admin -->
                        <ul class="navbar-nav ml-auto">
                            @php
                            $notifications = auth()->user()->unreadNotifications;
                            @endphp
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="far fa-bell"></i>
                                    <span class="badge badge-warning navbar-badge">
                                        {{ $notifications->count() }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                    @forelse ($notifications as $notification)
                                    <a href="{{ route('notifications.read', $notification->id) }}" class="dropdown-item">
                                        <i class="fas fa-envelope mr-2"></i> {{ $notification->data['message'] }}
                                        <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                                        <span class="float-right">
                                            <a href="{{ route('notifications.read', $notification->id) }}" class="text-muted" title="Mark as read">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </span>
                                    </a>
                                    @empty
                                    <a href="#" class="dropdown-item">
                                        No new notifications
                                    </a>
                                    @endforelse
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('notifications.index') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
                                </div>
                            </li>
                        </ul>
                        @endif


                        <li><a href="{{ route('profile.index') }}"><i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a></li>


                        <div>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </ul>
                </div>
            </div>
        </nav>


        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"> Home </a></li>
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


    <!-- JS for functionality (Bootstrap, Chart.js included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script src="{{ asset('js/script.js' )}}"></script>
    <script>
        var salesCtx = document.getElementById('salesChart').getContext('2d');
        var revenueCtx = document.getElementById('revenueChart').getContext('2d');

        var salesChart = new Chart(salesCtx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Sales',
                    data: [120, 150, 180, 200, 170, 220],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var revenueChart = new Chart(revenueCtx, {
            type: 'pie',
            data: {
                labels: ['Gift Orders', 'Booked Events', 'Venues'],
                datasets: [{
                    label: 'Revenue',
                    data: [300, 150, 100],
                    backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe'],
                }]
            }
        });
    </script>

    <!-- fullCalendar 2.2.5 -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Select the alert element
            var alert = document.querySelector('.alert-success');

            // Set a timeout to remove the alert after 5 seconds
            if (alert) {
                setTimeout(function() {
                    alert.classList.add('fade');
                    alert.classList.remove('show');
                    setTimeout(function() {
                        alert.remove();
                    }, 150); // Delay to allow fade out effect
                }, 5000); // Time in milliseconds (5000ms = 5 seconds)
            }
        });

        document.getElementById('price').addEventListener('input', function() {
            const priceInput = document.getElementById('price');
            let currentValue = parseInt(priceInput.value);

            if (currentValue <= 0) {
                priceInput.value = 1;
            }
        });

        document.getElementById('price').addEventListener('keydown', function(event) {
            if (event.key === 'ArrowDown' && parseInt(this.value) <= 0) {
                event.preventDefault();
            }
        });
    </script>
    <!-- <script>
        // Function to reload the page
        function autoReload() {
            location.reload();
        }

        // Set the interval to 5000 milliseconds (5 seconds)
        setInterval(autoReload, 30000);
    </script> -->

</body>

</html>