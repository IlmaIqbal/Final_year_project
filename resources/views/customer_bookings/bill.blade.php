@extends('user.home')

@section('content')

<div class="card">
    <div class="card-body mx-4">
        <div class="container">
            <p class="my-5 mx-5" style="font-size: 30px;">Thank for your purchase</p>
            <div class="row">
                <ul class="list-unstyled">
                    <li class="text-muted mt-1"><span class="text-black">Invoice</span> #111</li>
                    <li class="text-black mt-1">{{ \Carbon\Carbon::now()->format('F d, Y') }}</li>
                </ul>
                <div class="col-xl-10">
                    <table class="table">
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


            <a href="{{route('user.home')}}" id="" type="button" class="btn btn-primary">Go Back</a>


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

                        document.getElementById('download_invoice').addEventListener('click', function() {
                            const form = document.createElement('form');
                            form.method = 'GET';
                            form.action = '{{ route("download.invoice") }}';

                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'eventData';
                            input.value = JSON.stringify(eventData);
                            form.appendChild(input);

                            document.body.appendChild(form);
                            form.submit();
                            document.body.removeChild(form);
                        });
                    }
                });
            </script>
            @endsection