<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;

class OrderDetailController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $order = Order::findOrFail($id);

        return view('pages.order.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        // Get the current timestamp from the database server
        $currentTimestamp = now();

        $orderItem = new OrderDetail([
            'order_id' => $id,
            'total_amount' => $request->total_amount,
            'provider' => $request->provider,
            'payment_date' =>  $currentTimestamp,
            'status' => "paid",
        ]);

        // Save the cart item
        $orderItem->save();
        return redirect('/orders')->with('success', ' Payment is successful, products will be sent immediately.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve the order by its ID along with its associated products
        $order = Order::with('products')->findOrFail($id);

        // Retrieve the order detail by its order_id
        $orderDetail = OrderDetail::where('order_id', $order->id)->first();

        // Pass the order and order detail to the view
        return view('pages.order.show', compact('order', 'orderDetail'));
    }
}
