@extends('admin.navbar')

@section('title')
Events
@endsection
@section('content')

<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p>{{ $message }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Venue</th>
                    <th>Guest Count</th>
                    <th>Event Type</th>
                    <th>Description</th>
                    <th>State</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->customer_name }}</td>
                    <td>{{ $event->customer_email }}</td>
                    <td>{{ $event->start_date }}</td>
                    <td>{{ $event->end_date }}</td>
                    <td>{{ $event->venue->name }}</td>
                    <td>{{ $event->guest_no }}</td>
                    <td>{{ $event->event_type }}</td>
                    <td>
                        <div class="small-area">
                            <p>{{ $event->description}}</p>
                        </div>
                    </td>
                    <td>{{ ucfirst($event->status) }}</td>
                    <td>
                        @if ($event->status == 'pending')
                        <form action="{{ route('events.approve', $event->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('events.reject', $event->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection