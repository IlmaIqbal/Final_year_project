@extends('admin.navbar')

@section('title')
Invoice
@endsection
@section('content')

<div class="card">
    <div class="card-body mx-4">
        <div class="container">
            <p class="my-5 mx-5" style="font-size: 30px;">Thank for your purchase</p>
            <div class="row">
                <ul class="list-unstyled">
                    <li class="text-muted mt-1"><span class="text-black">Invoice</span> #001</li>
                    <li class="text-black mt-1">{{ \Carbon\Carbon::now()->format('F d, Y') }}</li>
                </ul>
                <div class="col-xl-10">
                    <table class="table">
                        <tr>
                            <td>Customer Name:</td>
                            <td id="customer_name" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Customer Email:</td>
                            <td id="customer_email" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Phone Number:</td>
                            <td id="phone_no" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Event Type:</td>
                            <td id="event_type" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Number of Guests:</td>
                            <td id="guest_no" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Start Date:</td>
                            <td id="start_date" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>End Date:</td>
                            <td id="end_date" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Event Duration:</td>
                            <td id="event_duration" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Venue:</td>
                            <td id="venue" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Venue Location:</td>
                            <td id="venue_location" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Venue Price:</td>
                            <td id="venue_price" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Catering:</td>
                            <td id="catering" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Catering Price:</td>
                            <td id="catering_price" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Decoration:</td>
                            <td id="decoration" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Decoration Price:</td>
                            <td id="decoration_price" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Entertainment:</td>
                            <td id="entertainment" class="text-right"></td>
                        </tr>
                        <tr>
                            <td>Entertainment Price:</td>
                            <td id="entertainment_price" class="text-right"></td>
                        </tr>
                        <tr>
                            <div class="row text-black">
                                <div class="col-xl-2">
                                    <div class="col-xl-12">
                                        <td>Total:</td>
                                        <td id="total" class="text-right fw-bold"></td>
                                    </div>
                                    <hr style="border: 2px solid black;">

                                </div>
                            </div>

                        </tr>
                    </table>
                </div>

            </div>

            <button id="download_invoice" type="button" class="btn btn-success">Download Invoice</button>


            <a href="{{route('admin.home')}}" id="" type="button" class="btn btn-primary">Go Back</a>


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const eventData = JSON.parse(localStorage.getItem('eventData'));

                    if (eventData) {
                        // Populate invoice fields
                        document.getElementById('customer_name').innerText = eventData.customer_name;
                        document.getElementById('customer_email').innerText = eventData.customer_email;
                        document.getElementById('phone_no').innerText = eventData.phone_no;

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

                        // Handle invoice download
                        const downloadInvoiceButton = document.getElementById('download_invoice');
                        downloadInvoiceButton.addEventListener('click', function() {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = '{{ route("download.invoice") }}';

                            // Add CSRF Token
                            const csrfToken = document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content');
                            const inputToken = document.createElement('input');
                            inputToken.type = 'hidden';
                            inputToken.name = '_token';
                            inputToken.value = csrfToken;
                            form.appendChild(inputToken);

                            // Add eventData
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'eventData';
                            input.value = JSON.stringify(eventData);
                            form.appendChild(input);

                            // Append and submit the form
                            document.body.appendChild(form);
                            form.submit();

                            // Clear localStorage
                            localStorage.removeItem('eventData');
                        });
                    }

                    // Clear local storage when navigating away from the page
                    window.addEventListener('beforeunload', function() {
                        localStorage.removeItem('eventData');
                    });
                });
            </script>
            @endsection