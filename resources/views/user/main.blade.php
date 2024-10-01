@extends('user.home')

@section('contain')

<style>
    .nav-link {
        color: black;
        /* Default link color */
        text-decoration: none;
    }

    .nav-link:hover {
        background-color: #2563eb;
        /* Hover link color */
        text-decoration: none;
        /* Optional: Add underline on hover */
        border-radius: 15px;
        /* Rounded corners on hover */
        padding: 5px 10px;
        /* Add padding for better shape */
    }
</style>

<div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active c-item">
            <img src="{{ asset('image/slider4.jpeg')}}" class="d-block w-100 c-img" alt="Slide 1">
            <div class="carousel-caption top-0 mt-4 d-none d-md-block">
                <p class="mt-5 fs-3 text-uppercase">First slide label</p>
                <h1 class="display-1 fw-bolder text-capitalize accent-dark">Beautiful Celebration</h1>
                <button class=" btn btn-primary px-4 py-2 fs-5 mt-5">Book An Event</button>
            </div>
        </div>
        <div class="carousel-item c-item">
            <img src="{{ asset('image/slider5.jpeg') }}" class="d-block w-100 c-img" alt="Slide 2">
            <div class="carousel-caption top-0 mt-4 d-none d-md-block">
                <p class="mt-5 fs-3 text-uppercase">First slide label</p>
                <h1 class="display-1 fw-bolder text-capitalize accent-dark">Beautiful Celebration</h1>
                <button class=" btn btn-primary px-4 py-2 fs-5 mt-5">Book An Event</button>
            </div>
        </div>
        <div class="carousel-item c-item">
            <img src="{{ asset('image/slider6.jpg') }}" class="d-block w-100 c-img" alt="Slide 3">
            <div class="carousel-caption top-0 mt-4 d-none d-md-block">
                <p class="mt-5 fs-3 text-uppercase">First slide label</p>
                <h1 class="display-1 fw-bolder text-capitalize accent-dark">Beautiful Celebration</h1>
                <button class=" btn btn-primary px-4 py-2 fs-5 mt-5">Book An Event</button>
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
<div class="row">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('image/bestdad.jpg') }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('image/bridesmaid_bb2aa143-b6ee-44b5-b9b9-bc999760f591_480x480.jpg') }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


@endsection