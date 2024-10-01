@extends('admin.navbar')

@section('title')
Add Gifts
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Gift</h3>
        <div class="card-tools">
            <a href="{{route('products.gift')}}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all Gifts</a>
        </div>
    </div>

    <form method="POST" action="{{ route('gift.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Gift Name" autocomplete="name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Detail</label>
                <textarea type="text" name="detail" class="form-control @error('detail') is-invalid @enderror " placeholder="Gift Detail" id="detail" value="{{ old('detail') }}" required style="height: 100px" autocomplete="detail"></textarea>
                @error('detail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control @error('category') is-invalid @enderror " placeholder="Enter your Category " id="category" value="{{ old('category') }}" required autocomplete="category">
                @error('category')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Qty</label>
                <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" required placeholder="Gift Quantity" autocomplete="quantity">
                @error('quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Price</label>
                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required placeholder="Gift Price" autocomplete="price">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Gift Image</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Gift</button>
        </div>
    </form>
</div>






@endsection