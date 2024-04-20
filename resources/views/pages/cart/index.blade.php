@extends('layouts.master-commerce')

@section('title', 'Cart List')

@section('content')

<table id="table-carts" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Amount</th>
            <th>Description</th>
            <th>Action</th>
            <!-- Add more table headings as needed -->
        </tr>
    </thead>
    <tbody>
        @foreach($carts as $item)
        <tr>
            <td>{{ $item->products->name }}</td>
            <td>Rp {{ number_format($item->products->price , 0, ',', '.') }}</td>
            <td>{{ $item->quantity }}</td>
            <td>Rp {{ number_format($item->total_amount, 0, ',', '.') }}</td>
            <td>{{ $item->products->description }}</td>
            <td>
                <div class="btn-group" role="group">
                    <form action="/orders/{{ $item->id }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success" title="Make Order" onclick="return confirm('Are you sure you want to make this order?')">
                            <i class="fas fa-box"></i>
                        </button>
                    </form>                    
                </div>
                <div class="btn-group" role="group">
                    <form id="deleteForm{{ $item->id }}" action="/carts/{{ $item->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteCart('{{ $item->id }}')" class="btn btn-danger"
                            title="Remove from Cart">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection()

@push('scripts')
<script src="{{ asset('/templates/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/templates/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
@endpush

<script>
    $(function () {
        $("#table-carts").DataTable();
    });

    function deleteCart(id) {
        if (confirm('Are you sure you want to delete this cart?')) {
            document.getElementById('deleteForm' + id).submit();
        }
    }
</script>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush