@extends('admin.navbar')

@section('title')
Customers
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Gift</h3>
        <div class="card-tools">
            <a href="{{route('wrapping.wrapping')}}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all
                Wrapping Papers</a>
        </div>
    </div>

    <form method="POST" action="{{ route('wrapping.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required placeholder="Wrapping Paper Name" autocomplete="name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Detail</label>
                <textarea type="text" name="detail" class="form-control @error('detail') is-invalid @enderror "
                    placeholder="Wrapping Paper Detail" id="detail" value="{{ old('detail') }}" required
                    style="height: 100px" autocomplete="detail"></textarea>
                @error('detail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Qty</label>
                <input type="number" name="quantity" id="quantity"
                    class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" required
                    placeholder="Wrapping Paper Quantity" autocomplete="quantity">
                @error('quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Price</label>
                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror"
                    value="{{ old('price') }}" required placeholder="Wrapping Paper Price" autocomplete="price">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Wrapping Paper Image</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Wrapping Paper</button>
        </div>
    </form>
</div>






@endsection