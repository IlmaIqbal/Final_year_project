@extends('admin.navbar')

@section('title')
All Orders
@endsection
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css?family=Assistant');

    body {
        background: #eee;
        font-family: Assistant, sans-serif;
    }

    .cell-1 {
        border-collapse: separate;
        border-spacing: 0 4em;
        background: #fff;
        border-bottom: 5px solid transparent;
        /*background-color: gold;*/
        background-clip: padding-box;
    }

    thead {
        background: #dddcdc;
    }

    .toggle-btn {
        width: 40px;
        height: 21px;
        background: grey;
        border-radius: 50px;
        padding: 3px;
        cursor: pointer;
        -webkit-transition: all 0.3s 0.1s ease-in-out;
        -moz-transition: all 0.3s 0.1s ease-in-out;
        -o-transition: all 0.3s 0.1s ease-in-out;
        transition: all 0.3s 0.1s ease-in-out;
    }

    .toggle-btn>.inner-circle {
        width: 15px;
        height: 15px;
        background: #fff;
        border-radius: 50%;
        -webkit-transition: all 0.3s 0.1s ease-in-out;
        -moz-transition: all 0.3s 0.1s ease-in-out;
        -o-transition: all 0.3s 0.1s ease-in-out;
        transition: all 0.3s 0.1s ease-in-out;
    }

    .toggle-btn.active {
        background: blue !important;
    }

    .toggle-btn.active>.inner-circle {
        margin-left: 19px;
    }

    .img_size {
        width: 100px;
        height: 100px;
    }
</style>
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <div class="rounded">
                <div class="table-responsive table-borderless">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Payment</th>
                                <th>Delivery</th>
                                <th>Paid At</th>
                                <th>Delivered At</th>
                                <th>Delivered</th>

                            </tr>
                        </thead>
                        @foreach ($orders as $order)

                        <tbody class="table-body">
                            <tr class="cell-1">
                                <td>{{$order->id}}</td>
                                <td>
                                    <img class="img_size" src="/image/{{$order->image}}">
                                </td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->address1}} {{$order->address2}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->product_name}}</td>
                                <td>{{$order->quantity}}</td>
                                <td>{{$order->price}}</td>
                                <td>{{$order->payment}}</td>
                                <td>{{$order->delivery}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    @if ($order->updated_at != $order->created_at)
                                    {{$order->updated_at}}
                                    @endif

                                </td>

                                <td>

                                    @if($order->delivery=="Processing")

                                    <a class="btn btn-success" href="{{route('delivered', $order->id)}}" onclick="return confirm('Are you sure this product is delivered?')">Delivered</a>

                                    @else

                                    <p>Delivered</p>

                                    @endif
                                </td>
                            </tr>

                        </tbody>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection