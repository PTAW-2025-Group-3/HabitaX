@php
    use App\Enums\AttributeType;
@endphp

{{-- This file is used to display the attributes of a property type in a form. --}}
<div>
    @if($attributes->isEmpty())
        <div class="flex flex-col items-center justify-center py-10">
            <i class="bi bi-houses text-5xl text-gray-300 mb-4"></i>
            <p class="text-gray text-md">Nenhum atributo disponível para este tipo de propriedade.</p>
        </div>
    @else
        @php
            $basePath = 'properties.form.attributes.';
            $typeViewMap = [
                AttributeType::INT->value => $basePath . 'int',
                AttributeType::FLOAT->value => $basePath . 'float',
                AttributeType::TEXT->value => $basePath . 'text',
                AttributeType::LONG_TEXT->value => $basePath . 'long-text',
                AttributeType::BOOLEAN->value => $basePath . 'boolean',
                AttributeType::SELECT_SINGLE->value => $basePath . 'select-single',
                AttributeType::SELECT_MULTIPLE->value => $basePath . 'select-multiple',
                AttributeType::DATE->value => $basePath . 'date',
            ];
            $sortedAttributes = $attributes->sortBy(function ($attr) {
                return $attr->is_required ? 0 : 1;
            })->sortBy('order')->values();
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($sortedAttributes as $attr)
                <div class="mb-4 transition-all duration-300 hover:shadow-md p-4 rounded-xl hover:bg-gray-50
                {{ $attr->type->value === \App\Enums\AttributeType::LONG_TEXT->value ? 'md:col-span-2' : '' }}">
                <label class="block text-sm font-semibold text-gray-secondary mb-2 flex items-center">
                        <x-attribute-icon :type="$attr->type" />
                        {{ $attr->name }}
                        @if($attr->is_required)
                            <span class="text-red-500 ml-1">*</span>
                        @endif
                        @if($attr->description)
                            <x-attribute-description :description="$attr->description" />
                        @endif
                    </label>

                    @isset($typeViewMap[$attr->type->value])
                        @include($typeViewMap[$attr->type->value], [
                            'attr' => $attr, 'parameter' => $parameters->firstWhere('attribute_id', $attr->id)
                        ])
                    @else
                        <div class="p-4 bg-red-50 border border-red-200 rounded-lg text-red-500">
                            <div class="flex items-center">
                                <i class="bi bi-exclamation-triangle mr-2"></i>
                                <strong>Erro:</strong> Tipo de atributo desconhecido.
                            </div>
                        </div>
                    @endisset

                @if(!$loop->last)
                        <div class="border-b border-gray-100 md:hidden mt-6"></div>
                    @endif
                </div>
            @endforeach

            <ul>
                @foreach($parameters as $parameter)
                    @if($parameter->attribute_id === null)
                        <li class="text-red-500">
                            <strong>Erro:</strong> Parâmetro {{ $parameter->id }} não associado a nenhum atributo.
                        </li>
                    @endif
                @endforeach
            </ul>

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
