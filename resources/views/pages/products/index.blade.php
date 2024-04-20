@extends('layouts.master-commerce')

@section('title', 'Product List')

@section('content')

    <div class="row">
        <div class="col-md-12 mb-3">
            <form action="{{ route('product.search') }}" method="GET">
                <div class="input-group">
                    <select class="custom-select" name="category">
                        <option value="">Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
        @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img class="card-img-top" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Category: {{ $product->category->name }}</li>
                        <li class="list-group-item">Price: Rp {{ number_format($product->price, 0, ',', '.') }}</li>
                        <li class="list-group-item">Quantity: {{ $product->quantity }}</li>
                    </ul>
                    <div class="card-footer">
                        @if ($product->quantity > 0)
                            @auth
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="number" name="quantity" class="form-control" value="1"
                                            min="1">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="decreaseQuantity(this)">-</button>
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="increaseQuantity(this)">+</button>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary">Login to Add to Cart</a>
                            @endauth
                        @else
                            <button type="button" class="btn btn-secondary" disabled>Add to Cart</button>
                            <span class="text-danger">Out of Stock</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection()

@push('scripts')
    <script src="{{ asset('/templates/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/templates/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
@endpush

<script>
    function increaseQuantity(button) {
        var input = button.parentNode.previousElementSibling;
        input.value = parseInt(input.value) + 1;
    }

    function decreaseQuantity(button) {
        var input = button.parentNode.previousElementSibling;
        if (parseInt(input.value) - 1 <= 1) {
            input.value = 1
        } else {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush
