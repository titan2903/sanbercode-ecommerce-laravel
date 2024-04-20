@extends('layouts.master-admin')

@section('title', 'Data Product Categories')

@section('content')

<div class="mb-3">
    <a href="{{ route('product_categories.create') }}" class="btn btn-primary">Create Product Category</a>
</div>

<table id="table-products" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productCategories as $key => $value)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->description }}</td>
            <td>
                <a href="/admin/product-category/{{ $value->id }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                <div class="btn-group" role="group">
                    <form id="deleteForm{{ $value->id }}" action="/admin/product-category/{{ $value->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteCast('{{ $value->id }}')" class="btn btn-danger">
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

    function deleteCast(id) {
        if (confirm('Are you sure you want to delete this product category?')) {
            document.getElementById('deleteForm' + id).submit();
        }
    }
</script>
@endpush

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush