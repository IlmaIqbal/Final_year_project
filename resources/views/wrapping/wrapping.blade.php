@extends('admin.navbar')

@section('title')
Wrapping Paper
@endsection
@section('content')


<div class="row">
    <div class=" col-md-6">
        <div class="form-group">
            <form method="GET" action="{{ route('wrapping.search') }}">
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
                <h3 class="card-title">Wrapping Paper Table</h3>
                <div class="card-tools">
                    <a href="{{ route('wrapping.wrapping_store')}}" class="btn btn-primary">Add Wrapping Paper</a>
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
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Detail</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th width="100px">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($wrapping_papers as $wrapping_paper )
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img src="/image/wrapping_paper/{{ $wrapping_paper->image }}" width="100px"></td>
                        <td>{{ $wrapping_paper->name}}</td>
                        <td>
                            <div class="small-area">
                                <p>{{ $wrapping_paper->detail}}</p>
                            </div>
                        </td>
                        <td>{{ $wrapping_paper->quantity}}</td>
                        <td>{{ $wrapping_paper->price}}</td>
                        <td>
                            @if ($wrapping_paper->active)
                            <form action="{{ route('wrapping.destroy', $wrapping_paper->id) }}" method="POST"
                                class="d-inline">
                                <a href="{{ route('wrapping.wrapping_show',$wrapping_paper->id) }}"
                                    class="btn btn-secondary">Show</a>

                                <a href="{{ route('wrapping.wrapping_edit',$wrapping_paper->id) }}"
                                    class="btn btn-warning">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Disable</button>
                            </form>
                            @else
                            <form action="{{ route('wrapping_paper.enable', $wrapping_paper->id) }}" method="POST"
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

{!! $wrapping_papers->links() !!}

{{ $wrapping_papers->links() }}

@endsection