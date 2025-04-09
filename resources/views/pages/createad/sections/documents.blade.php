<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-2xl font-semibold mb-4 text-blue-700">Documentos da Propriedade</h2>
    <p class="text-sm text-gray mb-4">Por favor, envia os documentos relevantes da propriedade (PDF, DOCX, etc.)</p>

    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="documents[]" multiple
               accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
               class="w-full border rounded-md px-4 py-2 text-sm file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0 file:text-sm file:font-semibold
                    file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        <p class="text-xs text-gray-400 mt-2">Formatos aceites: PDF, DOC, DOCX, JPG, PNG</p>
    </form>
</div>
