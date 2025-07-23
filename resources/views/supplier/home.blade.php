@extends('supplier.nav_supplier')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in as Supplier!') }}
                    <br>

                    @foreach(auth()->user()->notifications as $notification)
                    <p>{{ $notification->data['message'] ?? 'You have a new reorder request.' }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection