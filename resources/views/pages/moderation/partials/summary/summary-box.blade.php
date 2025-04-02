<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm font-medium">{{ $item['label'] }}</p>
            <p class="text-3xl font-bold mt-1
            @if($item['color'] === 'red') text-red-600
            @elseif($item['color'] === 'yellow') text-amber-500
            @elseif($item['color'] === 'green') text-emerald-600
            @else text-blue-600 @endif">
                {{ $item['value'] }}
            </p>
        </div>
        <div class="w-12 h-12 rounded-full flex items-center justify-center
        @if($item['color'] === 'red') bg-red-100 text-red-600
        @elseif($item['color'] === 'yellow') bg-amber-100 text-amber-600
        @elseif($item['color'] === 'green') bg-emerald-100 text-emerald-600
        @else bg-blue-100 text-blue-600 @endif">
            @include('pages.moderation.partials.icon', ['icon' => $item['icon']])
        </div>
    </div>
</div>
