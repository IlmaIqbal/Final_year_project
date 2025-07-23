@extends($layout)

@section('title')
Bouquet
@endsection
@section('content')




<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row  d-flex justify-content-center">
            <div class="grid-margin stretch-card">
                <div class="">
                    <div class="card-body">
                        <h4 class="card-title">Stock Details</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product </th>
                                        <th>Available Qty</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $index => $product)

                                    @php
                                    $availableQty = $product->total_qty - $product->total_issued
                                    @endphp

                                    <tr
                                        class="{{$availableQty <= $product->product->reorder_level ? 'table-danger' : 'table-success' }}">
                                        <td>{{$index + 1 }}</td>
                                        <td>{{$product->product->name ?? 'N/A'}}</td>
                                        <td>{{$availableQty}}</td>
                                        <td><a href=" {{ route('reorders.create', ['inventoryId' => $product->product->id]) }} "
                                                onclick="return confirm('Do you want to reorder?')"
                                                class="btn btn-secondary">Reorder Now</a>
                                        </td>

                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <input type="hidden" name="supplier_id" id="supplier_id">

<script>
    function setSupplierId(select) {
        const supplierId = select.options[select.selectedIndex].getAttribute('data-supplier');
        document.getElementById('supplier_id').value = supplierId;
    }
</script> -->
@endsection