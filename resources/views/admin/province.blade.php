@extends('admin.navbar')

@section('title')
All Province
@endsection
@section('content')
@if (session('success'))
<div id="success" class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
<div id="error" class="alert alert-danger">{{ session('error') }}</div>
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
    <div class="d-flex justify-content-center row">
        <h3 class="card-title">Province Table</h3>
        <br>
        <div class="card-tools">
            <a href="{{ route('province.create')}}" class="btn btn-primary">Add Province</a>
        </div>
        <div class="col-md-10">
            <div class="rounded">
                <div class="table-responsive table-borderless">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        @foreach ($province as $provinces)
                        <tbody class="table-body">
                            <tr class="cell-1">
                                <td>{{ $provinces->province_id }}</td>

                                <td>{{ $provinces->name}}</td>

                                <td>

                                    <a class="btn btn-info"
                                        href="{{ route('province.districtTable',['province_id' => $provinces->province_id]) }}">
                                        View</a>
                                    @if ($provinces->status)
                                    <a href="{{ route('province.edit', $provinces->province_id)}}"
                                        class="btn btn-warning">Edit</a>
                                    <Form action="{{ route('province.disable', $provinces->province_id) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Disable</button>

                                    </Form>
                                    @else
                                    <form action="{{ route('province.enable',  $provinces->province_id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Enable</button>
                                    </form>
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

<script>
    setTimeout(function() {
        document.getElementById('success').style.display = 'none';
    }, 3000);
</script>

@endsection