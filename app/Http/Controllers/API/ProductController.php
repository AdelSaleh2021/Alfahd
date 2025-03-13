<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'quantity' => 'required|integer',
            ]
        );

      
       

       
        $productFinal = Product::create($validated);
       // return response()->json($productFinal, 201);

        return response()->json([
            'success' => 'true',
            'message' => 'product has added',
            'product' => $productFinal
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product =Product::find($id);
        if(!$product){
            return response()->json([
                'error' => 'product not found'
            ],404);
        }
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'string',
            'price' => 'numeric',
            'stock' => 'integer',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}
