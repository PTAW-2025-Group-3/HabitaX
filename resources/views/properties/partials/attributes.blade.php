@php
    use App\Enums\AttributeType;
@endphp
{{-- This file is used to display the attributes of a property type in a form. --}}
<div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-200">
@if($attributes->isEmpty())
    <p class="text-muted">Nenhum atributo disponível para este tipo de propriedade.</p>
@else
    <h2 class="text-xl font-bold text-primary mb-6">Detalhes da Propriedade</h2>

    @foreach($attributes as $attr)
        <div class="mb-3">
            <label class="block text-sm font-medium text-gray-secondary mb-1">{{ $attr->name }}</label>

            @switch($attr->type->value)
                @case(AttributeType::INT->value)
                    <div class="relative">
                        <input type="number" name="attributes[{{ $attr->id }}]" class="py-2 pl-3 pr-10 w-full
                               bg-white border border-gray-300 rounded-lg shadow-sm appearance-none
                               text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div>
                    @break
                @case(AttributeType::FLOAT->value)
                    <div class="relative">
                        <input type="number" step="any" name="attributes[{{ $attr->id }}]"
                               class="py-2 pl-3 pr-10 w-full bg-white border border-gray-300 rounded-lg shadow-sm appearance-none
                      text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div>
                    @break
                @case(AttributeType::TEXT->value)
                    <div class="relative">
                        <input type="text" name="attributes[{{ $attr->id }}]"
                               class="py-2 pl-3 pr-10 w-full bg-white border border-gray-300 rounded-lg shadow-sm appearance-none
                      text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div>
                    @break
                @case(AttributeType::LONG_TEXT->value)
                    <textarea name="attributes[{{ $attr->id }}]" rows="4" cols="50"
                              class="py-2 px-3 w-full bg-white border border-gray-300 rounded-lg shadow-sm appearance-none
                                     text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"></textarea>
                    @break
                @case(AttributeType::BOOLEAN->value)
                    <div class="flex items-center space-x-4">
                        <div class="form-check">
                            <input type="radio" name="attributes[{{ $attr->id }}]" value="" id="attr-{{ $attr->id }}-no-answer" class="form-check-input">
                            <label for="attr-{{ $attr->id }}-no-answer" class="form-check-label">Sem resposta</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="attributes[{{ $attr->id }}]" value="true" id="attr-{{ $attr->id }}-true" class="form-check-input">
                            <label for="attr-{{ $attr->id }}-true" class="form-check-label">Sim</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="attributes[{{ $attr->id }}]" value="false" id="attr-{{ $attr->id }}-false" class="form-check-input">
                            <label for="attr-{{ $attr->id }}-false" class="form-check-label">Não</label>
                        </div>
                    </div>
                    @break

                @case(AttributeType::SELECT_SINGLE->value)
                    <div class="relative dropdown-wrapper w-full sm:w-auto">
                        <select id="attributes-{{ $attr->id }}" name="attributes[{{ $attr->id }}]"
                                class="dropdown-select py-2 pl-4 pr-10 w-full h-10" data-toggle="dropdown">
                            <option value="" disabled selected>Selecione uma opção</option>
                            @foreach($attr->options as $opt)
                                <option value="{{ $opt->value }}">{{ $opt->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                            <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                        </div>
                    </div>
                    @break

                @case(AttributeType::SELECT_MULTIPLE->value)
                    <div class="border border-gray-300 rounded-lg p-3">
                        <div class="text-sm text-gray-500 mb-2">
                            @if($attr->min_options > 0 && $attr->max_options)
                                Selecione de {{ $attr->min_options }} a {{ $attr->max_options }} opções
                            @elseif($attr->min_options > 0 && !$attr->max_options)
                                Selecione pelo menos {{ $attr->min_options }} opções
                            @elseif(!$attr->min_options && $attr->max_options)
                                Selecione até {{ $attr->max_options }} opções
                            @else
                                Selecione quantas opções desejar
                            @endif
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            @foreach($attr->options as $opt)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="attributes[{{ $attr->id }}][]" value="{{ $opt->value }}" id="attr-{{ $attr->id }}-opt-{{ $loop->index }}">
                                    <label class="form-check-label text-sm text-gray-700" for="attr-{{ $attr->id }}-opt-{{ $loop->index }}">
                                        {{ $opt->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @break

                @case(AttributeType::DATE->value)
                    <div class="relative">
                        <input type="date" name="attributes[{{ $attr->id }}]"
                               class="py-2 px-3
                               bg-white border border-gray-300 rounded-lg shadow-sm appearance-none
                               text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div>
                    @break

                @default
                    <div class="text-danger">
                        <strong>Erro:</strong> Tipo de atributo desconhecido.
                    </div>
                    @break
            @endswitch
        </div>
    @endforeach
@endif
</div>
