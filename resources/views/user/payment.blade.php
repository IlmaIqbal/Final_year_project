@extends('nav')

@section('content')
<div class="container1 mt-4 p-0">
    <div class="row px-md-4 px-2 pt-4">
        <div class="col-lg-8">
            <p class="pb-2 fw-bold">Order</p>
            <div class="card">
                <div class="table-responsive px-md-4 px-2 pt-3">
                    <table class="table table-borderless">
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4 payment-summary">
            <p class="fw-bold pt-lg-0 pt-4 pb-2">Payment Summary</p>
            <div class="card px-md-3 px-2 pt-4">
                <div class="col-lg-12">
                    <?php
                    $merchant_id = '1230823';
                    $order_id = 'ItemNo12345';
                    $amount = '1000';
                    $currency = 'LKR';
                    $merchant_secret = 'NTc0MzA3NDY1MzQ0MTIzODE2MjM0MTI5NDk1NjQzNzQ0NDQyNjg3';
                    ?>
                    <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
                        <input type="hidden" name="merchant_id" value="<?= $merchant_id ?>">
                        <!-- Replace your Merchant ID -->
                        <input type="hidden" name="return_url" value="http://localhost/jobnet/pay/return.php">
                        <input type="hidden" name="cancel_url" value="http://localhost/jobnet/pay/cancel.php">
                        <input type="hidden" name="notify_url" value="http://localhost/jobnet/pay/notify.php">
                        </br></br>Item Details</br>
                        <input type="text" name="order_id" value="<?= $order_id ?>">
                        <input type="text" name="items" value="Door bell wireless">
                        <input type="text" name="currency" value="<?= $currency ?>">
                        <input type="text" name="amount" value="<?= $amount ?>">
                        </br></br>Customer Details</br>
                        <input type="text" name="first_name" value="Saman">
                        <input type="text" name="last_name" value="Perera">
                        <input type="text" name="email" value="samanp@gmail.com">
                        <input type="text" name="phone" value="0771234567">
                        <input type="text" name="address" value="No.1, Galle Road">
                        <input type="text" name="city" value="Colombo">
                        <input type="hidden" name="country" value="Sri Lanka">
                        <?php $hash = strtoupper(
                            md5(
                                $merchant_id .
                                    $order_id .
                                    number_format($amount, 2, '.', '') .
                                    $currency .
                                    strtoupper(md5($merchant_secret))
                            )
                        ); ?>
                        <input type="hidden" name="hash" value="<?= $hash ?>"> <!-- Replace with generated hash -->
                        <input type="submit" value="Buy Now">
                    </form>

                    <div class="d-flex justify-content-between b-bottom mb-3">
                        <small class="text-muted">Total Amount</small>
                        <p id="total">Rs.0.00</p>
                    </div>
                    <button id="payNowButton" class="btn btn-primary w-100">Pay Now</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tableBody = document.querySelector(".table-borderless tbody");
        const totalElement = document.getElementById("total");

        let cartData = JSON.parse(localStorage.getItem("cart")) || [];
        let total_price = 0;

        tableBody.innerHTML = "";

        cartData.forEach(item => {
            total_price += item.price * item.quantity;

            let row = `
                <tr class="border-bottom">
                    <td>
                        <div class="d-flex align-items-center">
                            <div><img class="pic" src="${item.image}" alt="${item.name}"></div>
                            <div class="ps-3 d-flex flex-column justify-content">
                                <p class="fw-bold">${item.name}</p>
                            </div>
                        </div>
                    </td>
                    <td><p class="pe-3">Rs.${item.price}</p></td>
                    <td><span class="pe-3">Qty ${item.quantity}</span></td>
                    <td><span class="pe-3">= Rs.${(item.price * item.quantity).toFixed(2)}</span></td>
                </tr>`;
            tableBody.insertAdjacentHTML("beforeend", row);
        });

        totalElement.innerText = `Rs.${total_price.toFixed(2)}`;
    });

    document.getElementById("payNowButton").addEventListener("click", function(e) {
        e.preventDefault();

        const cartData = JSON.parse(localStorage.getItem("cart")) || [];
        const deliveryInfo = JSON.parse(localStorage.getItem("deliveryInfo")) || {};
        const total_price = cartData.reduce((sum, item) => sum + item.price * item.quantity, 0);

        if (cartData.length === 0) {
            alert("Cart is empty!");
            return;
        }

        if (!deliveryInfo.name || !deliveryInfo.email || !deliveryInfo.phone) {
            alert("Missing delivery details. Please go back and fill them out.");
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("{{ route('store_order') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({
                    user_id: "{{ auth()->user()->id }}",
                    user_name: deliveryInfo.name,
                    user_email: deliveryInfo.email,
                    user_address: (deliveryInfo.address1 || "") + " " + (deliveryInfo.address2 || ""),
                    phone: deliveryInfo.phone,
                    items: cartData.map(item => ({
                        id: item.id,
                        type: item.type || "default",
                        name: item.name,
                        detail: item.detail || "",
                        image: item.image,
                        price: item.price,
                        quantity: item.quantity
                    })),
                    total_price: total_price
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert("Order placed successfully!");
                    localStorage.removeItem("cart");
                    localStorage.removeItem("deliveryInfo");
                    window.location.href = `/order/${data.order_id}`;
                } else {
                    alert("Something went wrong. Try again.");
                }
            })
            .catch(error => {
                console.error("Error placing order:", error);
                alert("Server error. Try again later.");
            });
    });
</script>
@endsection