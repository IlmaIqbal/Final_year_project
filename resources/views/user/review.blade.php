@extends('nav')

@section('content')
<style>
    /* rating */
    .rating-css div {
        color: #ffe400;
        font-size: 30px;
        font-family: sans-serif;
        font-weight: 800;
        text-align: center;
        text-transform: uppercase;
        padding: 20px 0;
    }

    .rating-css input {
        display: none;
    }

    .rating-css input+label {
        font-size: 60px;
        text-shadow: 1px 1px 0 #8f8420;
        cursor: pointer;
    }

    .rating-css input:checked+label~label {
        color: #b4afaf;
    }

    .rating-css label:active {
        transform: scale(0.8);
        transition: 0.3s ease;
    }
</style>


<div class="d-flex justify-content-between pt-2">
    <p class="text-muted mb-0">Order Number : {{ $orders->id }}</p>
</div>
<form action="{{route('add-rating')}}" method="post">
    @csrf
    <input type="hidden" name="order_id" value="{{$orders->id}}">
    <label for="inventory_id">Select Product:</label>
    <select name="product_id" class="form-control" required>
        <option value="">-- Choose Product --</option>
        @foreach ($orderItems as $item)
        <option value="{{ $item['id'] }}">
            {{ $item['name'] }}
        </option>
        @endforeach
    </select>
    <div class="rating-css">
        <div class="star-icon">
            <input type="radio" value="1" name="product_rating" checked id="rating1">
            <label for="rating1" class="fa fa-star"></label>
            <input type="radio" value="2" name="product_rating" id="rating2">
            <label for="rating2" class="fa fa-star"></label>
            <input type="radio" value="3" name="product_rating" id="rating3">
            <label for="rating3" class="fa fa-star"></label>
            <input type="radio" value="4" name="product_rating" id="rating4">
            <label for="rating4" class="fa fa-star"></label>
            <input type="radio" value="5" name="product_rating" id="rating5">
            <label for="rating5" class="fa fa-star"></label>
        </div>
    </div>
    <div class="card mb-3 p-3">

        <br>
        <label for="review">Review:</label>
        <textarea name="review" rows="2"></textarea>

        <button type="submit" id="rating" onclick="clicked()" class="btn btn-primary btn-sm mt-2">Submit Rating</button>
</form>
</div>



@endsection