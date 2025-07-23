@extends('cashier.nav_cashier')

@section('content')

@section('title')
Pending Payment Orders
@endsection

@section('content')

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Delivery Address</th>
                                <th>Phone</th>
                                <th>Total Price</th>
                                <th>Payment</th>
                                <th>Delivery</th>
                                <th>Bank Recipe</th>
                                <th>Issue Status</th>
                                <th>Paid At</th>
                                <th>Confirmed At</th>
                                <th>Delivered At</th>
                                <th>Issued At</th>
                                <th>Paid By</th>

                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach ($orders as $order)

                        <tbody class="table-body">
                            <tr class="cell-1">
                                <td>{{$order->id}}</td>

                                <td>{{$order->user_name}}</td>
                                <td>{{$order->user_email}}</td>
                                <td>{{$order->user_address}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->total_price}}</td>
                                <td>
                                    @if ($order->payment=="Pending")
                                    <label class="badge badge-warning">{{$order->payment}}</label>
                                    @else
                                    <label class="badge badge-success">{{$order->payment}}</label>

                                    @endif

                                </td>
                                <td>
                                    @if ($order->delivery=="Processing")
                                    <label class="badge" style="background-color: #8B4513;">{{$order->delivery}}</label>

                                    @elseif ($order->delivery=="Confirmed")
                                    <label class="badge" style="background-color: #013273;">{{$order->delivery}}</label>

                                    @else
                                    <label class="badge "
                                        style="background-color: #063d01;">{{$order->delivery}}</label>

                                    @endif


                                </td>
                                <td>
                                    @if ($order->payment_method=="BankTransfer")
                                    <img src="{{ asset('image/'. $order->image ) }}" width="100px">
                                    @endif
                                </td>
                                <td>
                                    @if ($order->issue_status=="Ongoing")
                                    <label class="badge"
                                        style="background-color: #FFA500;">{{$order->issue_status}}</label>
                                    @else
                                    <label class="badge badge-success">{{$order->issue_status}}</label>

                                    @endif

                                </td>
                                <td>{{$order->paid_at}}</td>
                                <td>
                                    {{$order->confirmed_at}}
                                </td>
                                <td>
                                    {{$order->delivered_at}}
                                </td>
                                <td>
                                    {{$order->issued_at}}
                                </td>
                                <td>
                                    {{$order->paidBy->name ?? '_'}}
                                </td>
                                <td>


                                </td>
                                <td>
                                    <form action="{{ route('cashier.confirmPayment', $order->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success">Confirm Payment</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('admin.order-details', ['orderId' => $order->id]) }}"
                                        class="btn btn-info">View</a>
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
<div class="d-flex justify-content-center mt-4">
    {!! $orders->links('pagination::bootstrap-5') !!}
</div>
@endsection