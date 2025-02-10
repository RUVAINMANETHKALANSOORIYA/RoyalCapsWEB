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

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md min-h-screen">
    <h1 class="text-3xl font-bold text-center mb-6">Checkout</h1>

    <!-- Order Summary -->
<div class="mb-6">
    <h2 class="text-2xl font-semibold mb-4">Order Summary</h2>

    @if(empty($cart) || count($cart) == 0)
        <p class="text-center text-gray-500">Your cart is empty.</p>
    @else
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300 rounded-lg shadow-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2">Product</th>
                        <th class="border border-gray-300 px-4 py-2">Price</th>
                        <th class="border border-gray-300 px-4 py-2">Quantity</th>
                        <th class="border border-gray-300 px-4 py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $subtotal = 0; @endphp
                    @foreach($cart as $item)
                        @php 
                            $total = $item['price'] * $item['quantity'];
                            $subtotal += $total;
                        @endphp
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2">{{ $item['name'] }}</td>
                            <td class="border border-gray-300 px-4 py-2">LKR {{ number_format($item['price'], 2) }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $item['quantity'] }}</td>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">LKR {{ number_format($total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray-100">
                        <td colspan="3" class="border border-gray-300 px-4 py-2 font-bold text-right">Subtotal:</td>
                        <td class="border border-gray-300 px-4 py-2 font-bold">LKR {{ number_format($subtotal, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endif
</div>

 <!-- Payment Options -->
 <div class="flex justify-between mt-6">
    <a href="{{ route('cash_on_delivery') }}" 
       class="w-1/2 bg-green-600 text-white text-center py-2 rounded-lg shadow-md hover:bg-green-700 mx-1">
        Cash on Delivery
    </a>
    
    <a href="{{ route('index') }}" 
       class="w-1/2 bg-blue-600 text-white text-center py-2 rounded-lg shadow-md hover:bg-blue-700 mx-1">
        Card Payment
    </a>
</div>
</div>


    <!-- Delivery Details -->
    
</div>


</body>
@include('layouts.footer')

</html>
