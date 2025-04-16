<div class="bg-white shadow rounded p-3 md:p-6 space-y-3 md:space-y-4">
    <h3 class="text-lg md:text-xl font-semibold">Histórico de Preços do Imóvel</h3>

    <div class="flex items-center justify-between">
        <div>
            <div class="text-xl md:text-2xl font-bold text-gray-900">
                {{ number_format(end($price_history)['price'], 0, ',', '.') }}€
            </div>
            <div class="text-xs md:text-sm text-gray-500">preço médio</div>
            <div class="text-xs mt-1 text-green-600 font-semibold">● On Track</div>
        </div>

    </div>

    <div class="h-[180px] md:h-[130px]">
        <canvas id="priceHistoryChart"></canvas>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const prices = @json(array_map(function ($item) {
                return $item['price'];
            }, $price_history));
            const labels = @json(array_map(function ($item) {
                return date('M Y', strtotime($item['date']));
            }, $price_history));

            // Function to handle responsive chart
            function handleResponsiveChart() {
                const isMobile = window.innerWidth < 768;
                const ctx = document.getElementById('priceHistoryChart').getContext('2d');

                // Clear previous chart instance if it exists
                if (window.priceHistoryChartInstance) {
                    window.priceHistoryChartInstance.destroy();
                }

                // Create new chart instance
                window.priceHistoryChartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: isMobile ? labels.slice(-4) : labels, // Show fewer points on mobile
                        datasets: [{
                            data: isMobile ? prices.slice(-4) : prices,
                            borderColor: '#3B82F6',
                            backgroundColor: 'rgba(59,130,246,0.1)',
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: 'white',
                            pointBorderColor: '#3B82F6',
                            pointRadius: isMobile ? 3 : 4,
                            pointHoverRadius: isMobile ? 5 : 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                bodyFont: { size: isMobile ? 10 : 12 }
                            }
                        },
                        scales: {
                            x: {
                                display: true,
                                ticks: { font: { size: isMobile ? 10 : 12 } }
                            },
                            y: {
                                beginAtZero: false,
                                ticks: { font: { size: isMobile ? 10 : 12 } }
                            }
                        }
                    }
                });
            }

            // Initial render
            handleResponsiveChart();

            // Update on resize
            window.addEventListener('resize', handleResponsiveChart);
        });
    </script>
@endpush
