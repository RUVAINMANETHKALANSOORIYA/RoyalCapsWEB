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

<hr class="border-t-2 border-gray-300 my-0">

 <!-- Hero Section with Slideshow -->
 <div class="relative w-full h-[600px] overflow-hidden">
    <div class="absolute inset-0">
        <div class="slideshow" x-data="{ currentSlide: 0 }" x-init="setInterval(() => currentSlide = (currentSlide + 1) % 3, 5000)">
            <img class="slide h-full w-full object-cover absolute transition-opacity duration-1000" 
                 :class="{ 'opacity-100': currentSlide === 0, 'opacity-0': currentSlide !== 0 }" 
                 src="{{ asset('images/customize1.jpg') }}" alt="Slideshow Image 1">
            <img class="slide h-full w-full object-cover absolute transition-opacity duration-1000" 
                 :class="{ 'opacity-100': currentSlide === 1, 'opacity-0': currentSlide !== 1 }" 
                 src="{{ asset('images/customize2.webp') }}" alt="Slideshow Image 2">
            <img class="slide h-full w-full object-cover absolute transition-opacity duration-1000" 
                 :class="{ 'opacity-100': currentSlide === 2, 'opacity-0': currentSlide !== 2 }" 
                 src="{{ asset('images/customize3.jpg') }}" alt="Slideshow Image 3">
        </div>
    </div>

    <!-- Hero Content -->
    <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white bg-gradient-to-b from-black/40 to-black/70">
        <h1 class="text-5xl font-bold mb-6 tracking-tight animate-fade-in">
            let's customize your cap today.
        </h1>
        <p class="text-lg mb-6">Design your own cap with our customization tool. <br>Choose from a variety of styles, colors, and <br>embroidery options to create a cap that's uniquely yours.
        </p>
        <a href="#explore" class="mt-8 px-8 py-3 bg-white text-black rounded-full hover:bg-opacity-90 transition-all duration-300 font-semibold animate-bounce">
            Explore Now
        </a>
    </div>
</div>

<!-- Introduction Section -->
<section class="bg-white py-12">
    <div class="container mx-auto px-6 md:px-12 lg:px-20">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-6">Welcome to Royal Caps Customization</h1>
        <p class="text-lg text-gray-600 text-center leading-relaxed">
            At Royal Caps, we believe in letting you create your perfect cap. Whether it's for your brand, team, or a personal statement, 
            our customization tool allows you to design caps that reflect your unique style. 
        </p>
        <p class="text-lg text-gray-600 text-center mt-4 leading-relaxed">
            Choose from a variety of designs, colors, and embroidery options to create a cap that's uniquely yours.
        </p>
    </div>
</section>

<!-- How Customization Works -->
<section class="bg-gray-50 py-12">
    <div class="container mx-auto px-6 md:px-12 lg:px-20">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">How Customization Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Step 1 -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 mx-auto bg-gray-200 rounded-full flex items-center justify-center mb-4">
                    <span class="text-2xl font-bold text-gray-800">1</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Choose Your Cap</h3>
                <p class="text-gray-600">Browse our collection and select a cap style that suits your needs.</p>
            </div>
            <!-- Step 2 -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 mx-auto bg-gray-200 rounded-full flex items-center justify-center mb-4">
                    <span class="text-2xl font-bold text-gray-800">2</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Add Your Design</h3>
                <p class="text-gray-600">Upload your logo or use our design tools to create your custom look.</p>
            </div>
            <!-- Step 3 -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 mx-auto bg-gray-200 rounded-full flex items-center justify-center mb-4">
                    <span class="text-2xl font-bold text-gray-800">3</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Preview and Order</h3>
                <p class="text-gray-600">See your cap in 3D and place your order for fast delivery.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-gray-800 py-12 text-white">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Create Your Custom Cap?</h2>
        <p class="text-lg mb-6">Start designing today and make your vision a reality.</p>
        <a href="{{ route('customization.form') }}" class="px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow-md hover:bg-gray-100">
            Start Customizing
        </a>
        
    </div>
</section>

<hr class="border-t-2 border-gray-300 my-0">


@include('layouts.footer')



</body>
</html>