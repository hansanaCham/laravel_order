<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
        ]);

        // Create new order
        $order = new Order();
        $order->product_name = $request->input('product_name');
        $order->quantity = $request->input('quantity');
        $order->customer_name = $request->input('customer_name');
        $order->address = $request->input('address');
        $order->phone_number = $request->input('phone_number');
        // Add more fields as needed

        // Save the order
        $order->save();

        // Return response
        return response()->json(['message' => 'Order created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
