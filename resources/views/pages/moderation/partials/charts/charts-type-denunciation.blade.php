<div class="bg-white rounded-xl shadow-sm border border-gray overflow-hidden">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-secondary">Motivos das Denúncias</h3>
        <p class="text-sm text-gray mt-1">Distribuição do mês atual</p>
    </div>
    <div class="px-6 pb-6">
        <div class="h-52 flex flex-col items-center justify-center">
            @if(isset($reasonsData) && count($reasonsData) > 0)
                <div class="grid grid-cols-2 w-full gap-6">
                    <div class="flex items-center justify-center">
                        <div class="relative w-36 h-36">
                            <svg viewBox="0 0 36 36" class="w-full h-full">
                                @php
                                    $colors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444'];
                                    $cumulativePercentage = 0;
                                @endphp
                                @foreach($reasonsData as $index => $reason)
                                    @php
                                        $percentage = $reason['percentage'];
                                        $color = $colors[$index % count($colors)];
                                        $dashArray = $percentage * 100 / 100;
                                        $dashOffset = 100 - $cumulativePercentage;
                                        $cumulativePercentage += $percentage;
                                    @endphp
                                    <circle
                                        class="text-gray-200"
                                        stroke="{{ $color }}"
                                        stroke-width="3"
                                        fill="transparent"
                                        r="16"
                                        cx="18"
                                        cy="18"
                                        stroke-dasharray="{{ $dashArray }} {{ 100 - $dashArray }}"
                                        stroke-dashoffset="{{ $dashOffset }}"
                                        transform="rotate(-90 18 18)"
                                    />
                                @endforeach
                                <circle cx="18" cy="18" r="12" fill="white" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex flex-col justify-center space-y-3">
                        @foreach($reasonsData as $index => $reason)
                            <div class="flex items-center">
                                <div class="w-4 h-4 rounded-sm mr-3" style="background-color: {{ $colors[$index % count($colors)] }}"></div>
                                <div>
                                    <span class="text-sm font-medium">{{ $reason['name'] }}</span>
                                    <span class="text-sm text-gray-600 ml-2">{{ $reason['percentage'] }}%</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-gray text-center">
                    <p>Sem dados disponíveis para o mês atual</p>
                </div>
            @endif
        </div>
    </div>
</div>
