<div class="border border-gray-200 rounded-xl p-4 bg-white shadow-sm md:col-span-2">
    <div class="flex items-center text-sm text-gray-500 mb-3">
        <i class="bi bi-info-circle mr-2"></i>
        @if($attr->min_options > 0 && $attr->max_options)
            Selecione de {{ $attr->min_options }} a {{ $attr->max_options }} opções
        @elseif($attr->min_options > 0 && !$attr->max_options)
            Selecione pelo menos {{ $attr->min_options }} opções
        @elseif(!$attr->min_options && $attr->max_options)
            Selecione até {{ $attr->max_options }} opções
        @else
            Selecione quantas opções desejar
        @endif
        @if($attr->is_required)
            <span class="text-red-500 ml-1">*</span>
        @endif
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        @foreach($attr->options as $opt)
            <label class="flex items-center cursor-pointer p-2 rounded-lg hover:bg-gray-100">
                <input class="w-5 h-5 text-secondary focus:ring-secondary"
                       type="checkbox"
                       name="attributes[{{ $attr->id }}][]"
                       value="{{ $opt->id }}"
                       id="attr-{{ $attr->id }}-opt-{{ $loop->index }}">
                <span class="ml-2 text-gray-700">{{ $opt->name }}</span>
            </label>
        @endforeach
    </div>
</div>
