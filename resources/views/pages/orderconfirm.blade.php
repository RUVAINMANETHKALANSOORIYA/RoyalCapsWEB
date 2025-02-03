@include('layouts.header')  




<body class="bg-gray-100 text-gray-800">

@include('layouts.navigation')

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md text-center">
    <h1 class="text-3xl font-bold text-green-600 mb-6">Thank You!</h1>
    <p class="text-lg text-gray-700">
        {{ session('success') ?? "Your delivery details have been saved successfully!" }}
    </p>

    <a href="{{ route('home') }}" class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700">
        Continue Shopping
    </a>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Set cart count to 0
        localStorage.setItem('cart_count', 0);
        document.getElementById('cart-count').innerText = '0';

        let message = localStorage.getItem('order_success');
        if (message) {
            document.getElementById('order-message').innerText = message;
            localStorage.removeItem('order_success');
        } else {
            document.getElementById('order-message').innerText = "Your order has been processed.";
        }
    });
</script>



</body>
@include('layouts.footer')

</html>
