@php
    use App\Enums\AttributeType;

    $propertyAttributes = $attributes ?? collect();
    $sortedAttributes = $propertyAttributes->sortBy(function ($attribute) {
        return $attribute->type === AttributeType::SELECT_MULTIPLE ? 1 : 0;
    });
@endphp

{{-- This file is used to display the attributes of a property type in a form. --}}
<div class="bg-white shadow-xl rounded-2xl p-8 mb-8 border border-gray-200 animate-fade-in">
    @if($propertyAttributes->isEmpty())
        <div class="flex flex-col items-center justify-center py-10">
            <i class="bi bi-houses text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray text-lg">Nenhum atributo disponível para este tipo de propriedade.</p>
        </div>
    @else
        <div class="flex items-center mb-6 border-b border-gray-100 pb-4">
            <i class="bi bi-house-check text-2xl text-primary mr-3"></i>
            <h2 class="text-2xl font-bold text-primary">Detalhes da Propriedade</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($sortedAttributes as $attr)
                <div class="mb-4 transition-all duration-300 hover:shadow-md p-4 rounded-xl hover:bg-gray-50">
                    <label class="block text-sm font-semibold text-gray-secondary mb-2 flex items-center">
                        @switch($attr->type->value)
                            @case(AttributeType::INT->value)
                                <i class="bi bi-123 mr-2 text-secondary"></i>
                                @break
                            @case(AttributeType::FLOAT->value)
                                <i class="bi bi-rulers mr-2 text-secondary"></i>
                                @break
                            @case(AttributeType::TEXT->value)
                                <i class="bi bi-type mr-2 text-secondary"></i>
                                @break
                            @case(AttributeType::LONG_TEXT->value)
                                <i class="bi bi-text-paragraph mr-2 text-secondary"></i>
                                @break
                            @case(AttributeType::BOOLEAN->value)
                                <i class="bi bi-toggle-on mr-2 text-secondary"></i>
                                @break
                            @case(AttributeType::SELECT_SINGLE->value)
                                <i class="bi bi-list-check mr-2 text-secondary"></i>
                                @break
                            @case(AttributeType::SELECT_MULTIPLE->value)
                                <i class="bi bi-check2-all mr-2 text-secondary"></i>
                                @break
                            @case(AttributeType::DATE->value)
                                <i class="bi bi-calendar-event mr-2 text-secondary"></i>
                                @break
                        @endswitch
                        {{ $attr->name }}
                        @if($attr->is_required)
                            <span class="text-red-500 ml-1">*</span>
                        @endif
                        @if($attr->description)
                            <div class="relative inline-block ml-2 group">
                                <i class="bi bi-info-circle text-gray-400 hover:text-secondary cursor-help"></i>
                                <div class="absolute z-10 w-64 p-3 mb-1 bg-white rounded-lg shadow-lg opacity-0 pointer-events-none group-hover:opacity-100 transition-opacity duration-300 text-xs text-gray-600 -left-[70px] top-6 border border-gray-200">
                                    {{ $attr->description }}
                                    <div class="absolute -top-1 left-[75px] w-3 h-3 rotate-45 bg-white border-t border-l border-gray-200"></div>
                                </div>
                            </div>
                        @endif
                    </label>

                    @switch($attr->type->value)
                        @case(AttributeType::INT->value)
                            <div class="relative">
                                <input type="number" name="attributes[{{ $attr->id }}]"
                                       class="form-input-big w-full py-3 pl-4 pr-10"
                                       placeholder="Insira um valor numérico"
                                    {{ $attr->is_required ? 'required' : '' }}
                                    {{ $attr->min_value !== null ? 'min='.$attr->min_value : '' }}
                                    {{ $attr->max_value !== null ? 'max='.$attr->max_value : '' }}>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray">
                                    <i class="bi bi-hash"></i>
                                </div>
                            </div>
                            @if($attr->min_value !== null || $attr->max_value !== null)
                                <p class="text-xs text-gray-500 mt-1">
                                    @if($attr->min_value !== null && $attr->max_value !== null)
                                        Valor entre {{ $attr->min_value }} e {{ $attr->max_value }}
                                    @elseif($attr->min_value !== null)
                                        Valor mínimo: {{ $attr->min_value }}
                                    @elseif($attr->max_value !== null)
                                        Valor máximo: {{ $attr->max_value }}
                                    @endif
                                    @if($attr->unit)
                                        <span class="ml-1">({{ $attr->unit }})</span>
                                    @endif
                                </p>
                            @endif
                            @break

                        @case(AttributeType::FLOAT->value)
                            <div class="relative">
                                <input type="number" step="any" name="attributes[{{ $attr->id }}]"
                                       class="form-input-big w-full py-3 pl-4 pr-10"
                                       placeholder="Insira um valor decimal"
                                    {{ $attr->is_required ? 'required' : '' }}
                                    {{ $attr->min_value !== null ? 'min='.$attr->min_value : '' }}
                                    {{ $attr->max_value !== null ? 'max='.$attr->max_value : '' }}>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray">
                                    <i class="bi bi-slash-lg"></i>
                                </div>
                            </div>
                            @if($attr->min_value !== null || $attr->max_value !== null)
                                <p class="text-xs text-gray-500 mt-1">
                                    @if($attr->min_value !== null && $attr->max_value !== null)
                                        Valor entre {{ $attr->min_value }} e {{ $attr->max_value }}
                                    @elseif($attr->min_value !== null)
                                        Valor mínimo: {{ $attr->min_value }}
                                    @elseif($attr->max_value !== null)
                                        Valor máximo: {{ $attr->max_value }}
                                    @endif
                                    @if($attr->unit)
                                        <span class="ml-1">({{ $attr->unit }})</span>
                                    @endif
                                </p>
                            @endif
                            @break

                        @case(AttributeType::TEXT->value)
                            <div class="relative">
                                <input type="text" name="attributes[{{ $attr->id }}]"
                                       class="form-input-big w-full py-3 pl-4 pr-10"
                                       placeholder="Digite aqui"
                                    {{ $attr->is_required ? 'required' : '' }}
                                    {{ $attr->min_length !== null ? 'minlength='.$attr->min_length : '' }}
                                    {{ $attr->max_length !== null ? 'maxlength='.$attr->max_length : '' }}>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray">
                                    <i class="bi bi-pencil"></i>
                                </div>
                            </div>
                            @if($attr->min_length !== null || $attr->max_length !== null)
                                <p class="text-xs text-gray-500 mt-1">
                                    @if($attr->min_length !== null && $attr->max_length !== null)
                                        Texto entre {{ $attr->min_length }} e {{ $attr->max_length }} caracteres
                                    @elseif($attr->min_length !== null)
                                        Mínimo: {{ $attr->min_length }} caracteres
                                    @elseif($attr->max_length !== null)
                                        Máximo: {{ $attr->max_length }} caracteres
                                    @endif
                                </p>
                            @endif
                            @break

                        @case(AttributeType::LONG_TEXT->value)
                            <div class="relative">
                                <textarea name="attributes[{{ $attr->id }}]" rows="4"
                                          class="form-input-big w-full p-4 resize-y"
                                          placeholder="Digite sua descrição aqui"
                                          {{ $attr->is_required ? 'required' : '' }}
                                    {{ $attr->min_length !== null ? 'minlength='.$attr->min_length : '' }}
                                    {{ $attr->max_length !== null ? 'maxlength='.$attr->max_length : '' }}></textarea>
                                <div class="absolute top-3 right-3 pointer-events-none text-gray">
                                    <i class="bi bi-file-text"></i>
                                </div>
                            </div>
                            @if($attr->min_length !== null || $attr->max_length !== null)
                                <p class="text-xs text-gray-500 mt-1">
                                    @if($attr->min_length !== null && $attr->max_length !== null)
                                        Texto entre {{ $attr->min_length }} e {{ $attr->max_length }} caracteres
                                    @elseif($attr->min_length !== null)
                                        Mínimo: {{ $attr->min_length }} caracteres
                                    @elseif($attr->max_length !== null)
                                        Máximo: {{ $attr->max_length }} caracteres
                                    @endif
                                </p>
                            @endif
                            @break

                        @case(AttributeType::BOOLEAN->value)
                            <div class="flex flex-wrap gap-4 pt-2">
                                <label class="flex items-center cursor-pointer p-2 rounded-lg hover:bg-gray-100">
                                    <input type="radio" name="attributes[{{ $attr->id }}]" value=""
                                           id="attr-{{ $attr->id }}-no-answer"
                                           class="w-5 h-5 text-secondary focus:ring-secondary"
                                        {{ !$attr->is_required ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Sem resposta</span>
                                </label>
                                <label class="flex items-center cursor-pointer p-2 rounded-lg hover:bg-gray-100">
                                    <input type="radio" name="attributes[{{ $attr->id }}]" value="true"
                                           id="attr-{{ $attr->id }}-true"
                                           class="w-5 h-5 text-secondary focus:ring-secondary">
                                    <span class="ml-2 text-gray-700">Sim</span>
                                </label>
                                <label class="flex items-center cursor-pointer p-2 rounded-lg hover:bg-gray-100">
                                    <input type="radio" name="attributes[{{ $attr->id }}]" value="false"
                                           id="attr-{{ $attr->id }}-false"
                                           class="w-5 h-5 text-secondary focus:ring-secondary">
                                    <span class="ml-2 text-gray-700">Não</span>
                                </label>
                            </div>
                            @break

                        @case(AttributeType::SELECT_SINGLE->value)
                            <div class="relative dropdown-wrapper w-full sm:w-auto">
                                <select id="attributes-{{ $attr->id }}" name="attributes[{{ $attr->id }}]"
                                        class="dropdown-select py-3 pl-4 pr-10 w-full text-base"
                                    {{ $attr->is_required ? 'required' : '' }}>
                                    <option value="" disabled selected>Selecione uma opção</option>
                                    @foreach($attr->options as $opt)
                                        <option value="{{ $opt->id }}">{{ $opt->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                                    <i class="bi bi-chevron-right dropdown-arrow transition-transform duration-300 ease-in-out"></i>
                                </div>
                            </div>
                            <style>
                                select:focus + div .dropdown-arrow {
                                    transform: rotate(90deg);
                                }
                            </style>
                            @break

                        @case(AttributeType::DATE->value)
                            <div class="relative">
                                <input type="date" name="attributes[{{ $attr->id }}]"
                                       class="form-input-big w-full py-3 pl-4 pr-10 appearance-none"
                                       style="position: relative; z-index: 10; background: transparent;"
                                    {{ $attr->is_required ? 'required' : '' }}
                                    {{ $attr->min_date !== null ? 'min='.$attr->min_date->format('Y-m-d') : '' }}
                                    {{ $attr->max_date !== null ? 'max='.$attr->max_date->format('Y-m-d') : '' }}>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray">
                                    <i class="bi bi-calendar-event"></i>
                                </div>
                            </div>
                        @if($attr->min_date !== null || $attr->max_date !== null)
                                <p class="text-xs text-gray-500 mt-1">
                                    @if($attr->min_date !== null && $attr->max_date !== null)
                                        Data entre {{ $attr->min_date->format('d/m/Y') }} e {{ $attr->max_date->format('d/m/Y') }}
                                    @elseif($attr->min_date !== null)
                                        Data mínima: {{ $attr->min_date->format('d/m/Y') }}
                                    @elseif($attr->max_date !== null)
                                        Data máxima: {{ $attr->max_date->format('d/m/Y') }}
                                    @endif
                                </p>
                            @endif
                            @break

                        @case(AttributeType::SELECT_MULTIPLE->value)
                            <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-sm">
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
                            @break

                        @default
                            <div class="p-4 bg-red-50 border border-red-200 rounded-lg text-red-500">
                                <div class="flex items-center">
                                    <i class="bi bi-exclamation-triangle mr-2"></i>
                                    <strong>Erro:</strong> Tipo de atributo desconhecido.
                                </div>
                            </div>
                            @break
                    @endswitch

                    @if(!$loop->last)
                        <div class="border-b border-gray-100 md:hidden mt-6"></div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@push('styles')
    <style>
        input[type="date"]::-webkit-calendar-picker-indicator {
            opacity: 0;
            cursor: pointer;
        }
    </style>
@endpush
