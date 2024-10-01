@extends('admin.navbar')

@section('title')
Edit Services


@endsection
@section('content')

<div class="container">
    <h1>Edit Service</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $service->name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5">{{ $service->description }}</textarea>
                </div>
                <button type="button" class="btn btn-secondary" onclick="addMenuItem()">Add Menu Item</button>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $service->price }}" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    @if ($service->image)
                    <img src="{{ asset('storage/images/' . $service->image) }}" class="img-thumbnail mt-2" alt="{{ $service->name }}">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update Service</button>
            </form>
        </div>
    </div>
</div>
<script>
    function addMenuItem() {
        const description = document.getElementById('description');
        const text = description.value;
        const lines = text.split('\n').filter(line => line.trim() !== '');
        const nextNumber = lines.length + 1;
        const newItem = prompt("Enter the new menu item:");

        if (newItem) {
            description.value = text + (text ? '\n' : '') + nextNumber + '. ' + newItem;
        }
    }
</script>
@endsection