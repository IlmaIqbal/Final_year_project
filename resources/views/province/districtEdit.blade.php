@extends('admin.navbar')

@section('title')
Add District
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit District</h3>
    </div>

    <form method="POST" action="{{ route('district.update', $district->district_id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ $district->name}}" required placeholder="Province Name" autocomplete="name"
                oninput="removeInvalid(this)">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>



</div>

<div class="card-footer">
    <a href="{{route('province.districtTable', $district->province_id)}}" class="btn btn-secondary">Go back</a>

    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>

</div>
</form>
</div>

<script>
    document.getElementById('name').addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-Z\s.]/g, '');
    });

    function removeInvalid(input) {
        input.classList.remove('is-invalid');
    }
</script>



@endsection