@extends('admin.navbar')

@section('title')
Wrapping Paper and Boxes
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Gift</h3>
        <div class="card-tools">
            <a href="{{route('wrapping.wrapping')}}" class="btn btn-danger">Back</a>
        </div>
    </div>

    <form method="POST" action="{{ route('wrapping.update',$wrapping_paper->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $wrapping_paper->name }}"
                    placeholder="Wrapping Paper Name">

            </div>

            <div class="form-group">
                <label for="name">Detail</label>
                <textarea type="text" name="detail" class="form-control" id="detail" style="height: 280px"
                    placeholder="Wrapping Paper Detail">{{ $wrapping_paper->detail }}</textarea>

            </div>
            <div class="form-group">
                <label for="name">Qty</label>
                <input type="number" name="quantity" id="quantity" class="form-control"
                    value="{{ $wrapping_paper->quantity }}" placeholder="Wrapping Paper Quantity">

            </div>
            <div class="form-group">
                <label for="name">Price</label>
                <input type="number" name="price" id="price" class="form-control " value="{{ $wrapping_paper->price }}"
                    placeholder="Wrapping Paper Price">

            </div>
            <div class="form-group">
                <img src="/image/wrapping_paper/{{ $wrapping_paper->image }}" width="300px">
                <input type="file" class="form-control-file" name="image" id="image">

            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
        </div>
    </form>
</div>

@endsection