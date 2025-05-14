<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
     data-status="{{ $ad->status }}">
    <a href="{{ route('advertisements.show', $ad->id) }}" class="block">
        <div class="relative">
            <img src="{{ $ad->property->getFirstMediaUrl('images', 'thumb') ?? asset('images/property-placeholder.png') }}"
                 alt="Ad"
                 class="w-full h-48 object-cover">
            <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded-full
                {{ $ad->is_published ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">
                {{ $ad->is_published ? 'Publicado' : 'Não Publicado' }}
            </span>
        </div>
        <div class="p-4">
            <h3 class="text-lg font-semibold text-primary">
                {{ $ad->title }}
            </h3>
            <p class="text-sm text-gray mb-2">
                {{ $ad->property && $ad->property->parish ? $ad->property->parish->name : '' }}
            </p>
            <p class="text-lg font-bold text-secondary">
                {{ number_format($ad->price, 0, ',', '.') }}€
            </p>
            <div class="mt-4 flex items-center justify-between">
                <span class="text-sm text-gray">
                    Publicado há {{ \Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}
                </span>
                <div class="flex space-x-2">
                    <a href="{{ route('advertisements.edit', $ad->id) }}"
                       class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                        <i class="bi bi-pencil text-secondary"></i>
                    </a>
                    <form action="{{ route('advertisements.destroy', $ad->id) }}" method="POST"
                          onsubmit="return confirm('Tem certeza que deseja deletar este anúncio?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="bi bi-trash text-red"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </a>
</div>
