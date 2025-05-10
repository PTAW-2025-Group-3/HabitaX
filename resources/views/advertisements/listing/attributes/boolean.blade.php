<div class="mb-4">
    <h3 class="font-semibold text-gray-secondary mb-1 flex items-center">
        <i class="bi bi-check2-square mr-2 text-secondary"></i> {{ $attribute->name }}
    </h3>
    <div class="flex items-center">
        <input type="checkbox"
               id="boolean_{{ $attribute->id }}"
               name="attributes[{{ $attribute->id }}][boolean]"
               class="h-5 w-5 text-secondary rounded border-gray-300 focus:ring-secondary"
               value="1"
               {{ request()->input('attributes.' . $attribute->id . '.boolean') ? 'checked' : '' }}>
        <label for="boolean_{{ $attribute->id }}" class="ml-2 text-sm font-medium">Sim</label>
    </div>
</div>
