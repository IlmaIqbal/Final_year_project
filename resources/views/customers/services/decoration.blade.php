@extends('nav')

@section('content')


<style>
    .blur {
        filter: blur(4px);
        opacity: 0.6;
    }


    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 1.5em;
        font-weight: bold;
        text-transform: uppercase;
        z-index: 10;
    }

    .unavailable-tag {
        background-color: red;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }
</style>
</style>
<div class="row">
    @foreach ($decorations as $decoration)
    <div class="col-sm-3">

        <div class="card" style="width: 18rem; position: relative;">
            @if (!$decoration->active)
            <div class="overlay">
                <span class="unavailable-tag">Unavailable</span>
            </div>
            @endif
            <div class="{{ $decoration->active ? '' : 'blur' }}">
                <img src="{{ asset('storage/images/' . $decoration->image) }}" class="card-img-top" alt="{{ $decoration->name }}">
            </div>
            <div class="card-body">
                <h5 class="card-title text-bold">{{ $decoration->name }}</h5>
                <p class="card-text">{{ $decoration->description }}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong></strong> </li>
                    <li class="list-group-item"><strong>Price:</strong> Rs. {{ $decoration->price }}</li>
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