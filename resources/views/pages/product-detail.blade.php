<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - Product Details</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 text-gray-800">

@include('layouts.navigation')

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md min-h-screen">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Product Image -->
        <div>
            @if ($product->product_image)
                @php $images = json_decode($product->product_image, true); @endphp
                @if (!empty($images))
                    <img src="{{ asset('/uploads/' . $images[0]) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg shadow">
                @endif
            @endif
        </div>

        <!-- Product Details -->
        <!-- Product Details -->
<div>
    <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
    <p class="text-gray-600 mt-2">{{ $product->description }}</p>
    <p class="text-blue-600 font-bold text-2xl mt-4">LKR {{ number_format($product->price, 2) }}</p>

    <p class="text-gray-700 mt-2">Color: <span class="font-semibold">{{ $product->color }}</span></p>
    <p class="text-gray-700 mt-2">Stock: <span id="stock-count" class="font-semibold">{{ $product->stock }}</span></p>

    <!-- Quantity Selector -->
    {{-- <div class="mt-4 flex items-center">
        <label class="text-gray-700 font-semibold mr-2">Quantity:</label>
        <button type="button" id="decreaseQty" class="bg-gray-300 px-3 py-1 rounded-l text-gray-700 hover:bg-gray-400">-</button>
        <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
               class="w-16 text-center border border-gray-300 py-1">
        <button type="button" id="increaseQty" class="bg-gray-300 px-3 py-1 rounded-r text-gray-700 hover:bg-gray-400">+</button>
    </div> --}}

    <!-- Add to Cart Button -->
    @auth
        <!-- If User is Logged In -->
        <form action="{{ route('cart.add', ['id' => $product->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="price" value="{{ $product->price }}">
            <input type="hidden" name="color" value="{{ $product->color }}">
        
            <!-- Quantity Input -->
            <label for="quantity" class="block text-gray-700 font-semibold">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                class="border border-gray-300 rounded-lg p-2 w-24">
            
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg shadow-md hover:bg-blue-700 mt-3">
                Add to Cart
            </button>
        </form>
    @else
        <!-- If User is NOT Logged In -->
        <a href="{{ route('login') }}" class="w-full bg-red-600 text-white py-2 rounded-lg shadow-md hover:bg-red-700 mt-3 block text-center">
            Login to Add to Cart
        </a>
    @endauth
</div>

</div>


</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let stock = parseInt(document.getElementById('stock-count').textContent);
        let quantityInput = document.getElementById('quantity');
        let addToCartBtn = document.getElementById('addToCartBtn');
        let addToCartForm = document.getElementById('addToCartForm');
        let selectedQuantity = document.getElementById('selectedQuantity');

        // Increase Quantity
        document.getElementById('increaseQty').addEventListener('click', function () {
            let currentQty = parseInt(quantityInput.value);
            if (currentQty < stock) {
                quantityInput.value = currentQty + 1;
                selectedQuantity.value = quantityInput.value;
            }
        });

        // Decrease Quantity
        document.getElementById('decreaseQty').addEventListener('click', function () {
            let currentQty = parseInt(quantityInput.value);
            if (currentQty > 1) {
                quantityInput.value = currentQty - 1;
                selectedQuantity.value = quantityInput.value;
            }
        });

        // Validate Stock Before Adding to Cart
        addToCartForm.addEventListener('submit', function (event) {
            let selectedQty = parseInt(quantityInput.value);
            if (selectedQty > stock || stock === 0) {
                event.preventDefault(); // Prevent form submission
                alert("This product is out of stock!");
            }
        });
    });
</script>

</body>

@include('layouts.footer')

</html>
