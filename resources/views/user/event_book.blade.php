@extends('nav')

@section('content')

<h1 style="text-align: center;">Book Your Event</h1>
<br>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


<div class="container" id="events-container">
    <form action="" id="myForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name"
                    value="{{ old('customer_name') }}" required>
                <div class="invalid-feedback">
                    Please enter customer name.
                </div>
            </div>
            <div class="form-group">
                <label for="customer_email" class="form-label">Customer Email</label>
                <input type="email" class="form-control" id="customer_email" name="customer_email"
                    value="{{ old('customer_email') }}" required>
                <div class="invalid-feedback">
                    Please enter customer email address.
                </div>
            </div>
            <div class="form-group">
                <label for="phone_no" class="form-label">Phone Number</label>
                <input type="phone" class="form-control" id="phone_no" name="phone_no" value="{{ old('phone_no') }}"
                    required>
                <div class="invalid-feedback">
                    Please enter customer phone number.
                </div>
            </div>
            <div class="form-group">
                <label for="event_type" class="form-label">Event Type</label>
                <div class="col-md-6">
                    <select id="event_type" class="form-select @error('event_type') is-invalid @enderror"
                        name="event_type" required>
                        <option value="" selected>Choose...</option>
                        <optgroup label="NON-CORPORATE EVENTS">
                            <option value="Birth Day">Birth Day Party</option>
                            <option value="Wedding">Wedding</option>
                            <option value="Festival">Festival</option>
                            <option value="Exhibition">Exhibition</option>
                        </optgroup>
                        <optgroup label="CORPORATE EVENTS">
                            <option value="Conferences">Conference</option>
                            <option value="Trade Show">Trade show</option>
                            <option value="Seminar">Seminar</option>
                            <option value="Company party">Company party</option>
                        </optgroup>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="guest_no" class="form-label">Number of Guests</label>
                <input type="number" class="form-control" id="guest_no" name="guest_no" min="1"
                    value="{{ old('guest_no') }}" required>
                <div class="invalid-feedback">
                    Please enter a valid number of guests.
                </div>
            </div>
            <div class="form-group">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="datetime-local" class="form-control  @error('start_date') is-invalid @enderror"
                    id="start_date" name="start_date" value="{{ old('start_date') }}" onchange="syncEndDate()" required>
                @error('start_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_date" class="form-label">End Date</label>
                <input type="datetime-local" class="form-control  @error('end_date') is-invalid @enderror" id="end_date"
                    name="end_date" value="{{ old('end_date') }}" required>
                @error('end_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="event_duration" class="form-label">Event Duration</label>
                <div class="col-md-6">
                    <select id="event_duration" class="form-select @error('event_duration') is-invalid @enderror"
                        name="event_duration" required>
                        <option value="" selected>Choose...</option>
                        <option value="Half Day">Half Day</option>
                        <option value="Full Day">Full Day</option>
                    </select>
                </div>
            </div>
            <!-- Venue Selection -->
            <div class="form-group">
                <label for="venue_id">Venue</label>
                <select name="venue_id" id="venue" class="form-control @error('title') is-invalid @enderror">
                    <option value="">Select a venue</option>
                    @foreach ($venues as $venue)
                    <option value="{{ $venue->id }}" data-name="{{ $venue->name }}"
                        data-image="{{ asset('storage/images/venue/' . $venue->image) }}"
                        data-location="{{ $venue->location }}" data-price="{{ $venue->price }}" required>
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

            <div class="form-group">
                <img id="venue-image" src="" alt="Venue Image" style="display:none; max-width: 100%; margin-top: 20px;">
                <p id="venue-location" style="display:none; margin-top:10px; background:#00FF19; font:bold;"></p>
                <p id="venue-price" style="display:none; margin-top:10px; background:#00FF19; font:bold;">Price : </p>
            </div>


            <!-- Catering Selection -->
            <div class="form-group">
                <label for="catering_id">Catering Services</label>
                <select name="catering_id" id="catering" class="form-control">
                    <option value="">Select a catering service</option>
                    @foreach ($caterings as $catering)
                    <option value="{{ $catering->id }}" data-name="{{ $catering->name }}"
                        data-price="{{ $catering->price }}">
                        {{ $catering->name }} - Rs. {{ $catering->price }} Per Head
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Decoration Selection -->
            <div class="form-group">
                <label for="decoration_id">Decoration services</label>
                <select name="decoration_id" id="decoration" class="form-control">
                    <option value="">Select a decoration service</option>
                    @foreach ($decorations as $decoration)
                    <option value="{{ $decoration->id }}" data-name="{{ $decoration->name }}"
                        data-price="{{ $decoration->price }}">
                        {{ $decoration->name }} - Rs. {{ $decoration->price }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Entertainment Selection -->
            <div class="form-group">
                <label for="entertainment_id">Entertainment services</label>
                <select name="entertainment_id" id="entertainment" class="form-control">
                    <option value="">Select an entertainment service</option>
                    @foreach ($entertainments as $entertainment)
                    <option value="{{ $entertainment->id }}" data-name="{{ $entertainment->name }}"
                        data-price="{{ $entertainment->price }}">
                        {{ $entertainment->name }} - Rs.{{ $entertainment->price }}
                    </option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="d-flex justify-content-between mb-4">
            <a type="submit" href="{{ route('customer_bookings.bookings')}}" class="btn btn-outline-primary  ml-auto"
                onclick="saveEventDataToLocalStorage()">Book an Event</a>
        </div>
</div>
</form>

</div>
<!-- Hidden Auth User Details -->
<div id="auth-user-details" style="display: none;">
    <span id="user-id">{{ $user->id }}</span>
    <span id="user-name">{{ $user->name }}</span>
    <span id="user-email">{{ $user->email }}</span>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const currentDateTime = new Date();

        flatpickr("#start_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            minDate: currentDateTime, // Disable past dates for the start date
            onChange: function(selectedDates, dateStr) {
                // Update the minDate for the end date picker dynamically
                endDatePicker.set("minDate", dateStr);
            },
        });

        const endDatePicker = flatpickr("#end_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            minDate: currentDateTime, // Disable past dates for the end date
        });
    });
</script>

<script>
    document.getElementById('myForm').addEventListener('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity()) {
            saveEventDataToLocalStorage(); // Save to local storage if valid
        } else {
            this.classList.add('was-validated'); // Apply Bootstrap validation styling
        }
    });
    // Function to save data to local storage
    function saveEventDataToLocalStorage() {
        const guestNo = parseInt(document.getElementById('guest_no').value);
        const venueOption = document.querySelector('#venue option:checked');
        const venuePrice = parseFloat(venueOption.dataset.price) || 0;
        const duration = document.getElementById('event_duration').value;

        const eventData = {
            customer_name: document.getElementById('customer_name').value,
            customer_email: document.getElementById('customer_email').value,
            phone_no: document.getElementById('phone_no').value,
            event_type: document.getElementById('event_type').value,
            guest_no: guestNo,
            start_date: document.getElementById('start_date').value,
            end_date: document.getElementById('end_date').value,
            event_duration: duration,
            venue_name: venueOption.dataset.name,
            venue_location: venueOption.dataset.location,
            venue_price: (duration === 'Full Day' ? venuePrice * 2 : venuePrice).toFixed(2), // Updated calculation
            catering_name: document.querySelector('#catering option:checked').dataset.name,
            catering_price: (guestNo * parseFloat(document.querySelector('#catering option:checked').dataset.price))
                .toFixed(2),
            decoration_name: document.querySelector('#decoration option:checked').dataset.name,
            decoration_price: document.querySelector('#decoration option:checked').dataset.price,
            entertainment_name: document.querySelector('#entertainment option:checked').dataset.name,
            entertainment_price: document.querySelector('#entertainment option:checked').dataset.price,
            venue_id: document.getElementById('venue').value,
            catering_id: document.getElementById('catering').value,
            decoration_id: document.getElementById('decoration').value,
            entertainment_id: document.getElementById('entertainment').value,
            user_id: document.getElementById('user-id').innerText,
            user_name: document.getElementById('user-name').innerText,
            user_email: document.getElementById('user-email').innerText

        };

        localStorage.setItem('eventData', JSON.stringify(eventData));
        alert('Are you confirm to Checkout?');
        document.getElementById('myForm').submit(); // Submit the form after saving data to local storage
    }

    // Call this function when the form is submitted
    document.getElementById('myForm').addEventListener('submit', function(e) {
        saveEventDataToLocalStorage(); // Save data to local storage and then submit the form
    });

    function syncEndDate() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        if (startDateInput.value) {
            // Extract the date and time separately
            const startDateValue = startDateInput.value;
            const [startDateOnly, startTime] = startDateValue.includes('T') ?
                startDateValue.split('T') // For ISO 8601 format
                :
                startDateValue.split(' '); // For other formats

            const currentEndTime = endDateInput.value ? endDateInput.value.split('T')[1] || endDateInput.value.split(' ')[
                1] : "00:00";

            // Update the End Date field with Start Date's date and current End Date's time
            endDateInput.value = `${startDateOnly} ${currentEndTime}`;
        }
    }

    // Add an event listener to prevent changing the date of the End Date manually
    document.getElementById('end_date').addEventListener('input', function() {
        const startDateInput = document.getElementById('start_date');
        const startDateValue = startDateInput.value;

        if (startDateValue) {
            const [startDateOnly] = startDateValue.includes('T') ?
                startDateValue.split('T') :
                startDateValue.split(' ');

            const endTime = this.value.includes('T') ? this.value.split('T')[1] : this.value.split(' ')[1] ||
                "00:00";

            this.value = `${startDateOnly} ${endTime}`;
        }
    });

    document.getElementById('venue').addEventListener('change', function() {
        updateVenueDetailsAndPrice();
    });

    document.getElementById('event_duration').addEventListener('change', function() {
        updateVenueDetailsAndPrice();
    });

    function updateVenueDetailsAndPrice() {
        const venueOption = document.querySelector('#venue option:checked');
        const venuePrice = parseFloat(venueOption.dataset.price) || 0;
        const duration = document.getElementById('event_duration').value;
        const venueLocation = venueOption.dataset.location;
        const venueImage = venueOption.dataset.image;

        // Update the price based on duration
        let finalVenuePrice = venuePrice;
        if (duration === 'Full Day') {
            finalVenuePrice = venuePrice * 2; // Double the price for full day
        }

        // Display venue price
        document.getElementById('venue-price').textContent = `Price: Rs. ${finalVenuePrice.toFixed(2)}`;
        document.getElementById('venue-price').style.display = 'block';

        // Display venue image
        const imageElement = document.getElementById('venue-image');
        if (venueImage) {
            imageElement.src = venueImage;
            imageElement.style.display = 'block';
        } else {
            imageElement.style.display = 'none';
        }

        // Display venue location
        const locationElement = document.getElementById('venue-location');
        if (venueLocation) {
            locationElement.textContent = `Location: ${venueLocation}`;
            locationElement.style.display = 'block';
        } else {
            locationElement.style.display = 'none';
        }
    }
</script>


@endsection