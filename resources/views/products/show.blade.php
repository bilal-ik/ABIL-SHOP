<x-app-layout>
    <x-slot name="header">
        <nav class="text-sm text-stone-500">
            <a href="{{ route('products.index') }}" class="hover:text-emerald-700">Shop</a>
            <span class="mx-2">/</span>
            <span class="text-stone-700">{{ $product->name }}</span>
        </nav>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 grid md:grid-cols-2 gap-10">

                <div class="aspect-square bg-stone-100 rounded-xl flex items-center justify-center overflow-hidden">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="h-full w-full object-cover">
                    @else
                        <svg class="w-16 h-16 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 8h.01M4 4h16v16H4V4z" />
                        </svg>
                    @endif
                </div>

                <div class="flex flex-col">
                    <p class="text-xs uppercase tracking-wide text-emerald-700 font-medium mb-2">
                        {{ $product->category->name }}
                    </p>
                    <h1 class="text-2xl sm:text-3xl font-semibold text-stone-900 mb-3">
                        {{ $product->name }}
                    </h1>
                    <p class="text-3xl font-bold text-stone-900 mb-4">
                        ${{ number_format($product->price, 2) }}
                    </p>

                    @if ($product->stock > 0)
                        <span class="inline-flex items-center gap-1.5 text-sm text-emerald-700 mb-6 w-fit">
                            <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                            {{ $product->stock }} in stock
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 text-sm text-stone-500 mb-6 w-fit">
                            <span class="w-2 h-2 rounded-full bg-stone-400"></span>
                            Out of stock
                        </span>
                    @endif

                    <p class="text-stone-600 leading-relaxed flex-1">
                        {{ $product->description ?: 'No description available for this product yet.' }}
                    </p>

                    <button disabled
                        class="mt-8 w-full sm:w-auto bg-stone-200 text-stone-400 px-8 py-3 rounded-lg font-medium cursor-not-allowed">
                        Add to Cart — coming soon
                    </button>

                    <a href="{{ route('products.index') }}" class="mt-4 text-sm text-stone-500 hover:text-emerald-700 transition">
                        ← Back to Shop
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>