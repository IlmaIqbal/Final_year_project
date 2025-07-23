@extends($layout)

@section('title')
products
@endsection
@section('content')


<div class="row">
    <div class=" col-md-6">
        <div class="form-group">
            <form method="GET" action="{{ route('search') }}">
                <div class="input-group">
                    <input class="form-control" name="search" placeholder="Search...."
                        value="{{ isset($search) ? $search : ''}}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">product Table</h3>
                <div class="card-tools">
                    <a href="{{ route('products.store')}}" class="btn btn-primary">Create product</a>
                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>

                        <tr>
                            <th>Image</th>
                            <th>Product Type</th>
                            <th>Name</th>
                            <th>Detail</th>
                            <th>Category</th>
                            <th>Reorder Level</th>
                            <th width="100px">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product )
                        <tr>
                            <td><img src="{{ asset('image/'. $product->image ) }}" width="100px"></td>
                            <td>{{ $product->product_type}}</td>
                            <td>{{ $product->name}}</td>
                            <td>
                                <div class="small-area">
                                    <p>{{ $product->detail}}</p>
                                </div>
                            </td>
                            <td>{{ $product->category}}</td>

                            <td>{{ $product->reorder_level}}</td>
                            <td>
                                @if ($product->active)
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                    class="d-inline">
                                    <a href="{{ route('products.show',$product->id) }}"
                                        class="btn btn-secondary">Show</a>

                                    <a href="{{ route('products.edit',$product->id) }}" class="btn btn-warning">Edit</a>

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Disable</button>
                                </form>
                                @else
                                <form action="{{ route('product.enable', $product->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Enable</button>
                                </form>
                                @endif
                            </td>


                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

</div>

<div class="d-flex justify-content-center mt-4">
    {!! $products->links('pagination::bootstrap-5') !!}
</div>


@endsection