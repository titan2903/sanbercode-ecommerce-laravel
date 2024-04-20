@extends('layouts.master-commerce')

@section('title', 'Profile')

@section('content')

<div class="card">
    <div class="card-header">
        Profile Information
    </div>
    <div class="card-body">
        <p class="card-text">Name: {{ $user->name }}</p>
        <p class="card-text">Email: {{ $user->email }}</p>
        @if($user->userAddress)
            <p class="card-text">State: {{ $user->userAddress->state }}</p>
            <p class="card-text">Address: {{ $user->userAddress->address }}</p>
            <p class="card-text">Postal Code: {{ $user->userAddress->postal_code }}</p>
        @endif
    </div>
    <div class="card-footer">
        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">Update</a>
    </div>
</div>

@endsection()

@push('scripts')
<script src="{{ asset('/templates/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/templates/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush
