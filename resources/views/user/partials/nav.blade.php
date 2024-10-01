<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"> -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <style>
        .navbar-nav .nav-item .nav-link {
            white-space: nowrap;
            /* Prevents text from wrapping */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #f8f9fa;
            padding: 10px 20px;
        }

        ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        li.nav-item {
            margin-right: 20px;
        }

        li.nav-item a {
            text-decoration: none;
            color: #333;
        }

        li.nav-item.active a {
            font-weight: bold;
            color: blue;
        }


        .card-hover:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            transition: box-shadow 0.3s ease-in-out;
        }

        .nav-link {
            text-decoration: none;
            color: black;
            font-size: 16px;
            font-family: Arial, sans-serif;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: orange;
            /* Change this to the desired hover color */
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>


</head>

<body>
    <div id="app1">
        <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <a class="navbar-brand" href="">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link select_link active" aria-current="page" href="{{ route('user.home') }}">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Products
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a href="{{route('user.products.gift')}}" class="dropdown-item">Gifts</a>
                                    <a href="{{route('user.products.bouquet')}}" class="dropdown-item">Bouquet</a>
                                    <a href="{{route('user.products.wrapping_paper')}}" class="dropdown-item">Gift's Box</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link select_link" onclick="return confirm('please Make Sure to Checked Availability of the Venue before Booking an Event. Thank You......')" href="{{route('user.event_book')}}">Book an Event</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link select_link" href="{{route('user.venue_select')}}">Venues</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link select_link" href="{{route('customers.customerService')}}">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link select_link" href="">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link select_link" href="{{ route('user.feedBack') }}">Feed Back</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link select_link" href="{{ route('contactUs.contact_us') }}">Contact Us</a>
                            </li>
                        </ul>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest

                        @else

                        <div class="collapse navbar-collapse" id="navbarNav">

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto">

                                    <li class="nav-item">
                                        <a class="nav-link select_link" href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i></a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('profile.index') }}">
                                                {{ __('Profile') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('user.order') }}">
                                                {{ __('Orders Info') }}
                                            </a>

                                            <!-- Add more links as needed -->

                                        </div>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>

                                        @endguest
                                    </li>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>


        <main>

        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
<footer>

</footer>

</html>