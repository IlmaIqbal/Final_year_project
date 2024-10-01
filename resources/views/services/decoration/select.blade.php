@extends('admin.navbar')

@section('content')
<h1>Select Decoration Services for {{ $event->name }}</h1>
<form action="/events/{{ $event->id }}/decoration" method="POST">
    @csrf
    @foreach($decorations as $decoration)
    <div>
        <input type="checkbox" name="decoration_id[]" value="{{ $decoration->id }}">
        {{ $decoration->name }} - ${{ $decoration->price }}
    </div>
    @endforeach
    <button type="submit">Next</button>
</form>
@endsection