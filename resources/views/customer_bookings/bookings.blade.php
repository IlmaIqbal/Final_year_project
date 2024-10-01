@extends('user.home')

@section('content')


<section class="h-100 h-custom">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="table-responsive">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="h5">Event Details</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td> Event Type:</td>
                                <td id="event_type"></td>

                            </tr>
                            <tr>
                                <td> Guest Number: </td>
                                <td id="guest_no"></td>

                            </tr>
                            <tr>
                                <td> Event Start Date: </td>
                                <td id="start_date"></td>

                            </tr>

                            <tr>
                                <td> Event End Date: </td>
                                <td id="end_date"></td>
                            </tr>


                        </tbody>
                        <!-- Venue Selection -->
                        <thead>
                            <tr>
                                <th scope="col" class="h5">Venue Details</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Venue:</td>
                                <td id="venue"></td>
                            </tr>
                            <tr>
                                <td>Venue Location:</td>
                                <td id="venue_location"></td>
                            </tr>
                            <tr>
                                <td>Venue Price:</td>
                                <td id="venue_price"></td>
                            </tr>
                        </tbody>

                        <!-- Catering Selection -->

                        <thead>
                            <tr>
                                <th scope="col" class="h5">Catering Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Catering:</td>
                                <td id="catering"></td>
                            </tr>
                            <tr>
                                <td>Catering Price:</td>
                                <td id="catering_price"></td>
                            </tr>
                        </tbody>

                        <!-- Decoration Selection -->
                        <thead>
                            <tr>
                                <th scope="col" class="h5">Decoration Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Decoration:</td>
                                <td id="decoration"></td>
                            </tr>
                            <tr>
                                <td>Decoration Price:</td>
                                <td id="decoration_price"></td>
                            </tr>
                        </tbody>
                        <!-- Entertainment Selection -->
                        <thead>
                            <tr>
                                <th scope="col" class="h5">Entertainment Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Entertainment:</td>
                                <td id="entertainment"></td>
                            </tr>
                            <tr>
                                <td>Entertainment Price:</td>
                                <td id="entertainment_price"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-4 col-xl-3">
                                <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                                    <p class="mb-2">Total</p>
                                    <p class="mb-2" id="total">Rs.</p>
                                </div>

                                <a href="{{ route('customer_bookings.payment')}}" class="btn btn-primary">
                                    <span>Checkout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const eventData = JSON.parse(localStorage.getItem('eventData'));
        if (eventData) {
            document.getElementById('event_type').innerText = eventData.event_type;
            document.getElementById('guest_no').innerText = eventData.guest_no;
            document.getElementById('start_date').innerText = eventData.start_date;
            document.getElementById('end_date').innerText = eventData.end_date;

            document.getElementById('venue').innerText = eventData.venue_name;
            document.getElementById('venue_location').innerText = eventData.venue_location;
            document.getElementById('venue_price').innerText = eventData.venue_price;

            document.getElementById('catering').innerText = eventData.catering_name;
            document.getElementById('catering_price').innerText = eventData.catering_price;

            document.getElementById('decoration').innerText = eventData.decoration_name;
            document.getElementById('decoration_price').innerText = eventData.decoration_price;

            document.getElementById('entertainment').innerText = eventData.entertainment_name;
            document.getElementById('entertainment_price').innerText = eventData.entertainment_price;

            // Calculate the total price
            const totalPrice = parseFloat(eventData.venue_price || 0) +
                parseFloat(eventData.catering_price || 0) +
                parseFloat(eventData.decoration_price || 0) +
                parseFloat(eventData.entertainment_price || 0);
            document.getElementById('total').innerText = 'Rs. ' + totalPrice.toFixed(2);
        }
    });
</script>
@endsection