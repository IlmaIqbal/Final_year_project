@extends('admin.navbar')

@section('title')
Employee Registration
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('employee.store' ) }}">
                        @csrf

                        <div class="row mb-3">

<<<<<<< HEAD
                            <div class="col-md-2">
                                <label for="name" class="col-form-label text-md-end">{{ __('Name') }}</label>
                            </div>
                            <div class="col-md-4">
                                <input id="name" type="text" onkeypress="return isTextKey(event)"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
=======
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

<<<<<<< HEAD
                            <div class="col-md-2">
                                <label for="nic" class="col-form-label text-md-end">{{ __('NIC') }}</label>
                            </div>
                            <div class="col-md-4">

                                <input id="txtnic" type="text" class="form-control @error('nic') is-invalid @enderror"
                                    name="nic" value="{{ old('nic') }}" onblur="nicnumber()" required autocomplete="nic"
                                    autofocus>
=======
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76

                                @error('nic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="dob" class="col-form-label text-md-end">{{ __('Data of Birth') }}</label>
                            </div>
                            <div class="col-md-4">
                                <input id="txtdob" type="date" class="form-control @error('dob') is-invalid @enderror"
                                    name="dob" value="{{ old('dob') }}" required autocomplete="dob">

<<<<<<< HEAD
                                @error('Day of Birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="gender" class="col-form-label text-md-end">{{ __('Gender ') }}</label>
                            </div>
                            <div class="col-md-4">
                                <input id="txtgender" type="text"
                                    class="form-control @error('gender') is-invalid @enderror" name="gender"
                                    value="{{ old('gender') }}" required autocomplete="gender">
=======
                            <div class="col-md-6">
                                <input id="nic" type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="nic" value="{{ old('nic') }}" required autocomplete="nic">
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
<<<<<<< HEAD

                            <div class="col-md-2">
                                <label for="email" class="col-form-label text-md-end">{{ __('Email ') }}</label>
                            </div>
                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" onblur="emailValidation()" value="{{ old('email') }}" required
                                    autocomplete="email">
=======
                            <label for="phone"
                                class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}" required autocomplete="phone">
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="phone" class="col-form-label text-md-end">{{ __('Mobile') }}</label>
                            </div>
                            <div class="col-md-4">
                                <input id="phone" type="text" onkeypress="return isNumberKey(event)"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone') }}" required autocomplete="phone"
                                    onblur="phoneNumber('phone')">

<<<<<<< HEAD
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
=======
                            <div class="col-md-6">
                                <select id="role" class="form-select @error('role') is-invalid @enderror" name="role"
                                    value="{{ old('role') }}" required autocomplete="role" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <option selected>Choose...</option>
                                    <option value="deliver">Deliver</option>
                                    <option value="front_office">Front Office</option>
                                    <option value="product_manager">Product Manager</option>
                                    <option value="stock_keeper">Stock Keeper</option>
                                    <option value="cashier">Cashier</option>

                                </select>
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76
                            </div>
                        </div>
                        <div class="row mb-3">
<<<<<<< HEAD

                            <div class="col-md-2">
                                <label for="address" class="col-form-label text-md-end">{{ __('Address') }}</label>
                            </div>
                            <div class="col-md-4">
                                <input id="address1" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address1"
                                    value="{{ old('address') }}" required autocomplete="address">
                                <br>
                                <input id="address2" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address2"
                                    value="{{ old('address') }}" required autocomplete="address">
=======
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">

<<<<<<< HEAD
                                <label for="role" class="col-form-label text-md-right ">{{ __('Designation') }}</label>
                            </div>
                            <div class="col-md-4">
                                <select id="role" class="form-select @error('role') is-invalid @enderror" name="role"
                                    value="{{ old('role') }}" required autocomplete="role" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <option value="" selected>Choose...</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager_assistant">Manager Assistant</option>
                                    <option value="deliver">Deliver</option>
                                    <option value="front_office">Front Office</option>
                                    <option value="product_manager">Product Manager</option>
                                    <option value="stock_keeper">Stock Keeper</option>
                                    <option value="cashier">Cashier</option>

                                </select>

                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
=======
                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
>>>>>>> f1c4650e72b838410c295a1ed7df16871068ee76
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="reset" class="btn btn-primary">
                                    {{ __('Clear') }}
                                </button>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    //this is for text validation
    function isTextKey(evt) // only text to allow the input field
    {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || charCode == 127 ||
                charCode == 32 || charCode == 46) && (!(evt.ctrlKey && (charCode == 118 || charCode == 86))))
            return true;

        return false;
    }

    //this is for number validation
    function isNumberKey(evt) // only numbers to allow the input field
    {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

    function phoneNumber(mobile_text_box_name) // Mobile No 
    {
        var phoneNo = /^\d{10}$/;
        if (document.getElementById(mobile_text_box_name).value == "") {} else {
            if (document.getElementById(mobile_text_box_name).value.match(phoneNo)) {
                hand(mobile_text_box_name);
            } else {
                alert("Enter 10 digit Mobile Number");
                document.getElementById(mobile_text_box_name).value = "";
                document.getElementById(mobile_text_box_name).focus() = true;
                return false;
            }
        }
    }

    function hand(mobile_text_box_name) {
        var str = document.getElementById(mobile_text_box_name).value;
        var res = str.substring(0, 2);
        if (res == "07") {
            return true;
        } else {
            alert("Enter 10 digit of Mobile Number start with 07xxxxxxxx");
            document.getElementById(mobile_text_box_name).value = "";
            document.getElementById(mobile_text_box_name).focus() = true;
            return false;
        }
    }
    //check email validation format
    function emailValidation() {
        var email = document.getElementById("email").value;
        var emailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (email.match(emailformat)) {

        } else if (email.length == 0) {

        } else {
            alert("Email Address is Invalid");
            document.getElementById("email").value = "";
            document.getElementById("email").focus() = true;
        }
    }

    //nic format validation
    function nicnumber() {
        var nic = document.getElementById("txtnic").value;
        if (nic.length == 10) {
            var nicformat1 = /^[0-9]{9}[a-zA-Z0-9]{1}$/;
            if (nic.match(nicformat1)) {
                var nicformat2 = /^[0-9]{9}[vVxX]{1}$/;
                if (nic.match(nicformat2)) {
                    calculatedob(nic);
                } else {
                    alert("last character must be V/v/X/x");
                    document.getElementById("txtnic").value = "";
                    document.getElementById("txtnic").focus();
                    document.getElementById("txtdob").value = "";
                }
            } else {
                alert("First 9 characters must be numbers");
                document.getElementById("txtnic").value = "";
                document.getElementById("txtnic").focus();
                document.getElementById("txtdob").value = "";
            }
        } else if (nic.length == 12) {
            var nicformat3 = /^[0-9]{12}$/;
            if (nic.match(nicformat3)) {
                calculatedob(nic);
            } else {
                alert("All 12 characters must be number");
                document.getElementById("txtnic").value = "";
                document.getElementById("txtnic").focus();
                document.getElementById("txtdob").value = "";
            }
        } else if (nic.length == 0) {

        } else {
            alert("NIC No must be 10 or 12 Characters");
            document.getElementById("txtnic").value = "";
            document.getElementById("txtnic").focus();
            document.getElementById("txtdob").value = "";
        }
    }

    //send nic to ajaxpage for get dob
    function calculatedob(nic) {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {

            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                document.getElementById("txtdob").value = xmlhttp.responseText.trim();
                if (nic.length == 10) {
                    var bday_num = nic.substring(2, 5);
                } else {
                    var bday_num = nic.substring(4, 7);
                }
                if (bday_num > 500) {
                    var gender = "Female";
                } else {
                    var gender = "Male";
                }
                document.getElementById("txtgender").value = gender;
            }
        };

        xmlhttp.open(
            "GET",
            "{{ url('/ajaxpage') }}?frompage=dob&dobcal=" + nic,
            true
        );
        xmlhttp.send();
    }
</script>
@endsection