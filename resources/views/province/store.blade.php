@extends('admin.navbar')

@section('title')
Add Province
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Province</h3>
        <div class="card-tools">
            <a href="{{route('admin.province')}}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all
                Province</a>
        </div>
    </div>

    <form method="POST" action="{{ route('province.store')}}" enctype="multipart/form-data">
        @csrf


        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required placeholder="Province Name" autocomplete="name"
                oninput="removeInvalid(this)">
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

function removeInvalid(input) {
    input.classList.remove('is-invalid');
}
</script>



@endsection