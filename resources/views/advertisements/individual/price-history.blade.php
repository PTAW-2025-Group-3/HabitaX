<div class="bg-white shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] rounded-2xl p-5 md:p-8 space-y-5 animate-fade-in">
    <div class="flex items-center justify-between border-b border-indigo-100 pb-4">
        <h3 class="text-xl md:text-2xl font-bold text-primary flex items-center gap-2">
            <i class="bi bi-graph-up-arrow text-secondary text-2xl"></i>
            Histórico de Preços
        </h3>
        <span class="bg-indigo-100 text-secondary text-xs md:text-sm font-semibold px-3 py-1 rounded-full shadow-sm">Atualizado</span>
    </div>

    @if(count($priceHistory) > 0)
        <div class="flex items-center gap-4">
            <div>
                <div class="text-2xl md:text-3xl font-extrabold text-gray-900">
                    {{ number_format($priceHistory->last()->price, 0, ',', '.') }}€
                </div>
                <div class="text-xs md:text-sm text-gray-500">Preço mais recente</div>
                <div class="text-xs mt-1 text-green-600 font-semibold flex items-center gap-1">
                    <i class="bi bi-check-circle-fill text-green-500"></i>
                    Em linha com o mercado
                </div>
            </div>
        </div>

        <div class="h-[180px] md:h-[140px]">
            <canvas id="priceHistoryChart"></canvas>
        </div>
    @else
        <div class="text-center py-8 text-gray-500">
            <i class="bi bi-info-circle text-2xl mb-2 block"></i>
            <p>Não há histórico de preços disponível para este anúncio.</p>
        </div>
    @endif
</div>

@if(count($priceHistory) > 0)
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const prices = @json($priceHistory->pluck('price'));
                const labels = @json($priceHistory->map(function($item) {
                    return $item->register_date->format('M Y');
                }));

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
@endif
