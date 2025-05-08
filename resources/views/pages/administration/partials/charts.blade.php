<div class="col-span-1 bg-white p-4 shadow rounded-xl">
    <h4 class="font-semibold text-primary mb-2">Anúncios</h4>
    <canvas id="anunciosChart" class="w-full h-48"></canvas>
</div>
<div class="col-span-1 bg-white p-4 shadow rounded-xl">
    <h4 class="font-semibold text-primary mb-2">Utilizadores</h4>
    <canvas id="utilizadoresChart" class="w-full h-48"></canvas>
</div>
<div class="col-span-1 bg-white p-4 shadow rounded-xl">
    <h4 class="font-semibold text-primary mb-2">Utilizadores por Tipo</h4>
    <canvas id="userRolesChart" class="w-full h-48"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($chartLabels);

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
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        title: function(context) {
                            return labels[context[0].dataIndex] + ' ' + new Date().getFullYear();
                        }
                    }
                }
            }
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

    // Create the user roles chart and make it globally accessible
    window.userRolesChart = new Chart(document.getElementById('userRolesChart'), {
        type: 'bar',
        data: {
            labels: @json($userRoleLabels),
            datasets: [{
                label: 'Total',
                data: @json($userRoleData),
                backgroundColor: [
                    '#3b82f6', // blue for users
                    '#8b5cf6', // purple for moderators
                    '#ef4444'  // red for admins
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Function to update user roles chart data
    function updateUserRolesChart() {
        fetch('/admin/user-roles-data', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(res => res.json())
            .then(data => {
                if (window.userRolesChart) {
                    window.userRolesChart.data.datasets[0].data = data.userRoleData;
                    window.userRolesChart.update();
                }
            })
            .catch(err => {
                console.error('Erro ao atualizar gráfico:', err);
            });
    }

    // Make the update function globally accessible
    window.updateUserRolesChart = updateUserRolesChart;
</script>
