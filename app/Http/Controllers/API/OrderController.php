<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get(); 
        return response()->json($orders);
    }

    public function show($id)
    {
        $order = Order::with('user', 'orderDetails.product')->findOrFail($id);
        return response()->json($order);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $order = Order::create($validatedData);
        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'exists:users,id',
        ]);

        $order = Order::findOrFail($id);
        $order->update($validatedData);
        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(null, 204);
    }
}



