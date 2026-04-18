@props(['active' => false, 'icon' => ''])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 px-4 py-3 text-sm font-bold text-primary bg-primary/5 rounded-xl transition-all'
            : 'flex items-center gap-3 px-4 py-3 text-sm font-semibold text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all rounded-xl';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        <span class="material-symbols-outlined text-[20px] {{ ($active ?? false) ? 'fill-1' : '' }}" style="font-variation-settings: 'FILL' {{ ($active ?? false) ? 1 : 0 }}">
            {{ $icon }}
        </span>
    @endif
    <span>{{ $slot }}</span>
</a>
