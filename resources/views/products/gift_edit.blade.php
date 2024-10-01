@extends('admin.navbar')

@section('title')
Gifts
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Gift</h3>
        <div class="card-tools">
            <a href="{{route('products.gift')}}" class="btn btn-danger">Back</a>
        </div>
    </div>

    <form method="POST" action="{{ route('gift.update',$gift->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $gift->name }}" placeholder="Gift Name">

            </div>

            <div class="form-group">
                <label for="name">Detail</label>
                <textarea type="text" name="detail" class="form-control" id="detail" style="height: 280px" placeholder="Gift Detail">{{ $gift->detail }}</textarea>

            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ $gift->category }}" placeholder="category">

            </div>
            <div class="form-group">
                <label for="name">Qty</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $gift->quantity }}" placeholder="Gift Quantity">

            </div>
            <div class="form-group">
                <label for="name">Price</label>
                <input type="number" name="price" id="price" class="form-control " value="{{ $gift->price }}" placeholder="Gift Price">

            </div>
            <div class="form-group">
                <img src="/image/{{ $gift->image }}" width="300px">
                <input type="file" class="form-control-file" name="image" id="image">

            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
        </div>
    </form>
</div>

@endsection