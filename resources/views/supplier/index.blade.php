@extends('admin.navbar')

@section('title')
Customers
@endsection
@section('content')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Supplier Table</h3>
                <div class="card-tools">
                    <a href="{{ route('supplier.create') }}" class="btn btn-primary">Create New Supplier</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Mobile No</th>
                            <th>Email</th>
                            <th>Start Date</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supplier as $index => $user )

                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->address1}} {{$user->address2}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                @if ($user->active)
                                <form action="{{ route('supplier.disable', $user->id) }}" method="POST"
                                    class="d-inline">

                                    <a href="{{ route('supplier.edit', $user->id)}}" class="btn btn-sm btn-info">Edit
                                        Details</a>

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Disable</button>
                                </form>
                                @else
                                <form action="{{ route('supplier.enable', $user->id) }}" method="POST" class="d-inline">
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

@endsection