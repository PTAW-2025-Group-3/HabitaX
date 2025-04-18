<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
     data-status="{{ $ad->status }}">
    {{-- Ad Status --}}
    <a href="{{ route('advertisements.show', $ad->id) }}" class="block">
        <div class="relative">
            <img src=" {{ $ad->property->images[0] }}"
                 alt="Ad"
                 class="w-full h-48 object-cover">
            <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
            Ativo
        </span>
        </div>
        <div class="p-4">
            <h3 class="text-lg font-semibold text-primary">
                {{ $ad->title }} em {{ $ad->property->location }}
            </h3>
            <p class="text-sm text-gray mb-2">
                {{ \App\Models\Parish::find($ad->property->parish_id)->name }}
            </p>
            <p class="text-lg font-bold text-secondary">
                {{ number_format($ad->price, 0, ',', '.') }}€
            </p>
            <div class="mt-4 flex items-center justify-between">
                <span class="text-sm text-gray">Publicado há {{ \Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</span>
                <div class="flex space-x-2">
                    <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                        <i class="bi bi-pencil text-secondary"></i>
                    </button>
                    <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                        <i class="bi bi-trash text-red"></i>
                    </button>
                </div>
            </div>
        </div>
    </a>
</div>
