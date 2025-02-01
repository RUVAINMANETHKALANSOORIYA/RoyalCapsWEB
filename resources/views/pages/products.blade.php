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

<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-center mb-6">Our Products</h1>

    <!-- Men's Collection -->
    <div class="mb-10">
        <h2 class="text-2xl font-semibold mb-4">Men's Collection</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($menProducts as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if ($product->product_image)
                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover">
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                        <p class="text-gray-600">{{ $product->description }}</p>
                        <p class="text-blue-600 font-bold">${{ $product->price }}</p>
                        <p class="text-gray-700">Color: <span class="font-semibold">{{ $product->color }}</span></p>
                        <p class="text-gray-700">Stock: <span class="font-semibold">{{ $product->stock }}</span></p>
                    </div>
                </div>
            @endforeach
        </div>
        

    <!-- Women's Collection -->
    <div class="mb-10">
        <h2 class="text-2xl font-semibold mb-4">Women's Collection</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($womenProducts as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if ($product->product_image)
                        <img src="{{ asset('storage/' . $product->product_image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-40 object-cover">
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                        <p class="text-gray-600">{{ $product->description }}</p>
                        <p class="text-blue-600 font-bold">${{ $product->price }}</p>
                        <p class="text-gray-700">Color: <span class="font-semibold">{{ $product->color }}</span></p>
                        <p class="text-gray-700">Stock: <span class="font-semibold">{{ $product->stock }}</span></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


    @include('layouts.footer')

</body>
</html>

