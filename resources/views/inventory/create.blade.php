@extends($layout)

@section('title')
Add Inventory
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Products</h3>
        <div class="card-tools">
            <a href="{{route('inventory.index')}}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all
                Products</a>
        </div>
    </div>

    <form method="POST" action="{{ route('inventory.store')}}" enctype="multipart/form-data">
        @csrf

        <!-- Product Type Dropdown -->
        <div class="form-group">
            <label for="product_type">Product Type</label>
            <select id="product_type" class="form-select" name="product_type" required>
                <option value="">-- Select Type --</option>
                <option value="gift">Gift</option>
                <option value="bouquet">Bouquet</option>
                <option value="wrapping_paper">Wrapping Paper</option>
            </select>
        </div>

        <!-- Product Dropdown (populated dynamically) -->
        <div class="form-group">
            <label for="product_id">Product</label>
            <select id="product" name="product_id" class="form-select" required>
                <option value="">-- Select Product --</option>
            </select>
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="r_date">Received Date</label>
                <input type="text" name="r_date" id="r_date" class="form-control @error('r_date') is-invalid @enderror"
                    value="{{ old('r_date', date('Y-m-d')) }}" required placeholder="Date" autocomplete="date">
                @error('r_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="supplier_id" class="form-label">Select Supplier</label>
                <select class="form-select" name="supplier_id" id="supplier_id" required>
                    <option value="">-- Choose Supplier --</option>
                    @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">
                        {{ $supplier->user->name ?? 'Unnamed Supplier' }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Purchase Price</label>
                <input type="number" name="p_price" id="p_price"
                    class="form-control @error('p_price') is-invalid @enderror" value="{{ old('p_price') }}" required
                    placeholder="Purchase Price" autocomplete="p_price">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Selling Price</label>
                <input type="number" name="sell_price" id="sell_price"
                    class="form-control @error('sell_price') is-invalid @enderror" value="{{ old('sell_price') }}"
                    required placeholder="Selling Price" autocomplete="s_price">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Qty</label>
                <input type="number" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror"
                    value="{{ old('qty') }}" required placeholder="Gift Quantity" autocomplete="qty">
                @error('quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="discount">Discount</label>
                <input type="number" name="discount" id="discount"
                    class="form-control @error('discount') is-invalid @enderror" value="{{ old('discount') }}" required
                    placeholder="Product discount" autocomplete="discount" step="0.01">
                @error('discount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create product</button>
        </div>
    </form>
</div>

<script>
document.getElementById('product_type').addEventListener('change', function() {
    const selectedType = this.value;
    const productDropdown = document.getElementById('product');

    // Clear previous options
    productDropdown.innerHTML = '<option value="">-- Select Product --</option>';

    if (selectedType) {
        fetch(`/products/by-type/${selectedType}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(product => {
                    const option = document.createElement('option');
                    option.value = product.id;
                    option.textContent = product.name;
                    productDropdown.appendChild(option);
                });
            });
    }
});
</script>





@endsection