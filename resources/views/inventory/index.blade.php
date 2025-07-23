@extends($layout)

@section('title')
Bouquet
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


<div class="page-content page-container" id="page-content">
    <div class="">
        <form action="{{ route('inventory.search') }}" method="GET" class="mb-3">
            <input type="text" name="search" placeholder="Search......!">
            <input type="date" name="from_date" value="{{ request('from_date') }}">
            <input type="date" name="to_date" value="{{ request('to_date') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <div class="row  d-flex justify-content-center">
            <div class="grid-margin stretch-card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Products Details</h4>
                            <div class="card-tools col-12 ">
                                <a href="{{ route('inventory.create')}}" class="btn btn-primary">Create Product</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product </th>
                                            <th>Supplier</th>
                                            <th>Received Date</th>
                                            <th>Purchase Price</th>
                                            <th>Selling Price</th>
                                            <th>Qty</th>
                                            <th>Discount</th>
                                            <th>Issue Qty</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $index => $product)
                                        <tr>
                                            <td>{{$index + 1 }}</td>
                                            <td>{{$product->product->name ?? 'N/A'}}</td>
                                            <td>{{$product->supplier->user->name ?? 'N/A'}}</td>
                                            <td>{{$product -> r_date }}</td>
                                            <td>{{$product -> p_price }}</td>
                                            <td>{{$product -> sell_price }}</td>
                                            <td>{{$product -> qty }}</td>
                                            <td>{{$product -> discount }}</td>
                                            <td>{{$product -> issue_qty }}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-4">
    {!! $products->links('pagination::bootstrap-5') !!}
</div>
@endsection