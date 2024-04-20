<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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
        $orders = Order::where('user_id', $user->id)->with('products')->get();

        return view('pages.order.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $cart = Cart::findOrFail($id);

        // Get the current timestamp from the database server
        $currentTimestamp = now();

        // Create a new cart item
        $orderItem = new Order([
            'product_id' => $cart->product_id, // Ensure product_id is provided
            'user_id' => $cart->user_id,
            'quantity' => $cart->quantity,
            'total_amount' => $cart->total_amount,
            'order_date' =>  $currentTimestamp,
        ]);

        // Save the cart item
        $orderItem->save();

        // delete cart
        $cart->delete();

        // Optionally, you can return a success message or redirect back
        return back()->with('success', 'The product was successfully ordered.');
    }
}
