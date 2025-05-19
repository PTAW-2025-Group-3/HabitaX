<!-- Sobre o Anunciante -->
<div class="bg-white shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] rounded-2xl p-5 md:p-8 space-y-5 animate-fade-in">
    <div class="flex items-center justify-between border-b border-indigo-100 pb-4">
        <h3 class="text-xl md:text-2xl font-bold text-primary flex items-center gap-2">
            <i class="bi bi-person-circle text-secondary text-2xl"></i>
            Sobre o Anunciante
        </h3>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <!-- Informações do anunciante -->
        <div class="flex items-start gap-4">
            <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-gray-200 overflow-hidden flex-shrink-0 border-2 border-indigo-100 shadow-md">
                <img src="{{ $ad->creator->getProfilePictureUrl() }}" alt="Foto de {{ $ad->creator->name }}" class="w-full h-full object-cover">
            </div>

            <div class="space-y-3">
                <div>
                    <h4 class="text-lg font-bold text-gray-800">{{ $ad->creator->name }}</h4>
                    @if($ad->creator->title)
                        <p class="text-xs text-gray-500">{{ $ad->creator->title }}</p>
                    @endif
                </div>

                @if($ad->creator->bio)
                    <p class="text-sm text-gray-600">{{ $ad->creator->bio }}</p>
                @endif

                <div class="flex flex-wrap gap-3 mt-1">
                    @php
                        $isOwner = auth()->check() && auth()->id() == $ad->created_by;
                    @endphp

                    @if(!$isOwner && $ad->creator->telephone)
                        <button onclick="return showPhoneNumber(this, '{{ $ad->creator->telephone }}')" class="group flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-indigo-50 to-blue-50 hover:from-indigo-100 hover:to-blue-100 border border-indigo-100 text-indigo-700 rounded-lg transition-all shadow-sm hover:shadow">
                            <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                <i class="bi bi-telephone-fill text-indigo-500"></i>
                            </div>
                            <span class="text-sm font-medium phone-text">Ver Número</span>
                        </button>
                    @endif

                    @if(!$isOwner && $ad->creator->email)
                        <a href="mailto:{{ $ad->creator->email }}" class="group flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-violet-50 to-purple-50 hover:from-violet-100 hover:to-purple-100 border border-purple-100 text-purple-700 rounded-lg transition-all shadow-sm hover:shadow">
                            <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                <i class="bi bi-envelope-fill text-purple-500"></i>
                            </div>
                            <span class="text-sm font-medium">{{ $ad->creator->email }}</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Estatísticas do anunciante -->
        <div class="grid grid-cols-2 gap-4 mt-2">
            <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl p-4 shadow-sm">
                <div class="flex items-center">
                    <div class="h-12 w-12 flex items-center justify-center bg-white text-indigo-500 rounded-xl mr-3 shadow-sm">
                        <i class="bi bi-building text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-indigo-700 font-medium">Anúncios Ativos</p>
                        <p class="text-2xl font-bold text-indigo-900">
                            {{ $ad->creator->advertisements()
                                ->where('is_published', true)
                                ->where('is_suspended', false)
                                ->whereHas('property.property_type', function($q) {
                                    $q->where('is_active', true);
                                })
                                ->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-50 to-violet-50 rounded-xl p-4 shadow-sm">
                <div class="flex items-center">
                    <div class="h-12 w-12 flex items-center justify-center bg-white text-purple-500 rounded-xl mr-3 shadow-sm">
                        <i class="bi bi-calendar-check text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-purple-700 font-medium">Membro desde</p>
                        <p class="text-2xl font-bold text-purple-900">
                            {{ $ad->creator->created_at->format('m/y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Links para perfil e outros anúncios -->
        <div class="flex flex-wrap gap-3 pt-2">
            <a href="{{ route('advertisements.index', ['created_by' => $ad->creator->id]) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-secondary rounded-lg transition-colors">
                <i class="bi bi-grid-3x3-gap"></i>
                <span class="text-sm font-medium">Ver Todos os Anúncios</span>
            </a>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function showPhoneNumber(button, phoneNumber) {
            const phoneText = button.querySelector('.phone-text');

            if (phoneText.textContent === 'Ver Número') {
                // Primeiro clique - mostrar o número
                phoneText.textContent = phoneNumber;
                button.classList.add('from-indigo-100', 'to-blue-100');
                button.classList.remove('from-indigo-50', 'to-blue-50');

                // Armazenar um atributo para rastrear o estado
                button.setAttribute('data-revealed', 'true');

                // Prevenir a ação padrão na primeira vez
                return false;
            } else {
                // Segundo clique - abrir discador telefônico
                window.location.href = 'tel:' + phoneNumber;
            }
        }
    </script>
@endpush
