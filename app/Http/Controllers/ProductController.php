<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('pages-admin.products.index', compact('products'));
    }

    public function productCommerce(Request $request)
    {
        $products = Product::query();

        // If a category is selected, filter products by category
        if ($request->filled('category')) {
            $categoryId = $request->input('category');
            $products->whereHas('category', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            });
        }

        $products = $products->get();
        $categories = ProductCategory::all();

        return view('pages.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('pages-admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:product_category,id',
            'name' => 'required|max:255|unique:products', // Changed 'nama' to 'name'
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image_url' => 'required|url',
        ]);

        // Log the validated data
        info('Validated data:', $request->all());

        Product::create($request->all());
        return redirect('/admin/product')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $categoryId = $product->category_id;
        $category = ProductCategory::findOrFail($categoryId);
        return view('pages-admin.products.show', compact('product', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = ProductCategory::all();
        return view('pages-admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:product_category,id',
            'name' => 'required|max:255|unique:products,name,' . $id, // Updated unique validation rule
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image_url' => 'required|url',
        ]);

        // Log the validated data
        info('Validated data:', $request->all());

        $product = Product::findOrFail($id); // Find the existing product by ID
        $product->update($request->all()); // Update the product with the new data

        return redirect('/admin/product')->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/admin/product')->with('success', 'Product deleted successfully');
    }
}
