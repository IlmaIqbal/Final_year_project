@extends('admin.navbar')

@section('title')
Events
@endsection
@section('content')
<div class="container">
    <h1>Notifications</h1>
    <ul class="list-group">
        @foreach ($notifications as $notification)
        <li class="list-group-item">
            - {{ $notification->created_at->diffForHumans() }}
            <br>
            User: {{ $notification->name }} ({{ $notification->email }})
            <br>
            Venue: {{ $notification->venue_name }} ({{ $notification->address }})
            <br>
            Checking availability At: <p class="text-primary">{{ $notification->start_date }}</p> To <p class="text-primary">{{ $notification->end_date }}</p>
            <a href="{{route('send_email', $notification->id)}}" type="button" class="btn btn-success">Venue Available</a>
            <a href="{{route('unavailable_venue', $notification->id)}}" type="button" class="btn btn-danger">Venue Unavailable</a>
        </li>
        @endforeach
    </ul>
</div>
@endsection