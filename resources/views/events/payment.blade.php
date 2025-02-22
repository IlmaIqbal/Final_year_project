@extends('admin.navbar')

@section('title')
Payment
@endsection

@section('content')

<div class="container">


    <div class="row d-flex justify-content-left py-5">
        <h2>Payment for Event: Wedding</h2>
        <p>Customer Name: Kamal Bandara</p>
        <p>Customer Email: Kamal@gmail.com</p>
        <p>Venue Price: Rs. 100000</p>
        <p>Catering services Price: Rs. 150000</p>
        <p>Total Price: Rs. 250000</p>
        <div class="col-md-7 col-lg-5 col-xl-4">
            <div class="card" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <form>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" id="typeText" class="form-control form-control-lg" siez="17" placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                                <label class="form-label" for="typeText">Card Number</label>
                            </div>
                            <img src="https://img.icons8.com/color/48/000000/visa.png" alt="visa" width="64px" />
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" id="typeName" class="form-control form-control-lg" siez="17" placeholder="Cardholder's Name" />
                                <label class="form-label" for="typeName">Cardholder's Name</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-2">
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                                <label class="form-label" for="typeExp">Expiration</label>
                            </div>
                            <div data-mdb-input-init class="form-outline">
                                <input type="password" id="typeText2" class="form-control form-control-lg" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                                <label class="form-label" for="typeText2">Cvv</label>
                            </div>
                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-rounded">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection