@extends('nav')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi Item Carousel Cards</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <section class="pt-5 pb-5">

        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h3 class="mb-3">Gift Items</h3>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-secondary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <a class="btn btn-secondary mb-3" href="#carouselExampleIndicators2" role="button" data-slide="next">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
                <div class="col-12">
                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($gifts->chunk(3) as $index => $giftChunk)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="row">
                                    @foreach ($giftChunk as $gift)

                                    <div class="col-md-4 mb-3">

                                        <div class="card">
                                            <img class="img-fluid" alt="100%x280" src="/image/{{ $gift->image }}">
                                            <div class="card-body">
                                                <h4 class="card-title">{{ $gift->name }}</h4>
                                                <p class="card-text">{{ $gift->detail }}</p>
                                                <p><strong>Rs.{{ $gift->price }}</strong></p>
                                                <a href="#" class="btn btn-outline-primary">Add to Cart</a>
                                                <a href="#" class="btn btn-outline-primary">Buy Now</a>

                                            </div>

                                        </div>


                                    </div>
                                    @endforeach


                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
@endsection