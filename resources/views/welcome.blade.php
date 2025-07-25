@extends('nav')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <!-- Styles -->
    <style>

    </style>
</head>

<body>
    <div id="app1">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">


        </nav>
        <!-- <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                    <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                    @endauth
                </div>
                @endif
            </div> -->
        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active c-item">
                    <img src="{{ asset('image/slider4.jpeg')}}" class="d-block w-100 c-img" alt="Slide 1">
                    <div class="carousel-caption top-0 mt-4 d-none d-md-block">
                        <p class="mt-5 fs-3 text-uppercase">First slide label</p>
                        <h1 class="display-1 fw-bolder text-capitalize accent-dark">Beautiful Celebration</h1>
                        <a href="{{ route('login') }}" class=" btn btn-primary px-4 py-2 fs-5 mt-5">Book An Events</a>
                        <a href="{{ route('find-gift') }}" class=" btn btn-primary px-4 py-2 fs-5 mt-5">Find a Gift</a>

                    </div>
                </div>
                <div class="carousel-item c-item">
                    <img src="{{ asset('image/slider5.jpeg') }}" class="d-block w-100 c-img" alt="Slide 2">
                    <div class="carousel-caption top-0 mt-4 d-none d-md-block">
                        <p class="mt-5 fs-3 text-uppercase">Second slide label</p>
                        <h1 class="display-1 fw-bolder text-capitalize accent-dark">Beautiful Celebration</h1>
                        <a href="{{ route('login') }}" class=" btn btn-primary px-4 py-2 fs-5 mt-5">Book An Event</a>
                        <a href="{{ route('find-gift') }}" class=" btn btn-primary px-4 py-2 fs-5 mt-5">Find a Gift</a>

                    </div>
                </div>
                <div class="carousel-item c-item">
                    <img src="{{ asset('image/slider6.jpg') }}" class="d-block w-100 c-img" alt="Slide 3">
                    <div class="carousel-caption top-0 mt-4 d-none d-md-block">
                        <p class="mt-5 fs-3 text-uppercase">Third slide label</p>
                        <h1 class="display-1 fw-bolder text-capitalize accent-dark">Beautiful Celebration</h1>
                        <a href="{{ route('login') }}" class=" btn btn-primary px-4 py-2 fs-5 mt-5">Book An Event</a>
                        <a href="{{ route('find-gift') }}" class=" btn btn-primary px-4 py-2 fs-5 mt-5">Find a Gift</a>

                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <br>
        <h1 class="text-center">OUR SERVICES</h1>
        <br>
        <div class="container">
            <div class="row d-flex flex-row">
                <div class="col-md-4">

                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top"
                            src="{{ asset('image/chinese-take-out-473784604-57d31f7f3df78c5833464853.jpg') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Chinese Menu</h5>
                            <p class="card-text">Chinese cuisine is one of the world's oldest and most diverse cuisines,
                                comprising foods originating from China.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset('image/images (1).jpeg') }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Sri Lankan</h5>
                            <p class="card-text">Sri Lankan cuisine is known for its particular combinations of herbs,
                                spices, fish, vegetables, rices, and fruits..</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset('image/image.jpg') }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Event Decoration</h5>
                            <p class="card-text">A decoration is anything used to make something more attractive or
                                festive.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer For the website -->





        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

</body>

</html>

@endsection