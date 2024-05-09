<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class OrderController extends Controller
{
    public function store(Request $request, $id)
    {

        try {
            request()->merge(['cart_id' => $id]);

            $request->validate([
                'cart_id' => 'required|exists:carts,id'
            ]);
            $cartItems = CartItem::whereCartId($id)->with('product')->get();
            $order_items = [];
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => true,
                'total_price' => 0
            ]);
            $total = 0;
            foreach ($cartItems as $cartItem) {
                $order_items[] = [
                    'order_id' => $order?->id,
                    'product_id' => $cartItem?->product_id,
                    'quantity' => $cartItem?->quantity,
                    'price' => $cartItem?->product?->price,
                ];
                $total += floatval($cartItem?->product?->price) * intval($cartItem?->quantity);
            }

            $order->total_price = $total;
            $order->save();

            OrderItem::insert($order_items);

            CartItem::whereCartId($id)->delete();

            Transaction::create([
                'order_id' => $order->id,
                'transaction_id' => strtoupper(Str::random(20)),
                'amount' => $total,
                'status' => 'Paid',
            ]);

            return response()->json([
                'status' => true,
                'data' => [
                    'html' => view('order-success')->render()
                ]
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage() 
            ]);
        }
    }
}
