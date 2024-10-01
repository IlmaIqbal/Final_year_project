@extends('nav')

@section('content')
<div class="row">
    @foreach ($venues as $venue)
    <div class="col-sm-3">
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('storage/images/venue/' . $venue->image) }}" class="card-img-top" alt="{{ $venue->name }}">
            <div class="card-body">
                <h5 class="card-title text-bold">{{ $venue->name }}</h5>
                <p class="card-text">{{ $venue->description }}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Price:</strong> Rs. {{ $venue->price }} Per Hour</li>
                    <li class="list-group-item"><strong>Capacity:</strong>{{ $venue->capacity }} Guests</li>
                    <li class="list-group-item "><strong>Location:</strong> {{ $venue->location }}</li>
                    <br>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection