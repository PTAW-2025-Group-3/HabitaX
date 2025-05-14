<div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg p-8 text-white">
    <div class="flex flex-col md:flex-row justify-between items-center">
        <!-- Seção de título e data -->
        <div class="space-y-2 text-center md:text-left mb-6 md:mb-0">
            <h1 class="text-3xl md:text-4xl font-bold text-white">Painel de Moderação</h1>
            <p class="text-sm md:text-base text-blue-100">{{ now()->locale('pt_PT')->isoFormat('dddd, DD [de] MMMM [de] YYYY') }}</p>
        </div>

        <!-- Seção de avatar e informações do moderador -->
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3">
                <!-- Avatar com borda sutil e sombra -->
{{--                @if(auth()->user()->profile_picture_path)--}}
                    <img src="{{ auth()->user()->getProfilePictureUrl() }}" alt="Profile"
                         class="h-16 w-16 rounded-full border-4 border-white/30 shadow-lg object-cover bg-gray-50">
{{--                @else--}}
{{--                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff" alt="Profile" class="h-16 w-16 rounded-full border-4 border-white/30 shadow-lg">--}}
{{--                @endif--}}
                <div>
                    <p class="font-medium text-lg text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-blue-100">
                        {{ auth()->user()->isAdmin() ? 'Administrador' : 'Moderador' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
