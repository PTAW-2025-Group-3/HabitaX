<div class="mb-4">
    <h3 class="font-semibold text-gray-secondary mb-2 flex items-center">
        <i class="bi bi-calendar-event mr-2 text-secondary"></i> {{ $attribute->name }}
    </h3>
    <div class="grid grid-cols-2 gap-3">
        <div>
            <label for="start_date_{{ $attribute->id }}" class="text-sm font-medium">Start Date</label>
            <input type="date"
                   id="start_date_{{ $attribute->id }}"
                   name="attributes[{{ $attribute->id }}][start_date]"
                   class="w-full border-gray-300 rounded-lg focus:ring-secondary focus:border-secondary"
                   value="{{ request()->input('attributes.' . $attribute->id . '.start_date') }}">
        </div>
        <div>
            <label for="end_date_{{ $attribute->id }}" class="text-sm font-medium">End Date</label>
            <input type="date"
                   id="end_date_{{ $attribute->id }}"
                   name="attributes[{{ $attribute->id }}][end_date]"
                   class="w-full border-gray-300 rounded-lg focus:ring-secondary focus:border-secondary"
                   value="{{ request()->input('attributes.' . $attribute->id . '.end_date') }}">
        </div>
    </div>
</div>
