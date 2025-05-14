<div class="bg-white rounded-xl shadow-sm border border-gray overflow-hidden">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-secondary">Anúncios Reportados</h3>
        <p class="text-sm text-gray mt-1">Últimos 6 meses</p>
    </div>
    <div class="px-6 pb-6">
        <div class="h-52 flex items-end justify-between space-x-2">
            @if(isset($reportedAdsData) && count($reportedAdsData) > 0 && collect($reportedAdsData)->sum() > 0)
                @php
                    $fixedMaxScale = 10;
                    $maxValue = max($fixedMaxScale, max($reportedAdsData));
                    $colors = ['bg-blue-400', 'bg-blue-500', 'bg-blue-600', 'bg-blue-700'];

                    $minPixelHeight = 1;
                    $maxPixelHeight = 100;
                @endphp

                @foreach ($reportedAdsData as $index => $count)
                    @php
                        $percentage = $count / $maxValue;
                        $pixelHeight = $count > 0
                            ? max($minPixelHeight, $percentage * $maxPixelHeight)
                            : 0;
                        $color = $colors[$index % count($colors)];
                    @endphp
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full {{ $color }} rounded-t transition-all duration-300 relative group"
                             style="height: {{ $pixelHeight }}px">
                            <div class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                {{ $monthLabels[$index] ?? '' }}: {{ $count }} report{{ $count == 1 ? '' : 's' }}
                            </div>
                        </div>
                        <div class="text-xs text-gray mt-2">{{ $monthLabels[$index] ?? '' }}</div>
                    </div>
                @endforeach
            @else
                <div class="w-full flex items-center justify-center h-full">
                    <p class="text-gray text-sm">Sem anúncios reportados nos últimos 6 meses</p>
                </div>
            @endif
        </div>
    </div>
</div>
