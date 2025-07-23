@extends('nav')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    const assetBaseUrl = "{{ asset('') }}";
</script>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <h4 class="mb-3">Order Summary</h4>
            <div class="card p-3">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card p-3">
                <h5>Payment</h5>
                <h5 class="text-end pe-3">Total: <span id="total">Rs.0.00</span></h5>

                <button id="payNowButton" class="btn btn-success w-100 mt-3">Pay with PayHere</button>
            </div>
        </div>
    </div>
</div>

<!-- CryptoJS for MD5 hashing -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tableBody = document.querySelector(".table-borderless tbody");
        const totalElement = document.getElementById("total");
        let cartData = JSON.parse(localStorage.getItem("cart")) || [];
        let deliveryInfo = JSON.parse(localStorage.getItem("deliveryInfo")) || {};
        let total_price = 0;
        let rows = "";

        // Build cart rows
        cartData.forEach(item => {
            const subTotal = item.price * item.quantity;
            total_price += subTotal;
            rows += `
            <tr class="border-bottom">
                <td>
                    <div class="d-flex align-items-center">
                        <img class="pic" src="${assetBaseUrl}${item.image}" alt="${item.name}" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="ps-3">
                            <p class="fw-bold mb-0">${item.name}</p>
                            <small>Qty: ${item.quantity}</small>
                        </div>
                    </div>
                </td>
                <td>Rs.${item.price}</td>
                <td>Rs.${subTotal.toFixed(2)}</td>
            </tr>`;
        });

        // Customer info row
        rows += `
        <tr>
            <td colspan="3">
                <div class="pt-4">
                    <h5 class="fw-bold mb-2">Customer Details</h5>
                    <p><strong>Name:</strong> ${deliveryInfo.name || '-'}</p>
                    <p><strong>Email:</strong> ${deliveryInfo.email || '-'}</p>
                    <p><strong>Phone:</strong> ${deliveryInfo.phone || '-'}</p>
                    <p><strong>Address:</strong> ${(deliveryInfo.address1 || '') + ' ' + (deliveryInfo.address2 || '')+ ' ' + (deliveryInfo.address3 || '')}</p>
                </div>
            </td>
        </tr>`;

        tableBody.innerHTML = rows;
        totalElement.innerText = `Rs.${total_price.toFixed(2)}`;
    });

    document.getElementById("payNowButton").addEventListener("click", function(e) {
        e.preventDefault();

        const delivery = JSON.parse(localStorage.getItem("deliveryInfo")) || {};
        const cart = JSON.parse(localStorage.getItem("cart")) || [];

        if (!delivery.name || !delivery.email || !delivery.phone || cart.length === 0) {
            alert("Missing cart or delivery details");
            return;
        }

        const itemNames = cart.map(item => item.name).join(', ');
        const amount = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
        const orderId = 'Order' + Math.floor(Math.random() * 1000000);

        // PayHere required values
        const merchant_id = '1230823';
        const currency = 'LKR';
        const merchant_secret = 'NTc0MzA3NDY1MzQ0MTIzODE2MjM0MTI5NDk1NjQzNzQ0NDQyNjg3'; // Keep safe in production!

        // Hash generator
        function generateHash(merchantId, orderId, amount, currency, secret) {
            const full = merchantId + orderId + Number(amount).toFixed(2) + currency + CryptoJS.MD5(secret)
                .toString().toUpperCase();
            return CryptoJS.MD5(full).toString().toUpperCase();
        }

        const hash = generateHash(merchant_id, orderId, amount, currency, merchant_secret);

        // Create and auto-submit form
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "https://sandbox.payhere.lk/pay/checkout";

        const fields = {
            merchant_id,
            return_url: "http://localhost/Final_year_project/user/online-confirmation",
            cancel_url: "http://localhost/Final_year_project/public/user/delivery_detail",
            notify_url: "http://localhost/Final_year_project/public/pay/notify",
            order_id: orderId,
            items: itemNames,
            currency,
            amount: amount.toFixed(2),
            first_name: (delivery.name || '').split(' ')[0],
            last_name: (delivery.name || '').split(' ').slice(1).join(' ') || "-",
            email: delivery.email,
            phone: delivery.phone,
            address: (delivery.address1 || '') + ' ' + (delivery.address2 || ''),
            city: delivery.address3,
            country: "Sri Lanka",
            hash
        };

        for (let key in fields) {
            const input = document.createElement("input");
            input.type = "hidden";
            input.name = key;
            input.value = fields[key];
            form.appendChild(input);
        }

        document.body.appendChild(form);
        form.submit();
    });
</script>
@endsection