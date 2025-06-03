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
                <div class="flex items-center gap-2">
                    <div class="text-2xl md:text-3xl font-extrabold text-gray-900">
                        {{ number_format($priceHistory->last()->price, 0, ',', '.') }}€
                    </div>
                    @php
                        $lastPrice = $priceHistory->last()->price;
                        $previousPrice = count($priceHistory) > 1 ? $priceHistory[count($priceHistory) - 2]->price : $lastPrice;
                        $priceDiff = $lastPrice - $previousPrice;
                        $percentChange = $previousPrice > 0 ? ($priceDiff / $previousPrice) * 100 : 0;
                        $isIncrease = $priceDiff > 0;
                        $isDecrease = $priceDiff < 0;
                        $changeClass = $isIncrease ? 'text-green-600' : ($isDecrease ? 'text-rose-600' : 'text-gray-500');
                        $icon = $isIncrease ? 'bi-arrow-up-circle-fill' : ($isDecrease ? 'bi-arrow-down-circle-fill' : 'bi-dash-circle-fill');
                    @endphp
                    @if(count($priceHistory) > 1)
                        <div class="{{ $changeClass }} text-sm md:text-base font-medium flex items-center gap-1">
                            <i class="bi {{ $icon }}"></i>
                            {{ abs(round($percentChange, 1)) }}%
                        </div>
                    @endif
                </div>
                <div class="text-xs md:text-sm text-gray-500">Preço mais recente</div>
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
                const fullDates = @json($formattedDates);

                // Mapeamento de meses em português
                const ptMonths = @json($ptMonths);

                // Criar labels com os meses em português
                const labels = fullDates.map(date => {
                    const [day, month, year] = date.split('/');
                    return `${ptMonths[parseInt(month)]} ${year}`;
                });

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
                                    bodyFont: { size: isMobile ? 10 : 12 },
                                    callbacks: {
                                        title: function (context) {
                                            return fullDates[context[0].dataIndex];
                                        },
                                        label: function (context) {
                                            return `Preço: €${context.parsed.y.toLocaleString('pt-PT')}`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    display: true,
                                    ticks: { font: { size: isMobile ? 10 : 12 } }
                                },
                                y: {
                                    beginAtZero: false,
                                    ticks: {
                                        font: { size: isMobile ? 10 : 12 },
                                        callback: function (value) {
                                            return '€' + value.toLocaleString('pt-PT');
                                        }
                                    }
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
