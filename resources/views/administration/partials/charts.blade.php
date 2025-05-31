<div class="bg-white rounded-xl shadow-sm border border-gray overflow-hidden">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-secondary">Anúncios</h3>
        <p class="text-sm text-gray mt-1">Últimos 6 meses</p>
    </div>
    <div class="px-6 pb-6">
        <div class="h-52">
            <canvas id="anunciosChart"></canvas>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray overflow-hidden">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-secondary">Utilizadores</h3>
        <p class="text-sm text-gray mt-1">Últimos 6 meses</p>
    </div>
    <div class="px-6 pb-6">
        <div class="h-52">
            <canvas id="utilizadoresChart"></canvas>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray overflow-hidden">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-secondary">Utilizadores por Tipo</h3>
        <p class="text-sm text-gray mt-1">Distribuição atual</p>
    </div>
    <div class="px-6 pb-6">
        <div class="h-52">
            <canvas id="userRolesChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($chartLabels);
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    title: function(context) {
                        return labels[context[0].dataIndex] + ' ' + new Date().getFullYear();
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    display: true,
                    color: 'rgba(0,0,0,0.05)'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    };

    new Chart(document.getElementById('anunciosChart'), {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Anúncios',
                data: @json($anunciosData),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
                tension: 0.3,
                borderWidth: 3
            }]
        },
        options: chartOptions
    });

    new Chart(document.getElementById('utilizadoresChart'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Utilizadores',
                data: @json($utilizadoresData),
                backgroundColor: 'rgba(79, 70, 229, 0.8)',
                borderRadius: 4,
                barPercentage: 0.8,
                categoryPercentage: 0.9
            }],
        },
        options: {
            ...chartOptions,
            scales: {
                ...chartOptions.scales,
                x: {
                    ...chartOptions.scales.x,
                    offset: true,
                    ticks: {
                        align: 'center'
                    }
                }
            }
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
                ],
                borderRadius: 4,
                barPercentage: 0.6, // Reduz a largura das barras para 60%
                categoryPercentage: 0.8 // Ajusta o espaçamento entre categorias
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: 'rgba(0,0,0,0.05)'
                    },
                    // Garante que o eixo Y tenha espaço suficiente no topo
                    suggestedMax: function(context) {
                        const max = Math.max(...context.chart.data.datasets[0].data);
                        return max * 1.2; // Adiciona 20% de espaço acima do valor máximo
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            layout: {
                padding: {
                    top: 15 // Adiciona um padding no topo do gráfico
                }
            },
            animation: {
                duration: 1000 // Animação mais suave
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
