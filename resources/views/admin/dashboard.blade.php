@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
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
        // Automatically hide the message after 4 seconds
        setTimeout(function() {
            let message = document.getElementById('login-success-message');
            if (message) {
                message.style.transition = "opacity 0.5s ease-out";
                message.style.opacity = "0";
                setTimeout(() => message.style.display = "none", 500);
            }
        }, 3000); // 4000ms = 4 seconds
    </script>

    @if (isset($deliveryDetails))
        @include('admin.delivery_details', ['deliveryDetails' => $deliveryDetails])
    @else
        <p class="text-center text-gray-500 ">No delivery details available.</p>
    @endif


    <!-- Admin List -->
    <div class="bg-white rounded shadow p-6 mb-8 max-w-3xl mx-auto mt-11">
        <h3 class="text-2xl font-semibold mb-4 text-center">Admin List</h3>
        @if ($admins->isEmpty())
            <p class="text-center text-gray-500">No admins available.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300 rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Name</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $admin->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $admin->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $admin->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Users List -->
    <div class="bg-white rounded shadow p-6 mb-8 max-w-3xl mx-auto">
        <h3 class="text-2xl font-semibold mb-4 text-center">Users List</h3>
        @if ($users->isEmpty())
            <p class="text-center text-gray-500">No users available.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300 rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Name</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                            <th class="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $user->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="bg-white rounded shadow p-6 mb-8 max-w-7xl mx-auto">
        <h3 class="text-2xl font-semibold mb-4 text-center">Customizations List</h3>
        @if ($customizations->isEmpty())
            <p class="text-center text-gray-500">No customizations available.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300 rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Name</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                            <th class="border border-gray-300 px-4 py-2">Phone</th>
                            <th class="border border-gray-300 px-4 py-2">Address</th>
                            <th class="border border-gray-300 px-4 py-2">Style</th>
                            <th class="border border-gray-300 px-4 py-2">Color</th>
                            <th class="border border-gray-300 px-4 py-2">Category</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                            <th class="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customizations as $customization)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $customization->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $customization->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $customization->email }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    {{ $customization->contact_number }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $customization->address }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $customization->style }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $customization->color }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $customization->category }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <span
                                        class="px-3 py-1 text-white rounded-lg
                                    {{ $customization->status == 'Accepted' ? 'bg-green-500' : ($customization->status == 'Rejected' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                        {{ $customization->status }}
                                    </span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    @if ($customization->status == 'Pending')
                                        <form action="{{ route('admin.customizations.accept', $customization->id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">Accept</button>
                                        </form>

                                        <form action="{{ route('admin.customizations.reject', $customization->id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">Reject</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Orders List -->
    {{-- <div class="bg-white rounded shadow p-6 mb-8 max-w-6xl mx-auto">
        <h3 class="text-2xl font-semibold mb-4 text-center">Orders List</h3>
        @if ($orders->isEmpty())
            <p class="text-center text-gray-500">No orders available.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300 rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">Order ID</th>
                            <th class="border border-gray-300 px-4 py-2">Customer</th>
                            <th class="border border-gray-300 px-4 py-2">Phone</th>
                            <th class="border border-gray-300 px-4 py-2">Delivery Address</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                            <th class="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $order->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->phone }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $order->delivery_address }}</td>
                                <td
                                    class="border border-gray-300 px-4 py-2 text-center font-semibold 
                            @if ($order->status == 'Pending') text-yellow-500 
                            @elseif($order->status == 'Accepted') text-green-500 
                            @else text-red-500 @endif">
                                    {{ $order->status }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                            class="border border-gray-300 rounded p-1">
                                            <option value="Pending"
                                                {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Accepted"
                                                {{ $order->status == 'Accepted' ? 'selected' : '' }}>Accept</option>
                                            <option value="Rejected"
                                                {{ $order->status == 'Rejected' ? 'selected' : '' }}>Reject</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div> --}}


    <!-- Product Form -->
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6 mt-6">
        <h2 class="text-2xl font-semibold mb-6 text-center">Add New Product</h2>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Product Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Product Name</label>
                <input type="text" name="name" id="name" required
                    class="w-full border border-gray-300 rounded-lg shadow-sm p-2">
            </div>

            <!-- Product Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full border border-gray-300 rounded-lg shadow-sm p-2"></textarea>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-semibold mb-2">Price (LKR)</label>
                <input type="number" name="price" id="price" step="0.01" required
                    class="w-full border border-gray-300 rounded-lg shadow-sm p-2">
            </div>

            <!-- Stock Quantity -->
            <div class="mb-4">
                <label for="stock" class="block text-gray-700 font-semibold mb-2">Stock Quantity</label>
                <input type="number" name="stock" id="stock" required min="0"
                    class="w-full border border-gray-300 rounded-lg shadow-sm p-2">
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-semibold mb-2">Category</label>
                <select name="category" id="category"
                    class="w-full border border-gray-300 rounded-lg shadow-sm p-2">
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                </select>
            </div>

            <!-- Color Selection -->
            <div class="mb-4">
                <label for="color" class="block text-gray-700 font-semibold mb-2">Choose Color</label>
                <select name="color" id="color" class="w-full border border-gray-300 rounded-lg shadow-sm p-2">
                    <option value="Black">Black</option>
                    <option value="White">White</option>
                    <option value="Red">Red</option>
                    <option value="Blue">Blue</option>
                    <option value="Green">Green</option>
                </select>
            </div>


            <!-- Product Images (Multiple Uploads) -->
            <div class="mb-4">
                <label for="product_image" class="block text-gray-700 font-semibold mb-2">Upload Product
                    Images</label>
                <input type="file" name="product_image[]" id="product_image" multiple
                    class="w-full border border-gray-300 rounded-lg shadow-sm p-2">
                <p class="text-sm text-gray-500">You can upload multiple images (JPEG, PNG, JPG, GIF).</p>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg shadow-md hover:bg-blue-700">
                Add Product
            </button>
        </form>

        @if (session('success'))
            <div class="text-green-600 text-center mb-4">
                {{ session('success') }}
            </div>
        @endif

    </div>

    <!-- Products List Section -->
    <div class="bg-white rounded shadow p-6 mb-8 max-w-7xl mx-auto mt-11 mb-14">
        <h3 class="text-2xl font-semibold mb-4 text-center">Manage Products</h3>

        @if (isset($products) && !$products->isEmpty())
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300 rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Product Name</th>
                            <th class="border border-gray-300 px-4 py-2">Category</th>
                            <th class="border border-gray-300 px-4 py-2">Price (LKR)</th>
                            <th class="border border-gray-300 px-4 py-2">Stock</th>
                            <th class="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $product->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $product->category }}</td>
                                <td class="border border-gray-300 px-4 py-2">LKR
                                    {{ number_format($product->price, 2) }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $product->stock }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center flex justify-center gap-2">
                                    <!-- Edit Button -->
                                    <button onclick="openEditModal({{ json_encode($product) }})"
                                        class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                        Edit
                                    </button>

                                    <!-- Delete Form -->
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-500">No products available.</p>
        @endif

    </div>

    <!-- Edit Product Modal -->
    <div id="editProductModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">Edit Product</h2>

            <form id="editProductForm" action="" method="POST">
                @csrf
                @method('PATCH')

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="edit_name" class="block text-gray-700 font-semibold">Product Name</label>
                    <input type="text" name="name" id="edit_name"
                        class="w-full border border-gray-300 rounded-lg shadow-sm p-2" required>
                </div>

                <!-- Product Price -->
                <div class="mb-4">
                    <label for="edit_price" class="block text-gray-700 font-semibold">Price (LKR)</label>
                    <input type="number" name="price" id="edit_price" step="0.01"
                        class="w-full border border-gray-300 rounded-lg shadow-sm p-2" required>
                </div>

                <!-- Stock -->
                <div class="mb-4">
                    <label for="edit_stock" class="block text-gray-700 font-semibold">Stock Quantity</label>
                    <input type="number" name="stock" id="edit_stock" min="0"
                        class="w-full border border-gray-300 rounded-lg shadow-sm p-2" required>
                </div>

                <!-- Category Selection -->
                <div class="mb-4">
                    <label for="edit_category" class="block text-gray-700 font-semibold">Category</label>
                    <select name="category" id="edit_category"
                        class="w-full border border-gray-300 rounded-lg shadow-sm p-2" required>
                        <option value="Men">Men</option>
                        <option value="Women">Women</option>
                    </select>
                </div>

                   <!-- Product Image -->
            <div class="mb-4">
                <label for="edit_image" class="block text-gray-700 font-semibold">Update Product Image</label>
                <input type="file" name="product_image" id="edit_image" 
                    class="w-full border border-gray-300 rounded-lg shadow-sm p-2">
                <p class="text-sm text-gray-500">Leave this blank if you don't want to update the image.</p>
            </div>

                <!-- Submit Button -->
                <div class="flex justify-between">
                    <button type="button" onclick="closeEditModal()"
                        class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Cancel
                    </button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript to Handle Modal -->
    <script>
        function openEditModal(product) {
            document.getElementById('edit_name').value = product.name;
            document.getElementById('edit_price').value = product.price;
            document.getElementById('edit_stock').value = product.stock;
            document.getElementById('edit_category').value = product.category; // Set category value


            // Set the form action dynamically
            document.getElementById('editProductForm').action = `/admin/products/${product.id}`;

            document.getElementById('editProductModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editProductModal').classList.add('hidden');
        }
    </script>







    @include('layouts.footer')

</x-app-layout>
