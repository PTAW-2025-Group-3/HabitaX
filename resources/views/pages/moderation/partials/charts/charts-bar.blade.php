<div class="bg-white rounded-xl shadow-sm border border-gray overflow-hidden">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-secondary">Anúncios Reportados</h3>
        <p class="text-sm text-gray mt-1">Últimos 7 dias</p>
    </div>
    <div class="px-6 pb-6">
        <div class="h-52 flex items-end justify-between space-x-2">
            @foreach ([30, 50, 40, 70, 60, 80, 20] as $index => $bar)
                @php
                    $pixelHeight = ($bar / 100) * 208;
                @endphp
                <div class="flex flex-col items-center flex-1">
                    <div class="w-full bg-blue-{{ 300 + ($index % 4) * 100 }} rounded-t transition-all duration-300"
                         style="height: {{ $pixelHeight }}px"></div>
                    <div class="text-xs text-gray mt-2">{{ ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'][$index] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>
