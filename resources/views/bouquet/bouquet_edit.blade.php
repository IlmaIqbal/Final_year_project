@extends('admin.navbar')

@section('title')
Bouquet
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Bouquet</h3>
        <div class="card-tools">
            <a href="{{route('bouquet.bouquet')}}" class="btn btn-danger">Back</a>
        </div>
    </div>

    <form method="POST" action="{{ route('bouquet.update',$bouquet->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $bouquet->name }}"
                    placeholder="Bouquet Name">

            </div>

            <div class="form-group">
                <label for="name">Detail</label>
                <textarea type="text" name="detail" class="form-control" id="detail" style="height: 280px"
                    placeholder="Bouquet Detail">{{ $bouquet->detail }}</textarea>
            </div>
            <div class="form-group">
                <label for="name">Qty</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $bouquet->quantity }}"
                    placeholder="Bouquet Quantity">

            </div>
            <div class="form-group">
                <label for="name">Price</label>
                <input type="number" name="price" id="price" class="form-control " value="{{ $bouquet->price }}"
                    placeholder="Bouquet Price">

            </div>
            <div class="form-group">
                <img src="/image/bouquet/{{ $bouquet->image }}" width="300px">
                <input type="file" class="form-control-file" name="image" id="image">

            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
        </div>
    </form>
</div>

@endsection