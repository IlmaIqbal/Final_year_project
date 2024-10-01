@extends('nav')

@section('content')

<div class="container_con">
    @if(session('success'))
    <p>{{ session('success') }}</p>
    @endif
    <div style="text-align:center">
        <h2>Contact Us</h2>
        <p>Swing by for a cup of coffee, or leave us a message:</p>
    </div>
    <div class="row">
        <div class="column">
            <img src="{{ asset('image/contact_us.jpg') }}" style="width:100%">
        </div>
        <div class="column">
            <form action="{{ route('contact_us.send') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="name">Name</label>
                <input type="text" class="input_field" id="name" name="name" placeholder="Your name.." required>
                <label for="email">Email</label>
                <input type="email" class="input_field" id="email" name="email" placeholder="Your Email Address.." required>
                <label for="phone">Phone</label>
                <input type="tel" class="input_field" id="phone" name="phone" placeholder="Your Phone Number.." required>
                <label for="message">Message</label>
                <textarea id="message" class="input_field" name="message" placeholder="Write something.." style="height:170px" required></textarea>
                <button class="suc" type="submit">Send</button>
            </form>
        </div>
    </div>
</div>

@endsection