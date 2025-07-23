@extends('admin.navbar')

@section('title')
Wrapping Paper
@endsection
@section('content')


<div class="card bg-body-secondary" style="width: 30rem; height: 30rem;">
    <img class="card-img-top" style="width: 10rem; height: 10rem; object-fit: cover;"
        src="/image/wrapping_paper/{{ $wrapping_paper->image }}" alt="Card image cap">
    <div class="card-body">
        <h4 class="card-title">{{ $wrapping_paper->name }}</h4>
        <p class="card-text">{{ $wrapping_paper->detail }}</p>
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> Qty : {{ $wrapping_paper->quantity }}</li>
                <li class="list-group-item"> Price : {{ $wrapping_paper->price }}</li>
            </ul>
        </div>
        <a href="{{ route('wrapping.wrapping')}}" class="btn btn-primary">Go Back</a>
    </div>
</div>
@endsection