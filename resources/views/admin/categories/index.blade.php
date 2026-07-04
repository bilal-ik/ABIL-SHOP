<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin — Categories</h2>
            <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 text-sm">
                + Add Category
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
            @endif

            <table class="w-full bg-white shadow rounded">
                <thead>
                    <tr class="text-left border-b">
                        <th class="p-3">Name</th>
                        <th class="p-3">Products</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-b">
                            <td class="p-3">{{ $category->name }}</td>
                            <td class="p-3">{{ $category->products_count }}</td>
                            <td class="p-3 space-x-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $categories->links() }}
            </div>

        </div>
    </div>
</x-app-layout>