<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row p-6"> <!-- Add row for grid layout -->
                    <!-- Pie Chart Column -->
                    <div class="col-md-4">
                        <canvas id="productPieChart"></canvas>
                    </div>

                    <!-- Bar Chart Column -->
                    <div class="col-md-4" height="300">
                        <canvas id="productBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            // Data for Pie Chart
            var ctx = document.getElementById('productPieChart').getContext('2d');
            var productPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Published', 'Not Published'],
                    datasets: [{
                        label: 'Product Publish Status',
                        data: [{{ $publishedCount }}, {{ $notPublishedCount }}],
                        backgroundColor: ['#4CAF50', '#FF5733'],
                        borderColor: ['#ffffff', '#ffffff'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Product Publish Status', // Title text
                            font: {
                                size: 18,
                                weight: 'bold'
                            },
                            color: '#333'
                        },
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });

            // Get the context of the canvas element for the bar chart
            var ctx = document.getElementById('productBarChart').getContext('2d');

            // Create the bar chart
            var productBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($productsByDate->pluck('date')) !!},  // Dates for x-axis
                    datasets: [{
                        label: 'Products Created',
                        data: {!! json_encode($productsByDate->pluck('count')) !!},  // Product counts for y-axis
                        backgroundColor: '#4CAF50',  // Bar color
                        borderColor: '#2C6E49',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Products Created Per Date',
                            font: {
                                size: 18,
                                weight: 'bold'
                            },
                            color: '#333'
                        },
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });
        
        });
    </script>
    @endpush
</x-app-layout>