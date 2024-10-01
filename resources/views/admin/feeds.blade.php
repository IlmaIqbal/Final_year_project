@extends('admin.navbar')

@section('title')
Feed Backs
@endsection
@section('content')

<table class="table">
    <thead>
        <tr>
            <th scope="col">Email</th>
            <th scope="col">Comments</th>
        </tr>
    </thead>
    @foreach ($feedBacks as $feedBack )
    <tbody>
        <tr>

            <td>{{ $feedBack->email }}</td>
            <td>{{ $feedBack->comment }}</td>
        </tr>



    </tbody>
    @endforeach

</table>

@endsection