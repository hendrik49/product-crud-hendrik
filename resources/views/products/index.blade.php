<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Create New Product</a>
                    </div>

                    <table id="products-table" class="table-auto w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Price (RM)</th>
                                <th class="px-4 py-2">Details</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Created At</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $product->name }}</td>
                                    <td class="px-4 py-2">{{ number_format($product->price, 2) }}</td>
                                    <td class="px-4 py-2">{{ $product->detail }}</td>
                                    <td class="px-4 py-2">{{ $product->is_publish ? 'Published' : 'Not Published' }}</td>
                                    <td class="px-4 py-2">{{ $product->created_at->format('j M Y, H:i'); }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
     @push('scripts')
    <script>
        $(document).ready(function () {
            $('#products-table').DataTable({
                "searching": true,         // Enable searching
                "ordering": true,          // Enable sorting
                "paging": false,
                "info": false, 
                "order": [[ 0, 'desc' ]] 
            });
        });
    </script>
    @endpush
</x-app-layout>
