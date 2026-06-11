@extends('nav')

@section('content')
<br>
<div class="container">
    <div class="row d-flex flex-row">
        <div class="col-md-4">

            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('image/Main_Gift.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Gift <span class=" text-secondary">({{$counts['gifts']}} Items)</span>
                    </h5>
                    <p></p>
                    <br>
                    <a href="{{ route('user.products.gift') }}" class=" btn btn-outline-primary">View
                        More</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('image/main_bouquet.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Bouquets <span class=" text-secondary">({{$counts['bouquets']}} Items)</span>
                    </h5>
                    <p></p>
                    <br>
                    <a href="{{ route('user.products.bouquet') }}" class=" btn btn-outline-primary">View
                        More</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('image/main_wrapping_paper.jpg') }}" alt="Card image cap">
                <div class="card-body">

                    <h5 class="card-title">Wrapping Paper <span class=" text-secondary">({{$counts['wrapping']}}
                            Items)</span>
                    </h5>
                    <p></p>
                    <br>
                    <a href="{{ route('user.products.wrapping_paper') }}" class=" btn btn-outline-primary">View
                        More</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection