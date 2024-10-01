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
        <a href="{{ route('services.invitation.create') }}" class="btn btn-primary ml-auto">Add Service</a>
    </div>

    <div class="row">
        @foreach ($invitations as $invitation)
        <div class="col-sm-4">

            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/images/' . $invitation->image) }}" class="card-img-top" alt="{{ $invitation->name }}">
                <div class="card-body">
                    <h5 class="card-title text-bold">{{ $invitation->name }}</h5>
                    <p class="card-text">{{ $invitation->description }}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong></strong> </li>
                        <li class="list-group-item"><strong>Price:</strong> Rs. {{ $invitation->price }} Per Card</li>
                        <li class="list-group-item"><strong></strong> </li>

                    </ul>
                    <a href="{{ route('services.invitation.edit', $invitation->id) }}" class="btn btn-warning">Edit</a>
                    @if ($invitation->active)
                    <form action="{{ route('services.invitation.disable', $invitation->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Disable</button>
                    </form>
                    @else
                    <form action="{{ route('invitation.enable', $invitation->id) }}" method="POST" class="d-inline">
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