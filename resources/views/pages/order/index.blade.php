@extends('layouts.master-commerce')

@section('title', 'Order List')

@section('content')

<div class="table-responsive">
    <table id="table-orders" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->products->name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->orderDetail->total_amount ?? 0 }}</td>
                <td>
                    @if($order->orderDetail)
                    <span class="badge badge-success">{{ $order->orderDetail->status }}</span>
                    @else
                    <span class="badge badge-danger">Unpaid</span>
                    @endif
                </td>
                <td>
                    <a href="/order/detail/{{ $order->id }}" class="btn btn-primary">Detail</i></a>
                    @if($order->orderDetail)
                    <button type="button" class="btn btn-success" disabled>Pay</button>
                    @else
                    <a href="/order/detail/{{ $order->id }}/create" class="btn btn-success">Pay</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection()

@push('scripts')
<script src="{{ asset('/templates/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/templates/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
@endpush

<script>
    $(function () {
        $("#table-orders").DataTable();
    });
</script>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush