<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        return view('cart.index', ['cart' => $cart->load('items.product')]);
    }

    public function add(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $quantity = $request->input('quantity', 1);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        }

        return back()->with('success', 'Added to cart');
    }

    public function update(CartItem $cartItem, Request $request)
    {
        $cartItem->update(['quantity' => $request->quantity]);
        return back();
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();
        return back();
    }
}
