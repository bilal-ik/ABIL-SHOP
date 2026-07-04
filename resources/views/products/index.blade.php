<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Products
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Search & Filter --}}
            <form method="GET" action="{{ route('products.index') }}" class="bg-white p-4 rounded-lg shadow mb-6 flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block text-sm text-gray-600">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm text-gray-600">Category</label>
                    <select name="category" class="border rounded px-3 py-2">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm text-gray-600">Min Price</label>
                    <input type="number" name="min_price" value="{{ request('min_price') }}" class="border rounded px-3 py-2 w-24">
                </div>

                <div>
                    <label class="block text-sm text-gray-600">Max Price</label>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" class="border rounded px-3 py-2 w-24">
                </div>

                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Filter
                </button>

                <a href="{{ route('products.index') }}" class="text-gray-500 px-4 py-2">Reset</a>
            </form>

            {{-- Product Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4">
                        <a href="{{ route('products.show', $product) }}">
                            <div class="h-40 bg-gray-200 rounded mb-3 flex items-center justify-center text-gray-400">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="h-full object-cover rounded">
                                @else
                                    No Image
                                @endif
                            </div>
                            <h3 class="font-semibold text-gray-800">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $product->category->name }}</p>
                            <p class="text-indigo-600 font-bold mt-2">${{ number_format($product->price, 2) }}</p>
                        </a>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-3">No products found.</p>
                @endforelse
                
            {{-- Pagination --}}
            <div class="mt-6">
                {{ $products->links() }}
            </div>

        </div>
    </div>
</x-app-layout>