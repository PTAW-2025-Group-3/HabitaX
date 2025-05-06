@extends('layout.app')

@section('title', 'Últimas Notícias - HabitaX')

@section('content')
    <div class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Cabeçalho da página -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold mb-3">
                    Últimas <span class="text-secondary">Notícias</span>
                </h1>
                <p class="text-gray-600 max-w-2xl mx-auto">Acompanhe as novidades e tendências do mercado imobiliário, dicas para compradores e vendedores, e atualizações relevantes sobre o setor habitacional.</p>
            </div>

            @if(!empty($noticias['items'] ?? []))
                <!-- Destaque principal (primeira notícia) -->
                @php
                    $primeiraNoticia = $noticias['items'][0];
                    $imagemPrimeira = $primeiraNoticia['image'] ?? $primeiraNoticia['media']['thumbnail'] ?? 'https://via.placeholder.com/800x400?text=Habitação';
                @endphp
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-12 border border-gray-100">
                    <div class="md:flex">
                        <div class="md:w-1/2">
                            <div class="h-72 md:h-full bg-cover bg-center" style="background-image: url('{{ $imagemPrimeira }}')"></div>
                        </div>
                        <div class="md:w-1/2 p-8">
                            <div class="flex items-center text-gray-500 text-sm mb-3">
                                <i class="bi bi-calendar3 mr-1"></i>
                                {{ \Carbon\Carbon::parse($primeiraNoticia['date_published'] ?? now())->locale('pt')->isoFormat('D [de] MMMM, YYYY') }}
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">
                                {{ $primeiraNoticia['title'] ?? 'Notícia Imobiliária' }}
                            </h2>
                            <p class="text-gray-600 mb-6">
                                {{ \Illuminate\Support\Str::limit(strip_tags($primeiraNoticia['description'] ?? ''), 250) }}
                            </p>
                            <a href="{{ $primeiraNoticia['url'] ?? '#' }}"
                               class="btn-secondary px-5 py-3"
                               target="_blank">
                                <span>Ler notícia completa</span>
                                <i class="bi bi-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Grid de notícias restantes -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach(array_slice($noticias['items'], 1) as $noticia)
                        @php
                            $imagem = $noticia['image'] ?? $noticia['media']['thumbnail'] ?? 'https://via.placeholder.com/400x240?text=Notícia';
                            $titulo = $noticia['title'] ?? 'Notícia Imobiliária';
                            $descricao = strip_tags($noticia['description'] ?? '');
                            $link = $noticia['url'] ?? '#';
                            $fonte = $noticia['source']['title'] ?? parse_url($link, PHP_URL_HOST) ?? 'Fonte de notícias';
                            $data = \Carbon\Carbon::parse($noticia['date_published'] ?? now());
                        @endphp
                        <a href="{{ $link }}" target="_blank" class="block">
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-md group h-full">
                                <div class="h-48 bg-cover bg-center relative" style="background-image: url('{{ $imagem }}')">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                    <div class="absolute bottom-0 left-0 p-4">
                                        <span class="inline-block text-xs font-medium bg-secondary text-white px-3 py-1 rounded-full">
                                            {{ $fonte }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="flex items-center text-gray-500 text-xs mb-2">
                                        <i class="bi bi-calendar3 mr-1"></i>
                                        {{ $data->locale('pt')->isoFormat('D [de] MMMM, YYYY') }}
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-secondary transition-colors">
                                        {{ $titulo }}
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                        {{ \Illuminate\Support\Str::limit($descricao, 150) }}
                                    </p>
                                    <div class="flex items-center text-sm text-secondary font-medium group-hover:translate-x-1 transition-all">
                                        Ler mais
                                        <i class="bi bi-arrow-right ml-1"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-lg shadow-sm">
                    <i class="bi bi-info-circle text-gray-400 text-4xl mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-800 mb-2">Não há notícias disponíveis no momento</h3>
                    <p class="text-gray-500">Por favor, volte mais tarde para ver as últimas atualizações.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
