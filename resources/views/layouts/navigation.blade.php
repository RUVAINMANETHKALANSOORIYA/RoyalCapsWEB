<!-- Header -->
<header class="bg-gray-800 text-white">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-xl font-bold tracking-wide hover:text-yellow-400">
            {{ config('app.name', 'Royal Caps') }}
        </a>

        <!-- Mobile Menu Button (Only Visible on Small Screens) -->
        <button id="mobile-menu-button" class="block sm:hidden text-white focus:outline-none">
            <i class="fas fa-bars text-2xl"></i>
        </button>

        <!-- Navigation Links (Desktop - Hidden on Mobile) -->
        <nav class="hidden lg:flex space-x-6 mx-auto">
            <a href="{{ route('home') }}" class="hover:text-yellow-400">Home</a>
            <a href="{{ route('products') }}" class="hover:text-yellow-400">Products</a>
            <a href="{{ route('customization') }}" class="hover:text-yellow-400">Customization</a>
            <a href="{{ route('about-us') }}" class="hover:text-yellow-400">About Us</a>
        </nav>

        <!-- Authentication Links & User Dashboard (Desktop - Hidden on Mobile) -->
        <div class="hidden lg:flex space-x-6 items-center">
            @auth
                <!-- User Dashboard Link -->
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" 
                    class="text-white hover:text-yellow-400">
                    <i class="fas fa-user-circle text-xl"></i>
                </a>

                <!-- Cart Icon -->
                <a href="{{ route('cart.view') }}" class="relative flex items-center text-gray-700 dark:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5 5m2 8L3 3m4 10v5m10-5v5m-6-5v5">
                        </path>
                    </svg>
                    <span id="cart-count"
                        class="absolute -top-1 -right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2 py-0">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </a>

                <!-- Logout -->
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   class="hover:text-yellow-400">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-yellow-400">Login</a>
            @endauth
        </div>
    </div>

    <!-- Mobile Navigation Menu (Hidden by Default) -->
    <nav id="mobile-menu" class="hidden lg:hidden bg-gray-900 text-white py-4">
        <div class="container mx-auto flex flex-col items-center space-y-4">
            <a href="{{ route('home') }}" class="hover:text-yellow-400">Home</a>
            <a href="{{ route('products') }}" class="hover:text-yellow-400">Products</a>
            <a href="{{ route('customization') }}" class="hover:text-yellow-400">Customization</a>
            <a href="{{ route('about-us') }}" class="hover:text-yellow-400">About Us</a>
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" 
                    class="hover:text-yellow-400">
                    Dashboard
                </a>
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   class="hover:text-yellow-400">
                    Logout
                </a>
            @else
                <a href="{{ route('login') }}" class="hover:text-yellow-400">Login</a>
            @endauth
        </div>
    </nav>
</header>

<!-- JavaScript for Mobile Menu Toggle -->
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>

<!-- FontAwesome CDN (Ensure it's included in your layout) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
