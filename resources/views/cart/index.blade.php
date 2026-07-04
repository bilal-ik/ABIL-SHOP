<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your Cart
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">

            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if ($cart->items->isEmpty())
                <p class="text-gray-500">Your cart is empty.</p>
            @else
                <div class="space-y-4">
                    @foreach ($cart->items as $item)
                        <div class="flex items-center justify-between border rounded-lg p-4 bg-white">
                            <div>
                                <h3 class="font-semibold">{{ $item->product->name }}</h3>
                                <p class="text-gray-500">${{ number_format($item->price, 2) }} each</p>
                            </div>

                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                       class="w-16 border rounded px-2 py-1">
                                <button type="submit" class="text-blue-600 hover:underline">Update</button>
                            </form>

                            <p class="font-semibold">${{ number_format($item->price * $item->quantity, 2) }}</p>

                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Remove</button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-between items-center border-t pt-4">
                    <p class="text-xl font-bold">
                        Total: ${{ number_format($cart->items->sum(fn($i) => $i->price * $i->quantity), 2) }}
                    </p>
                    <a href="#" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800">
                        Proceed to Checkout
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>