@extends('admin.navbar')

@section('title')
Employees
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Employee Table</h3>
                <div class="card-tools">
                    <a href="{{ route('employee.create') }}" class="btn btn-primary">Create New Employee</a>
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
                            <th>NIC</th>
                            <th>Phone Number</th>
                            <th>Role</th>
                            <th>Start Date</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee_table as $user )
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->nic }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_at }}</td>

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