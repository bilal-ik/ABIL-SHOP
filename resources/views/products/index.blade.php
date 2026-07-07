<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Shop
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Hero banner --}}
            <form
                method="GET"
                action="{{ route('products.index') }}"
                class="flex flex-wrap gap-4 items-end mb-6">
                <input type="hidden" name="search" value="{{ request('search') }}">
            {{-- Filter bar --}}
            <form method="GET" action="{{ route('products.index') }}" class="bg-white border border-stone-200 rounded-2xl p-5 mb-8 shadow-sm">
                <div class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs font-medium text-stone-500 uppercase tracking-wide mb-1">Search</label>
                        <input type="text" id="live-search" name="search" value="{{ request('search') }}" placeholder="Search products..."
                               class="w-full border-stone-300 rounded-lg focus:border-emerald-600 focus:ring-emerald-600 text-sm">
                    </div>

                    <div>
                        <label
                            class="block text-xs font-medium text-stone-500 uppercase tracking-wide mb-1">Category</label>
                        <select
                            name="category"
                            onchange="this.form.submit()"
                            class="border-stone-300 rounded-lg text-sm">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                @selected(request('category') == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-medium text-stone-500 uppercase tracking-wide mb-1">Min $</label>
                        <input
                            type="number"
                            name="min_price"
                            value="{{ request('min_price') }}"
                            class="w-24 border-stone-300 rounded-lg text-sm"></div>
                        <div>
                            <label
                                class="block text-xs font-medium text-stone-500 uppercase tracking-wide mb-1">Max $</label>
                            <input
                                type="number"
                                name="max_price"
                                value="{{ request('max_price') }}"
                                class="w-24 border-stone-300 rounded-lg text-sm"></div>
                            <button
                                type="submit"
                                class="bg-orange-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-orange-700 transition">Apply</button>
                        </form>

                        {{-- Result count --}}
                        <p class="text-sm text-stone-500 mb-4">{{ $products->total() }}
                            products</p>

                        {{-- Product grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            @forelse ($products as $product)
                            <div
                                class="group bg-white rounded-2xl border border-stone-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-200">

                                <a href="{{ route('products.show', $product) }}">
                                    <div
                                        class="relative aspect-square bg-stone-100 flex items-center justify-center overflow-hidden">
                                        @if ($product->image)
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            @else
                                            <svg
                                                class="w-12 h-12 text-stone-300"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 8h.01M4 4h16v16H4V4z"/>
                                            </svg>
                                            @endif @if ($product->stock == 0)
                                            <span
                                                class="absolute top-3 left-3 bg-stone-800 text-white text-[11px] font-medium px-2 py-1 rounded-full">
                                                Out of stock
                                            </span>
                                            @elseif ($product->stock <= 5)
                                            <span
                                                class="absolute top-3 left-3 bg-red-500 text-white text-[11px] font-medium px-2 py-1 rounded-full">
                                                Low stock
                                            </span>
                                            @endif
                                        </div>

                                        <div class="p-4 pb-2">
                                            <p
                                                class="text-[11px] uppercase tracking-wide text-orange-600 font-semibold mb-1">
                                                {{ $product->category->name }}
                                            </p>
                                            <h3 class="font-medium text-stone-800 leading-snug line-clamp-2 mb-2">
                                                {{ $product->name }}
                                            </h3>
                                            <p class="text-lg font-bold text-stone-900">
                                                ${{ number_format($product->price, 2) }}
                                            </p>
                                        </div>
                                    </a>

                                    <div class="px-4 pb-4">
                                        @guest
                                        <p class="text-xs text-stone-400 text-center mb-2">Login to purchase</p>
                                        @endguest
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button
                                                type="submit"
                                                {{ $product->stock == 0 ? 'disabled' : '' }}
                                                class="w-full flex items-center justify-center gap-1.5 {{ $product->stock == 0 ? 'bg-stone-200 text-stone-400 cursor-not-allowed' : 'bg-orange-600 text-white hover:bg-orange-700' }} py-2 rounded-lg text-sm font-semibold transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                                {{ $product->stock == 0 ? 'Out of Stock' : 'Add to Cart' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @empty
                                <div class="col-span-full text-center py-20">
                                    <p class="text-stone-400">No products match your filters.</p>
                                    <a
                                        href="{{ route('products.index') }}"
                                        class="text-orange-600 text-sm hover:underline mt-2 inline-block">Clear filters</a>
                                </div>
                                @endforelse
                            </div>

                            <div class="mt-8">
                                {{ $products->links() }}
                            </div>

                        </div>
                    </div>
                </x-app-layout>
            {{-- Result count --}}
            <p class="text-sm text-stone-500 mb-4">{{ $products->total() }} products</p>

            <div id="product-results">
                @include('products.partials.grid')
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('live-search');
        const resultsDiv = document.getElementById('product-results');
        let debounceTimer;

        searchInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const params = new URLSearchParams(window.location.search);
                params.set('search', searchInput.value);

                fetch(`{{ route('products.index') }}?${params.toString()}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.text())
                .then(html => {
                    resultsDiv.innerHTML = html;
                    window.history.replaceState({}, '', `?${params.toString()}`);
                });
            }, 400);
        });
    });
});
</script>
@endpush
</x-app-layout>
