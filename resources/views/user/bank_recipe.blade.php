@extends('nav')

@section('content')
<div class="card card-primary">

    <div class="card-body align-content-lg-center">

        <br>
        <form method="POST" action="{{ route('recipe_update', $order->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="d-flex justify-content-between pt-2">
                <p class="fw-bold mb-0">Order ID : {{$order->id}}</p>
            </div>
            <br>
            <br>
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-success" name="action"
                onclick="return confirm('are you sure?')">Upload</button>
        </form>
    </div>
</div>
@endsection