@props(['nome', 'imagem', 'cargo', 'funcao' => null])

<div class="bg-white rounded-xl shadow-lg overflow-hidden group">
    <div class="relative overflow-hidden">
        <img src="{{ Str::startsWith($imagem, 'http') ? $imagem : asset($imagem) }}" class="card-about-img" alt="{{ $nome }}">
        <div class="card-about"></div>
    </div>
    <div class="p-6">
        <h3 class="text-xl font-bold text-black">{{ $nome }}</h3>
        <p class="text-secondary font-medium">{{ $cargo }}</p>
        @if($funcao)
            <p class="text-gray">{{ $funcao }}</p>
        @endif
    </div>
</div>

