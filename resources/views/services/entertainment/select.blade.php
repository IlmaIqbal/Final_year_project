@extends('admin.navbar')

@section('content')

<h1>Select Invitation Cards for {{ $event->name }}</h1>
<form action="/events/{{ $event->id }}/invitation" method="POST">
    @csrf
    @foreach($entertainments as $entertainment)
    <div>
        <input type="checkbox" name="entertainment_id[]" value="{{ $entertainment->id }}">
        {{ $entertainment->name }} - ${{ $entertainment->price }}
    </div>
    @endforeach
    <button type="submit">Next</button>
</form>
@endsection