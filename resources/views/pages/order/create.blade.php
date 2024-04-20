@extends('layouts.master-commerce')

@section('title', 'Product Payment')

@section('content')

<form action="{{ route('orderdetail.store', ['order_id' => $order->id]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="total_amount">Total Amount</label>
        <input type="text" class="form-control" name="total_amount" id="total_amount" value="{{ $order->total_amount }}"
            readonly>
    </div>

    <div class="form-group">
        <label for="provider">Provider</label>
        <select class="form-control" name="provider" id="provider">
            <option value="OVO">OVO</option>
            <option value="DANA">DANA</option>
            <option value="GOPAY">GOPAY</option>
            <option value="SPAY">SPAY</option>
            <option value="BANK TRANSFER">BANK TRANSFER</option>
        </select>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection()

@push('scripts')
<script src="{{ asset('/templates/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/templates/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush