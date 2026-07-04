<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Show the checkout page (address form + order summary)
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.index', ['cart' => $cart]);
    }

    // Process the order
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $cart = Cart::where('user_id', Auth::id())->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $order = DB::transaction(function () use ($cart, $request) {
            $total = $cart->items->sum(fn($item) => $item->price * $item->quantity);

            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'pending',
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);

                // reduce stock
                $item->product->decrement('stock', $item->quantity);
            }

            // clear the cart
            $cart->items()->delete();

            return $order;
        });

        return redirect()->route('checkout.confirmation', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    // Order confirmation page
    public function confirmation(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.confirmation', ['order' => $order->load('items.product')]);
    }

    // Order history
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->latest()
            ->get();

        return view('checkout.history', ['orders' => $orders]);
    }
}