<footer class="bg-stone-900 text-stone-300 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid grid-cols-2 md:grid-cols-4 gap-8">
        <div>
            <h4 class="text-white font-semibold mb-3">Get to Know Us</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:text-orange-400">About ABIL SHOP</a></li>
                <li><a href="#" class="hover:text-orange-400">Careers</a></li>
                <li><a href="#" class="hover:text-orange-400">Press Releases</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-white font-semibold mb-3">Connect with Us</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:text-orange-400">Facebook</a></li>
                <li><a href="#" class="hover:text-orange-400">Instagram</a></li>
                <li><a href="#" class="hover:text-orange-400">Twitter</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-white font-semibold mb-3">Let Us Help You</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('orders.history') }}" class="hover:text-orange-400">Your Orders</a></li>
                <li><a href="#" class="hover:text-orange-400">Shipping Info</a></li>
                <li><a href="#" class="hover:text-orange-400">Help Center</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-white font-semibold mb-3">ABIL SHOP</h4>
            <p class="text-sm">Fresh arrivals, unbeatable prices — your everyday marketplace.</p>
        </div>
    </div>
    <div class="border-t border-stone-800 py-4 text-center text-xs text-stone-500">
        © {{ date('Y') }} ABIL SHOP. Built by Person A &amp; Person B.
    </div>
</footer>