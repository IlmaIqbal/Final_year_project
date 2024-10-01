@extends('admin.home')

@section('title')
Permission
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permission Table</h3>
                <div class="card-tools">
                    <a href="{{ route('permission.create') }}" class="btn btn-primary">Create Permission</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $permission )
                        <tr>
                            <td>{{ $permission->id}}</td>
                            <td>{{ $permission->name}}</td>
                            <td>{{ $permission->created_at}}</td>
                            <td>
                                <a href="{{ route('permission.edit'), $permission->id }}" class="btn btn-sm btn-info">Edit Permission</a>
                            </td>
                        </tr>
                        @empty
                        <tr>Result Not Found</tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection