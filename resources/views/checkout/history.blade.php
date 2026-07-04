<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Orders
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @forelse ($orders as $order)
                <div class="bg-white rounded-2xl border border-stone-200 p-5">
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <p class="font-semibold">Order #{{ $order->id }}</p>
                            <p class="text-sm text-stone-500">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <span class="text-xs px-3 py-1 rounded-full bg-stone-100 text-stone-600 capitalize">
                            {{ $order->status }}
                        </span>
                    </div>

                    <div class="text-sm text-stone-600 space-y-1 mb-3">
                        @foreach ($order->items as $item)
                            <p>{{ $item->product->name }} × {{ $item->quantity }}</p>
                        @endforeach
                    </div>

                    <div class="border-t pt-3 flex justify-between font-semibold">
                        <span>Total</span>
                        <span>${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            @empty
                <p class="text-stone-400 text-center py-10">You haven't placed any orders yet.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>