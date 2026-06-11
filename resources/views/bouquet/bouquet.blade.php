@extends('admin.navbar')

@section('title')
Bouquet
@endsection
@section('content')


<div class="row">
    <div class=" col-md-6">
        <div class="form-group">
            <form method="GET" action="{{ route('bouquet.search') }}">
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
                <h3 class="card-title">Bouquet Table</h3>
                <div class="card-tools">
                    <a href="{{ route('bouquet.bouquet_store')}}" class="btn btn-primary">Create Bouquet</a>
                </div>
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
                        <th>Name</th>
                        <th>Detail</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th width="100px">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($bouquets as $bouquet )
                    <tr>
                        <td><img src="/image/bouquet/{{ $bouquet->image }}" width="100px"></td>
                        <td>{{ $bouquet->name}}</td>
                        <td>
                            <div class="small-area">
                                <p>{{ $bouquet->detail}}</p>
                            </div>
                        </td>
                        <td>{{ $bouquet->quantity}}</td>
                        <td>{{ $bouquet->price}}</td>
                        <td>
                            @if ($bouquet->active)
                            <form action="{{ route('bouquet.destroy',$bouquet->id) }}" method="POST" class="d-inline">
                                <a href="{{ route('bouquet.bouquet_show',$bouquet->id) }}"
                                    class="btn btn-secondary">Show</a>

                                <a href="{{ route('bouquet.bouquet_edit',$bouquet->id) }}"
                                    class="btn btn-warning">Edit</a>

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Disable</button>
                            </form>
                            @else
                            <form action="{{ route('bouquet1.enable', $bouquet->id) }}" method="POST" class="d-inline">
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

{!! $bouquets->links() !!}

{{ $bouquets->links() }}

@endsection