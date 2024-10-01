@extends('admin.navbar')


@section('title')

Venue

@endsection
@section('content')

<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p>{{ $message }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('venues.create') }}" class="btn btn-primary ml-auto">Add Venue</a>
    </div>

    <div class="row">
        @foreach ($venues as $venue)
        <div class="col-sm-4">
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
                    <a href="{{ route('venues.edit', $venue->id) }}" class="btn btn-warning">Edit</a>
                    @if ($venue->active)
                    <form action="{{ route('venues.destroy', $venue->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Disable</button>
                    </form>
                    @else
                    <form action="{{ route('venues.enable', $venue->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Enable</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>




@endsection