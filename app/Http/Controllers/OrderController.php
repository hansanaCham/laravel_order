<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
            'unit_price' => 'required|numeric|min:1',
            'customer_name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
        ]);

        // Create new order
        $order = new Order();
        $order->product_name = $request->input('product_name');
        $order->quantity = $request->input('quantity');
        $order->unit_price = $request->input('unit_price');
        $order->customer_name = $request->input('customer_name');
        $order->address = $request->input('address');
        $order->phone_number = $request->input('phone_number');
        $order->user_id = Auth::id();
  
         $processId = rand(1, 10);

         try {
            $order->save();
            $status = 'success';

            $orderData = [
                'Order_ID' => $order->id,
                'Customer_Name' => $order->customer_name,
                'Order_Value' => $order->quantity * $order->unit_price , 
                'Order_Date' => $order->created_at->format('Y-m-d H:i:s'),
                'Order_Status' => 'Processing',
                'Process_ID' => $processId,
            ];

            $response = Http::post('https://wibip.free.beeceptor.com/order', $orderData);

            if ($response->successful()) {    

            } else {
               
                $status = 'fail';
            }

        } catch (\Exception $e) {
            
            $status = 'fail';
        }
        
        return response()->json([
            'order_id' => $order->id ?? null,
            'process_id' => $processId,
            'status' => $status
        ], $status === 'success' ? 201 : 500);
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
