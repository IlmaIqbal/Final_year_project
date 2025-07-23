@extends('admin.navbar')

@section('title')
Employee Registration
@endsection

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Supplier Details</h3>
        <div class="card-tools">
            <a href="{{route('supplier.index')}}" class="btn btn-danger">Back</a>
        </div>
    </div>

    <form method="POST" action="{{ route('supplier.update',$user->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}"
                    placeholder="Name">

            </div>

            <div class="form-group">
                <label for="address">Address Line 1</label>
                <input type="text" name="address1" class="form-control" id="address1" value="{{ $user->address1 }}"
                    placeholder="Address Line 1">

            </div>
            <div class="form-group">
                <label for="address">Address Line 2</label>
                <input type="text" name="address2" class="form-control" id="address2" value="{{ $user->address2 }}"
                    placeholder="Address Line 2">
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}"
                    placeholder="Email">

            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="number" name="phone" id="phone" class="form-control" value="{{ $user->phone }}"
                    placeholder="Phone number">

            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
        </div>
    </form>
</div>
@endsection