<div class="mb-6">
    <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
        <i class="bi bi-calendar-event mr-2 text-secondary"></i> {{ $attribute->name }}
    </h3>

    <div class="space-y-3">
        <div class="flex items-center">
            <span class="text-sm font-medium text-gray-600 w-24">De:</span>
            <div class="flex-1">
                <input type="date"
                       id="start_date_{{ $attribute->id }}"
                       name="attributes[{{ $attribute->id }}][start_date]"
                       class="w-full h-12 px-4 text-sm rounded-lg border-2 border-gray-200
                              focus:ring-2 focus:ring-secondary focus:border-secondary
                              hover:border-gray-300 transition-all"
                       value="{{ request()->input('attributes.' . $attribute->id . '.start_date') }}">
            </div>
        </div>

        <div class="flex items-center">
            <span class="text-sm font-medium text-gray-600 w-24">Até:</span>
            <div class="flex-1">
                <input type="date"
                       id="end_date_{{ $attribute->id }}"
                       name="attributes[{{ $attribute->id }}][end_date]"
                       class="w-full h-12 px-4 text-sm rounded-lg border-2 border-gray-200
                              focus:ring-2 focus:ring-secondary focus:border-secondary
                              hover:border-gray-300 transition-all"
                       value="{{ request()->input('attributes.' . $attribute->id . '.end_date') }}">
            </div>
        </div>
    </div>
</div>
