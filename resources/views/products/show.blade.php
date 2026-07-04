<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6 flex flex-col md:flex-row gap-6">

                <div class="md:w-1/2 h-64 bg-gray-200 rounded flex items-center justify-center text-gray-400">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="h-full object-cover rounded">
                    @else
                        No Image
                    @endif
                </div>

                <div class="md:w-1/2">
                    <p class="text-sm text-gray-500">{{ $product->category->name }}</p>
                    <h1 class="text-2xl font-bold text-gray-800 mt-1">{{ $product->name }}</h1>
                    <p class="text-indigo-600 text-xl font-semibold mt-2">${{ number_format($product->price, 2) }}</p>
                    <p class="text-sm mt-1 {{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                        {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }}
                    </p>
                    <p class="text-gray-700 mt-4">{{ $product->description }}</p>
                    @if ($product->stock > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-6 flex items-center gap-3">
                            @csrf
                            <label for="quantity" class="text-sm text-gray-600">Qty</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                class="w-20 border rounded px-2 py-1">
                            <button type="submit" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800">
                                Add to Cart
                            </button>
                        </form>
                    @else
                        <button disabled class="mt-6 bg-gray-300 text-gray-500 px-6 py-2 rounded cursor-not-allowed">
                            Out of Stock
                        </button>
                    @endif
                    <a href="{{ route('products.index') }}" class="inline-block mt-6 text-indigo-600 hover:underline">
                        ← Back to Products
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>