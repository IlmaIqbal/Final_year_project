<!-- nav.blade.php -->
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <style>
        .navbar-nav .nav-item .nav-link {
            white-space: nowrap;
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

        .select_link:hover {
            font-weight: bold;
            color: blue;
        }

        .card-hover:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            transition: box-shadow 0.3s ease-in-out;
        }

        .nav-link {
            color: black;
            text-decoration: none;
        }

        .nav-link:hover {
            background-color: #2563eb;
            text-decoration: none;
            border-radius: 15px;
            padding: 5px 10px;
        }
    </style>
</head>

<body>
    <div id="app">
        @guest
        <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link select_link active" aria-current="page" href="{{ route('welcome') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link select_link" href="{{route('customers.customerVenue')}}">Venues</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link select_link" href="{{route('customers.customerService')}}">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link select_link" href="#">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link select_link" href="{{ route('contactUs.contact_us') }}">Contact Us</a>
                        </li>
                    </ul>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link select_link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link select_link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        @else

        @include('user.partials.nav')

        @endguest
        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        document.querySelectorAll(".nav-item").forEach((item) => {
            item.addEventListener("click", function() {
                document.querySelector(".nav-item.active").classList.remove("active");
                this.classList.add("active");
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
<footer>
    @include('user.partials.footer')
</footer>

</html>