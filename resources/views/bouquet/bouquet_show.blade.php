@extends('admin.navbar')

@section('title')
Bouquet
@endsection
@section('content')


<div class="card bg-body-secondary" style="width: 30rem; height: 30rem;">
    <img class="card-img-top" style="width: 10rem; height: 10rem; object-fit: cover;"
        src="/image/bouquet/{{ $bouquet->image }}" alt="Card image cap">
    <div class="card-body">
        <h4 class="card-title">{{ $bouquet->name }}</h4>
        <p class="card-text">{{ $bouquet->detail }}</p>
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> Qty : {{ $bouquet->quantity }}</li>
                <li class="list-group-item"> Price : {{ $bouquet->price }}</li>
            </ul>
        </div>
        <a href="{{ route('bouquet.bouquet')}}" class="btn btn-primary">Go Back</a>
    </div>
</div>
@endsection