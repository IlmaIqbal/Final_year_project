@extends('supplier.nav_supplier')

@section('title')
All Reorders
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
</style>
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <div class="rounded">
                <div class="table-responsive table-borderless">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Reorder #</th>
                                <th>Product name</th>
                                <th>Last Received date</th>
                                <th>Request quantity</th>
                                <th>Reorder Date</th>
                                <th>Supplier Approval</th>
                                <th>Supplier Respond At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($reorders as $reorder)

                        <tbody class="table-body">
                            <tr class="cell-1">
                                <td>{{$reorder->id}}</td>
                                <td>{{$reorder->inventory->product->name}}</td>
                                <td>{{$reorder->inventory->r_date}}</td>
                                <td>{{$reorder->requested_qty}}</td>
                                <td>{{$reorder->created_at}}</td>
                                <td>
                                    @if ($reorder->supplier_approved == 0)
                                    <label class="badge badge-warning">Pending</label>
                                    @elseif ($reorder->supplier_approved == 1)
                                    <label class="badge badge-success">Approved</label>
                                    @else
                                    <label class="badge bg-danger">Not Approved</label>

                                    @endif

                                </td>
                                <td>{{$reorder->supplier_approved_at}}</td>

                                <td> @if ($reorder->supplier_approved == 0 )
                                    <form action="{{route('supplier.approve', $reorder->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary mt-2"
                                            onclick="return confirm('Do you approve the request?')">Approval</button>

                                    </form>
                                    <form action="{{ route('supplier.reject', $reorder->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-danger mt-2"
                                            onclick="return confirm('Do you need to reject?')">Not Approval</button>
                                    </form>
                                    @elseif ($reorder->supplier_approved == 1 )
                                    <span class="badge badge-success">Approved</span>
                                    @else
                                    <span class="badge bg-danger">Not Approved</span>
                                    @endif

                                    <br><br>
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
</div>



@endsection