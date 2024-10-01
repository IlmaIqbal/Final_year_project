@extends('nav')

@section('content')

<section class="pt-5 pb-5">

    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3 class="mb-3">Gift Items</h3>
            </div>
            <div class="row">

                @foreach ($gifts as $gift)

                <div class="col-md-4 mb-3">

                    <div class="card">
                        <img class="img-fluid" alt="100%x280" src="/image/{{ $gift->image }}">
                        <div class="card-body">
                            <h4 class="card-title">{{ $gift->name }}</h4>
                            <p class="card-text">{{ $gift->detail }}</p>
                            <p><strong>Rs.{{ $gift->price }}</strong></p>

                            <a href="#" class="btn btn-outline-primary" style="margin-bottom: 10px;">Gift Details</a>

                            <form action="{{route('products.add_cart_gift', $gift->id )}}" method="Post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" name="quantity" value="1" min="1" style="width: 100px; margin-right: 10px;">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="submit" class="btn btn-outline-primary" value="Add to Cart">
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>


                </div>
                @endforeach()
            </div>
        </div>
    </div>
</section>



@endsection