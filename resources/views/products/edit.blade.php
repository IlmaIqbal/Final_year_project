@extends($layout)

@section('title')
Products
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Product</h3>
        <div class="card-tools">
            <a href="{{route('products.index')}}" class="btn btn-danger">Back</a>
        </div>
    </div>

    <form method="POST" action="{{ route('product.update',$product->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="product_type">Product Type</label>
                <select id="product_type" class="form-select" name="product_type" required autocomplete="product_type"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <option value="Gift" {{ $product->product_type == 'Gift' ? 'selected' : ''}}>Gift</option>
                    <option value="Bouquet" {{ $product->product_type == 'Bouquet' ? 'selected' : ''}}>Bouquet</option>
                    <option value="Wrapping_Paper" {{ $product->product_type == 'Wrapping_Paper' ? 'selected' : ''}}>
                        Wrapping Paper</option>
                </select>

            </div>


            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}"
                    placeholder="Product name">

            </div>

            <div class="form-group">
                <label for="product_type">Detail</label>
                <textarea type="text" name="detail" class="form-control" id="detail" style="height: 280px"
                    placeholder="PRODUCT Detail">{{ $product->detail }}</textarea>

            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ $product->category }}"
                    placeholder="category">

            </div>
            <div class="form-group">
                <label for="reorder_level">Reorder Level</label>
                <input type="number" name="reorder_level" id="reorder_level" class="form-control"
                    value="{{ $product->reorder_level }}" placeholder="Product Reorder Level">

            </div>

            <div class="form-group">
                <img src="{{asset('image/' .$product->image )}}" width="300px">
                <input type="file" class="form-control-file" product_type="image" name="image" id="image">

            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
        </div>
    </form>
</div>

@endsection