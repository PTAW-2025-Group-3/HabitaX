<div class="bg-white shadow-xl rounded-2xl p-8 mb-8 border border-gray-200 animate-fade-in">
    <div class="flex items-center mb-6 border-b border-gray-100 pb-4">
        <i class="bi bi-building text-2xl text-primary mr-3"></i>
        <h2 class="text-2xl font-bold text-primary">Informação Base da Propriedade</h2>
    </div>

    <!-- Título -->
    <div class="transition-all duration-300 hover:shadow-md p-4 rounded-xl hover:bg-gray-50 mb-4">
        <label for="title" class="block text-sm font-semibold text-gray-secondary mb-3 flex items-center">
            <i class="bi bi-house-door mr-2 text-secondary"></i>
            Título da Propriedade
        </label>
        <input type="text" name="title" id="title"
               placeholder="ex., Apartamento T3 Moderno"
               class="form-input focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
    </div>

    <!-- Descrição -->
    <div class="transition-all duration-300 hover:shadow-md p-4 rounded-xl hover:bg-gray-50 mb-4">
        <label for="description" class="block text-sm font-semibold text-gray-secondary mb-3 flex items-center">
            <i class="bi bi-file-text mr-2 text-secondary"></i>
            Descrição da Propriedade
        </label>
        <textarea name="description" id="description" rows="5"
                  placeholder="Descreva a propriedade em detalhe..."
                  class="form-input focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all"></textarea>
    </div>
</div>
