@extends('nav')

@section('content')


<style>
</style>

<section class="pt-5 pb-5">
    <div class="container">
        <h3 class="mb-3">Gift Items</h3>
        <div class="row"> {{-- ✅ All product cards go inside this single row --}}
            @foreach ($gifts as $productGroup)
            @php

            $inStockInventories = $productGroup->filter(fn($inv) => $inv->qty > $inv->issue_qty);
            $outOfStock = $inStockInventories->isEmpty();
            $product = $productGroup->first()->product;


            @endphp

            @if (!$outOfStock)
            @foreach ($inStockInventories as $gift)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img class="img-fluid" alt="100%x280" src="{{ asset('image/' .$gift->product->image) }}">
                    <div class="card-body">
                        <h4 class="card-title">{{ $gift->product->name }}</h4>
                        <p class="card-text">{{ $gift->product->detail }}</p>
                        <p><strong>Rs.{{ $gift->sell_price }}</strong></p>
                        <span class="text-danger" style="width: 150px; height: 40px;"> Only
                            quantity have</span>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{route('user.products.item_details', $gift->id)}}"
                                    class="btn btn-success rounded-pill" style="width: 150px; height: 40px;">
                                    Gift Details
                                </a>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary rounded-pill add-to-cart"
                                    style="width: 150px; height: 40px;" data-id="{{ $gift->id }}"
                                    data-name="{{ $gift->product->name }}" data-detail="{{ $gift->product->detail }}"
                                    data-price="{{ $gift->sell_price }}"
                                    data-image="/image/{{ $gift->product->image }}">
                                    Add to cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            {{-- Show only one "Out of Stock" card for the product --}}
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img class="img-fluid" src="/image/{{ $product->image }}" alt="Product Image">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text">{{ $product->detail }}</p>
                        <span class="badge badge-danger rounded-pill" style="width: 150px; height: 40px;">
                            Out of Stock
                        </span>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div> {{-- ✅ Closing the main row --}}
    </div>
</section>

<script>
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
                const quantityInput = document.querySelector(`.quantity[data-id="${id}"]`);
                const quantity = quantityInput ? quantityInput.value : 1;

                const giftItem = {
                    id: id,
                    type: 'gift',
                    name: name,
                    detail: detail,
                    price: price,
                    image: image,
                    quantity: parseInt(quantity),
                };

                // Retrieve existing cart from local storage
                let cart = JSON.parse(localStorage.getItem('cart')) || [];

                // Check if the item is already in the cart
                const existingItemIndex = cart.findIndex(item => item.id === id && item.type ===
                    'gift');
                if (existingItemIndex >= 0) {
                    // Update quantity if item exists
                    cart[existingItemIndex].quantity += giftItem.quantity;
                } else {
                    // Add new item to the cart
                    cart.push(giftItem);
                }

                // Save updated cart back to local storage
                localStorage.setItem('cart', JSON.stringify(cart));

                alert('Added to cart');
            });
        });
    });
</script>

@endsection