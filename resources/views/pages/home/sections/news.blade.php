<section class="bg-back py-16">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Cabeçalho da seção -->
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold mb-3">
                Notícias do <span class="text-secondary">Mercado</span>
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Fique por dentro das últimas novidades e tendências do mercado imobiliário português</p>
        </div>

        <!-- Grid de notícias -->
        @if(!empty($news['items'] ?? []))
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach(array_slice($news['items'], 0, 3) as $noticia)
                    @php
                        $imagem = $noticia['image'] ?? $noticia['media']['thumbnail'] ?? 'https://via.placeholder.com/400x240?text=Notícia';
                        $titulo = $noticia['title'] ?? 'Notícia Imobiliária';
                        $descricao = strip_tags($noticia['description'] ?? '');
                        $link = $noticia['url'] ?? '#';
                        $data = \Carbon\Carbon::parse($noticia['date_published'] ?? now());
                    @endphp
                    <a href="{{ $link }}" target="_blank" class="block">
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-md group h-full">
                            <div class="h-48 bg-cover bg-center relative" style="background-image: url('{{ $imagem }}')">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 p-4">
                                    <span class="inline-block text-xs font-medium bg-secondary text-white px-3 py-1 rounded-full">
                                        Mercado Imobiliário
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
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ \Illuminate\Support\Str::limit($descricao, 100) }}
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

            <!-- Botão "Ver Todas" -->
            <div class="text-center mt-10">
                <a href="{{ url('/noticias') }}" class="btn-secondary px-5 py-3">
                    Ver todas as notícias
                    <i class="bi bi-arrow-right ml-2"></i>
                </a>
            </div>
        @else
            <div class="text-center py-8 bg-white rounded-lg shadow-sm">
                <i class="bi bi-info-circle text-gray-400 text-4xl mb-2"></i>
                <p class="text-gray-500">Não há notícias disponíveis no momento.</p>
            </div>
        @endif
    </div>
</section>
