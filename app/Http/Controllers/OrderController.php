<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'sales_id' => 'required',
            'total_price' => 'required|numeric',
            'products' => 'required'
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        $data = $validation->validated();
        $data['products'] = json_encode($validation->validated());

        $order = Order::create($data);
        if (!$order) {
            return response()->json(['Cannot create order'], 400);
        }

        return response()->json(['Order created.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    public function addProductsToOrder(Request $request, Order $order)
    {
        $products = $request->toArray();
        $order_products = json_decode($order['products'], true);

        array_push($products['products'], $order_products);
        $order['products'] = json_encode($products['products']);
        $order->save();
        if (!$order) {
            return response()->json(['Failed to add products to order'], 400);    
        }
        return response()->json(['Products added to order']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->deleteOrFail();
        return response()->json(['Order canceled']);
    }
}
