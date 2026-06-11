@extends('admin.navbar')

@section('title')
Events
@endsection
@section('content')

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar w/ text</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
            <span class="navbar-text">
                Navbar text with an inline element
            </span>
        </div>
    </div>
</nav>
<br>
<div class="row">
    <div class="col-sm-6">
        <div class="card bg-body-secondary" style="width: 30rem; height: 30rem;">
            <img class="card-img-top" style="width: 10rem; height: 10rem; object-fit: cover;" src="/image/"
                alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title text-bold"></h4>
                <p class="card-text"></p>
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> Location : {{ $booking->venue_location }} </li>
                        <li class="list-group-item"> Price : {{ $booking->venue_price }} </li>
                    </ul>
                </div>
                <a href="" class="btn btn-primary">Go Back</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card bg-body-secondary" style="width: 30rem; height: 30rem;">
            <div class="card-body">
                <h4 class="card-title text-bold"></h4>
                <p class="card-text"></p>
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> Qty :</li>
                        <li class="list-group-item"> Price : </li>
                    </ul>
                </div>
                <a href="" class="btn btn-primary">Go Back</a>
            </div>
        </div>
    </div>
</div>

@endsection