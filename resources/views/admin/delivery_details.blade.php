<div class="bg-white rounded shadow p-6 mb-8 max-w-6xl mx-auto">
    <h3 class="text-2xl font-semibold mb-4 text-center">Delivery Details</h3>

    @if($deliveryDetails->isEmpty())
        <p class="text-center text-gray-500">No delivery details available.</p>
    @else
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300 rounded-lg shadow-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Phone</th>
                        <th class="border border-gray-300 px-4 py-2">City</th>
                        <th class="border border-gray-300 px-4 py-2">Postal Code</th>
                        <th class="border border-gray-300 px-4 py-2">Address</th>
                        <th class="border border-gray-300 px-4 py-2">Instructions</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deliveryDetails as $detail)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2">{{ $detail->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $detail->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $detail->email }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $detail->phone }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $detail->city }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $detail->postal_code }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $detail->delivery_address }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $detail->delivery_instructions ?? 'N/A' }}</td>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">
                                {{ $detail->status }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <form action="{{ route('admin.delivery.update', $detail->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="border border-gray-300 p-1 rounded">
                                        <option value="Pending" {{ $detail->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Accepted" {{ $detail->status == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="Rejected" {{ $detail->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                        Update
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
