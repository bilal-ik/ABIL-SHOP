<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order Confirmed
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl border border-stone-200 p-8 text-center mb-8">
                <div class="w-14 h-14 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    ✓
                </div>
                <h3 class="text-xl font-semibold mb-2">Thank you for your order!</h3>
                <p class="text-stone-500">Order #{{ $order->id }} has been placed successfully.</p>
            </div>

            <div class="bg-white rounded-2xl border border-stone-200 p-6">
                <h4 class="font-semibold mb-4">Order Details</h4>

                <div class="space-y-3 mb-4">
                    @foreach ($order->items as $item)
                        <div class="flex justify-between text-sm">
                            <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                            <span class="font-medium">${{ number_format($item->price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t pt-4 flex justify-between font-semibold text-lg mb-4">
                    <span>Total</span>
                    <span>${{ number_format($order->total, 2) }}</span>
                </div>

                <p class="text-sm text-stone-500">
                    Shipping to: {{ $order->address }}, {{ $order->city }}, {{ $order->country }}
                </p>
            </div>

            <div class="mt-6 flex gap-4">
                <a href="{{ route('products.index') }}" class="text-emerald-700 hover:underline">Continue Shopping</a>
                <a href="{{ route('orders.history') }}" class="text-stone-500 hover:underline">View Order History</a>
            </div>

        </div>
    </div>
</x-app-layout>