@extends('front_office.nav_front')

@section('title')
Customers
@endsection
@section('content')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Customer Table</h3>

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

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer_view as $user )

                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->address1}} {{$user->address2}}</td>
                            <td>{{$user->created_at}}</td>

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
{{ $customer_view->links() }}

@endsection