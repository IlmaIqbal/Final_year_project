@extends('nav')

@section('content')

<style>
    .gradient-custom {
        /* fallback for old browsers */
        background: #cd9cf2;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to top left, rgba(205, 156, 242, 1), rgba(246, 243, 255, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to top left, rgba(205, 156, 242, 1), rgba(246, 243, 255, 1))
    }
</style>

<section class="h-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-10 col-xl-8">
                <div class="card" style="border-radius: 10px;">
                    <div class="card-header px-4 py-5">
                        <h5 class="text-muted mb-0">Thanks for your Order, <span
                                style="color: #a8729a;">{{ $order->user_name }}</span>
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <p class="lead fw-normal mb-0" style="color: #a8729a;">Products Details</p>

                        </div>

                        <div class="card shadow-0 border mb-4">
                            <div class="card-body">
                                @if (!empty($orderItem))

                                @foreach ($orderItem as $item)

                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ asset('') }}{{ $item['image'] }}" class="img-fluid"
                                            alt="{{ $item['name'] }}">
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0">{{ $item['name'] }}</p>
                                    </div>
                                    <div class="col-md-4 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">{{ $item['detail'] }}</p>
                                    </div>

                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">{{ $item['quantity'] }}</p>
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">Rs. {{ $item['price'] }}</p>
                                    </div>
                                </div>
                                @endforeach
                                @php

                                $deliveryStatus = $order->delivery ?? 'Pending';

                                $process = match($deliveryStatus){
                                'Pending' => 25,
                                'outForDelivery' => 65,
                                'Delivered' => 100,
                                default => 0,

                                }


                                @endphp
                                <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-2">
                                        <p class="text-muted mb-0 small">Track Order</p>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="progress" style="height: 6px; border-radius: 16px;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $process }}%; border-radius: 16px; background-color: #a8729a;"
                                                aria-valuenow="$process" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="d-flex justify-content-around mb-1">

                                            <p
                                                class="text-muted mt-1 mb-0 small {{ $process >= 25 ? 'text-success' : '' }}">
                                                Pending</p>

                                            <p
                                                class="text-muted mt-1 mb-0 small {{ $process >= 65 ? 'text-success' : '' }}">
                                                Out for Delivery</p>
                                            <p
                                                class="text-muted mt-1 mb-0 small {{ $process == 100 ? 'text-success' : '' }}">
                                                Delivered</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <p class="text-muted text-center">No items found in this order.</p>
                        @endif
                        <div class="d-flex justify-content-between pt-2">
                            <p class="fw-bold mb-0">Order Details</p>
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <p class="text-muted mb-0">Order Number : {{ $order->id }}</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p class="text-muted mb-0">Order Date : {{ $order->created_at}}</p>
                        </div>
                        <div class="d-flex justify-content-between pt-2">
                            <p class="fw-bold mb-0">Deliver Details</p>
                        </div>
                        <div class="d-flex justify-content-between pt-2">
                            <p class="text-muted mb-0">Deliver Name : {{ $order->deliverBy->name ?? '' }}</p>
                        </div>
                        <div class="d-flex justify-content-between ">
                            <p class="text-muted mb-0">Vehicle Number : {{ $order->vehicle_no }}</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p class="text-muted mb-0">Estimate Date : {{ $order->estimate_date}}</p>
                        </div>

                    </div>
                    <div class="card-footer border-0 px-4 py-5"
                        style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                            paid: <span class="h4 mb-0 ms-2">Rs. {{ $order->total_price }}</span></h5>

                        <a href="{{route('user.order')}}" class="btn btn-secondary">Go Back</a>



                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        // after button clicked wants to disappear
    </script>
</section>

@endsection