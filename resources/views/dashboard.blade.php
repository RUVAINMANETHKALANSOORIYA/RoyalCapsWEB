@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>

        <!-- Settings Dropdown -->
        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile')" wire:navigate>
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    {{-- <button wire:click="logout" class="w-full text-start">
                        <x-dropdown-link>
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </button> --}}
                </x-slot>
            </x-dropdown>
        </div>
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
        // Automatically hide the message after 4 seconds
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
    
    @if($deliveryDetails->isEmpty())
        <p class="text-center text-gray-500">No delivery details available.</p>
    @else
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
        
        @if($orders->isEmpty())
            <p class="text-center text-gray-500">No orders placed yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300 rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">Order ID</th>
                            <th class="border border-gray-300 px-4 py-2">Delivery Address</th>
                            <th class="border border-gray-300 px-4 py-2">Phone</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $order->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->delivery_address }}</td>
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

