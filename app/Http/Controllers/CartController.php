<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Retrieve carts owned by the current user along with their associated products
        $carts = Cart::where('user_id', $user->id)->with('products')->get();

        return view('pages.cart.index', compact('carts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        // Find the product by its ID
        $product = Product::findOrFail($cart->product_id);

        // Update the product's quantity
        $updateQty =  $product->quantity + $cart->quantity;
        $product->update(['quantity' =>  $updateQty]);

        return redirect('/carts')->with('success', 'Cart deleted successfully');
    }

    public function addToCart($id, Request $request)
    {
        try {
            // Find the product by its ID
            $product = Product::findOrFail($id);

            // Validate the request data
            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            // Retrieve the authenticated user's ID
            $user_id = Auth::id();

            $total_amount = $request->quantity * $product->price;
            // Create a new cart item
            $cartItem = new Cart([
                'product_id' => $product->id, // Ensure product_id is provided
                'user_id' => $user_id,
                'quantity' => $request->quantity,
                'total_amount' => $total_amount,
            ]);

            // Save the cart item
            $cartItem->save();

            // Update the product's quantity
            $updateQty =  $product->quantity - $request->quantity;
            $product->update(['quantity' =>  $updateQty]);

            // Optionally, you can return a success message or redirect back
            return back()->with('success', 'Product added to cart successfully.');
        } catch (\Throwable $e) {
            //throw $th;
            // Handle any exceptions, such as database errors or validation errors
            return back()->with('error', 'Product already added to cart');
        }
    }
}
