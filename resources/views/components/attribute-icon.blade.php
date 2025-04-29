@php
    use App\Enums\AttributeType;
@endphp

@switch($type->value)
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
    @default
        <i class="bi bi-question-circle mr-2 text-secondary"></i>
@endswitch
