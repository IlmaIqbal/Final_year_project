@extends('admin.navbar')

@section('title')
Add Province
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add District</h3>
        <div class="card-tools">
            <div class="card-tools">
                <a href="{{ route('province.districtTable',['province_id' => $province->province_id]) }}"
                    class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all
                    Districts</a>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('district.store')}}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="province_id" value="{{ $province->province_id }}">


        <div class="form-group">
            <label for="name">Province Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ $province->name }}" required placeholder="District Name" autocomplete="name" readonly>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">District Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required placeholder="District Name" autocomplete="name">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>



</div>

<div class="card-footer">

    <button type="reset" class="btn btn-secondary"> Clear</button>

    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
</div>
</form>
</div>

<script>
    document.getElementById('name').addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-Z\s.]/g, '');
    });
</script>



@endsection