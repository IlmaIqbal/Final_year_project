@extends('nav')

@section('content')

<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>



    <div class="row">
        @foreach ($venues as $venue)
        <div class="col-sm-3">
            <div class="card border-info mb-3" style="width: 18rem;">
                <img src="{{ asset('storage/images/venue/' . $venue->image) }}" class="card-img-top" alt="{{ $venue->name }}">
                <div class="card-body">
                    <h5 class="card-title text-bold">{{ $venue->name }}</h5>
                    <p class="card-text">{{ $venue->description }}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong><i class="fas fa-coins"></i></strong> Rs. {{ $venue->price }} Per Hour</li>
                        <li class="list-group-item"><strong><i class="fas fa-user-friends"></i></strong> {{ $venue->capacity }} Guests</li>
                        <li class="list-group-item "><strong><i class="fas fa-map-marker-alt"></i></strong> {{ $venue->location }}</li>

                        <form action="{{ route('notifyAdmin') }}" method="POST">
                            @csrf
                            <input type="hidden" name="venue[id]" value="{{ $venue->id }}">
                            <input type="hidden" name="venue[name]" value="{{ $venue->name }}">
                            <input type="hidden" name="venue[location]" value="{{ $venue->location }}">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control  @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control  @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                            <br>
                            <button class="btn btn-info" type="submit">Request Venue</button>
                        </form>

                        <br>


                    </ul>
                </div>
            </div>
        </div>
        @endforeach
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

</body>

</html>

@endsection