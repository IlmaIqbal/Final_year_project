@extends('nav')

@section('content')
<style>
    @media print {

        footer,
        .footer,
        .site-footer,
        .page-footer,
        .d-print-none {
            display: none !important;
        }


        body {
            margin: 0;
            padding: 0;
        }


        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: 1rem;
        }
    }
</style>

<div class="container mt-5">
    <h3>Your order has been placed successfully!</h3>

    <link rel="stylesheet" href="/resources/css/all.min.css"
        integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div>
                                <div class="invoice-title">
                                    <h4 class="float-end font-size-15">Invoice #DS0204
                                        <span class="badge bg-success font-size-12 ms-2">Paid</span>
                                    </h4>
                                    <div class="mb-4">
                                    </div>
                                    <div class="text-muted">
                                        <p class="mb-1">3184 Spruce Drive Pittsburgh, PA 15201</p>
                                        <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> xyz@987.com</p>
                                        <p><i class="uil uil-phone me-1"></i> 012-345-6789</p>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="text-muted">
                                            <h5 class="font-size-16 mb-3">Billed To:</h5>
                                            <h5 id="user_name" class="font-size-15 mb-2"></h5>
                                            <p id="user_address" class="mb-1"></p>
                                            <p id="user_email" class="mb-1"></p>
                                            <p id="phone"></p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-sm-6">
                                        <div class="text-muted text-sm-end">
                                            <div>
                                                <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                                <p>#DZ0112</p>
                                            </div>
                                            <div class="mt-4">
                                                <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                                <p>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
                                            </div>
                                            <div class="mt-4">
                                                <h5 class="font-size-15 mb-1">Order No:</h5>
                                                <p>#{{ $orderId }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="py-2">
                                    <h5 class="font-size-15">Order Summary</h5>

                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 70px;">No.</th>
                                                    <th>Item</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th class="text-end" style="width: 120px;">Total</th>
                                                </tr>
                                            </thead><!-- end thead -->
                                            <tbody class="borderless" id="cardItemData">




                                                <!-- end tr -->
                                                <tr>
                                                    <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                                    <td class="border-0 text-end">
                                                        <h4 id="total" class="m-0 fw-semibold">Rs.</h4>
                                                    </td>
                                                </tr>
                                                <!-- end tr -->
                                            </tbody><!-- end tbody -->
                                        </table><!-- end table -->
                                    </div><!-- end table responsive -->
                                </div>
                            </div>
                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i
                                            class="fa fa-print"></i></a>
                                    <a href="{{ route('user.home') }}" class="btn btn-primary w-md">Go Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tableBody = document.getElementById("cardItemData");
        const totalElement = document.getElementById("total");

        let cartData = JSON.parse(localStorage.getItem("cart")) || [];

        let deliveryData = JSON.parse(localStorage.getItem("deliveryInfo")) || [];

        let billingData = JSON.parse(localStorage.getItem("billingInfo")) || [];

        let paymentMethodData = localStorage.getItem("paymentMethod");

        let total_price = 0;

        if (billingData) {
            document.getElementById('user_name').innerText = billingData.name || "N/A";
            document.getElementById('user_address').innerText = (billingData.address1 || "N/A") + ' ' + (billingData
                .address2 || "N/A") + ' ' + (billingData.address3 || "N/A");
            document.getElementById('user_email').innerText = billingData.email || "N/A";
            document.getElementById('phone').innerText = billingData.phone || "N/A";

        }

        tableBody.innerHTML = "";

        cartData.forEach((item, index) => {
            total_price += item.price * item.quantity;

            let row = `
             <tr>
             <th scope="row">${index + 1}</th>
                 <td>
                    <div>
                    <h5 class="text-truncate font-size-14 mb-1">
                         ${item.name}
                    </h5>
                    <p class="text-muted mb-0">${item.detail}</p>
                     </div>
                      </td>
                      <td>Rs. ${item.price}</td>
                     <td>${item.quantity}</td>
                     <td class="text-end">Rs. ${(item.price * item.quantity).toFixed(2)}</td>
                     </tr>
              `;
            tableBody.insertAdjacentHTML("beforeend", row);
        });

        totalElement.innerText = `Rs.${total_price.toFixed(2)}`;
    });

    const cartData = JSON.parse(localStorage.getItem('cart')) || [];
    let deliveryData = JSON.parse(localStorage.getItem("deliveryInfo")) || [];

    let billingData = JSON.parse(localStorage.getItem("billingInfo")) || [];

    let paymentMethodData = localStorage.getItem("paymentMethod");

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
        payment_method: paymentMethodData,
        paid_at: new Date().toISOString().split('T')[0] // "YYYY-MM-DD"

    };
    if (paymentMethodData === "OnlinePayment") {
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

    }
</script>

@endsection