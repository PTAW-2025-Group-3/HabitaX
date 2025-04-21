<div class="bg-gradient-to-tr bg-white shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] rounded-2xl p-5 md:p-7 space-y-6 animate-fade-in">
    <div class="flex items-center justify-between border-b border-indigo-100 pb-4">
        <h3 class="text-lg md:text-xl font-bold text-primary flex items-center gap-2">
            <i class="bi bi-person-lines-fill text-secondary text-2xl"></i>
            Contactar o Anunciante
        </h3>
        <span class="bg-indigo-100 text-secondary text-xs md:text-sm font-semibold px-3 py-1 rounded-full shadow-sm">
            {{ $ad->creator->name ?? 'Anunciante' }}
        </span>
    </div>

    <form class="space-y-4 text-sm md:text-base">
        <div>
            <label class="block text-gray-600 text-xs md:text-sm mb-1">O seu email</label>
            <input type="email" class="form-input" placeholder="exemplo@email.com">
        </div>
        <div>
            <label class="block text-gray-600 text-xs md:text-sm mb-1">O seu telefone</label>
            <input type="tel" class="form-input" placeholder="+351...">
        </div>
        <div>
            <label class="block text-gray-600 text-xs md:text-sm mb-1">Mensagem</label>
            <textarea class="form-input" rows="4" placeholder="Estou interessado neste imóvel..."></textarea>
        </div>
        <button type="submit" class="btn-secondary w-full py-3">
            <i class="bi bi-send-fill mr-2"></i> Enviar Contacto
        </button>
    </form>

    <div class="text-center">
        <a href="#" class="text-sm text-blue-600 font-medium hover:underline">
            <i class="bi bi-telephone-fill mr-1"></i> Ver número de telefone
        </a>
    </div>
</div>
