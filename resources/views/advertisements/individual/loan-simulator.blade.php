<div class="bg-white shadow rounded p-3 md:p-4 space-y-3 md:space-y-4">
    <h3 class="text-base md:text-lg font-semibold">Simulação/Crédito de Habitação</h3>
    <div class="grid grid-cols-1 gap-2 md:gap-4">
        <div>
            <label class="text-xs md:text-sm font-medium">Preço do Imóvel</label>
            <input type="text" class="w-full border rounded p-1.5 md:p-2 text-sm md:text-base" value="{{ number_format($property->price, 0, ',', '.') }}€" disabled>
        </div>
        <div>
            <label class="text-xs md:text-sm font-medium">Entrada Inicial (25%)</label>
            <input type="text" class="w-full border rounded p-1.5 md:p-2 text-sm md:text-base" value="{{ number_format($property->price * 0.25, 0, ',', '.') }}€" disabled>
        </div>
        <div>
            <label class="text-xs md:text-sm font-medium">Prazo em Anos</label>
            <input type="text" class="w-full border rounded p-1.5 md:p-2 text-sm md:text-base" value="40" disabled>
        </div>
        <div>
            <label class="text-xs md:text-sm font-medium">Impostos e Despesas</label>
            <input type="text" class="w-full border rounded p-1.5 md:p-2 text-sm md:text-base" value="33.193€" disabled>
        </div>
        <div>
            <label class="text-xs md:text-sm font-medium">Montante de Empréstimo</label>
            <input type="text" class="w-full border rounded p-1.5 md:p-2 text-sm md:text-base" value="{{ number_format($property->price * 0.75, 0, ',', '.') }}€" disabled>
        </div>
        <div>
            <label class="text-xs md:text-sm font-medium">Prestação Mensal (simulada)</label>
            <input type="text" class="w-full border rounded p-1.5 md:p-2 text-sm md:text-base" value="1.448€" disabled>
        </div>
    </div>
</div>
