@extends('admin.navbar')

@section('content')

<h1>Select Catering Services for {{ $event->name }}</h1>
<p>Hi hello</p>
<form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        @foreach($services as $service)
        <div>
            <input type="checkbox" name="service_id[]" value="{{ $service->id }}">
            {{ $service->name }} - ${{ $service->price }}
        </div>
        @endforeach
    </div>
    <input type="hidden" name="event_id" value="{{ $event->id ?? '' }}">
    <button type="submit">Next</button>
</form>
@endsection