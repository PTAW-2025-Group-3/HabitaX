<form method="POST" action="{{ $action }}" class="bg-white p-6 rounded-lg shadow-md space-y-4">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="name" class="block text-sm font-semibold text-primary">Nome</label>
            <input type="text" name="name" id="name" placeholder="Ex: Moradia"
                   value="{{ old('name', $propertyType->name ?? '') }}"
                   class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
        </div>
    </div>

{{--    description--}}
    <div>
        <label for="description" class="block text-sm font-semibold text-primary">Descrição</label>
        <textarea name="description" id="description" placeholder="Ex: Unidade habitacional destinada a habitação."
                  class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">{{ old('description', $propertyType->description ?? '') }}</textarea>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="relative mb-4 p-3 bg-red-50 text-xs sm:text-sm text-red-600 rounded-lg z-10">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="pt-4">
        <button type="submit"
                class="w-full rounded-md bg-primary py-2 px-4 text-center font-semibold text-white shadow hover:bg-primary-dark transition">
            {{ $buttonText }}
        </button>
    </div>
</form>
