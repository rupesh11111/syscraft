<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index() {
        $auth = Auth::user();
        $data['cartItems'] = $cartItems = $auth->cart->cart_items()->with('product')->get()->append('total_price');
        $data['total'] = collect($cartItems)->sum('total_price');
        return view('cart',$data);
    }

    public function addToCart()
    {
        try {
            request()->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'nullable|numeric'
            ]);

            $cart = Cart::whereUserId(Auth::id())->first();

            DB::beginTransaction();
            
            if (!$cart) {
                $cart = Cart::create([
                    'user_id' => Auth::id(),
                ]);
            }

            $cartItem = CartItem::updateOrcreate([
                'cart_id' => $cart->id,
                'product_id' => request('product_id')
            ]);

            $cartItem->quantity += request('quantity', 1);
            $cartItem->save();

            $data['cart_count'] = CartItem::whereHas('cart', fn ($q) => $q->whereUserId(Auth::id()))->count();
            
            DB::commit();
            
            return response()->json([
                'status' => true,
                'message' => "Item added Successfully",
                'data' => $data
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy($itemCartId) {
        $data = [
            'total' => 0
        ];

        $cartItem = CartItem::whereId($itemCartId)->first();

        $cartItem->delete();

        if($cartItem) {
            $cartItems = CartItem::whereCartId($cartItem->cart_id)->with('product')->get()->append('total_price');
            $data['total'] = collect($cartItems)->sum('total_price');    
        }
        return response()->json([
            'status' => true,
            'message' => 'Item removed from cart',
            'data' => $data
        ]);
    }
}
