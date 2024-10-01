@extends('admin.navbar')


@section('title')

Create Services

@endsection
@section('content')
<style>
    .input-group {
        display: flex;
        align-items: center;
    }

    .input-group input {
        text-align: center;
        width: 100px;
    }
</style>
<div class="container">
    <h1>Add Service</h1>
    <form action="{{ route('services.decoration.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <div class="input-group">
                <input type="number" class="form-control" id="price" name="price" value="1" required>
            </div>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Add Service</button>
    </form>
</div>
@endsection