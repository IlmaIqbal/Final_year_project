@extends($layout)

@section('title')
Add Products
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Product</h3>
        <div class="card-tools">
            <a href="{{route('products.index')}}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all
                Products</a>
        </div>
    </div>

    <form method="POST" action="{{ route('product.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="product_type">Product Type</label>
                <select id="product_type" class="form-select @error('product_type') is-invalid @enderror"
                    name="product_type" value="{{ old('product_type') }}" required autocomplete="product_type"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <option selected>Choose...</option>
                    <option value="Gift">Gift</option>
                    <option value="Bouquet">Bouquet</option>
                    <option value="Wrapping_Paper">Wrapping Paper</option>
                </select>
                @error('product_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required placeholder="Product Name" autocomplete="name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Detail</label>
                <textarea type="text" name="detail" class="form-control @error('detail') is-invalid @enderror "
                    placeholder="Product Detail" id="detail" value="{{ old('detail') }}" required style="height: 100px"
                    autocomplete="detail"></textarea>
                @error('detail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control @error('category') is-invalid @enderror "
                    placeholder="Enter your Category " id="category" value="{{ old('category') }}" required
                    autocomplete="category">
                @error('category')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Reorder Level</label>
                <input type="number" name="reorder_level" id="reorder_level"
                    class="form-control @error('reorder_level') is-invalid @enderror" value="{{ old('reorder_level') }}"
                    required placeholder="Product Reorder Level" autocomplete="quantity">
                @error('reorder_level')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Product</button>
        </div>
    </form>
</div>






@endsection