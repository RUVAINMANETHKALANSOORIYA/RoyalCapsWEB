<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shopping Cart - Royal Caps</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 text-gray-800">

@include('layouts.navigation')

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-center mb-6">Shopping Cart</h1>

    @if(session('success'))
        <div class="text-green-600 text-center mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(empty($cart))
        <p class="text-center text-gray-500">Your cart is empty.</p>
    @else
        <table class="table-auto w-full border-collapse border border-gray-300 rounded-lg shadow-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="border border-gray-300 px-4 py-2">Product</th>
                    <th class="border border-gray-300 px-4 py-2">Price</th>
                    <th class="border border-gray-300 px-4 py-2">Color</th>
                    <th class="border border-gray-300 px-4 py-2">Quantity</th>
                    <th class="border border-gray-300 px-4 py-2">Subtotal</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    @php 
                        $itemStock = isset($item['stock']) ? $item['stock'] : 1; // Default to 1 if stock is missing
                        $subtotal = $item['price'] * $item['quantity']; 
                    @endphp
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 flex items-center">
                            @if (!empty($item['image']))
                                <img src="{{ asset('images/products/' . $item['image']) }}" class="w-12 h-12 object-cover mr-2">
                            @endif
                            {{ $item['name'] }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">LKR {{ number_format($item['price'], 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['color'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="number" value="{{ $item['quantity'] }}" min="1" max="{{ $itemStock }}" 
                                class="w-16 text-center border border-gray-300 py-1 update-quantity" 
                                data-id="{{ $item['id'] }}" data-price="{{ $item['price'] }}" data-stock="{{ $itemStock }}">
                        </td>
                        <td class="border border-gray-300 px-4 py-2 subtotal">LKR {{ number_format($subtotal, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('cart.remove', $item['id']) }}" class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">
                                Remove
                            </a>
                        </td>
                    </tr>
                    @php $total += $subtotal; @endphp
                @endforeach
            </tbody>
            
            <!-- Total Price Section -->
            <tfoot>
                <tr>
                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-right font-semibold">Total:</td>
                    <td class="border border-gray-300 px-4 py-2 font-bold" id="cart-total">LKR {{ number_format($total, 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2"></td>
                </tr>
            </tfoot>
            
            <!-- JavaScript for Live Update -->
            <script>
                document.querySelectorAll('.update-quantity').forEach(input => {
                    input.addEventListener('change', function() {
                        let quantity = parseInt(this.value);
                        let maxStock = parseInt(this.getAttribute('data-stock'));
                        let price = parseFloat(this.getAttribute('data-price'));
                        let id = this.getAttribute('data-id');
            
                        if (quantity <= 0) {
                            alert('Quantity cannot be less than 1.');
                            this.value = 1;
                            quantity = 1;
                        }
            
                        if (quantity > maxStock) {
                            alert('Only ' + maxStock + ' items available in stock.');
                            this.value = maxStock;
                            quantity = maxStock;
                        }
            
                        let subtotalElement = this.closest('tr').querySelector('.subtotal');
                        let subtotal = price * quantity;
                        subtotalElement.textContent = 'LKR ' + subtotal.toFixed(2);
            
                        updateCartTotal();
                    });
                });
            
                function updateCartTotal() {
                    let total = 0;
                    document.querySelectorAll('.subtotal').forEach(subtotalElement => {
                        total += parseFloat(subtotalElement.textContent.replace('LKR ', ''));
                    });
                    document.getElementById('cart-total').textContent = 'LKR ' + total.toFixed(2);
                }
            </script>
            
            
        </table>

        <!-- Total Price -->
        <div class="text-right mt-4 text-xl font-bold">
            Total: LKR <span id="total-amount">{{ number_format($total, 2) }}</span>
        </div>

        <!-- Proceed to Checkout -->
        <div class="text-right mt-6">
            <a href="{{ route('checkout') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Proceed to Checkout
            </a>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateQuantityInputs = document.querySelectorAll('.update-quantity');

        updateQuantityInputs.forEach(input => {
            input.addEventListener('change', function () {
                let quantity = parseInt(this.value);
                let price = parseFloat(this.dataset.price);
                let subtotalElement = this.closest('tr').querySelector('.subtotal');
                let totalAmountElement = document.getElementById('total-amount');

                // Validate stock and quantity
                if (quantity < 1) {
                    this.value = 1;
                    quantity = 1;
                }

                let subtotal = quantity * price;
                subtotalElement.innerText = 'LKR ' + subtotal.toFixed(2);

                // Update total
                let total = 0;
                document.querySelectorAll('.subtotal').forEach(subtotalElem => {
                    total += parseFloat(subtotalElem.innerText.replace('LKR ', ''));
                });
                totalAmountElement.innerText = total.toFixed(2);

                // Send AJAX request to update cart
                fetch(`/cart/update/${this.dataset.id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ quantity: quantity })
                }).then(response => response.json()).then(data => {
                    console.log(data.message);
                }).catch(error => console.error(error));
            });
        });
    });
</script>


</body>
@include('layouts.footer')

</html>
