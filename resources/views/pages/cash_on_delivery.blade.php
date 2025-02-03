@extends('layouts.header')

@include('layouts.navigation')

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-center mb-6">Cash on Delivery</h1>

    <p class="text-center text-gray-600 mb-6">
        Fill in the delivery details to proceed with Cash on Delivery.
    </p>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="text-green-600 text-center mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Delivery Details Form -->
    <form id="checkout-form" action="{{ route('delivery_details.store') }}" method="POST">
        @csrf
    
        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold">Full Name</label>
            <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-lg p-2" required>
        </div>
    
        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold">Email</label>
            <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg p-2" required>
        </div>
    
        <!-- Phone Number -->
        <div class="mb-4">
            <label for="phone" class="block text-gray-700 font-semibold">Phone Number</label>
            <input type="text" id="phone" name="phone" class="w-full border border-gray-300 rounded-lg p-2" required>
        </div>
    
        <!-- City -->
        <div class="mb-4">
            <label for="city" class="block text-gray-700 font-semibold">City</label>
            <input type="text" id="city" name="city" class="w-full border border-gray-300 rounded-lg p-2" required>
        </div>
    
        <!-- Postal Code -->
        <div class="mb-4">
            <label for="postal_code" class="block text-gray-700 font-semibold">Postal Code</label>
            <input type="text" id="postal_code" name="postal_code" class="w-full border border-gray-300 rounded-lg p-2" required>
        </div>
    
        <!-- Delivery Address -->
        <div class="mb-4">
            <label for="delivery_address" class="block text-gray-700 font-semibold">Delivery Address</label>
            <textarea id="delivery_address" name="delivery_address" class="w-full border border-gray-300 rounded-lg p-2" required></textarea>
        </div>
    
        <!-- Delivery Instructions -->
        <div class="mb-4">
            <label for="delivery_instructions" class="block text-gray-700 font-semibold">Delivery Instructions</label>
            <textarea id="delivery_instructions" name="delivery_instructions" class="w-full border border-gray-300 rounded-lg p-2"></textarea>
        </div>
    
        <!-- Submit Button -->
        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg shadow-md hover:bg-green-700 mt-6">
            Place Order
        </button>
    </form>
    

{{-- 
<!-- Order Form -->
<form id="order-form" action="{{ route('orders.store') }}" method="POST">
    @csrf

    <!-- Phone Number -->
    <div class="mb-4">
        <label for="phone" class="block text-gray-700 font-semibold">Phone Number</label>
        <input type="text" id="phone" name="phone" class="w-full border border-gray-300 rounded-lg p-2" required>
    </div>

    <!-- Delivery Instructions -->
    <div class="mb-4">
        <label for="delivery_instructions" class="block text-gray-700 font-semibold">Delivery Instructions</label>
        <textarea id="delivery_instructions" name="delivery_instructions" class="w-full border border-gray-300 rounded-lg p-2" required></textarea>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg shadow-md hover:bg-green-700 mt-6">
        Place Order
    </button>
</form> --}}

{{-- <div class="text-center mt-6">
    <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Return to Home</a>
</div> --}}
</div>


@include('layouts.footer')
