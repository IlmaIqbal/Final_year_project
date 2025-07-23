@extends('user.home')

@section('content')

<style>
    .img_deg {
        height: 200px;
        width: 200px;
    }
</style>


<section class="h-100 h-custom">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
                    <div id="toastSuccess" class="toast align-items-center text-bg-success border-0" role="alert"
                        aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                Successfully removed product
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>

                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="h5">Image</th>
                                <th scope="col" class="h5">Shopping Items</th>
                                <th scope="col" class="h5"></th>
                                <th scope="col" class="h5">Quantity</th>
                                <th scope="col" class="h5">Price</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">

                            <!-- Cart items will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>

                <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-4 col-xl-3">
                                <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                                    <p class="mb-2">Total</p>
                                    <p class="mb-2" id="total">Rs.0.00</p>
                                </div>
                                <button id="checkoutBtn" class="btn btn-primary">
                                    <span>Checkout</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById('checkoutBtn').addEventListener('click', function() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];

        if (cart.length === 0) {
            alert("Your cart is empty!");
        } else {
            // Proceed to checkout page
            window.location.href = "{{ route('user.delivery_detail') }}";
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cartItemsContainer = document.getElementById('cart-items');
        const totalElement = document.getElementById('total');
        const cartCountBadge = document.querySelector('.cart-count-badge'); // Cart badge
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let totalPrice = 0;


        // Function to get unique cart item count
        const getCartItemCount = () => {
            return cart.length; // Number of unique items
        };


        // Function to update cart count badge
        const updateCartCount = () => {
            let itemCount = getCartItemCount();
            if (cartCountBadge) {
                if (itemCount > 0) {
                    cartCountBadge.textContent = itemCount;
                    cartCountBadge.style.display = 'inline-block';
                } else {
                    cartCountBadge.style.display = 'none';
                }
            }
        };

        // Function to render cart items
        const renderCart = () => {
            cartItemsContainer.innerHTML = '';
            totalPrice = 0;

            cart.forEach((item, index) => {
                const row = `
                    <tr>
                        <td><img class="img_deg" src="{{ asset('') }}${item.image}" alt="${item.name}"></td>
                        <td>${item.name}</td>
                        <td>Rs.${item.price} per item</td>
                        <td>
                            <input type="number" class="form-control quantity-input" min="1" value="${item.quantity}" data-index="${index}" style="width: 80px;">
                        </td>
                        <td>Rs.${(item.price * item.quantity).toFixed(2)}</td>
                        <td>
                            <button class="btn btn-danger" onclick="removeCartItem(${index})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
                cartItemsContainer.innerHTML += row;
                totalPrice += item.price * item.quantity;
            });

            totalElement.textContent = `Rs.${totalPrice.toFixed(2)}`;
            updateCartCount(); // Update cart count after rendering
        };

        // Function to remove an item
        window.removeCartItem = (index) => {
            if (confirm('Are you sure you want to remove this item?')) {
                cart.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                renderCart();

                const toast = new bootstrap.Toast(document.getElementById("toastSuccess"));
                toast.show();
            }
        };

        // Event listener for quantity change
        cartItemsContainer.addEventListener('input', (e) => {
            if (e.target.classList.contains('quantity-input')) {
                const index = e.target.dataset.index;
                const newQuantity = parseInt(e.target.value);

                if (newQuantity > 0) {
                    cart[index].quantity = newQuantity;
                    localStorage.setItem('cart', JSON.stringify(cart));
                    renderCart();
                } else {
                    alert('Quantity must be at least 1.');
                    e.target.value = cart[index].quantity;
                }
            }
        });

        // Initial render
        renderCart();
    });
</script>

@endsection