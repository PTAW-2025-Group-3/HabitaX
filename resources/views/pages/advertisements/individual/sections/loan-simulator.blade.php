<div class="bg-white shadow rounded p-4 space-y-4">
    <h3 class="text-lg font-semibold">Simulação/Crédito de Habitação</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="text-sm font-medium">Preço do Imóvel</label>
            <input type="text" class="w-full border rounded p-2" value="{{ number_format($ad->price, 0, ',', '.') }}€" disabled>
        </div>
        <div>
            <label class="text-sm font-medium">Entrada Inicial (25%)</label>
            <input type="text" class="w-full border rounded p-2" value="{{ number_format($ad->price * 0.25, 0, ',', '.') }}€" disabled>
        </div>
        <div>
            <label class="text-sm font-medium">Prazo em Anos</label>
            <input type="text" class="w-full border rounded p-2" value="40" disabled>
        </div>
        <div>
            <label class="text-sm font-medium">Impostos e Despesas</label>
            <input type="text" class="w-full border rounded p-2" value="33.193€" disabled>
        </div>
        <div>
            <label class="text-sm font-medium">Montante de Empréstimo</label>
            <input type="text" class="w-full border rounded p-2" value="{{ number_format($ad->price * 0.75, 0, ',', '.') }}€" disabled>
        </div>
        <div>
            <label class="text-sm font-medium">Prestação Mensal (simulada)</label>
            <input type="text" class="w-full border rounded p-2" value="1.448€" disabled>
        </div>
    </div>
</div>
