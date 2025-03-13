<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetail::with('order', 'product')->get(); 
        return response()->json($orderDetails);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $orderDetail = OrderDetail::create($validatedData);
        return response()->json($orderDetail, 201);
    }

    public function show($id)
    {
        $orderDetail = OrderDetail::with('order', 'product')->findOrFail($id);
        return response()->json($orderDetail);
    }


    public function update(Request $request, $id)
    {
        // Validate request data
        $validatedData = $request->validate([
            'order_id' => 'sometimes|exists:orders,id',   // Validate optionally
            'product_id' => 'sometimes|exists:products,id', // Validate optionally
            'quantity' => 'sometimes|integer',              // Quantity should be an integer
            'price' => 'sometimes|numeric',                 // Price should be numeric
        ]);

        // Find the order detail
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->update($validatedData); // Update the order detail
        return response()->json($orderDetail);
    }

    public function destroy($id)
    {
        // Find the order detail
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->delete(); // Delete the order detail
        return response()->json(null, 204); // Return no content response
    }
}
