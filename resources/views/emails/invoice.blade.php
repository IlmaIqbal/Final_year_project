@extends('nav')

@section('content')



<div class="card">
    <div class="card-body mx-4">
        <div class="container">
            <p class="my-5 mx-5" style="font-size: 30px;">Thank for your purchase</p>
            <?php $total_price = 0; ?>

            @foreach ($items as $item )

            <div class="row">
                <ul class="list-unstyled">
                    <li class="text-black">{{ $item->name }}</li>
                    <li class="text-muted mt-1"><span class="text-black">Invoice</span> #{{ $item->id }}</li>
                    <li class="text-black mt-1">{{ $item->created_at->format('Y-m-d') }}</li>
                </ul>
                <hr>
                <div class="col-xl-10">
                    <p>{{ $item->product_name }} <br> Qty{{ $item->quantity }}</p>
                </div>
                <div class="col-xl-2">
                    <p class="float-end">Rs.{{ $item->price }}
                    </p>
                </div>
                <hr>
            </div>

            <?php $total_price = $total_price + $cart->price ?>
            @endforeach

            <div class="row text-black">

                <div class="col-xl-12">
                    <p class="float-end fw-bold">Total: Rs.{{ number_format($total_price, 2)}}
                    </p>
                </div>
                <hr style="border: 2px solid black;">
            </div>

        </div>
    </div>
</div>

@endsection