<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>About Us - Royal Caps</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Ensure Tailwind CSS is linked -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    @include('layouts.navigation')

    <hr class="border-t-2 border-gray-300 my-0">

    <!-- Hero Section -->
    <section class="bg-gray-800 py-16 text-white">
        <div class="container mx-auto px-6 md:px-12 lg:px-20">
            <h1 class="text-4xl font-bold text-center">About Royal Caps</h1>
            <p class="text-lg text-center mt-4">
                Your trusted partner in creating customized caps that speak your unique story.
            </p>
        </div>
    </section>

    <!-- About Us Content -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-6 md:px-12 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Text Content -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Who We Are</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        At Royal Caps, we specialize in crafting high-quality, customizable caps for individuals, businesses, and teams worldwide. 
                        With a deep passion for creativity and precision, we’ve built a reputation as leaders in personalized headwear.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Whether you're looking to showcase your brand, unify your team, or express your personal style, our mission is to deliver caps that 
                        combine exceptional craftsmanship with your vision.
                    </p>
                </div>
                <!-- Image -->
                <div>
                    <img src="{{ asset('images/aboutus1.jpg') }}" alt="Royal Caps" class="rounded-lg shadow-md">
                </div>
            </div>
        </div>
    </section>

    <!-- Mission and Vision -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-6 md:px-12 lg:px-20 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Mission and Vision</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Mission -->
                <div class="bg-gray-50 rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-blue-600 mb-2">Our Mission</h3>
                    <p class="text-gray-600">
                        To empower creativity by providing top-notch customization options that allow our customers to design caps that reflect their unique identities.
                    </p>
                </div>
                <!-- Vision -->
                <div class="bg-gray-50 rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-blue-600 mb-2">Our Vision</h3>
                    <p class="text-gray-600">
                        To become the global leader in customized headwear, fostering connections and individuality through personalized design solutions.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-6 md:px-12 lg:px-20">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-6">Why Choose Royal Caps?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Quality -->
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Exceptional Quality</h3>
                    <p class="text-gray-600">We use the finest materials and techniques to ensure every cap meets your expectations.</p>
                </div>
                <!-- Customization -->
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Endless Customization</h3>
                    <p class="text-gray-600">From colors to logos, we provide tools to help you design the perfect cap.</p>
                </div>
                <!-- Service -->
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Outstanding Support</h3>
                    <p class="text-gray-600">Our dedicated team is here to assist you at every step of the process.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-gray-800 py-12 text-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Join the Royal Caps Family</h2>
            <p class="text-lg mb-6">Discover the difference that custom design and premium quality can make.</p>
            <a href="{{ route('customization') }}" class="px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow-md hover:bg-gray-100">
                Start Customizing
            </a>
        </div>
    </section>

    <hr class="border-t-2 border-gray-300 my-0">


    @include('layouts.footer')

</body>
</html>
