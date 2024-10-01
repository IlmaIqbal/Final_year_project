@extends('admin.navbar')

@section('content')

<h1>Payment for {{ $event->name }}</h1>
<p>Total Cost: ${{ $totalCost }}</p>
<form action="/events/{{ $event->id }}/payment" method="POST">
    @csrf
    <button type="submit">Pay Now</button>
</form>
@endsection