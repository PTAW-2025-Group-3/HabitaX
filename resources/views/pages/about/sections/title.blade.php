@props(['title', 'class' => '', 'slot' => ''])

<div class="{{ $class }} text-center">
    <h2 class="text-4xl font-bold text-black">{{ $title }}</h2>
    @if($slot)
        <p class="text-lg text-gray mt-4 max-w-3xl mx-auto">{{ $slot }}</p>
    @endif
</div>
