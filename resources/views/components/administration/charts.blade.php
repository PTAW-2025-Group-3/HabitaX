@php
    $anunciosData = [12, 19, 3, 5, 2, 3];
    $utilizadoresData = [8, 15, 6, 9, 5, 4];
    $receitaData = [100, 120, 90, 140, 130, 150];
    $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
@endphp

<div class="grid grid-cols-3 gap-6 animate-fade-in">
    <div class="bg-white p-4 shadow rounded-xl">
        <h4 class="font-semibold text-primary mb-2">Anúncios</h4>
        <canvas id="anunciosChart" class="w-full h-48"></canvas>
    </div>
    <div class="bg-white p-4 shadow rounded-xl">
        <h4 class="font-semibold text-primary mb-2">Utilizadores</h4>
        <canvas id="utilizadoresChart" class="w-full h-48"></canvas>
    </div>
    <div class="bg-white p-4 shadow rounded-xl">
        <h4 class="font-semibold text-primary mb-2">Receita Gerada</h4>
        <canvas id="receitaChart" class="w-full h-48"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($labels);

    new Chart(document.getElementById('anunciosChart'), {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Anúncios',
                data: @json($anunciosData),
                borderColor: '#4f46e5',
                backgroundColor: 'rgba(79, 70, 229, 0.2)',
                fill: true,
                tension: 0.3
            }]
        }
    });

    new Chart(document.getElementById('utilizadoresChart'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Utilizadores',
                data: @json($utilizadoresData),
                backgroundColor: '#1d4ed8'
            }]
        }
    });

    new Chart(document.getElementById('receitaChart'), {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Receita (€)',
                data: @json($receitaData),
                borderColor: '#059669',
                backgroundColor: 'rgba(5, 150, 105, 0.2)',
                fill: true,
                tension: 0.3
            }]
        }
    });
</script>
