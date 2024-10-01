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
                <label for="guest_no" class="form-label">Number of Guests</label>
                <input type="number" class="form-control  @error('guest_no') is-invalid @enderror" id="guest_no" name="guest_no" min="1" value="{{ old('guest_no') }}" required>
                @error('guest_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
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
            <!-- Venue Selection -->
            <div class="form-group">
                <label for="venue_id">Venue</label>
                <select name="venue_id" id="venue" class="form-control @error('title') is-invalid @enderror" required>
                    <option value="">Select a venue</option>
                    @foreach ($venues as $venue)
                    <option value="{{ $venue->id }}" data-name="{{ $venue->name }}" data-location="{{ $venue->location }}" data-price="{{ $venue->price }}">
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
                    <option value="{{ $catering->id }}" data-name="{{ $catering->name }}" data-price="{{ $catering->price }}">
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
                    <option value="{{ $decoration->id }}" data-name="{{ $decoration->name }}" data-price="{{ $decoration->price }}">
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
                    <option value="{{ $entertainment->id }}" data-name="{{ $entertainment->name }}" data-price="{{ $entertainment->price }}">
                        {{ $entertainment->name }} - Rs.{{ $entertainment->price }}
                    </option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="d-flex justify-content-between mb-4">
            <a type="submit" href="{{ route('customer_bookings.bookings')}}" class="btn btn-outline-primary  ml-auto" onclick="saveEventDataToLocalStorage()">Book an Event</a>
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
    // Function to save data to local storage

    // Function to save data to local storage
    function saveEventDataToLocalStorage() {
        const eventData = {
            event_type: document.getElementById('event_type').value,
            guest_no: document.getElementById('guest_no').value,
            start_date: document.getElementById('start_date').value,
            end_date: document.getElementById('end_date').value,
            venue_name: document.querySelector('#venue option:checked').dataset.name,
            venue_location: document.querySelector('#venue option:checked').dataset.location,
            venue_price: document.querySelector('#venue option:checked').dataset.price,
            catering_name: document.querySelector('#catering option:checked').dataset.name,
            catering_price: document.querySelector('#catering option:checked').dataset.price,
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
        alert('Event data has been saved to local storage.');
        document.getElementById('myForm').submit(); // Submit the form after saving data to local storage
    }

    // Call this function when the form is submitted
    document.getElementById('myForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting
        saveEventDataToLocalStorage(); // Save data to local storage and then submit the form
    });
</script>


@endsection