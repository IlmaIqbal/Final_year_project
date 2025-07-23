@extends('nav')

@section('content')

<section class="pt-5 pb-5">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-3">Customize Boxes and Wrapping papers</h3>
            </div>
            <div class="row">

                <!-- wrapping paper in the database as box -->
                @foreach ($boxes as $box)

                <div class="col-md-4 mb-3">

                    <div class="card">
                        <img class="img-fluid" alt="100%x280" src="{{ asset('image/' .$box->product->image) }}">
                        <div class="card-body">
                            <h4 class="card-title">{{ $box->product->name }}</h4>
                            <p class="card-text">{{ $box->product->detail }}</p>
                            <p><strong>Rs.{{ $box->sell_price }}</strong></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{route('user.products.item_details', $box->id)}}"
                                        class="btn btn-success rounded-pill" style="width: 150px; height: 40px;">Box
                                        Details</a>
                                </div>
                                <div class="col-md-4">
                                    @if ($box->qty > $box->issue_qty)
                                    <button class="btn btn-primary rounded-pill add-to-cart"
                                        style="width: 150px; height: 40px;" data-id="{{ $box->id }}"
                                        data-name="{{ $box->product->name }}" data-detail="{{ $box->product->detail }}"
                                        data-price="{{ $box->sell_price }}"
                                        data-image="/image/{{ $box->product->image }}">
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
        const addToCartButtons = document.querySelectorAll('.add-to-cart');

        addToCartButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const id = button.dataset.id;
                const name = button.dataset.name;
                const detail = button.dataset.detail;
                const price = parseFloat(button.dataset.price);
                const image = button.dataset.image;
                const quantityInput = document.querySelector(`.quantity[data-id="${id}"]`);
                const quantity = quantityInput ? quantityInput.value : 1;

                const boxItem = {
                    id: id,
                    type: 'wrapping_paper',
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
                    'wrapping_paper');
                if (existingItemIndex >= 0) {
                    // Update quantity if item exists
                    cart[existingItemIndex].quantity += boxItem.quantity;
                } else {
                    // Add new item to the cart
                    cart.push(boxItem);
                }

                // Save updated cart back to local storage
                localStorage.setItem('cart', JSON.stringify(cart));

                alert('Added to cart');
            });
        });
    });
</script>
@endsection