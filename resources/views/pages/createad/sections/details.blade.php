<div class="bg-white shadow rounded-xl p-6 border border-gray-300">
    <h2 class="text-xl font-bold text-blue-700 mb-4">Detalhes da Propriedade</h2>

    {{-- Título --}}
    <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-secondary mb-1">Título</label>
        <input type="text" name="title" id="title"
               placeholder="ex., Apartamento T3 Moderno"
               class="form-input">
    </div>

    {{-- Descrição --}}
    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-secondary mb-1">Descrição</label>
        <textarea name="description" id="description" rows="5"
                  placeholder="Descreva a propriedade em detalhe..."
                  class="form-input"></textarea>
    </div>

    {{-- Preço --}}
    <div class="mb-0">
        <label for="price" class="block text-sm font-medium text-gray-secondary mb-1">Preço da Propriedade (€)</label>
        <input type="number" name="price" id="price"
               placeholder="Introduza o preço"
               class="form-input">
    </div>
</div>
