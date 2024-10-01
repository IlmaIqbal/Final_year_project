<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Profile Update with Image profile upload using jquery ajax</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/admin/home') }}">
                User Profile
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ">
                    <!-- Authentication Links -->



                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="bi bi-person-fill"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                </ul>


            </div>
        </div>
    </nav>
    <!-- Modal -->

    <div class="container rounded bg-white mt-5 mb-5">
        <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('updateProfile') }}">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        @php($profile_image = auth()->user()->profile_image)
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <img class="rounded-circle mt-5" width="150px" src="@if($profile_image == null) {{ asset("storage/profile_images/no-pic.png") }}  @else {{ asset("storage/$profile_image") }} @endif" id="image_preview_container">

                        </div>

                        <span class="font-weight-bold">
                            <input type="file" name="profile_image" id="profile_image" class="form-control">
                        </span>



                    </div>
                </div>
                <div class="col-md-8 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row" id="res"></div>
                        <div class="row mt-2">

                            <div class="col-md-6">
                                <label class="labels">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="First name" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Email</label>
                                <input type="text" name="email" disabled class="form-control" value="{{ auth()->user()->email }}" placeholder="Email">
                            </div>
                        </div>
                        <div class="row mt-2">

                            <div class="col-md-6">
                                <label class="labels">Address Line 1</label>
                                <input type="text" name="address1" class="form-control" value="{{ auth()->user()->address1 }}" placeholder="Address Line 1">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Address Line 2</label>
                                <input type="text" name="address2" class="form-control" value="{{ auth()->user()->address2 }}" placeholder="Address Line 2">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ auth()->user()->phone }}">
                            </div>
                        </div>

                        <div class="mt-5 text-center"><button id="btn" class="btn btn-success profile-button" type="submit">Save Profile</button>
                            <a href="{{ route('user.home')}}" class="btn btn-primary">Go Back</a>
                        </div>

                    </div>
                </div>

            </div>

        </form>
        <div class="container mt-5">
            <h4>Change Password</h4>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('user.password.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <br>
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="Enter Current password" required>
                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" placeholder="Enter New Password" required>
                    @error('new_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Enter New password again" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/profileupdate.js') }}"></script>


</body>

</html>