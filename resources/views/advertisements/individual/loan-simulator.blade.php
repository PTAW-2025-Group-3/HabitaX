<div class="bg-white shadow-lg rounded-2xl p-6 space-y-6 animate-fade-in">
    <div class="flex items-center justify-between border-b border-indigo-100 pb-4">
        <h3 class="text-xl md:text-2xl font-bold text-primary flex items-center">
            <i class="bi bi-house-heart mr-3 text-secondary"></i>
            Simulador de Crédito Habitação
        </h3>
        <span class="bg-indigo-100 text-secondary text-xs font-semibold px-3 py-1 rounded-full">Compra</span>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <!-- Preço do Imóvel com Slider -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 shadow-sm transition-all duration-300 hover:shadow-md">
            <label class="text-sm md:text-base font-medium text-primary flex items-center gap-1">
                Preço do Imóvel
                <i class="bi bi-info-circle text-gray-400 hover:text-primary transition-colors text-sm cursor-pointer"
                   title="Valor de venda do imóvel definido pelo anunciante."></i>
            </label>
            <div class="flex items-center space-x-4 mt-2">
                <div class="w-full">
                    <input
                        type="range"
                        id="house-price-slider"
                        min="50000"
                        max="1000000"
                        step="5000"
                        value="{{ $ad->price }}"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600"
                        oninput="updateHousePrice(this.value)"
                    >
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>50.000€</span>
                        <span>1.000.000€</span>
                    </div>
                </div>
                <div class="relative">
                    <input
                        type="text"
                        id="house-price-input"
                        class="w-32 border-2 border-indigo-200 focus:border-indigo-500 rounded-lg p-2 text-right font-semibold text-secondary"
                        value="{{ number_format($ad->price, 0, ',', '.') }}€"
                        oninput="handleManualInput(this, 'house-price')"
                    >
                </div>
            </div>
        </div>

        <!-- Entrada Inicial com Slider -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 shadow-sm transition-all duration-300 hover:shadow-md">
            <div class="flex justify-between">
                <label class="text-sm md:text-base font-medium text-primary flex items-center gap-1">
                    Entrada Inicial
                    <i class="bi bi-info-circle text-gray-400 hover:text-primary transition-colors text-sm cursor-pointer"
                       title="Montante inicial pago pelo comprador. O restante será financiado."></i>
                </label>
                <span id="down-payment-percentage" class="text-xs font-semibold bg-blue-100 text-blue-800 px-2 py-1 rounded-full">25%</span>
            </div>

            <div class="flex items-center space-x-4 mt-2">
                <div class="w-full">
                    <input
                        type="range"
                        id="down-payment-slider"
                        min="10"
                        max="50"
                        step="1"
                        value="25"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600"
                        oninput="updateDownPayment(this.value)"
                    >
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>10%</span>
                        <span>50%</span>
                    </div>
                </div>
                <div class="relative">
                    <input
                        type="text"
                        id="down-payment-input"
                        class="w-32 border-2 border-indigo-200 focus:border-indigo-500 rounded-lg p-2 text-right font-semibold text-secondary"
                        value="{{ number_format($ad->price * 0.25, 0, ',', '.') }}€"
                        oninput="handleManualInput(this, 'down-payment')"
                    >
                </div>
            </div>
        </div>

        <!-- Taxa de Juros com Slider -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 shadow-sm transition-all duration-300 hover:shadow-md">
            <div class="flex justify-between">
                <label class="text-sm md:text-base font-medium text-primary flex items-center gap-1">
                    Taxa de Juros
                    <i class="bi bi-info-circle text-gray-400 hover:text-primary transition-colors text-sm cursor-pointer"
                       title="Percentagem anual aplicada ao valor do empréstimo. Pode ser fixa ou variável."></i>
                </label>
                <span id="interest-rate-type" class="text-xs font-semibold bg-green-100 text-green-800 px-2 py-1 rounded-full">Taxa Fixa</span>
            </div>

            <div class="flex items-center space-x-4 mt-2">
                <div class="w-full">
                    <input
                        type="range"
                        id="interest-rate-slider"
                        min="1"
                        max="7"
                        step="0.1"
                        value="3.5"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600"
                        oninput="updateInterestRate(this.value)"
                    >
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>1%</span>
                        <span>7%</span>
                    </div>
                </div>
                <div class="relative">
                    <input
                        type="text"
                        id="interest-rate-input"
                        class="w-32 border-2 border-indigo-200 focus:border-indigo-500 rounded-lg p-2 text-right font-semibold text-secondary"
                        value="3.5%"
                        oninput="handleManualInput(this, 'interest-rate')"
                    >
                </div>
            </div>
        </div>

        <!-- Prazo em Anos com Slider -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 shadow-sm transition-all duration-300 hover:shadow-md">
            <label class="text-sm md:text-base font-medium text-primary flex items-center gap-1">
                Prazo em Anos
                <i class="bi bi-info-circle text-gray-400 hover:text-primary transition-colors text-sm cursor-pointer"
                   title="Duração total do empréstimo em anos."></i>
            </label>

            <div class="flex items-center space-x-4 mt-2">
                <div class="w-full">
                    <input
                        type="range"
                        id="loan-term-slider"
                        min="10"
                        max="40"
                        step="5"
                        value="40"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600"
                        oninput="updateLoanTerm(this.value)"
                    >
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>10 anos</span>
                        <span>40 anos</span>
                    </div>
                </div>
                <div class="relative">
                    <input
                        type="text"
                        id="loan-term-input"
                        class="w-32 border-2 border-indigo-200 focus:border-indigo-500 rounded-lg p-2 text-right font-semibold text-secondary"
                        value="40 anos"
                        oninput="handleManualInput(this, 'loan-term')"
                    >
                </div>
            </div>
        </div>

        <!-- Resultados da Simulação -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <!-- Impostos e Despesas -->
            <div class="bg-blue-900 text-white rounded-xl p-4 shadow-md">
                <div class="flex items-center justify-between">
                    <label class="text-xs md:text-sm font-medium text-blue-200 flex items-center gap-1">
                        Impostos e Despesas
                        <i class="bi bi-info-circle text-blue-200 hover:text-white transition-colors text-xs cursor-pointer"
                           title="Estimativa de custos como imposto de selo, IMT, escrituras e registos."></i>
                    </label>
                    <i class="bi bi-coin text-xl text-blue-200"></i>
                </div>
                <div class="text-lg md:text-xl font-bold mt-2" id="taxes-fees">33.193€</div>
                <div class="text-xs text-blue-200 mt-1">Estimativa baseada no preço</div>
            </div>

            <!-- Montante de Empréstimo -->
            <div class="bg-indigo-600 text-white rounded-xl p-4 shadow-md">
                <div class="flex items-center justify-between">
                    <label class="text-xs md:text-sm font-medium text-indigo-200 flex items-center gap-1">
                        Montante de Empréstimo
                        <i class="bi bi-info-circle text-indigo-200 hover:text-white transition-colors text-xs cursor-pointer"
                           title="Valor que será financiado pelo banco após subtrair a entrada inicial."></i>
                    </label>
                    <i class="bi bi-bank text-xl text-indigo-200"></i>
                </div>
                <div class="text-lg md:text-xl font-bold mt-2" id="loan-amount">{{ number_format($ad->price * 0.75, 0, ',', '.') }}€</div>
                <div class="text-xs text-indigo-200 mt-1">Valor a financiar</div>
            </div>

            <!-- Prestação Mensal -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl p-4 shadow-md">
                <div class="flex items-center justify-between">
                    <label class="text-xs md:text-sm font-medium text-indigo-100 flex items-center gap-1">
                        Prestação Mensal
                        <i class="bi bi-info-circle text-indigo-100 hover:text-white transition-colors text-xs cursor-pointer"
                           title="Valor mensal estimado a pagar ao banco durante o prazo acordado."></i>
                    </label>
                    <i class="bi bi-calendar-check text-xl text-indigo-100"></i>
                </div>
                <div class="text-lg md:text-xl font-bold mt-2" id="monthly-payment">1.448€</div>
                <div class="text-xs text-indigo-100 mt-1" id="interest-rate-display">Simulação com taxa fixa 3.5%</div>
            </div>
        </div>

        <!-- Gráfico ilustrativo simples -->
        <div class="bg-white rounded-xl p-4 shadow-sm mt-4">
            <div class="h-6 w-full flex rounded-full overflow-hidden">
                <div id="down-payment-bar" class="bg-indigo-600 h-full" style="width: 25%"></div>
                <div id="loan-amount-bar" class="bg-blue-400 h-full" style="width: 75%"></div>
            </div>
            <div class="flex justify-between text-xs text-gray-500 mt-2">
                <span>Entrada: <span id="down-payment-percentage-display">25%</span></span>
                <span>Empréstimo: <span id="loan-amount-percentage-display">75%</span></span>
            </div>
        </div>

        <!-- Botões de ação -->
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 pt-4">
            <button id="print-simulation-btn" class="btn-secondary flex-1 py-3">
                <i class="bi bi-printer mr-2"></i>
                Imprimir simulação
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variáveis iniciais
        let housePrice = {{ $ad->price }};
        let downPaymentPercentage = 25;
        let loanTerm = 40;
        let interestRate = 3.5;

        // Função para impressão
        function printSimulation() {
            // Preparar dados para impressão
            const simulationData = {
                housePrice: document.getElementById('house-price-input').value,
                downPayment: document.getElementById('down-payment-input').value,
                loanTerm: document.getElementById('loan-term-input').value,
                interestRate: document.getElementById('interest-rate-input').value,
                taxesAndFees: document.getElementById('taxes-fees').innerText,
                loanAmount: document.getElementById('loan-amount').innerText,
                monthlyPayment: document.getElementById('monthly-payment').innerText
            };

            // Criar uma janela de impressão
            const printWindow = window.open('', '_blank');

            // Estilo básico para a janela de impressão
            printWindow.document.write(`
                <!DOCTYPE html>
                <html lang="pt">
                <head>
                    <meta charset="UTF-8">
                    <title>Simulação de Crédito Habitação</title>
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
                            <h1>Simulação de Crédito Habitação</h1>
                            <p class="date">Data: ${new Date().toLocaleDateString('pt-PT')}</p>
                        </div>

                        <div class="parameters">
                            <h2>Parâmetros da Simulação</h2>

                            <div class="row">
                                <div class="label">Preço do Imóvel:</div>
                                <div class="value">${simulationData.housePrice}</div>
                            </div>

                            <div class="row">
                                <div class="label">Entrada Inicial:</div>
                                <div class="value">${simulationData.downPayment} (${downPaymentPercentage}%)</div>
                            </div>

                            <div class="row">
                                <div class="label">Prazo do Empréstimo:</div>
                                <div class="value">${simulationData.loanTerm}</div>
                            </div>

                            <div class="row">
                                <div class="label">Taxa de Juro:</div>
                                <div class="value">${simulationData.interestRate} (fixa)</div>
                            </div>
                        </div>

                        <div class="results">
                            <h2>Resultados da Simulação</h2>

                            <div class="row">
                                <div class="label">Montante de Empréstimo:</div>
                                <div class="value">${simulationData.loanAmount}</div>
                            </div>

                            <div class="row">
                                <div class="label">Impostos e Despesas:</div>
                                <div class="value">${simulationData.taxesAndFees}</div>
                            </div>

                            <div class="result-title">Prestação Mensal (estimada):</div>
                            <div style="font-size: 24px; font-weight: bold; text-align: center; margin: 15px 0;">${simulationData.monthlyPayment}</div>
                        </div>

                        <div class="footer">
                            <p>Esta simulação é meramente indicativa e não constitui uma oferta de crédito.</p>
                            <p>Os valores apresentados podem variar de acordo com a avaliação do imóvel e análise de risco.</p>
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
            // Opcional: Acionar automaticamente o comando de impressão
            // printWindow.print();
        }

        // Adicionar evento de clique ao botão de impressão
        document.getElementById('print-simulation-btn').addEventListener('click', printSimulation);

        // Atualizar a taxa de juros - NOVA FUNÇÃO
        function updateInterestRate(value) {
            interestRate = parseFloat(value);
            document.getElementById('interest-rate-input').value = interestRate.toFixed(1) + '%';
            document.getElementById('interest-rate-display').innerText = 'Simulação com taxa fixa ' + interestRate.toFixed(1) + '%';
            updateCalculations();
        }

        // Resto do código original
        function updateHousePrice(value) {
            housePrice = parseInt(value);
            document.getElementById('house-price-input').value = formatCurrency(housePrice) + '€';
            updateCalculations();
        }

        function updateDownPayment(percentage) {
            downPaymentPercentage = parseInt(percentage);
            const downPaymentValue = (housePrice * downPaymentPercentage / 100);
            document.getElementById('down-payment-input').value = formatCurrency(downPaymentValue) + '€';
            document.getElementById('down-payment-percentage').innerText = downPaymentPercentage + '%';
            updateCalculations();
        }

        function updateLoanTerm(years) {
            loanTerm = parseInt(years);
            document.getElementById('loan-term-input').value = loanTerm + ' anos';
            updateCalculations();
        }

        function updateCalculations() {
            // Cálculo de valores
            const downPayment = housePrice * (downPaymentPercentage / 100);
            const loanAmount = housePrice - downPayment;

            // Cálculo de taxas e impostos (estimativa simples)
            const taxesAndFees = housePrice * 0.08;

            // Cálculo da prestação mensal
            const monthlyInterestRate = interestRate / 100 / 12;
            const totalPayments = loanTerm * 12;
            const monthlyPayment = (loanAmount * monthlyInterestRate) / (1 - Math.pow(1 + monthlyInterestRate, -totalPayments));

            // Atualização dos elementos na interface
            document.getElementById('taxes-fees').innerText = formatCurrency(taxesAndFees) + '€';
            document.getElementById('loan-amount').innerText = formatCurrency(loanAmount) + '€';
            document.getElementById('monthly-payment').innerText = formatCurrency(monthlyPayment) + '€';

            // Atualização do gráfico
            document.getElementById('down-payment-bar').style.width = downPaymentPercentage + '%';
            document.getElementById('loan-amount-bar').style.width = (100 - downPaymentPercentage) + '%';
            document.getElementById('down-payment-percentage-display').innerText = downPaymentPercentage + '%';
            document.getElementById('loan-amount-percentage-display').innerText = (100 - downPaymentPercentage) + '%';
        }

        function handleManualInput(input, type) {
            let value = input.value.replace(/[^0-9.,]/g, '');

            if (type === 'house-price') {
                if (value) {
                    housePrice = parseInt(value);
                    document.getElementById('house-price-slider').value = housePrice;
                }
                input.value = formatCurrency(housePrice) + '€';
            } else if (type === 'down-payment') {
                if (value) {
                    const downPayment = parseInt(value);
                    downPaymentPercentage = Math.round((downPayment / housePrice) * 100);
                    document.getElementById('down-payment-slider').value = downPaymentPercentage;
                }
                input.value = formatCurrency(housePrice * (downPaymentPercentage / 100)) + '€';
            } else if (type === 'loan-term') {
                if (value) {
                    loanTerm = parseInt(value);
                    if (loanTerm < 10) loanTerm = 10;
                    if (loanTerm > 40) loanTerm = 40;
                    document.getElementById('loan-term-slider').value = loanTerm;
                }
                input.value = loanTerm + ' anos';
            } else if (type === 'interest-rate') {
                // Nova condição para a taxa de juros
                value = value.replace(',', '.');
                if (value) {
                    interestRate = parseFloat(value);
                    if (interestRate < 1) interestRate = 1;
                    if (interestRate > 7) interestRate = 7;
                    document.getElementById('interest-rate-slider').value = interestRate;
                }
                input.value = interestRate.toFixed(1) + '%';
                document.getElementById('interest-rate-display').innerText = 'Simulação com taxa fixa ' + interestRate.toFixed(1) + '%';
            }

            updateCalculations();
        }

        function formatCurrency(value) {
            return new Intl.NumberFormat('pt-PT').format(Math.round(value));
        }

        // Expor funções globalmente
        window.updateHousePrice = updateHousePrice;
        window.updateDownPayment = updateDownPayment;
        window.updateLoanTerm = updateLoanTerm;
        window.updateInterestRate = updateInterestRate; // Nova função exposta
        window.handleManualInput = handleManualInput;

        // Inicializar cálculos
        updateCalculations();
    });
</script>
