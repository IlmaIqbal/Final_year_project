@extends('admin.navbar')

@section('title')
Add Division
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Division</h3>

        <div class="card-tools">
            <a href="{{ route('province.divisionTable',['district_id' => $district->district_id]) }}"
                class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all
                Division</a>
        </div>
    </div>

    <form method="POST" action="{{ route('division.store')}}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="district_id" value="{{ $district->district_id }}">

        <div class="form-group">
            <label for="name">District Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ $district->name }}" required placeholder="District Name" autocomplete="name" readonly>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">Division Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required placeholder="Division Name" autocomplete="name">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>



</div>

<div class="card-footer">
    <button type="reset" class="btn btn-secondary"> Clear</button>

    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
</div>
</form>
</div>

<script>
document.getElementById('name').addEventListener('input', function() {
    this.value = this.value.replace(/[^a-zA-Z\s.]/g, '');
});
</script>



@endsection