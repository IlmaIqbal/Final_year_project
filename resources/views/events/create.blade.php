@extends('admin.navbar')

@section('title')
Add Event
@endsection
@section('content')

<div class="container" id="events-container">
    <form action="{{ route('events.store') }}" id="myForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required placeholder="Enter Title..." autocomplete="title">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required autocomplete="customer_name">
                @error('customer_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="customer_email" class="form-label">Customer Email</label>
                <input type="email" class="form-control  @error('customer_email') is-invalid @enderror" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required autocomplete="customer_email">
                @error('customer_email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>

            </div>
            <div class="form-group">
                <label for="venue_id">Venue</label>
                <select name="venue_id" id="venue" class="form-control  @error('title') is-invalid @enderror" onchange="displayVenueDetails()" required>
                    <option value="">Select a venue</option>
                    @foreach ($venues as $venue)
                    <option value="{{ $venue->id }}" data-image="{{ asset('storage/images/venue/' . $venue->image) }}" data-location="{{ $venue->location }}" data-price="{{ $venue->price }}">
                        {{ $venue->name }}
                    </option>
                    @endforeach
                </select>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <input type="hidden" id="venue_price" name="venue_price">


            <div class="form-group">
                <img id="venue-image" src="" alt="Venue Image" style="display:none; max-width: 100%; margin-top: 20px;">
                <p id="venue-location" style="display:none; margin-top:10px; background:#00FF19; font:bold;"></p>
                <p id="venue-price" style="display:none; margin-top:10px; background:#00FF19; font:bold;">Price : </p>
            </div>
            <div class="form-group">
                <label for="guest_no" class="form-label">Number of Guests</label>
                <input type="number" class="form-control  @error('guest_no') is-invalid @enderror" id="guest_no" name="guest_no" value="{{ old('guest_no') }}" required>
                @error('guest_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="event_type" class="form-label">Event Type</label>
                <div class="col-md-6">
                    <select id="event_type" class="form-select @error('event_type') is-invalid @enderror" name="event_type" required>
                        <option selected>Choose...</option>
                        <optgroup label="NON-CORPORATE EVENTS">
                            <option value="birth_day">Birth Day Party</option>
                            <option value="Wedding">Wedding</option>
                            <option value="festival">Festival</option>
                            <option value="exhibition">Exhibition</option>
                        </optgroup>
                        <optgroup label="CORPORATE EVENTS">
                            <option value="conferences">Conference</option>
                            <option value="trade_show">Trade show</option>
                            <option value="seminar">Seminar</option>
                            <option value="trade_show">Company party</option>
                        </optgroup>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control  @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                @error('start_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control  @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                @error('end_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('events.service_selection') }}" class="btn btn-primary ml-auto">Next</a>
        </div>

    </form>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#start_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i K",
            time_24hr: false,

        });
        flatpickr("#end_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i K",
            time_24hr: false,

        });
    });
</script>
<script>
    function displayVenueDetails() {
        const selectElement = document.getElementById('venue');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const imageUrl = selectedOption.getAttribute('data-image');
        const location = selectedOption.getAttribute('data-location');
        const price = selectedOption.getAttribute('data-price');
        document.getElementById('venue_price').value = venuePrice;

        const imageElement = document.getElementById('venue-image');
        const locationElement = document.getElementById('venue-location');
        const priceElement = document.getElementById('venue-price');

        if (imageUrl) {
            imageElement.src = imageUrl;
            imageElement.style.display = 'block';
        } else {
            imageElement.style.display = 'none';
        }
        if (location) {
            locationElement.textContent = `Location: ${location}`;
            locationElement.style.display = 'block';
        } else {
            locationElement.style.display = 'none';
        }
        if (price) {
            priceElement.textContent = `Price: ${price}`;
            priceElement.style.display = 'block';
        } else {
            priceElement.style.display = 'none';
        }
    }

    document.getElementById('myForm').addEventListener('submit', function(event) {
        const titleInput = document.getElementById('title');

        if (!titleInput.value.trim()) {
            alert('Please fill out the Title field.');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>


@endsection