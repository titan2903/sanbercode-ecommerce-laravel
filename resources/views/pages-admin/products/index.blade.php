@extends('layouts.master-admin')

@section('title', 'Data Products')

@section('content')

<div class="mb-3">
    <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
</div>

<table id="table-products" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $key => $value)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $value->name }}</td>
            <td>Rp {{ number_format($value->price, 0, ',', '.') }}</td>
            <td>{{ $value->quantity }}</td>
            <td>
                <a href="/admin/product/{{ $value->id }}" class="btn btn-primary"><i class="far fa-eye"></i></a>
                <a href="/admin/product/{{ $value->id }}/edit" class="btn btn-success"><i class="fas fa-edit"></i></a>
                <div class="btn-group" role="group">
                    <form id="deleteForm{{ $value->id }}" action="/admin/product/{{ $value->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteProduct('{{ $value->id }}')" class="btn btn-danger">
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
<script>
    $(function () {
        $("#table-products").DataTable();
    });

    function deleteProduct(id) {
        if (confirm('Are you sure you want to delete this product?')) {
            document.getElementById('deleteForm' + id).submit();
        }
    }
</script>
@endpush

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush