@extends('admin.navbar')

@section('title')
All Division
@endsection
@section('content')
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<style>
    @import url('https://fonts.googleapis.com/css?family=Assistant');

    body {
        background: #eee;
        font-family: Assistant, sans-serif;
    }

    .cell-1 {
        border-collapse: separate;
        border-spacing: 0 4em;
        background: #fff;
        border-bottom: 5px solid transparent;
        /*background-color: gold;*/
        background-clip: padding-box;
    }

    thead {
        background: #dddcdc;
    }

    .toggle-btn {
        width: 40px;
        height: 21px;
        background: grey;
        border-radius: 50px;
        padding: 3px;
        cursor: pointer;
        -webkit-transition: all 0.3s 0.1s ease-in-out;
        -moz-transition: all 0.3s 0.1s ease-in-out;
        -o-transition: all 0.3s 0.1s ease-in-out;
        transition: all 0.3s 0.1s ease-in-out;
    }

    .toggle-btn>.inner-circle {
        width: 15px;
        height: 15px;
        background: #fff;
        border-radius: 50%;
        -webkit-transition: all 0.3s 0.1s ease-in-out;
        -moz-transition: all 0.3s 0.1s ease-in-out;
        -o-transition: all 0.3s 0.1s ease-in-out;
        transition: all 0.3s 0.1s ease-in-out;
    }

    .toggle-btn.active {
        background: blue !important;
    }

    .toggle-btn.active>.inner-circle {
        margin-left: 19px;
    }

    .img_size {
        width: 100px;
        height: 100px;
    }
</style>

<div class="container mt-5">
    <h3>District Name : {{ $district->name }} </h3>
    <br>
    <a href="{{route('province.districtTable', ['province_id' => $district->province_id])}}"
        class="btn btn-secondary">Go Back</a>

    @if ($district->province->status != 1 || $district->status != 1)

    @else
    <a href="{{ route('district.edit', $district->district_id)}}" class="btn btn-warning">Edit</a>
    @endif

    <div class="d-flex justify-content-center row">
        <div class="card-tools">
            <br>
            <h2 class="card-title">Division Table </h2>
            <br>
            @if ($district->province->status != 1 || $district->status != 1)

            @else
            <a href="{{ route('province.division',['district_id' => $district->district_id])}}" class="btn btn-primary">
                Add Division</a>
            @endif

        </div>


        <div class="card-tools">
        </div>
        <div class="col-md-10">
            <div class="rounded">
                <div class="table-responsive table-borderless">
                    <table class="table">
                        <thead>
                            <br>
                            <tr>
                                <th>#</th>
                                <th>Divisions Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($division as $divisions)
                        <tbody class="table-body">
                            <tr class="cell-1">
                                <td>{{ $divisions->division_id }}</td>

                                <td>{{ $divisions->name}}</td>

                                <td>
                                    @if ($district->province->status != 1 || $district->status != 1)

                                    @else

                                    @if ($divisions->status == 1)
                                    <a href="{{ route('division.edit', $divisions->division_id)}}"
                                        class="btn btn-warning">Edit</a>
                                    <Form action="{{ route('division.disable', $divisions->division_id) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Disable</button>

                                    </Form>
                                    @else
                                    <form action="{{ route('division.enable',  $divisions->division_id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Enable</button>
                                    </form>
                                    @endif

                                    @endif


                                </td>
                            </tr>

                        </tbody>
                        @endforeach




                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection