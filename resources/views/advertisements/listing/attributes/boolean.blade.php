<div class="mb-6">
    <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
        <i class="bi bi-check2-square mr-2 text-secondary"></i> {{ $attribute->name }}
    </h3>

    <div class="flex gap-3">
        <label class="flex-1">
            <input type="radio"
                   name="attributes[{{ $attribute->id }}][boolean]"
                   value=""
                   class="peer hidden"
                {{ request()->input('attributes.' . $attribute->id . '.boolean') === null ? 'checked' : '' }}>
            <div class="h-12 flex items-center justify-center rounded-lg border-2 border-gray-200
                        peer-checked:border-blue-500 peer-checked:bg-blue-50
                        hover:bg-gray-50 cursor-pointer transition-all">
                <span class="text-sm font-medium peer-checked:text-blue-600">Todos</span>
            </div>
        </label>

        <label class="flex-1">
            <input type="radio"
                   name="attributes[{{ $attribute->id }}][boolean]"
                   value="1"
                   class="peer hidden"
                {{ request()->input('attributes.' . $attribute->id . '.boolean') == '1' ? 'checked' : '' }}>
            <div class="h-12 flex items-center justify-center rounded-lg border-2 border-gray-200
                        peer-checked:border-green-500 peer-checked:bg-green-50
                        hover:bg-gray-50 cursor-pointer transition-all">
                <span class="text-sm font-medium peer-checked:text-green-600">Sim</span>
            </div>
        </label>

        <label class="flex-1">
            <input type="radio"
                   name="attributes[{{ $attribute->id }}][boolean]"
                   value="0"
                   class="peer hidden"
                {{ request()->input('attributes.' . $attribute->id . '.boolean') == '0' ? 'checked' : '' }}>
            <div class="h-12 flex items-center justify-center rounded-lg border-2 border-gray-200
                        peer-checked:border-red-500 peer-checked:bg-red-50
                        hover:bg-gray-50 cursor-pointer transition-all">
                <span class="text-sm font-medium peer-checked:text-red-600">Não</span>
            </div>
        </label>
    </div>
</div>
