<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" class="w-full border rounded px-3 py-2">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mb-4 flex gap-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full border rounded px-3 py-2">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    @if ($product->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $product->image) }}" class="h-24 rounded">
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Replace Image</label>
                        <input type="file" name="image" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active)) class="rounded">
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>

                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Update Product
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>