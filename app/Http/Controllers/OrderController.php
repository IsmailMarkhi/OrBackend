<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return Order::where('user_id', $request->input('user_id'))->get();
    }

public function store(Request $request)
{
    if (!$request->input('user_id')) {
        return response()->json([
            'error' => 'user_id missing'
        ], 400);
    }

    $order = new Order();

    $order->user_id = $request->input('user_id');
    $order->client_name = $request->client_name;
    $order->product = $request->product;
    $order->price = (float) $request->price;
    $order->status = 'pending';

    $order->save();

    return response()->json([
        'success' => true,
        'order' => $order
    ]);
}

public function show($id, Request $request)
{
    return Order::where('id', $id)
        ->where('user_id', $request->input('user_id'))
        ->first();
}


    public function destroy($id, Request $request)
    {
        $order = Order::where('id', $id)
            ->where('user_id', $request->input('user_id'))
            ->first();

        if (!$order) {
            return response()->json(['error'=>'Not found'], 404);
        }

        $order->delete();

        return response()->json(['success'=>true]);
    }

    public function updateStatus($id, Request $request)
    {
        $order = Order::where('id', $id)
            ->where('user_id', $request->input('user_id'))
            ->first();

        if (!$order) {
            return response()->json(['error'=>'Not found'], 404);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json($order);
    }
    public function update($id, Request $request)
{
    $order = Order::where('id', $id)
        ->where('user_id', $request->input('user_id'))
        ->first();

    if (!$order) {
        return response()->json(['error' => 'Not found'], 404);
    }

    $order->client_name = $request->client_name;
    $order->product = $request->product;
    $order->price = (float) $request->price;

    $order->save();

    return response()->json([
        'success' => true,
        'order' => $order
    ]);
}
}