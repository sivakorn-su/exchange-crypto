<?php

namespace App\Http\Controllers;

use App\Http\Enum\OrderStatus;
use App\Http\Enum\OrderType;
use App\Models\Order;
use App\Models\OrderDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'from_currency_id' => 'required|exists:currencies,id',
            'to_currency_id' => 'required|exists:currencies,id',
            'amount' => 'required|decimal|min:0',
            'price' => 'required|decimal|min:0',
            'rate' => 'required|decimal|min:0',
            'type' => ['required', new Enum(OrderType::class)],
            'status' => ['required', new Enum(OrderStatus::class)],
        ]);
        try {
            $order = new Order();
            $order->user_id = auth()->id();
            $order->wallet_id = auth()->user()->wallet->id;
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->type = $request->type;
            $orderDetail->from_currency_id = $request->from_currency_id;
            $orderDetail->to_currency_id = $request->currency_id;
            $orderDetail->rate = $request->rate;
            $orderDetail->amount = $request->amount;
            $orderDetail->price = $request->price;
            $order->save();
            $orderDetail->save();
            return response()->json(['message' => 'Order created'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Order failed'], 500);

        }

    }

    public function show(Order $order)
    {
        $order->load('user', 'wallet', 'orderDetail', 'orderDetail.fromCurrency', 'orderDetail.toCurrency');
        return response()->json($order, 200);
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->validated(
            ['status' => ['required', new Enum(OrderStatus::class)],]
        ));
        return response()->json(['message' => 'Order updated'], 200);
    }

}
