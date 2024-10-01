@extends('admin.navbar')

@section('content')
<h1>Select Invitation Cards for {{ $event->name }}</h1>
<form action="/events/{{ $event->id }}/invitation" method="POST">
    @csrf
    @foreach($invitations as $card)
    <div>
        <input type="checkbox" name="invitation_id[]" value="{{ $card->id }}">
        {{ $card->name }} - ${{ $card->price }}
    </div>
    @endforeach
    <button type="submit">Next</button>
</form>
@endsection