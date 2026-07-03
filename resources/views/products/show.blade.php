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

                    <a href="{{ route('products.index') }}" class="inline-block mt-6 text-indigo-600 hover:underline">
                        ← Back to Products
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>