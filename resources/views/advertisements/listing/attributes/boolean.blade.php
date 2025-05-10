<div class="mb-4">
    <h3 class="font-semibold text-gray-secondary mb-1 flex items-center">
        <i class="bi bi-check2-square mr-2 text-secondary"></i> {{ $attribute->name }}
    </h3>
    <div class="flex items-center space-x-4">
        <label class="flex items-center">
            <input type="radio"
                   name="attributes[{{ $attribute->id }}][boolean]"
                   value=""
                   class="h-5 w-5 text-secondary rounded border-gray-300 focus:ring-secondary"
                   {{ request()->input('attributes.' . $attribute->id . '.boolean') === null ? 'checked' : '' }}>
            <span class="ml-2 text-sm font-medium">Sem escolha</span>
        </label>
        <label class="flex items-center">
            <input type="radio"
                   name="attributes[{{ $attribute->id }}][boolean]"
                   value="1"
                   class="h-5 w-5 text-secondary rounded border-gray-300 focus:ring-secondary"
                   {{ request()->input('attributes.' . $attribute->id . '.boolean') == '1' ? 'checked' : '' }}>
            <span class="ml-2 text-sm font-medium">Sim</span>
        </label>
        <label class="flex items-center">
            <input type="radio"
                   name="attributes[{{ $attribute->id }}][boolean]"
                   value="0"
                   class="h-5 w-5 text-secondary rounded border-gray-300 focus:ring-secondary"
                   {{ request()->input('attributes.' . $attribute->id . '.boolean') == '0' ? 'checked' : '' }}>
            <span class="ml-2 text-sm font-medium">Não</span>
        </label>
    </div>
</div>
