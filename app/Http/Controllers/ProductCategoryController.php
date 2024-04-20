<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategories = ProductCategory::all();
        return view('pages-admin.product_categories.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages-admin.product_categories.create');
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
            'name' => 'required|max:255|unique:product_category',
            'description' => 'required',
        ]);

        ProductCategory::create($request->all());

        return redirect('/admin/product-category')->with('success', 'Product category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productCategory = ProductCategory::find($id);
        return view('pages-admin.product_categories.edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:product_category,name,' . $id,
            'description' => 'required',
        ]);

        $productCategory = ProductCategory::find($id);
        $productCategory->name = $request['name'];
        $productCategory->description = $request['description'];
        $productCategory->update();
        return redirect('/admin/product-category')->with('success', 'Product category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Check if any products are associated with the category
        $productsCount = Product::where('category_id', $id)->count();

        if ($productsCount > 0) {
            return redirect('/admin/product-category')->with('error', 'Cannot delete category because it has associated products.');
        }

        $productCategory = ProductCategory::find($id);
        $productCategory->delete();
        return redirect('/admin/product-category')->with('success', 'Product category deleted successfully');
    }
}
