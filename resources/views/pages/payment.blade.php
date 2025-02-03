@include('layouts.header')    

<body class="bg-gray-100 text-gray-800">
@include('layouts.navigation')

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-center mb-6">Card Payment</h1>

    <p class="text-center text-gray-600 mb-6">Enter your card details to complete the payment.</p>

    <form action="#" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Cardholder Name</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Card Number</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg p-2" required>
        </div>

        <div class="flex space-x-4">
            <div class="w-1/2">
                <label class="block text-gray-700 font-semibold">Expiry Date</label>
                <input type="text" class="w-full border border-gray-300 rounded-lg p-2" placeholder="MM/YY" required>
            </div>
            <div class="w-1/2">
                <label class="block text-gray-700 font-semibold">CVV</label>
                <input type="text" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg shadow-md hover:bg-blue-700 mt-6">
            Pay Now
        </button>
    </form>
</div>

@include('layouts.footer')

</body>
</html>
