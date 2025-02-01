<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Royal Caps</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Ensure Tailwind CSS is linked -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    @include('layouts.navigation')

    @include('layouts.slideshow')
    
    {{-- @include('layouts.productslideshowWithPromotions') --}}
   
    <section class="container mx-auto py-12 px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-3xl font-bold mb-4 flex justify-around">INTRODUCTION</h2>
                <p class="mb-2">Welcome to Royal Caps, the ultimate destination for premium headwear that blends style, comfort, and quality. Our carefully curated collection features a wide variety of caps and hats, ensuring there's something for everyone.</p>
                <p class="mb-2">Our commitment to excellence is reflected in every piece we offer. We source only the finest materials and partner with skilled artisans to create headwear that stands the test of time.</p>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <img src="https://sterkowski.com/blog/wp-content/uploads/2022/08/CZX-AFG-BveSOC4.jpg" alt="Hat Image" class="rounded-lg">
                <img src="https://images.pexels.com/photos/1040945/pexels-photo-1040945.jpeg?cs=srgb&dl=pexels-blitzboy-1040945.jpg&fm=jpg" alt="Hat Image" class="rounded-lg">
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">Our Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-20">
                <div class="relative">
                    <img src="https://cdn.shopify.com/s/files/1/0408/9909/files/Feature_x_New_Era_-_Timepiece_Los_Angeles_Dodgers_-_New_York_Yankees_-_San_Diego_Padres_-_Green-Royal_-_Feature.jpg?v=1637021590" alt="Product 1" class="w-full h-full object-cover rounded-lg shadow-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center p-4 opacity-0 hover:opacity-100 transition-opacity duration-300">
                        <h2 class="text-white text-xl md:text-2xl font-bold mb-4">Exclusive Cap</h2>
                        <a href="/products" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Shop Now</a>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://tombalding.com/cdn/shop/files/PhotoJul182024_111647AM.jpg?v=1721323508&width=1946" alt="Product 2" class="w-full h-full object-cover rounded-lg shadow-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center p-4 opacity-0 hover:opacity-100 transition-opacity duration-300">
                        <h2 class="text-white text-xl md:text-2xl font-bold mb-4">Limited Edition</h2>
                        <a href="/products" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Shop Now</a>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://www.apparelnbags.com/blog/wp-content/uploads/2024/01/best-selling-caps-for-2024-blog-social-media.jpg" alt="Product 3" class="w-full h-full object-cover rounded-lg shadow-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center p-4 opacity-0 hover:opacity-100 transition-opacity duration-300">
                        <h2 class="text-white text-xl md:text-2xl font-bold mb-4">Best Seller</h2>
                        <a href="/products" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">Customer Reviews</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                <div class="bg-white p-10 rounded-lg shadow-lg transform transition-transform duration-500 animate-fade-in-up delay-0">
                    <img src="https://play-lh.googleusercontent.com/050MUO_KcXxnSjq6V9B4OIbiTGPjv6fxHFhIGNNJsaHj2uld5mwzxO3Uf85Cp6q4Fn2B=w526-h296-rw" alt="Customer 1" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <p class="text-gray-600">“I love my cap! The quality is amazing, and the fit is perfect.”</p>
                    <h3 class="font-bold mt-4">- sunny Doe</h3>
                </div>
                <div class="bg-white p-10 rounded-lg shadow-lg transform transition-transform duration-500 animate-fade-in-up delay-1s">
                    <img src="https://play-lh.googleusercontent.com/jInS55DYPnTZq8GpylyLmK2L2cDmUoahVacfN_Js_TsOkBEoizKmAl5-p8iFeLiNjtE=w526-h296-rw" alt="Customer 2" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <p class="text-gray-600">“Great service and fast delivery! I’ll definitely be back for more.”</p>
                    <h3 class="font-bold mt-4">- Jane Smith</h3>
                </div>
                <div class="bg-white p-10 rounded-lg shadow-lg transform transition-transform duration-500 animate-fade-in-up delay-2s">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQc-XLkAcIi1IbjGAq8pst5GIJnhmEs3QdzRCadcA11AwxOa8n-gYR0Q0ODWdC9Sx_TIok&usqp=CAU" alt="Customer 3" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <p class="text-gray-600">“The customization options are fantastic. Highly recommend!”</p>
                    <h3 class="font-bold mt-4">- Lilyy madinson</h3>
                </div>
            </div>
        </div>
    </section>


    @include('layouts.footer')

    <script>
        // Toggle mobile menu visibility
        document.getElementById('menu-toggle').addEventListener('click', function () {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
