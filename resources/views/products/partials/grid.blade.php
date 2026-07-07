  {{-- Product grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @forelse ($products as $product)
                            <div class="group bg-white rounded-2xl border border-stone-200 overflow-hidden hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">

                                <a href="{{ route('products.show', $product) }}">
                                    <div class="relative aspect-square bg-stone-100 flex items-center justify-center overflow-hidden">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <svg class="w-12 h-12 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 8h.01M4 4h16v16H4V4z" />
                                            </svg>
                                        @endif

                                        @if ($product->stock == 0)
                                            <span class="absolute top-3 left-3 bg-stone-800 text-white text-[11px] font-medium px-2 py-1 rounded-full">
                                                Out of stock
                                            </span>
                                        @elseif ($product->stock <= 5)
                                            <span class="absolute top-3 left-3 bg-amber-500 text-white text-[11px] font-medium px-2 py-1 rounded-full">
                                                Low stock
                                            </span>
                                        @endif
                                    </div>

                                    <div class="p-4">
                                        <p class="text-[11px] uppercase tracking-wide text-emerald-700 font-medium mb-1">
                                            {{ $product->category->name }}
                                        </p>
                                        <h3 class="font-medium text-stone-800 leading-snug line-clamp-2 mb-2">
                                            {{ $product->name }}
                                        </h3>
                                        <p class="text-lg font-semibold text-stone-900">
                                            ${{ number_format($product->price, 2) }}
                                        </p>
                                    </div>
                                </a>

                                <div class="px-4 pb-4">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            @if($product->stock == 0) disabled @endif
                                            class="w-full {{ $product->stock == 0 ? 'bg-stone-200 text-stone-400 cursor-not-allowed' : 'bg-emerald-700 text-white hover:bg-emerald-800' }} py-2 rounded-lg text-sm font-medium transition">
                                            {{ $product->stock == 0 ? 'Out of Stock' : 'Add to Cart' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-20">
                                <p class="text-stone-400">No products match your filters.</p>
                                <a href="{{ route('products.index') }}" class="text-emerald-700 text-sm hover:underline mt-2 inline-block">Clear filters</a>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>