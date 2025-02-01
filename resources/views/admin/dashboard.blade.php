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

    
    <!-- Admin List -->
    <div class="bg-white rounded shadow p-6 mb-8 max-w-3xl mx-auto mt-11">
        <h3 class="text-2xl font-semibold mb-4 text-center">Admin List</h3>
        @if($admins->isEmpty())
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
        @if($users->isEmpty())
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
                                    <button type="submit" class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">
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
    
    <!-- Customizations List -->
    <div class="bg-white rounded shadow p-6 mb-8 max-w-6xl mx-auto">
        <h3 class="text-2xl font-semibold mb-4 text-center">Customizations List</h3>
        @if($customizations->isEmpty())
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customizations as $customization)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $customization->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $customization->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $customization->email }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $customization->contact_number }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $customization->address }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $customization->style }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $customization->color }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $customization->category }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    
    <!-- Product Form -->
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold mb-6 text-center">Add New Product</h2>
    
        <form action="{{ route('products.store') }}" method="POST">
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
                <select name="category" id="category" class="w-full border border-gray-300 rounded-lg shadow-sm p-2">
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
            <label for="product_images" class="block text-gray-700 font-semibold mb-2">Upload Product Images</label>
            <input type="file" name="product_images[]" id="product_images" multiple class="w-full border border-gray-300 rounded-lg shadow-sm p-2">
            <p class="text-sm text-gray-500">You can upload multiple images (JPEG, PNG, JPG, GIF).</p>
        </div>
    
            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg shadow-md hover:bg-blue-700">
                Add Product
            </button>
        </form>
    
        @if(session('success'))
        <div class="text-green-600 text-center mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    </div>
    <hr class="border-t-2 border-gray-300 my-0 mb-6 mt-6">
    
    @include('layouts.footer')

</x-app-layout>