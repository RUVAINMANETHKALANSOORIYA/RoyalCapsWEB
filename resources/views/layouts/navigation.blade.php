<!-- Header -->
<header class="bg-gray-800 text-white">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
        <!-- Logo -->
        <a href="{{ route('welcome') }}" class="text-xl font-bold tracking-wide hover:text-yellow-400">
            {{ config('app.name', 'Royal Caps') }}
        </a>

        <!-- Navigation Links -->
        <nav class="hidden lg:flex space-x-6 mx-auto">
            <a href="{{ route('home') }}" class="hover:text-yellow-400">Home</a>
            <a href="{{ route('products') }}" class="hover:text-yellow-400">Products</a>
            <a href="{{ route('customization') }}" class="hover:text-yellow-400">Customization</a>
            <a href="{{ route('about-us') }}" class="hover:text-yellow-400">About Us</a>
        </nav>

        <!-- Authentication Links & User Dashboard -->
        <div class="hidden lg:flex space-x-4 items-center">
            @auth
                <span class="text-sm">Welcome, {{ Auth::user()->name }}</span>

                <!-- User Dashboard Link -->
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" 
                    class="text-white hover:text-yellow-400">
                     <i class="fas fa-user-circle text-lg"></i> <!-- FontAwesome User Icon -->
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
</header>

<!-- FontAwesome CDN (Ensure it's included in your layout) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
