@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div id="login-success-message" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            let message = document.getElementById('login-success-message');
            if (message) {
                message.style.transition = "opacity 0.5s ease-out";
                message.style.opacity = "0";
                setTimeout(() => message.style.display = "none", 500);
            }
        }, 3000);
    </script>

    <!-- Delivery Details Section -->
    <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md p-6 mt-11 mb-11">
        <h2 class="text-2xl font-semibold mb-4 text-center">Your Delivery Details</h2>

        @if(isset($deliveryDetails) && !$deliveryDetails->isEmpty())
            @include('admin.delivery_details', ['deliveryDetails' => $deliveryDetails])
        @else
            <p class="text-center text-gray-500">No delivery details available.</p>


            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300 rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">Delivery ID</th>
                            <th class="border border-gray-300 px-4 py-2">Name</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                            <th class="border border-gray-300 px-4 py-2">Phone</th>
                            <th class="border border-gray-300 px-4 py-2">City</th>
                            <th class="border border-gray-300 px-4 py-2">Postal Code</th>
                            <th class="border border-gray-300 px-4 py-2">Address</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deliveryDetails as $delivery)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $delivery->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $delivery->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $delivery->email }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $delivery->phone }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $delivery->city }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $delivery->postal_code }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $delivery->delivery_address }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                @if($delivery->status == 'Pending')
                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded">Pending</span>
                                @elseif($delivery->status == 'Accepted')
                                    <span class="bg-green-500 text-white px-3 py-1 rounded">Accepted</span>
                                @elseif($delivery->status == 'Rejected')
                                    <span class="bg-red-500 text-white px-3 py-1 rounded">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Orders Section -->
    <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md p-6 mt-11 mb-11">
        <h2 class="text-2xl font-semibold mb-4 text-center">Your Orders</h2>

        @if(isset($orders) && $orders->isEmpty())
            <p class="text-center text-gray-500">No orders placed yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300 rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">Order ID</th>
                            <th class="border border-gray-300 px-4 py-2">Phone</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $order->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->phone }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                @if($order->status == 'Pending')
                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded">Pending</span>
                                @elseif($order->status == 'Accepted')
                                    <span class="bg-green-500 text-white px-3 py-1 rounded">Accepted</span>
                                @elseif($order->status == 'Rejected')
                                    <span class="bg-red-500 text-white px-3 py-1 rounded">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@include('layouts.footer')
</x-app-layout>
