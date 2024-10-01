@extends('admin.navbar')

@section('title')
Services


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
        <a href="{{ route('services.decoration.create') }}" class="btn btn-primary ml-auto">Add Service</a>
    </div>

    <div class="row">
        @foreach ($decorations as $decoration)
        <div class="col-sm-4">

            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/images/' . $decoration->image) }}" class="card-img-top" alt="{{ $decoration->name }}">
                <div class="card-body">
                    <h5 class="card-title text-bold">{{ $decoration->name }}</h5>
                    <p class="card-text">{{ $decoration->description }}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong></strong> </li>
                        <li class="list-group-item"><strong>Price:</strong> Rs. {{ $decoration->price }}</li>
                        <li class="list-group-item"><strong></strong> </li>

                    </ul>
                    <a href="{{ route('services.decoration.edit', $decoration->id) }}" class="btn btn-warning">Edit</a>
                    @if ($decoration->active)
                    <form action="{{ route('services.decoration.disable', $decoration->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Disable</button>
                    </form>
                    @else
                    <form action="{{ route('decoration.enable', $decoration->id) }}" method="POST" class="d-inline">
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
</div>

@endsection