@extends('base')

@section('title', 'Products')

@section('content')
    <h2 class="text-2xl font-semibold mb-6">Product List</h2>

    <!-- Filter Bar -->
    <div class="mb-4 flex space-x-4">
        <!-- Name Filter -->
        <div class="w-full sm:w-1/4">
            <input type="text" id="nameFilter" placeholder="Filter by Name" class="px-4 py-2 border rounded-md w-full" oninput="filterTable()">
        </div>
        <!-- Price Filter -->
        <div class="w-full sm:w-1/4">
            <input type="number" id="priceFilter" placeholder="Filter by Price" class="px-4 py-2 border rounded-md w-full" oninput="filterTable()">
        </div>
        <!-- Quantity Filter -->
        <div class="w-full sm:w-1/4">
            <input type="number" id="quantityFilter" placeholder="Filter by Quantity" class="px-4 py-2 border rounded-md w-full" oninput="filterTable()">
        </div>
        <!-- Description Filter -->
        <div class="w-full sm:w-1/4">
            <input type="text" id="descFilter" placeholder="Filter by Description" class="px-4 py-2 border rounded-md w-full" oninput="filterTable()">
        </div>
    </div>

    <div class="overflow-x-auto shadow-lg rounded-lg">
        <table class="min-w-full table-auto border-collapse bg-white rounded-lg" id="productTable">
            <thead>
                <tr class="bg-gray-200 text-left text-gray-700">
                    <th class="px-6 py-3 border-b font-medium text-sm cursor-pointer" onclick="sortTable(0)">#ID</th>
                    <th class="px-6 py-3 border-b font-medium text-sm cursor-pointer" onclick="sortTable(1)">Name</th>
                    <th class="px-6 py-3 border-b font-medium text-sm cursor-pointer" onclick="sortTable(2)">Description</th>
                    <th class="px-6 py-3 border-b font-medium text-sm cursor-pointer" onclick="sortTable(3)">Quantity</th>
                    <th class="px-6 py-3 border-b font-medium text-sm cursor-pointer" onclick="sortTable(4)">Image</th>
                    <th class="px-6 py-3 border-b font-medium text-sm cursor-pointer" onclick="sortTable(5)">Price</th>
                    <th class="px-6 py-3 border-b font-medium text-sm">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 border-b text-sm text-gray-800">{{ $product->id }}</td>
                        <td class="px-6 py-4 border-b text-sm text-gray-800">{{ $product->name }}</td>
                        <td class="px-6 py-4 border-b text-sm text-gray-800">{{ $product->description }}</td>
                        <td class="px-6 py-4 border-b text-sm text-gray-800">{{ $product->quantity }}</td>
                        <td class="px-6 py-4 border-b text-sm text-gray-800">
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-md">
                        </td>
                        <td class="px-6 py-4 border-b text-sm text-gray-800">{{ number_format($product->price, 2) }} MAD</td>
                        <td class="px-6 py-4 border-b text-sm text-gray-800">
                            <button class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 focus:outline-none" onclick="openEditModal({{ $product->id }})">Edit</button>
                            <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 focus:outline-none ml-2" onclick="openDeleteModal({{ $product->id }})">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-lg text-gray-500">No Products Available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
  

    <!-- Pagination (Optional) -->
    <div class="mt-4 flex justify-between">
        <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Previous</button>
        <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Next</button>
    </div>

    <!-- Modals for Edit/Delete (Placeholder for modal content) -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold">Edit Product</h3>
            <!-- Edit form here -->
            <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded" onclick="closeModal('editModal')">Close</button>
        </div>
    </div>

    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold">Are you sure you want to delete this product?</h3>
            <button class="mt-4 bg-red-500 text-white py-2 px-4 rounded" onclick="closeModal('deleteModal')">Cancel</button>
            <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded" onclick="deleteProduct()">Confirm</button>
        </div>
    </div>

    <script>
        // Filter Functionality for Multiple Columns
        function filterTable() {
            let nameFilter = document.getElementById('nameFilter').value.toLowerCase();
            let priceFilter = document.getElementById('priceFilter').value;
            let quantityFilter = document.getElementById('quantityFilter').value;
            let descFilter = document.getElementById('descFilter').value.toLowerCase();
            let rows = document.querySelectorAll('#productTable tbody tr');
            
            rows.forEach(row => {
                let productName = row.cells[1].innerText.toLowerCase();
                let productDesc = row.cells[2].innerText.toLowerCase();
                let productPrice = row.cells[5].innerText.replace(' MAD', '').trim();
                let productQuantity = row.cells[3].innerText.trim();

                let matchName = productName.includes(nameFilter);
                let matchDesc = productDesc.includes(descFilter);
                let matchPrice = priceFilter ? parseFloat(productPrice) <= parseFloat(priceFilter) : true;
                let matchQuantity = quantityFilter ? parseInt(productQuantity) <= parseInt(quantityFilter) : true;

                if (matchName && matchDesc && matchPrice && matchQuantity) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Sort Table by Column
        function sortTable(n) {
            let table = document.getElementById('productTable');
            let rows = Array.from(table.rows).slice(1);  // Excluding the header
            let isAsc = table.rows[0].cells[n].classList.contains('asc');

            rows.sort((rowA, rowB) => {
                let cellA = rowA.cells[n].innerText;
                let cellB = rowB.cells[n].innerText;
                
                return isAsc ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
            });

            rows.forEach(row => table.appendChild(row));  // Reattach rows in sorted order

            // Toggle sort direction
            table.rows[0].cells[n].classList.toggle('asc', !isAsc);
            table.rows[0].cells[n].classList.toggle('desc', isAsc);
        }

        // Modal functionality
        function openEditModal(productId) {
            document.getElementById('editModal').classList.remove('hidden');
            // Pre-fill modal with product data if needed
        }

        function openDeleteModal(productId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            // Store productId and proceed with deletion logic
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function deleteProduct() {
            // Call API or server-side logic to delete the product
            alert('Product deleted!');
            closeModal('deleteModal');
        }
    </script>
@endsection
