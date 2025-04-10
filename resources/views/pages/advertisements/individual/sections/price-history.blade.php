<div class="bg-white shadow rounded p-6 space-y-4">
    <h3 class="text-xl font-semibold">Histórico de Preços do Imóvel</h3>

    <div class="flex items-center justify-between">
        <div>
            <div class="text-2xl font-bold text-gray-900">
                {{ number_format(end($ad->price_history), 0, ',', '.') }}€
            </div>
            <div class="text-sm text-gray-500">preço médio</div>
            <div class="text-xs mt-1 text-green-600 font-semibold">● On Track</div>
        </div>

    </div>

    <canvas id="priceHistoryChart" height="130"></canvas>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const prices = @json($ad->price_history);
            const labels = Array.from({length: prices.length}, (_, i) => i + 1);

            new Chart(document.getElementById('priceHistoryChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        data: prices,
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59,130,246,0.1)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'white',
                        pointBorderColor: '#3B82F6',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: { display: true },
                        y: { beginAtZero: false }
                    }
                }
            });
        });
    </script>
@endpush
