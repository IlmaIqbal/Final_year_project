@extends('nav')

@section('content')

<?php

use Illuminate\Support\Facades\Auth;

$user = Auth::user();

?>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="mb-4">Delivery Information</h3>

            <form id="deliveryForm">
                @csrf
                <div class="form-group mb-3">
                    <label for="delivery_name">Customer Name</label>
                    <input type="text" class="form-control" id="delivery_name" name="delivery_name"
                        value="{{ old('name', $user->name ?? '')}}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="delivery_address1">Address</label>
                    <input type="text" class="form-control" id="delivery_address1" name="delivery_address1"
                        value="{{ old('address1', $user->address1 ?? '')}}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="delivery_address2">City</label>
                    <input type="text" class="form-control" id="delivery_address2" name="delivery_address2"
                        value="{{ old('address2', $user->address2 ?? '')}}">
                </div>

                <div class="form-group mb-3">
                    <label for="delivery_address3">District</label>
                    <select type="text" class="form-control" id="delivery_address3" name="delivery_address3" required
                        autocomplete="delivery_address3" data-bs-toggle="dropdown" aria-expanded="false">
                        <option selected value="Colombo">Colombo</option>
                        <option value="Gampaha">Gampaha</option>
                        <option value="Kalutara">Kalutara</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Matale">Matale</option>
                        <option value="NuwaraEliya">Nuwara Eliya</option>
                        <option value="Matara">Matara</option>
                        <option value="Hambantota">Hambantota</option>
                        <option value="Trincomalee">Trincomalee</option>
                        <option value="Batticaloa">Batticaloa</option>
                        <option value="Ampara">Ampara</option>
                        <option value="Jaffna">Jaffna</option>
                        <option value="Kilinochchi">Kilinochchi</option>
                        <option value="Mannar">Mannar</option>
                        <option value="Mullaitivu">Mullaitivu</option>
                        <option value="Vavuniya">Vavuniya</option>
                        <option value="Kurunegala">Kurunegala</option>
                        <option value="Puttalam">Puttalam</option>
                        <option value="Anuradhapura">Anuradhapura</option>
                        <option value="Polonnaruwa">Polonnaruwa</option>
                        <option value="Kegalle">Kegalle</option>
                        <option value="Ratnapura">Ratnapura</option>
                        <option value="Badulla">Badulla</option>
                        <option value="Moneragala">Moneragala</option>
                    </select>
                </div>


                <div class="form-group mb-3">
                    <label for="delivery_email">Email</label>
                    <input type="email" class="form-control" id="delivery_email" autocomplete="email"
                        name="delivery_email" value="{{ old('email', $user->email ?? '')}}" required>
                </div>

                <div class="form-group mb-4">
                    <label for="delivery_phone">Phone Number</label>
                    <input type="text" class="form-control" id="delivery_phone" name="delivery_phone"
                        value="{{ old('phone', $user->phone ?? '')}}" required>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="sameAsDelivery">
                    <label class="form-check-label" for="sameAsDelivery">
                        Billing details same as delivery details
                    </label>
                </div>
            </form>
            <h3 class="mb-4">Billing Information</h3>

            <form id="billingForm">
                @csrf
                <div class="form-group mb-3">
                    <label for="billing_name">Customer Name</label>
                    <input type="text" class="form-control" id="billing_name" name="billing_name" required>
                </div>

                <div class="form-group mb-3">
                    <label for="billing_address1">Address</label>
                    <input type="text" class="form-control" id="billing_address1" name="billing_address1" required>
                </div>

                <div class="form-group mb-3">
                    <label for="billing_address2">City</label>
                    <input type="text" class="form-control" id="billing_address2" name="billing_address2">
                </div>

                <div class="form-group mb-3">
                    <label for="billing_address3">District</label>
                    <select type="text" class="form-control" id="billing_address3" name="billing_address3" required
                        autocomplete="billing_address3" data-bs-toggle="dropdown" aria-expanded="false">
                        <option selected>Choose...</option>
                        <option value="Colombo">Colombo</option>
                        <option value="Gampaha">Gampaha</option>
                        <option value="Kalutara">Kalutara</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Matale">Matale</option>
                        <option value="NuwaraEliya">Nuwara Eliya</option>
                        <option value="Matara">Matara</option>
                        <option value="Hambantota">Hambantota</option>
                        <option value="Trincomalee">Trincomalee</option>
                        <option value="Batticaloa">Batticaloa</option>
                        <option value="Ampara">Ampara</option>
                        <option value="Jaffna">Jaffna</option>
                        <option value="Kilinochchi">Kilinochchi</option>
                        <option value="Mannar">Mannar</option>
                        <option value="Mullaitivu">Mullaitivu</option>
                        <option value="Vavuniya">Vavuniya</option>
                        <option value="Kurunegala">Kurunegala</option>
                        <option value="Puttalam">Puttalam</option>
                        <option value="Anuradhapura">Anuradhapura</option>
                        <option value="Polonnaruwa">Polonnaruwa</option>
                        <option value="Kegalle">Kegalle</option>
                        <option value="Ratnapura">Ratnapura</option>
                        <option value="Badulla">Badulla</option>
                        <option value="Moneragala">Moneragala</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="billing_email">Email</label>
                    <input type="email" class="form-control" id="billing_email" name="billing_email" required>
                </div>

                <div class="form-group mb-4">
                    <label for="billing_phone">Phone Number</label>
                    <input type="text" class="form-control" id="billing_phone" name="billing_phone" required>
                </div>

            </form>
            <h3 class="mb-4">Payment Method</h3>

            <div class="card px-md-3 px-2 pt-4">
                <div class="col-lg-12">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="cashOnDelivery"
                            value="CashOnDelivery">
                        <label class="form-check-label" for="cashOnDelivery">
                            Cash on Delivery </label>
                    </div>
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="bankTransfer"
                            value="BankTransfer">
                        <label class="form-check-label" for="bankTransfer">
                            Bank Transfer </label>
                    </div>
                    <div class="border rounded p-3 bg-light">
                        <p><strong>Bank Name:</strong> Sampath Bank</p>
                        <p><strong>Account Name:</strong> Beautiful celebration Pvt Ltd</p>
                        <p><strong>Account Number:</strong> 123-456-789-0</p>
                        <p><strong>Branch:</strong> Colombo Main Branch</p>
                    </div>
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="onlinePayment"
                            value="OnlinePayment" checked>
                        <label class="form-check-label" for="onlinePayment">
                            Credit / Debit Card Payments </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 payment-summary">
            <h3 class="fw-bold pt-lg-0 pt-4 pb-2">Order Summary</h3>
            <div class="card px-md-3 px-2 pt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="table-responsive px-md-4 px-2 pt-3">
                            <table class="table table-borderless">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between b-bottom mb-3">
                        <small class="text-muted">Total Amount</small>
                        <p id="total">Rs.0.00</p>
                    </div>
                    <button id="continueToPay" type="submit" class="btn btn-primary w-100">Continue to Payment</button>
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
                            <div><img class="pic" src="{{ asset('') }}${item.image}" alt="${item.name}" style="width: 75px; height: 75px; object-fit: cover;"></div>
                            <div class="ps-4 d-flex flex-column justify-content">
                                <p class="fw-bold">${item.name}</p>
                            </div>
                        </div>
                    </td>
                    <td><span class="pe-3">Qty ${item.quantity}</span></td>
                    <td><span class="pe-3"> Rs.${(item.price * item.quantity).toFixed(2)}</span></td>
                </tr>`;
            tableBody.insertAdjacentHTML("beforeend", row);
        });

        totalElement.innerText = `Rs.${total_price.toFixed(2)}`;
    });

    document.getElementById("continueToPay").addEventListener("click", function(e) {
        e.preventDefault();

        const deliveryData = {
            name: document.getElementById("delivery_name").value,
            address1: document.getElementById("delivery_address1").value,
            address2: document.getElementById("delivery_address2").value,
            address3: document.getElementById("delivery_address3").value,
            email: document.getElementById("delivery_email").value,
            phone: document.getElementById("delivery_phone").value
        };

        const billingData = {
            name: document.getElementById("billing_name").value,
            address1: document.getElementById("billing_address1").value,
            address2: document.getElementById("billing_address2").value,
            address3: document.getElementById("billing_address3").value,
            email: document.getElementById("billing_email").value,
            phone: document.getElementById("billing_phone").value,
        };

        const selectPaymentMethod = document.querySelector('input[name="payment"]:checked');
        const paymentMethod = selectPaymentMethod ? selectPaymentMethod.value : null;

        if (!deliveryData.name || !deliveryData.email || !deliveryData.phone) {
            alert("Please fill all delivery details.");
            return;
        }
        if (!billingData.name || !billingData.email || !billingData.phone) {
            alert("Please fill all billing details.");
            return;
        }

        if (!paymentMethod) {
            alert("Please select a payment method.");
            return;
        }

        // Save to localStorage
        localStorage.setItem("deliveryInfo", JSON.stringify(deliveryData));
        localStorage.setItem("billingInfo", JSON.stringify(billingData));
        localStorage.setItem("paymentMethod", paymentMethod);

        const cartData = JSON.parse(localStorage.getItem('cart')) || [];
        if (cartData.length === 0) {
            alert("Your cart is empty!");
            return;
        }

        const totalPrice = cartData.reduce((sum, item) => sum + item.price * item.quantity, 0);

        // Build the request payload as you want:
        let payload = {
            user_id: "{{ auth()->user()->id }}",
            user_name: deliveryData.name,
            user_email: deliveryData.email,
            user_address: [
                deliveryData.address1,
                deliveryData.address2,
                deliveryData.address3
            ].filter(Boolean).join(', ') + '.',
            phone: deliveryData.phone,
            items: cartData.map(item => ({
                id: item.id,
                type: item.type || "default",
                name: item.name,
                detail: item.detail || "",
                image: item.image,
                price: item.price,
                quantity: item.quantity
            })),
            total_price: totalPrice,
            billing_name: billingData.name,
            billing_email: billingData.email,
            billing_address: [
                billingData.address1,
                billingData.address2,
                billingData.address3
            ].filter(Boolean).join(', ') + '.',
            billing_phone: billingData.phone,
            payment_method: paymentMethod
        };

        if (paymentMethod === "CashOnDelivery" || paymentMethod === "BankTransfer") {
            // Place order immediately and redirect to invoice
            fetch("{{route('store_order')}}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify(payload)

                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert("Order placed successfully!");
                        localStorage.removeItem("cart");
                        localStorage.removeItem("deliveryInfo");
                        localStorage.removeItem("billingInfo");
                        localStorage.removeItem("paymentMethod");
                        window.location.href =
                            `/Final_year_project/public/order/${data.order_id}`; // redirect to invoice page
                    } else {
                        alert("Failed to place order. Try again.");
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Server error. Please try again later.");
                });

        } else if (paymentMethod === "OnlinePayment") {
            // Redirect to online payment page for further processing
            window.location.href = "{{route('user.payment')}}";
        }
    });
    document.getElementById("sameAsDelivery").addEventListener("change", function() {
        if (this.checked) {
            // Copy delivery values into billing fields
            document.getElementById("billing_name").value = document.getElementById("delivery_name").value;
            document.getElementById("billing_address1").value = document.getElementById("delivery_address1").value;
            document.getElementById("billing_address2").value = document.getElementById("delivery_address2").value;
            document.getElementById("billing_address3").value = document.getElementById("delivery_address3").value;
            document.getElementById("billing_email").value = document.getElementById("delivery_email").value;
            document.getElementById("billing_phone").value = document.getElementById("delivery_phone").value;
        } else {
            // Clear billing fields if checkbox is unchecked
            document.getElementById("billing_name").value = "";
            document.getElementById("billing_address1").value = "";
            document.getElementById("billing_address2").value = "";
            document.getElementById("billing_address3").value = "";
            document.getElementById("billing_email").value = "";
            document.getElementById("billing_phone").value = "";
        }
    });
</script>
@endsection