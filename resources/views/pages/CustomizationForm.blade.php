<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Customize Your Cap</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">

    @if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif


@include('layouts.navigation')

<hr class="border-t-2 border-gray-300 my-0">

<section class="bg-white py-12">
    <div class="container mx-auto px-6 md:px-12 lg:px-20">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-6">Customize Your Cap</h1>
        <form method="POST" action="{{ route('customization.submit') }}" enctype="multipart/form-data" class="max-w-2xl mx-auto bg-gray-50 p-6 rounded-lg shadow-md">
            @csrf

            <!-- Customer Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Full Name</label>
                <input type="text" name="name" id="name" placeholder="Enter your full name" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <!-- Customer Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter your email address" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <!-- Customer Address -->
            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-semibold mb-2">Address</label>
                <textarea name="address" id="address" rows="3" placeholder="Enter your address" class="w-full border-gray-300 rounded-lg shadow-sm" required></textarea>
            </div>

            <!-- Contact Number -->
            <div class="mb-4">
                <label for="contact_number" class="block text-gray-700 font-semibold mb-2">Contact Number</label>
                <input type="text" name="contact_number" id="contact_number" placeholder="Enter your contact number" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <!-- Select Cap Style -->
            <div class="mb-4">
                <label for="style" class="block text-gray-700 font-semibold mb-2">Select Cap Style</label>
                <select name="style" id="style" class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="snapback">Snapback</option>
                    <option value="trucker">Trucker</option>
                    <option value="dad-cap">Dad Cap</option>
                </select>
            </div>

            <!-- Upload Logo -->
            <div class="mb-4">
                <label for="logo" class="block text-gray-700 font-semibold mb-2">Upload Your Logo</label>
                <input type="file" name="logo" id="logo" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <!-- Choose Cap Color -->
            <div class="mb-4">
                <label for="color" class="block text-gray-700 font-semibold mb-2">Choose Cap Color</label>
                <select name="color" id="color" class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="black" style="background-color: black; color: white;">Black</option>
                    <option value="white" style="background-color: white; color: black;">White</option>
                    <option value="red" style="background-color: red; color: white;">Red</option>
                    <option value="blue" style="background-color: blue; color: white;">Blue</option>
                    <option value="green" style="background-color: green; color: white;">Green</option>
                </select>
            </div>
            

            <!-- Select Category -->
            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-semibold mb-2">Select Category</label>
                <select name="category" id="category" class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="men">Men</option>
                    <option value="women">Women</option>
                </select>
            </div>

            <!-- Additional Notes -->
            <div class="mb-4">
                <label for="notes" class="block text-gray-700 font-semibold mb-2">Additional Notes</label>
                <textarea name="notes" id="notes" rows="4" placeholder="Enter any additional customization requests" class="w-full border-gray-300 rounded-lg shadow-sm"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700">
                Submit Your Customization
            </button>

        </form>
    </div>
</section>

<hr class="border-t-2 border-gray-300 my-0">

@include('layouts.footer')  

</body>
</html>
