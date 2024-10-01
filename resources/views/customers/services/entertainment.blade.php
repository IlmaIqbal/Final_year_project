@extends('nav')

@section('content')

<div class="row">
    @foreach ($entertainments as $entertainment)
    <div class="col-sm-3">

        <div class="card" style="width: 18rem;">
            <img src="{{ asset('storage/images/' . $entertainment->image) }}" class="card-img-top" alt="{{ $entertainment->name }}">
            <div class="card-body">
                <h5 class="card-title text-bold">{{ $entertainment->name }}</h5>
                <p class="card-text">{{ $entertainment->description }}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong></strong> </li>
                    <li class="list-group-item"><strong>Price:</strong> Rs. {{ $entertainment->price }}</li>
                    <li class="list-group-item"><strong></strong> </li>

                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
<footer>
    @include('user.partials.footer')
</footer>
@endsection