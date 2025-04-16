<div class="bg-white shadow rounded p-3 md:p-6 space-y-4 md:space-y-6">
    <h3 class="text-lg md:text-xl font-semibold">Dados do Mercado</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
        <!-- Gráfico de novos anúncios -->
        <div>
            <h4 class="text-xs md:text-sm font-medium mb-2">Número de Novos Anúncios na Zona</h4>
            <canvas id="adsChart" height="120"></canvas>
        </div>

        <!-- Comparação com média -->
        <div>
            <h4 class="text-xs md:text-sm font-medium mb-2">Comparação do Preço do Imóvel com a Média da Zona</h4>
            <canvas id="compareChart" height="120"></canvas>
            <div class="mt-2 text-center text-gray-500 text-xs md:text-sm">
                {{ number_format($ad->area_average, 0, ',', '.') }}€ <span class="font-semibold">Preço Médio da Zona</span>
            </div>
            <div class="text-center mt-1">
                <span class="inline-block px-2 py-1 bg-blue-600 text-white text-xs rounded shadow">
                    Este Imóvel está acima da média!
                </span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const newAds = @json($ad->monthly_ads); // [15, 20, 18, 25, 35, 28]
            const months = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun'];
            const currentPrice = @json($ad->price);
            const areaAvg = @json($ad->area_average);

            // Function to handle responsive charts
            function handleResponsiveCharts() {
                const isMobile = window.innerWidth < 768;

                new Chart(document.getElementById('adsChart').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Anúncios',
                            data: newAds,
                            backgroundColor: 'rgba(59,130,246,0.7)',
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                bodyFont: { size: isMobile ? 10 : 12 }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { font: { size: isMobile ? 10 : 12 } }
                            },
                            x: {
                                ticks: { font: { size: isMobile ? 10 : 12 } }
                            }
                        }
                    }
                });

                new Chart(document.getElementById('compareChart').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: ['Este imóvel', 'Média da zona'],
                        datasets: [{
                            data: [currentPrice, areaAvg],
                            backgroundColor: ['#3B82F6', '#D1D5DB'],
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                bodyFont: { size: isMobile ? 10 : 12 }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { font: { size: isMobile ? 10 : 12 } }
                            },
                            x: {
                                ticks: { font: { size: isMobile ? 10 : 12 } }
                            }
                        }
                    }
                });
            }

            // Initial render
            handleResponsiveCharts();

            // Update on resize
            window.addEventListener('resize', handleResponsiveCharts);
        });
    </script>
@endpush
