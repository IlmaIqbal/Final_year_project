@extends('nav')

@section('content')


<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
        <a href="{{ route('customers.services.catering') }}" class="text-decoration-none text-dark">
            <div class="card card-hover">
                <img src="{{asset('image/services/Catering.jpg')}}" class="card-img-top" alt="Catering">
                <div class="card-body">
                    <h5 class="card-title">Catering Services</h5>
                    <p class="card-text">It's not just food that we cater to your special day. It's the perfect blend of impeccable standard, exceptional quality and appetizing collection of food to provide your event a touch of grandeur..</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('customers.services.decoration') }}" class="text-decoration-none text-dark">
            <div class="card card-hover">
                <img src="{{asset('image/services/Decoration.jpg')}}" class="card-img-top" alt="Decoration">
                <div class="card-body">
                    <h5 class="card-title">Venue Decorations</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('customers.services.entertainment') }}" class="text-decoration-none text-dark">
            <div class="card card-hover">
                <img src="{{asset('image/services/Entertainment.jpg')}}" class="card-img-top" alt="Entertainment">
                <div class="card-body">
                    <h5 class="card-title">Entertainment</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('customers.services.invitation') }}" class="text-decoration-none text-dark">
            <div class="card card-hover">
                <img src="{{asset('image/services/Invitation.jpg')}}" class="card-img-top" alt="Invitation">
                <div class="card-body">
                    <h5 class="card-title">Invitation Card</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
        </a>
    </div>
</div>

@endsection