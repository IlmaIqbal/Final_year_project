@extends($layout)

@section('title')
All Orders
@endsection
@section('content')
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
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
<<<<<<< HEAD
=======
                                <th>Order Status</th>
                                <th>Payment Method</th>
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76
                                <th>Payment</th>
                                <th>Delivery</th>
                                <th>Issue Status</th>
                                <th>Paid At</th>
                                <th>Confirmed At</th>
                                <th>Delivered At</th>
                                <th>Issued At</th>
                                <th>Paid By</th>
<<<<<<< HEAD
                                <th>Delivered</th>
=======
                                <th>Confirmation</th>
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76
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
<<<<<<< HEAD
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
                                    @if ($order->issue_status=="Ongoing")
                                    <label class="badge"
                                        style="background-color: #FFA500;">{{$order->issue_status}}</label>
                                    @else
                                    <label class="badge badge-success">{{$order->issue_status}}</label>
=======
                                    @if ($order->order_status=="Pending")
                                    <label class="badge badge-warning">{{$order->order_status}}</label>
                                    @else
                                    <label class="badge badge-success">{{$order->order_status}}</label>

                                    @endif
                                </td>
                                <td>{{$order->payment_method}}</td>
                                <td>
                                    @if ($order->payment=="Pending")
                                    <label class="badge badge-warning">{{$order->payment}}</label>
                                    @else
                                    <label class="badge badge-success">{{$order->payment}}</label>
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76

                                    @endif

                                </td>
<<<<<<< HEAD
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
                                    <form action="{{route('update_order_status', ['order' => $order->id])}}"
                                        method="post">
                                        @csrf
                                        @method('PUT')

                                        @if($order->delivery=="Processing")

                                        <button class="btn btn-success" type="submit" name="action" value="Confirmed"
                                            onclick="return confirm('Are you sure this product is available on the stack?')">Confirm</button>

                                        @elseif ($order->delivery=="Confirmed")

                                        <button class="btn btn-primary" type="submit" name="action" value="Delivered"
                                            onclick="return confirm('Are you sure this product is delivered?')">Deliver</button>


                                        @else

                                        <p>Delivered</p>

=======
                                <td>
                                    @if ($order->delivery=="Processing")
                                    <label class="badge" style="background-color: #8B4513;">{{$order->delivery}}</label>

                                    @elseif ($order->delivery=="outForDelivery")
                                    <label class="badge" style="background-color: #013273;">{{$order->delivery}}</label>

                                    @else
                                    <label class="badge "
                                        style="background-color: #063d01;">{{$order->delivery}}</label>

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
                                    <form action="{{route('update_order_status', ['order' => $order->id])}}"
                                        method="post">
                                        @csrf
                                        @method('PUT')

                                        @if($order->order_status=="Pending")

                                        <button class="btn btn-success" type="submit" name="action" value="Confirmed"
                                            onclick="return confirm('Are you sure this product is available on the stack?')">Confirm</button>

                                        @elseif ($order->order_status=="Confirmed")
                                        <span>Confirmed</span>
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76
                                        @endif
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