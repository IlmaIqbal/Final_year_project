@extends('nav')

@section('content')

<section class="pt-5 pb-5">

    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3 class="mb-3">Bouquets</h3>
            </div>
            <div class="row">

                @foreach ($bouquets as $bouquet)

                <div class="col-md-4 mb-3">

                    <div class="card">
                        <img class="img-fluid" alt="100%x280" src="{{ asset('image/' .$bouquet->product->image) }}">
                        <div class="card-body">
                            <h4 class="card-title">{{ $bouquet->product->name }}</h4>
                            <p class="card-text">{{ $bouquet->product->detail }}</p>
                            <p><strong>Rs.{{ $bouquet->sell_price }}</strong></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{route('user.products.item_details', $bouquet->id)}}"
                                        class="btn btn-success rounded-pill" style="width: 150px; height: 40px;">Bouquet
                                        Details</a>
                                </div>
                                <div class="col-md-4">
                                    @if ($bouquet->qty > $bouquet->issue_qty)
                                    <button class="btn btn-primary rounded-pill add-to-cart1"
                                        style="width: 150px; height: 40px;" data-id="{{ $bouquet->id }}"
                                        data-name="{{ $bouquet->product->name }}"
                                        data-detail="{{ $bouquet->product->detail }}"
                                        data-price="{{ $bouquet->sell_price }}"
                                        data-image="/image/{{ $bouquet->product->image }}">
                                        Add to cart
                                    </button>
                                    @else
                                    <span class="badge badge-danger rounded-pill"
                                        style="width: 150px; height: 40px;">Out of
                                        Stock</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addToCartButtons1 = document.querySelectorAll('.add-to-cart1');

        addToCartButtons1.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const id = button.dataset.id;
                const name = button.dataset.name;
                const detail = button.dataset.detail;
                const price = parseFloat(button.dataset.price);
                const image = button.dataset.image;
                const quantityInput = document.querySelector(`.quantity[data-id="${id}"]`);
                const quantity = quantityInput ? quantityInput.value : 1;

                const bouquetItem = {
                    id: id,
                    type: 'bouquet', // differentiate from gift and wrapping paper
                    name: name,
                    detail: detail,
                    price: price,
                    image: image,
                    quantity: parseInt(quantity),
                };

                // Retrieve existing cart from local storage
                let cart = JSON.parse(localStorage.getItem('cart')) || [];

                // Check if the item is already in the cart
                const existingItemIndex = cart.findIndex(item => item.id === id && item
                    .type === 'bouquet');
                if (existingItemIndex >= 0) {
                    // Update quantity if item exists
                    cart[existingItemIndex].quantity += bouquetItem.quantity;
                } else {
                    // Add new item to the cart
                    cart.push(bouquetItem);
                }

                // Save updated cart back to local storage
                localStorage.setItem('cart', JSON.stringify(cart));

                alert('Added to cart');
            });
        });
    });
</script>
@endsection