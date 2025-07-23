@extends($layout)

@section('title')
products
@endsection
@section('content')


<div class="card bg-body-secondary" style="width: 30rem; height: 30rem;">
    <img class="card-img-top" style="width: 10rem; height: 10rem; object-fit: cover;"
        src="{{asset('image/'. $product->image )}}" alt="Card image cap">
    <div class="card-body">
        <h4 class="card-title text-bold">{{ $product->name }}</h4>
        <p class="card-text">{{ $product->detail }}</p>
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> Reorder Level : {{ $product->reorder_level }}</li>
                <li class="list-group-item"> Category : {{ $product->category }}</li>
            </ul>
        </div>
        <a href="{{ route('products.index')}}" class="btn btn-primary">Go Back</a>
    </div>
</div>
@endsection