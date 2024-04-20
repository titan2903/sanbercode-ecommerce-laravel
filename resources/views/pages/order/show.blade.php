@extends('layouts.master-commerce')

@section('title', 'Order Detail')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card" style="max-width: 800px;">
        <img src="{{ $order->products->image_url }}" class="card-img-top" alt="Product Image"
            style="height: 500px; object-fit: cover;">
        <div class="card-body">
            <h5 class="card-title">{{ $order->products->name }}</h5>
            <p class="card-text">{{ $order->products->description }}</p>
        </div>
        @if($orderDetail)
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Quantity: {{ $order->quantity }}</li>
            <li class="list-group-item">Total Amount: Rp {{ number_format($order->orderDetail->total_amount, 0, ',', '.') }}</li>
            <li class="list-group-item">Status: <span class="badge badge-success">{{ $order->orderDetail->status }}</span></li>
            <li class="list-group-item">Provider: {{ $order->orderDetail->provider }}</li>
            <li class="list-group-item">Order Date: {{ $order->order_date }}</li>
            <li class="list-group-item">Payment Date: {{ $order->orderDetail->payment_date }}</li>
        </ul>
        @else
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Quantity: {{ $order->quantity }}</li>
            <li class="list-group-item">Total Amount: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</li>
            <li class="list-group-item">Status:  <span class="badge badge-danger">Unpaid</span></li>
            <li class="list-group-item">Order Date: {{ $order->order_date }}</li>
        </ul>
        @endif
        <div class="card-footer">
            <a href="/orders" class="btn btn-secondary btn-sm">Back</a>
        </div>
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