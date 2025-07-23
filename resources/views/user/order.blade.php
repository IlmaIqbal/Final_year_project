@extends('nav')

@section('content')


<style>
    body {
        background-color: #f9f9fa
    }

    .flex {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto
    }

    @media (max-width:991.98px) {
        .padding {
            padding: 1.5rem
        }
    }

    @media (max-width:767.98px) {
        .padding {
            padding: 1rem
        }
    }

    .padding {
        padding: 5rem
    }

    .card {
        box-shadow: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        -ms-box-shadow: none
    }

    .pl-3,
    .px-3 {
        padding-left: 1rem !important
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid #d2d2dc;
        border-radius: 0
    }

    .card .card-title {
        color: #000000;
        margin-bottom: 0.625rem;
        text-transform: capitalize;
        font-size: 0.875rem;
        font-weight: 500
    }

    .card .card-description {
        margin-bottom: .875rem;
        font-weight: 400;
        color: #76838f
    }

    p {
        font-size: 0.875rem;
        margin-bottom: .5rem;
        line-height: 1.5rem
    }

    .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar
    }

    .table,
    .jsgrid .jsgrid-table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent
    }

    .table thead th,
    .jsgrid .jsgrid-table thead th {
        border-top: 0;
        border-bottom-width: 1px;
        font-weight: 500;
        font-size: .875rem;
        text-transform: uppercase
    }

    .table td,
    .jsgrid .jsgrid-table td {
        font-size: 0.875rem;
        padding: .875rem 0.9375rem
    }

    .badge {
        border-radius: 0;
        font-size: 12px;
        line-height: 1;
        padding: .375rem .5625rem;
        font-weight: normal
    }
</style>




<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row  d-flex justify-content-center">
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="">
                    <div class="card-body">
                        <h4 class="card-title">Order Details</h4>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Order Number</th>

                                        <th>Total Price</th>
                                        <th>Payment</th>
                                        <th>Paid At</th>
                                        <th>Delivered At</th>
                                        <th>Delivery Status</th>
                                        <th> </th>
                                        <th> </th>

                                    </tr>
                                </thead>
                                @foreach ($orders as $order )

                                <tbody>
                                    <tr>
                                        <td>{{$order->user_name}}</td>
                                        <td>{{$order->user_email}}</td>
                                        <td>{{$order->user_address}}</td>
                                        <td>{{$order->id}}</td>
                                        <td> Rs.{{$order->total_price}} </td>
                                        <td>
                                            @if ($order->payment=="Pending")
                                            <label class="badge badge-warning">{{$order->payment}}</label>

                                            @else
                                            <label class="badge badge-success">{{$order->payment}}</label>

                                            @endif

                                        </td>
                                        <td>{{$order->paid_at}}</td>
                                        <td>
                                            @if ($order->updated_at != $order->created_at)
                                            {{$order->updated_at}}
                                            @endif

                                        </td>

                                        <td>
                                            @if ($order->delivery=="Processing")
                                            <label class="badge badge-warning">{{$order->delivery}}</label>

                                            @else
                                            <label class="badge badge-success">{{$order->delivery}}</label>

                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ route('user.order-details', ['orderId' => $order->id]) }}"
                                                class="btn btn-primary">View</a>
                                        </td>
                                        <td>
                                            @if ($order->payment_method == "BankTransfer")
                                            <a href="{{ route('user.bank_recipe', ['orderId' => $order->id]) }}"
                                                class="btn btn-success">Bank Recipe</a>

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
    </div>
</div>
<div class="d-flex justify-content-center mt-4">
    {!! $orders->links('pagination::bootstrap-5') !!}
</div>
@endsection