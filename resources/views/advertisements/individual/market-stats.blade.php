<div class="bg-white shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] rounded-2xl p-5 md:p-8 space-y-5 animate-fade-in">
    <div class="flex items-center justify-between border-b border-indigo-100 pb-4">
        <h3 class="text-xl md:text-2xl font-bold text-primary flex items-center gap-2">
            <i class="bi bi-bar-chart-fill text-secondary text-2xl"></i>
            Dados do Mercado
        </h3>
        <span class="bg-indigo-100 text-secondary text-xs md:text-sm font-semibold px-3 py-1 rounded-full shadow-sm">Atualizado</span>
    </div>

    <div class="space-y-5">
        <div class="flex items-center gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <div class="text-2xl md:text-3xl font-extrabold text-gray-900">
                        {{ number_format($ad->district_average ?? 0, 0, ',', '.') }}€
                    </div>
                    @php
                        $isAboveAverage = $ad->price > $ad->district_average && $ad->district_average > 0;
                        $isBelowAverage = $ad->price < $ad->district_average && $ad->district_average > 0;
                        $percentDiff = $ad->district_average > 0 ?
                            abs(round((($ad->price - $ad->district_average) / $ad->district_average) * 100, 1)) : 0;
                    @endphp
                    @if($ad->district_average > 0)
                        <div class="{{ $isAboveAverage ? 'text-blue-600' : 'text-green-600' }} text-sm md:text-base font-medium flex items-center gap-1">
                            <i class="bi {{ $isAboveAverage ? 'bi-arrow-up-circle-fill' : 'bi-arrow-down-circle-fill' }}"></i>
                            {{ number_format($percentDiff, 1, ',', '.') }}% {{ $isAboveAverage ? 'acima' : 'abaixo' }}
                        </div>
                    @endif
                </div>
                <div class="text-xs md:text-sm text-gray-500">
                    Preço Médio {{ $ad->transaction_type == 'rent' ? 'para Arrendamento' : 'para Venda' }}, {{ $ad->property->property_type->name ?? 'Imóvel' }}
                </div>
                <div class="text-xs mt-1 {{ $isBelowAverage ? 'text-green-600' : 'text-blue-600' }} font-semibold flex items-center gap-1">
                    <i class="bi {{ $isBelowAverage ? 'bi-check-circle-fill text-green-500' : 'bi-info-circle-fill text-blue-500' }}"></i>
                    {{ $isBelowAverage ? 'Bom negócio! Abaixo da média do distrito' : 'Preço acima da média do distrito' }}
                </div>
            </div>
        </div>

        <div class="h-[180px] md:h-[160px] mt-2">
            <canvas id="compareChart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currentPrice = @json($ad->price);
            const districtAvg = @json($ad->district_average ?? 0);
            const transactionType = @json($ad->transaction_type);
            const distrito = @json($ad->property->parish->municipality->district->name ?? 'Não disponível');

            // Formatar valores grandes para exibição sem centavos
            function formatCurrency(value) {
                return parseFloat(value).toLocaleString('pt-PT', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }) + "€";
            }

            // Function to handle responsive chart
            function handleResponsiveChart() {
                const isMobile = window.innerWidth < 768;

                // Limpar canvas existente para evitar duplicação
                const chartElement = document.getElementById('compareChart');
                if (window.marketComparison) {
                    window.marketComparison.destroy();
                }

                window.marketComparison = new Chart(chartElement.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: [`Este imóvel`, `Média em ${distrito}`],
                        datasets: [{
                            data: [currentPrice, districtAvg],
                            backgroundColor: [
                                currentPrice > districtAvg ? '#3B82F6' : '#10B981',
                                'rgba(209, 213, 219, 0.7)'
                            ],
                            borderColor: [
                                currentPrice > districtAvg ? '#2563EB' : '#059669',
                                '#9CA3AF'
                            ],
                            borderWidth: 1,
                            borderRadius: 8,
                            barThickness: isMobile ? 40 : 60
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: 'rgba(255, 255, 255, 0.9)',
                                titleColor: '#111827',
                                bodyColor: '#374151',
                                borderColor: '#E5E7EB',
                                borderWidth: 1,
                                padding: 12,
                                cornerRadius: 8,
                                callbacks: {
                                    title: function(context) {
                                        return context[0].label;
                                    },
                                    label: function(context) {
                                        return formatCurrency(context.raw);
                                    }
                                },
                                bodyFont: { size: isMobile ? 10 : 12, family: "'Inter', sans-serif" }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(203, 213, 225, 0.3)',
                                    drawBorder: false
                                },
                                ticks: {
                                    font: { size: isMobile ? 10 : 12, family: "'Inter', sans-serif" },
                                    color: '#64748B',
                                    callback: function(value) {
                                        if (value >= 1000) {
                                            return Math.round(value / 1000) + 'k€';
                                        }
                                        return value + '€';
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    font: { size: isMobile ? 11 : 13, family: "'Inter', sans-serif" },
                                    color: '#64748B',
                                    maxRotation: 0,
                                    autoSkip: false
                                }
                            }
                        },
                        layout: {
                            padding: {
                                top: 10,
                                bottom: 10
                            }
                        },
                        animation: {
                            duration: 1000,
                            easing: 'easeOutQuart'
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
