<div class="bg-white shadow-lg rounded-2xl p-6 space-y-6 animate-fade-in">
    <div class="flex items-center justify-between border-b border-indigo-100 pb-4">
        <h3 class="text-xl md:text-2xl font-bold text-primary flex items-center">
            <i class="bi bi-cash-coin mr-3 text-secondary"></i>
            Simulador de Despesas Mensais
        </h3>
        <span class="bg-indigo-100 text-secondary text-xs font-semibold px-3 py-1 rounded-full">Arrendamento</span>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <!-- Renda Mensal -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300">
            <label class="text-sm md:text-base font-medium text-primary flex items-center gap-1">
                Renda Mensal
                <i class="bi bi-info-circle text-gray-400 hover:text-primary transition-colors text-sm cursor-pointer"
                   title="Valor da renda mensal pedida pelo senhorio."></i>
            </label>
            <div class="flex items-center space-x-4 mt-2">
                <div class="w-full">
                    <input
                        type="range"
                        id="renda-slider"
                        min="200"
                        max="5000"
                        step="50"
                        value="{{ $ad->price }}"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600"
                        oninput="updateSlider('renda')"
                    >
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>200€</span>
                        <span>5.000€</span>
                    </div>
                </div>
                <div class="relative">
                    <input
                        type="text"
                        id="renda-input"
                        class="w-32 border-2 border-indigo-200 focus:border-indigo-500 rounded-lg p-2 text-right font-semibold text-secondary"
                        value="{{ number_format($ad->price, 0, ',', '.') }}€"
                        oninput="updateInput('renda')"
                    >
                </div>
            </div>
        </div>

        <!-- Condomínio -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300">
            <label class="text-sm md:text-base font-medium text-primary flex items-center gap-1">
                Condomínio
                <i class="bi bi-info-circle text-gray-400 hover:text-primary transition-colors text-sm cursor-pointer"
                   title="Despesas mensais com manutenção do edifício e áreas comuns."></i>
            </label>
            <div class="flex items-center space-x-4 mt-2">
                <div class="w-full">
                    <input
                        type="range"
                        id="condominio-slider"
                        min="0"
                        max="500"
                        step="10"
                        value="50"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600"
                        oninput="updateSlider('condominio')"
                    >
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>0€</span>
                        <span>500€</span>
                    </div>
                </div>
                <div class="relative">
                    <input
                        type="text"
                        id="condominio-input"
                        class="w-32 border-2 border-indigo-200 focus:border-indigo-500 rounded-lg p-2 text-right font-semibold text-secondary"
                        value="50€"
                        oninput="updateInput('condominio')"
                    >
                </div>
            </div>
        </div>

        <!-- Internet -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300">
            <label class="text-sm md:text-base font-medium text-primary flex items-center gap-1">
                Internet
                <i class="bi bi-info-circle text-gray-400 hover:text-primary transition-colors text-sm cursor-pointer"
                   title="Custo médio mensal de um serviço de internet em casa."></i>
            </label>
            <div class="flex items-center space-x-4 mt-2">
                <div class="w-full">
                    <input
                        type="range"
                        id="internet-slider"
                        min="10"
                        max="100"
                        step="5"
                        value="35"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600"
                        oninput="updateSlider('internet')"
                    >
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>10€</span>
                        <span>100€</span>
                    </div>
                </div>
                <div class="relative">
                    <input
                        type="text"
                        id="internet-input"
                        class="w-32 border-2 border-indigo-200 focus:border-indigo-500 rounded-lg p-2 text-right font-semibold text-secondary"
                        value="35€"
                        oninput="updateInput('internet')"
                    >
                </div>
            </div>
        </div>

        <!-- Utilidades -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300">
            <label class="text-sm md:text-base font-medium text-primary flex items-center gap-1">
                Água, Luz e Gás
                <i class="bi bi-info-circle text-gray-400 hover:text-primary transition-colors text-sm cursor-pointer"
                   title="Estimativa das despesas com utilidades básicas como eletricidade, água e gás."></i>
            </label>
            <div class="flex items-center space-x-4 mt-2">
                <div class="w-full">
                    <input
                        type="range"
                        id="utilidades-slider"
                        min="30"
                        max="300"
                        step="10"
                        value="150"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600"
                        oninput="updateSlider('utilidades')"
                    >
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>30€</span>
                        <span>300€</span>
                    </div>
                </div>
                <div class="relative">
                    <input
                        type="text"
                        id="utilidades-input"
                        class="w-32 border-2 border-indigo-200 focus:border-indigo-500 rounded-lg p-2 text-right font-semibold text-secondary"
                        value="150€"
                        oninput="updateInput('utilidades')"
                    >
                </div>
            </div>
        </div>

        <!-- Total Estimado -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl p-4 shadow-md mt-2">
            <div class="flex items-center justify-between">
                <label class="text-sm font-medium text-indigo-100">Despesas Totais Estimadas</label>
                <i class="bi bi-calculator text-xl text-indigo-100"></i>
            </div>
            <div class="text-2xl font-bold mt-2" id="total-despesas">435€</div>
            <div class="text-xs text-indigo-100 mt-1">Baseado nos valores simulados acima</div>
        </div>

        <!-- Botão de impressão -->
        <div class="pt-4">
            <button id="print-despesas-btn" class="btn-secondary w-full py-3">
                <i class="bi bi-printer mr-2"></i>
                Imprimir simulação
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const campos = ['renda', 'condominio', 'internet', 'utilidades'];

        campos.forEach(campo => {
            document.getElementById(`${campo}-slider`).addEventListener('input', () => updateSlider(campo));
            document.getElementById(`${campo}-input`).addEventListener('input', () => updateInput(campo));
        });

        function updateSlider(campo) {
            const slider = document.getElementById(`${campo}-slider`);
            const input = document.getElementById(`${campo}-input`);
            input.value = formatCurrency(slider.value) + '€';
            calcularTotal();
        }

        function updateInput(campo) {
            const slider = document.getElementById(`${campo}-slider`);
            const input = document.getElementById(`${campo}-input`);
            let val = parseInt(input.value.replace(/[^0-9]/g, '')) || 0;
            slider.value = val;
            input.value = formatCurrency(val) + '€';
            calcularTotal();
        }

        function calcularTotal() {
            let total = 0;
            campos.forEach(campo => {
                const val = parseInt(document.getElementById(`${campo}-slider`).value) || 0;
                total += val;
            });
            document.getElementById('total-despesas').innerText = formatCurrency(total) + '€';
        }

        function formatCurrency(val) {
            return new Intl.NumberFormat('pt-PT').format(val);
        }

        document.getElementById('print-despesas-btn').addEventListener('click', printSimulation);

        calcularTotal();

        function printSimulation() {
            const data = {
                renda: document.getElementById('renda-input').value,
                condominio: document.getElementById('condominio-input').value,
                internet: document.getElementById('internet-input').value,
                utilidades: document.getElementById('utilidades-input').value,
                total: document.getElementById('total-despesas').innerText
            };

            const printWindow = window.open('', '_blank');

            printWindow.document.write(`
        <!DOCTYPE html>
        <html lang="pt">
        <head>
            <meta charset="UTF-8">
            <title>Simulação de Despesas Mensais</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; padding: 20px; }
                h1 { color: #1e3a8a; text-align: center; margin-bottom: 30px; }
                .container { max-width: 800px; margin: 0 auto; }
                .header { border-bottom: 2px solid #4f46e5; padding-bottom: 15px; margin-bottom: 20px; }
                .row { display: flex; margin-bottom: 15px; }
                .label { font-weight: bold; width: 200px; }
                .value { flex: 1; }
                .results { margin-top: 30px; background-color: #f3f4f6; padding: 20px; border-radius: 8px; }
                .result-title { font-weight: bold; color: #4f46e5; margin-bottom: 10px; }
                .footer { margin-top: 40px; text-align: center; font-size: 12px; color: #6b7280; }
                @media print {
                    body { padding: 0; }
                    .no-print { display: none; }
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Simulação de Despesas Mensais</h1>
                    <p class="date">Data: ${new Date().toLocaleDateString('pt-PT')}</p>
                </div>

                <div class="parameters">
                    <h2>Despesas Detalhadas</h2>

                    <div class="row">
                        <div class="label">Renda Mensal:</div>
                        <div class="value">${data.renda}</div>
                    </div>

                    <div class="row">
                        <div class="label">Condomínio:</div>
                        <div class="value">${data.condominio}</div>
                    </div>

                    <div class="row">
                        <div class="label">Internet:</div>
                        <div class="value">${data.internet}</div>
                    </div>

                    <div class="row">
                        <div class="label">Água, Luz e Gás:</div>
                        <div class="value">${data.utilidades}</div>
                    </div>
                </div>

                <div class="results">
                    <h2>Total Estimado</h2>

                    <div class="result-title">Despesas Totais:</div>
                    <div style="font-size: 24px; font-weight: bold; text-align: center; margin: 15px 0;">
                        ${data.total}
                    </div>
                </div>

                <div class="footer">
                    <p>Esta simulação é meramente indicativa e baseada em valores estimados.</p>
                    <p>Podem existir variações dependendo do consumo real e contratos efetuados.</p>
                </div>

                <div class="no-print" style="text-align: center; margin-top: 30px;">
                    <button onclick="window.print();" style="padding: 10px 20px; background-color: #4f46e5; color: white; border: none; border-radius: 5px; cursor: pointer;">Imprimir</button>
                    <button onclick="window.close();" style="padding: 10px 20px; background-color: #9ca3af; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">Fechar</button>
                </div>
            </div>
        </body>
        </html>
    `);
            printWindow.document.close();
        }
    });
</script>
