@extends('nav')

@section('content')
<style>
    .product-image {
        max-height: 400px;
        object-fit: cover;
    }

    .thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
        opacity: 0.6;
        transition: opacity 0.3s ease;
    }

    .thumbnail:hover,
    .thumbnail.active {
        opacity: 1;
    }
</style>

<div class="container mt-5">
    <div class="row">
        @foreach ($id as $value)

        @php
        $availableQty = ($value->qty - $value->issue_qty)
        @endphp
        <!-- Product Images -->
        <div class="col-md-5 mb-4">
            <img src="{{ asset('image/' .$value->product->image)}}" alt="Product"
                class="img-fluid rounded mb-2 product-image" id="mainImage">
            <!-- <div class="d-flex justify-content-between">
                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwxfHxoZWFkcGhvbmV8ZW58MHwwfHx8MTcyMTMwMzY5MHww&ixlib=rb-4.0.3&q=80&w=1080"
                    alt="Thumbnail 1" class="thumbnail rounded active" onclick="changeImage(event, this.src)">
                <img src="https://images.unsplash.com/photo-1528148343865-51218c4a13e6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwzfHxoZWFkcGhvbmV8ZW58MHwwfHx8MTcyMTMwMzY5MHww&ixlib=rb-4.0.3&q=80&w=1080"
                    alt="Thumbnail 2" class="thumbnail rounded" onclick="changeImage(event, this.src)">
                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwxfHxoZWFkcGhvbmV8ZW58MHwwfHx8MTcyMTMwMzY5MHww&ixlib=rb-4.0.3&q=80&w=1080"
                    alt="Thumbnail 3" class="thumbnail rounded" onclick="changeImage(event, this.src)">
                <img src="https://images.unsplash.com/photo-1528148343865-51218c4a13e6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwzfHxoZWFkcGhvbmV8ZW58MHwwfHx8MTcyMTMwMzY5MHww&ixlib=rb-4.0.3&q=80&w=1080"
                    alt="Thumbnail 4" class="thumbnail rounded" onclick="changeImage(event, this.src)">
            </div> -->
        </div>

        <!-- Product Details -->
        <div class="col-md-6">

            <h2 class="mb-3">{{$value->product->name}}</h2>
            <p class="text-muted mb-4">SKU: WH1000XM4</p>
            <div class="mb-3">
                <span class="h4 me-2">Rs.{{$value->sell_price}}</span>
                <!-- <span class="text-muted"><s>$399.99</s></span> -->
            </div>
            <!-- <div class="mb-3">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-half text-warning"></i>
                <span class="ms-2">4.5 (120 reviews)</span>
            </div> -->
            <p class="mb-4">{{$value->product->detail}}</p>
            <span class="text-danger" id="qty" style="width: 150px; height: 40px;"> Only {{$availableQty}}
                quantity have</span>


            <div class="mb-4">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" class="form-control" id="quantity" value="1" min="{{$availableQty}}"
                    style="width: 80px;">

            </div>
            @endforeach
            @if ($value->qty >$value->issue_qty)
            <button class="btn btn-primary btn-lg mb-3 me-2 add-to-cart" data-id="{{ $value->id }}"
                data-name="{{ $value->product->name }}" data-detail="{{ $value->product->detail }}"
                data-price="{{ $value->sell_price}}" data-image="/image/{{ $value->product->image }}">
                <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
            @else
            <span class="badge badge-danger rounded-pill" style="width: 150px; height: 40px;">Out of
                Stock</span>
            @endif




        </div>
        <!-- @if(isset($similarProducts) && count($similarProducts))
        <h4>Similar Products</h4>
        <div class="row">
            @foreach($similarProducts as $similar)
            @if($similar->product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="/image/{{ $similar->product->image }}" class="card-img-top"
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $similar->product->name }}</h5>
                        <p class="card-text">Rs. {{ $similar->product->sell_price }}</p>
                        <a href="{{ route('item_details', $similar->id) }}"
                            class="btn btn-outline-primary btn-sm">View</a>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @else
        <p>No similar products found.</p>
        @endif -->

    </div>
</div>

<script>
    function changeImage(event, src) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
        event.target.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const addToCartButtons = document.querySelectorAll('.add-to-cart');

        addToCartButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const id = parseFloat(button.dataset.id);
                const name = button.dataset.name;
                const detail = button.dataset.detail;
                const price = parseFloat(button.dataset.price);
                const image = button.dataset.image;

                const quantityInput = document.getElementById('quantity');
                const qty = document.getElementById('qty');
                const quantity = quantityInput ? parseInt(quantityInput.value) : 1;
                const qty1 = qty ? parseInt(quantityInput.value) : 1;

                const Item = {
                    id: id,
                    name: name,
                    detail: detail,
                    price: price,
                    image: image,
                    quantity: quantity,
                };

                // Retrieve existing cart from local storage
                let cart = JSON.parse(localStorage.getItem('cart')) || [];

                // Check if the item is already in the cart
                const existingItemIndex = cart.findIndex(item => item.id === id);
                if (existingItemIndex >= 0) {
                    // Update quantity if item exists
                    cart[existingItemIndex].quantity += Item.quantity;
                } else {
                    // Add new item to the cart
                    cart.push(Item);
                }
                const qty2 = document.getElementById('qty');
                const quantity1 = quantityInput ? parseInt(quantityInput.value) : 1;

                if (qty2 > quantity1) {

                    localStorage.setItem('cart', JSON.stringify(cart));

                    alert('Added to cart');
                }

                // Save updated cart back to local storage

            });
        });
    });
</script>


@endsection