@extends('admin.navbar')

@section('title')
Edit Services


@endsection
@section('content')

<div class="container">
    <h1>Edit Service</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('services.invitation.update', $invitation->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $invitation->name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $invitation->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $invitation->price }}" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    @if ($invitation->image)
                    <img src="{{ asset('storage/images/' . $invitation->image) }}" class="img-thumbnail mt-2" alt="{{ $invitation->name }}">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update Service</button>
            </form>
        </div>
    </div>
</div>
@endsection