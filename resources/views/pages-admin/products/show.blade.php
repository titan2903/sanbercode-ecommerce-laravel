@extends('layouts.master-admin')

@section('title', 'Detail Product')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="card" style="max-width: 800px;">
    <img src="{{ $product->image_url }}" class="card-img-top" alt="Product Image"
      style="height: 500px; object-fit: cover;">
    <div class="card-body">
      <h5 class="card-title">{{ $product->name }}</h5>
      <p class="card-text">{{ $product->description }}</p>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Price: Rp {{ number_format($product->price, 0, ',', '.') }}</li>
      <li class="list-group-item">Quantity: {{ $product->quantity }}</li>
      <li class="list-group-item">Category: {{ $category->name }}</li>
    </ul>
    <div class="card-footer">
      <a href="/admin/product" class="btn btn-secondary btn-sm">Back</a>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('/templates/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/templates/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush