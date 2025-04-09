@if($icon === 'flag')
    <i class="bi bi-flag-fill h-6 w-6 text-current"></i>
@elseif($icon === 'clock')
    <i class="bi bi-clock-fill h-6 w-6 text-current"></i>
@elseif($icon === 'check-circle')
    <i class="bi bi-check-circle-fill h-6 w-6 text-current"></i>
@elseif($icon === 'x-circle')
    <i class="bi bi-x-circle-fill h-6 w-6 text-current"></i>
@elseif($icon === 'person-x')
    <i class="bi bi-person-x-fill h-6 w-6 text-current"></i>
@else
    <i class="bi bi-question-circle h-6 w-6 text-current"></i> {{-- fallback genérico --}}
@endif
