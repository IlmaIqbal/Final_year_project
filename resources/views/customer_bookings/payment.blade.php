@extends('nav')

@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif
        }

        .container {
            margin: 30px auto;
        }

        .container .card {
            width: 100%;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            background: #fff;
            border-radius: 0px;
        }

        body {
            background: #eee
        }



        .btn.btn-primary {
            background-color: #ddd;
            color: black;
            box-shadow: none;
            border: none;
            font-size: 20px;
            width: 100%;
            height: 100%;
        }

        .btn.btn-primary:focus {
            box-shadow: none;
        }

        .container .card .img-box {
            width: 80px;
            height: 50px;
        }

        .container .card img {
            width: 100%;
            object-fit: fill;
        }

        .container .card .number {
            font-size: 24px;
        }

        .container .card-body .btn.btn-primary .fab.fa-cc-paypal {
            font-size: 32px;
            color: #3333f7;
        }

        .fab.fa-cc-amex {
            color: #1c6acf;
            font-size: 32px;
        }

        .fab.fa-cc-mastercard {
            font-size: 32px;
            color: red;
        }

        .fab.fa-cc-discover {
            font-size: 32px;
            color: orange;
        }

        .c-green {
            color: green;
        }

        .box {
            height: 40px;
            width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ddd;
        }

        .btn.btn-primary.payment {
            background-color: #1c6acf;
            color: white;
            border-radius: 0px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 24px;
        }


        .form__div {
            height: 50px;
            position: relative;
            margin-bottom: 24px;
        }

        .form-control {
            width: 100%;
            height: 45px;
            font-size: 14px;
            border: 1px solid #DADCE0;
            border-radius: 0;
            outline: none;
            padding: 2px;
            background: none;
            z-index: 1;
            box-shadow: none;
        }

        .form__label {
            position: absolute;
            left: 16px;
            top: 10px;
            background-color: #fff;
            color: #80868B;
            font-size: 16px;
            transition: .3s;
            text-transform: uppercase;
        }

        .form-control:focus+.form__label {
            top: -8px;
            left: 12px;
            color: #1A73E8;
            font-size: 12px;
            font-weight: 500;
            z-index: 10;
        }

        .form-control:not(:placeholder-shown).form-control:not(:focus)+.form__label {
            top: -8px;
            left: 12px;
            font-size: 12px;
            font-weight: 500;
            z-index: 10;
        }

        .form-control:focus {
            border: 1.5px solid #1A73E8;
            box-shadow: none;
        }
    </style>

    <div class="container">
        <div class="row">



            <div class="col-12 mt-4">
                <div class="card p-3">
                    <p class="mb-0 fw-bold h4">Payment Methods</p>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-3">
                    <div class="card-body border p-0">


                    </div>
                    <div class="card-body border p-0">
                        <p>
                            <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                                data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                                aria-controls="collapseExample">
                                <span class="fw-bold">Card Payment</span>
                            </a>
                        </p>
                        <div class="collapse show p-3 pt-0" id="collapseExample">
                            <div class="row">
                                <div class="col-lg-7">
                                    <form action="" class="form">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form__div">
                                                    @error('card_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <input type="text"
                                                        class="form-control @error('card_number') is-invalid @enderror"
                                                        placeholder=" " maxlength="16" value="{{ old('card_number') }}"
                                                        required autocomplete="card_number">
                                                    <label for="card_number" class="form__label">Card Number</label>

                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form__div">

                                                    <input type="text"
                                                        class="form-control @error('m_d') is-invalid @enderror"
                                                        placeholder="MM/YY" maxlength="5" value="{{ old('m_d') }}"
                                                        pattern="^(0[1-9]|1[0-2])/(19|20)\d\d$" required
                                                        autocomplete="m_d">

                                                    @error('m_d')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <label for="m_d" class="form__label">MM / yy</label>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form__div">
                                                    @error('cvv_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <input type="password"
                                                        class="form-control @error('cvv_number') is-invalid @enderror"
                                                        placeholder=" " maxlength="3" value="{{ old('cvv_number') }}"
                                                        required autocomplete="cvv_number">
                                                    <label for="cvv_number" class="form__label">cvv code</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form__div">
                                                    @error('name_on_card')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <input type="text"
                                                        class="form-control @error('name_on_card') is-invalid @enderror"
                                                        placeholder=" " value="{{ old('name_on_card') }}" required
                                                        autocomplete="name_on_card">
                                                    <label for="name_on_card" class="form__label">name on the
                                                        card</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <a href="{{ route('customer_bookings.bill') }}" id="pay_now"
                                                    class="btn btn-primary w-100">Pay Now</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="btn btn-primary payment">
                    Make Payment
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('pay_now').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default anchor behavior

            // Retrieve data from local storage
            const eventData = JSON.parse(localStorage.getItem('eventData'));

            if (!eventData) {
                alert("No event data found in local storage!");
                return;
            }

            // Send data to the server
            fetch("{{ route('store.booking') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        eventData
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Booking stored successfully!");
                        window.location.href = "{{ route('customer_bookings.bill') }}"; // Redirect to bill page
                    } else {
                        alert("Error: " + data.error);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred!");
                });
        });
    </script>
</body>

@endsection