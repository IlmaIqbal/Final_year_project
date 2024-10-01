@extends('front_office.nav_front')

@section('title')
Invitation cards
@endsection
@section('content')

<div class="container">
    <div class="d-flex justify-content-between mb-4">
    </div>

    <div class="row">
        @foreach ($catering as $service)
        <div class="col-sm-4">

            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/images/' . $service->image) }}" class="card-img-top" alt="{{ $service->name }}">
                <div class="card-body">
                    <h5 class="card-title text-bold">{{ $service->name }}</h5>
                    <p class="card-text">{{ $service->description }}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong></strong> </li>
                        <li class="list-group-item"><strong>Price:</strong> Rs. {{ $service->price }} Per Card </br>
                            <p>Per head with service</p>
                        </li>
                        <li class="list-group-item"><strong></strong> </li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection