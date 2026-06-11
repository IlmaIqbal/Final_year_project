@extends('nav')

@section('content')

<div class="row">
    @foreach ($invitations as $invitation)
    <div class="col-sm-3">

        <div class="card" style="width: 18rem; position:relative">
            @if (!$invitation->active)
            <div class="overlay">
                <span class="unavailable-tag">Unavailable</span>
            </div>
            @endif
            <img src="{{ asset('storage/images/' . $invitation->image) }}" class="card-img-top {{ $invitation->active ? '' : 'blur' }}" alt="{{ $invitation->name }}">
            <div class="card-body">
                <h5 class="card-title text-bold">{{ $invitation->name }}</h5>
                <p class="card-text">{{ $invitation->description }}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong></strong> </li>
                    <li class="list-group-item"><strong>Price:</strong> Rs. {{ $invitation->price }}</li>
                    <li class="list-group-item"><strong></strong> </li>

                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
<footer>

</footer>
@endsection