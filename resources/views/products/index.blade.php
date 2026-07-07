<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Shop
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Filter bar --}}
            <form method="GET" action="{{ route('products.index') }}" class="bg-white border border-stone-200 rounded-2xl p-5 mb-8 shadow-sm">
                <div class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs font-medium text-stone-500 uppercase tracking-wide mb-1">Search</label>
                        <input type="text" id="live-search" name="search" value="{{ request('search') }}" placeholder="Search products..."
       class="w-full border-stone-300 rounded-lg focus:border-emerald-600 focus:ring-emerald-600 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-stone-500 uppercase tracking-wide mb-1">Category</label>
                        <select name="category" class="border-stone-300 rounded-lg focus:border-emerald-600 focus:ring-emerald-600 text-sm">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-stone-500 uppercase tracking-wide mb-1">Min $</label>
                        <input type="number" name="min_price" value="{{ request('min_price') }}" class="w-24 border-stone-300 rounded-lg focus:border-emerald-600 focus:ring-emerald-600 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-stone-500 uppercase tracking-wide mb-1">Max $</label>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" class="w-24 border-stone-300 rounded-lg focus:border-emerald-600 focus:ring-emerald-600 text-sm">
                    </div>

                    <button type="submit" class="bg-emerald-700 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-emerald-800 transition">
                        Filter
                    </button>

                    @if (request()->anyFilled(['search', 'category', 'min_price', 'max_price']))
                        <a href="{{ route('products.index') }}" class="text-sm text-stone-400 hover:text-stone-600 transition">Clear</a>
                    @endif
                </div>
            </form>

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
        }, 400); // waits 400ms after typing stops before searching
    });
});
</script>
@endpush
</x-app-layout>