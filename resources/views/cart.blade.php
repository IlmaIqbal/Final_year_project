@extends('user.home')

@section('content')

<style>
    .img_deg {
        height: 200px;
        width: 200px;
    }
</style>

<section class="h-100 h-custom">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="h5">Image</th>
                                <th scope="col" class="h5">Shopping Items</th>
                                <th scope="col" class="h5">Price</th>
                                <th scope="col" class="h5">Quantity</th>
                                <th scope="col" class="h5">Action</th>
                            </tr>
                        </thead>

                        <?php $total_price = 0; ?>

                        @foreach ($cart as $cart)

                        <tbody id="cart-items">
                            <td><img class="img_deg" src="/image/{{ $cart->image }}"></td>
                            <td>{{$cart->product_name}}</td>
                            <td>Rs.{{ number_format($cart->price / $cart->quantity, 2) }} X {{$cart->quantity}} = Rs.{{$cart->price}}</td>
                            <td>{{$cart->quantity}}</td>
                            <td><a href="{{route('remove_cart', $cart->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to remove this Item?')"><i class="fas fa-trash-alt"></i></a></td>

                        </tbody>
                        <?php $total_price = $total_price + $cart->price ?>

                        @endforeach

                    </table>
                </div>

                <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-4 col-xl-3">



                                <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                                    <p class="mb-2">Total</p>
                                    <p class="mb-2" id="total">Rs.{{ number_format($total_price, 2)}}</p>
                                </div>


                                <a href="{{route('user.payment')}}" class="btn btn-primary">
                                    <span>Checkout</span>
                                </a>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


    </div>
</section>


@endsection