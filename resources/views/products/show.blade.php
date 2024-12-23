<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h5 class="card-title"><strong>Name:</strong> {{ $product->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><strong>Price:</strong> Rm{{ number_format($product->price, 2) }}</h6>
                    <p class="card-text"><strong>Details:</strong> {{ $product->detail }}</p>
                    <p class="card-text">
                        <strong>Status:</strong> {{ $product->is_publish ? 'Published' : 'Not Published' }}
                    </p>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
