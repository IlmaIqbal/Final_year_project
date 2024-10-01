@extends('admin.navbar')

@section('title')
Send Email
@endsection
@section('content')

<h4 style="text-align: center;">Send Email to {{$emails->email}}</h4>

<div class="card card-primary">


    <form method="POST" action="{{route('send_user_email', $notification->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="greeting">Greeting</label>
                <input type="text" name="greeting" id="greeting" class="form-control @error('greeting') is-invalid @enderror" value="{{ old('greeting') }}" required placeholder="greeting" autocomplete="greeting">
                @error('greeting')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="greeting">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" required placeholder="subject" autocomplete="subject">
                @error('subject')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Body</label>
                <textarea type="text" name="body" class="form-control @error('body') is-invalid @enderror " placeholder="Write Your Email" id="body" value="{{ old('body') }}" required style="height: 100px" autocomplete="body"></textarea>
                @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="greeting">Button</label>
                <input type="text" name="button" id="button" class="form-control @error('button') is-invalid @enderror" value="{{ old('button') }}" required placeholder="button" autocomplete="button">
                @error('button')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="greeting">Url</label>
                <input type="text" name="url" id="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url') }}" required placeholder="url" autocomplete="url">
                @error('url')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <input type="submit" value="Send Email" class="btn btn-primary">
    </form>
</div>

@endsection