<form action="{{ $action }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4" enctype="multipart/form-data">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="name" class="block text-sm font-semibold text-primary">Nome</label>
            <input type="text" name="name" id="name" placeholder="Ex: Azul"
                   value="{{ old('name', $option->name ?? '') }}"
                   class="form-input">
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="md:col-span-2">
        <button type="submit" class="btn-primary px-4 py-2 rounded-lg flex items-center">
            {{ $buttonText }}
        </button>
    </div>
</form>
