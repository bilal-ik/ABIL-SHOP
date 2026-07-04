<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Checkout
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 grid md:grid-cols-2 gap-8">

            {{-- Shipping form --}}
            <div class="bg-white rounded-2xl border border-stone-200 p-6">
                <h3 class="font-semibold text-lg mb-4">Shipping Details</h3>

                <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm text-stone-600 mb-1">Address</label>
                        <input type="text" name="address" value="{{ old('address', auth()->user()->address ?? '') }}"
                               class="w-full border-stone-300 rounded-lg focus:border-emerald-600 focus:ring-emerald-600">
                        @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-stone-600 mb-1">City</label>
                        <input type="text" name="city" value="{{ old('city', auth()->user()->city ?? '') }}"
                               class="w-full border-stone-300 rounded-lg focus:border-emerald-600 focus:ring-emerald-600">
                        @error('city') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-stone-600 mb-1">Country</label>
                        <input type="text" name="country" value="{{ old('country', auth()->user()->country ?? '') }}"
                               class="w-full border-stone-300 rounded-lg focus:border-emerald-600 focus:ring-emerald-600">
                        @error('country') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full bg-emerald-700 text-white py-3 rounded-lg font-medium hover:bg-emerald-800 transition">
                        Place Order
                    </button>
                </form>
            </div>

            {{-- Order summary --}}
            <div class="bg-white rounded-2xl border border-stone-200 p-6">
                <h3 class="font-semibold text-lg mb-4">Order Summary</h3>

                <div class="space-y-3">
                    @foreach ($cart->items as $item)
                        <div class="flex justify-between text-sm">
                            <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                            <span class="font-medium">${{ number_format($item->price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t mt-4 pt-4 flex justify-between font-semibold text-lg">
                    <span>Total</span>
                    <span>${{ number_format($cart->items->sum(fn($i) => $i->price * $i->quantity), 2) }}</span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>