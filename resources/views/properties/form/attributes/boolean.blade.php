<div class="flex flex-wrap gap-4 pt-2">
    <label class="flex items-center cursor-pointer p-2 rounded-lg hover:bg-gray-100">
        <input type="radio" name="attributes[{{ $attr->id }}]" value=""
               id="attr-{{ $attr->id }}-no-answer"
               class="w-5 h-5 text-secondary focus:ring-secondary"
            {{ !$attr->is_required ? 'checked' : '' }}>
        <span class="ml-2 text-gray-700">Sem resposta</span>
    </label>
    <label class="flex items-center cursor-pointer p-2 rounded-lg hover:bg-gray-100">
        <input type="radio" name="attributes[{{ $attr->id }}]" value="true"
               id="attr-{{ $attr->id }}-true"
               class="w-5 h-5 text-secondary focus:ring-secondary">
        <span class="ml-2 text-gray-700">Sim</span>
    </label>
    <label class="flex items-center cursor-pointer p-2 rounded-lg hover:bg-gray-100">
        <input type="radio" name="attributes[{{ $attr->id }}]" value="false"
               id="attr-{{ $attr->id }}-false"
               class="w-5 h-5 text-secondary focus:ring-secondary">
        <span class="ml-2 text-gray-700">Não</span>
    </label>
</div>
