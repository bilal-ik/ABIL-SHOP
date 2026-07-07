<nav x-data="{ open: false, catOpen: false }" class="bg-stone-900 text-white">
    {{-- Top bar --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 gap-6">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                <svg
                    class="w-8 h-8 text-orange-500"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16.5 6a3 3 0 11-6 0 3 3 0 016 0zM3 20a6 6 0 0112 0M15 20a6 6 0 016-4.472M13.5 6a3 3 0 116 0"/>
                </svg>
                <span class="text-xl font-extrabold tracking-tight">
                    <span class="text-orange-500">ABIL</span>SHOP
                </span>
            </a>

            {{-- Search bar (Amazon-style, centered) --}}
            <form
                action="{{ route('products.index') }}"
                method="GET"
                class="hidden md:flex flex-1 max-w-2xl">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search ABIL SHOP..."
                    class="w-full rounded-l-md border-0 text-stone-800 text-sm focus:ring-2 focus:ring-orange-500">
                    <button
                        type="submit"
                        class="bg-orange-500 hover:bg-orange-600 px-4 rounded-r-md flex items-center justify-center">
                        <svg
                            class="w-5 h-5 text-stone-900"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z"/>
                        </svg>
                    </button>
                </form>

                {{-- Right side: account + cart --}}
                <div class="flex items-center gap-6 shrink-0">
                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="text-sm text-left leading-tight hover:text-orange-400 transition">
                                    <span class="block text-stone-300 text-xs">Hello,
                                        {{ Auth::user()->name ?? 'sign in' }}</span>
                                    <span class="font-semibold">Account &amp; Orders</span>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                @auth
                                <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                                <x-dropdown-link :href="route('orders.history')">My Orders</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link
                                        :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Log Out
                                    </x-dropdown-link>
                                </form>
                                @else
                                <x-dropdown-link :href="route('login')">Login</x-dropdown-link>
                                <x-dropdown-link :href="route('register')">Register</x-dropdown-link>
                                @endauth
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <a
                        href="{{ route('cart.index') }}"
                        class="relative flex items-center gap-1 hover:text-orange-400 transition">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.72-4.79 1.972-7.315a48.6 48.6 0 00-.108-1.03A1.125 1.125 0 0021.121 4.5H5.25M12 4.5H5.25m0 0L4.5 3M7.5 14.25L5.25 4.5m2.25 9.75L4.5 3"/>
                        </svg>
                        @auth @php $cart = auth()->user()->cart; $count = $cart ?
                        $cart->items->sum('quantity') : 0; @endphp
                        <span
                            class="absolute -top-2 -right-2 bg-orange-500 text-stone-900 text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $count }}
                        </span>
                        @endauth
                        <span class="text-sm font-semibold hidden sm:inline">Cart</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Category bar with hover dropdown --}}
        <div class="bg-stone-800 border-t border-stone-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-6 h-10 text-sm relative">

                    {{-- All Categories hover dropdown --}}
                    <div class="relative group h-full flex items-center">
                        <button class="flex items-center gap-1 hover:text-orange-400 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            All Categories
                        </button>

                        <div
                            class="absolute left-0 top-full hidden group-hover:block bg-white text-stone-800 shadow-xl rounded-b-md w-64 py-2 z-50">
                            @foreach ($allCategories ?? \App\Models\Category::all() as $cat)
                            <a
                                href="{{ route('products.index', ['category' => $cat->id]) }}"
                                class="block px-4 py-2 hover:bg-orange-50 hover:text-orange-600 transition">
                                {{ $cat->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Underline-style nav links --}}
                    <a
                        href="{{ route('products.index') }}"
                        class="h-full flex items-center border-b-2 {{ request()->routeIs('products.index') || request()->routeIs('home') ? 'border-orange-500 text-orange-400' : 'border-transparent hover:border-orange-400 hover:text-orange-400' }} transition">
                        Shop
                    </a>
                    <a
                        href="{{ route('orders.history') }}"
                        class="h-full flex items-center border-b-2 {{ request()->routeIs('orders.history') ? 'border-orange-500 text-orange-400' : 'border-transparent hover:border-orange-400 hover:text-orange-400' }} transition">
                        My Orders
                    </a>
                </div>
            </div>
        </div>
    </nav>
