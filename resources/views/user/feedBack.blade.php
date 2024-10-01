@extends('nav')

@section('content')

<div class="container">
    <h3 style="text-align: center;">Your Valuable Feed Backs</h3>
    <br>

    <form action="{{ route('feedBack.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
        </div>
        <div class="form-floating">
            <textarea class="form-control" name="comment" placeholder="Leave a comment here" id="comment" style="height: 100px"></textarea>
            <label for="comment">Comments</label>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
        <br>
    </form>
</div>

@endsection