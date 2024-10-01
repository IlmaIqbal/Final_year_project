@extends('admin.navbar')

@section('title')
Customers
@endsection
@section('content')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Customer Table</h3>
                <div class="card-tools">
                    <a href="{{ route('customer.addNew') }}" class="btn btn-primary">Create New Customer</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Start Date</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $user )

                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->address1}} {{$user->address2}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <a href="" class="btn btn-sm btn-info">Edit Details</a>
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
{{ $customers->links() }}

@endsection