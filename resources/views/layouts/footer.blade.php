 <!-- Footer -->
 <footer class="bg-gray-800 text-white py-6">
    <div class="container mx-auto text-center">
        <p>&copy; {{ date('Y') }} Royal Caps. All rights reserved.</p>
        <p class="mt-2">
            <a href="{{ route('welcome') }}" class="hover:text-yellow-400">Home</a> | 
            <a href="{{ route('products') }}" class="hover:text-yellow-400">Products</a> | 
            <a href="{{ route('customization') }}" class="hover:text-yellow-400">Customization</a> | 
            <a href="{{ route('about-us') }}" class="hover:text-yellow-400">About Us</a>
        </p>
    </div>
</footer>