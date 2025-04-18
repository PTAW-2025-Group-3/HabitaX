<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-status="pending">
    <a href="{{ route('properties.show', $property->id) }}" class="block">
        <div class="relative">
            <img src="{{ $property->images[0] }}"
                 alt="Property"
                 class="w-full h-48 object-cover">
            <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                    Pendente
                </span>
        </div>
        <div class="p-4">
            <h3 class="text-lg font-semibold text-primary">{{ $property->title }}</h3>
{{--            <p class="text-sm text-gray mb-2">{{ $property->parish_id->name }}</p>--}}
{{--            <p class="text-lg font-bold text-secondary">{{ $property->property_type->name }}</p>--}}
            <p class="text-sm text-gray mb-2">{{ \App\Models\Parish::find($property->parish_id)->name }}</p>
            <p class="text-lg font-bold text-secondary">{{ \App\Models\PropertyType::find($property->property_type)->name }}</p>
            <div class="mt-4 flex items-center justify-between">
                <span class="text-sm text-gray">Inserido há {{ \Carbon\Carbon::parse($property->created_at)->diffForHumans() }}</span>
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
