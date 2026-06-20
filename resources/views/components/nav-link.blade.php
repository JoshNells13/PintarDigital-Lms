@props(['active' => false, 'icon' => ''])

@php
$classes = ($active ?? false)
            ? 'flex items-center justify-center group-hover/sidebar:justify-start gap-0 group-hover/sidebar:gap-3 px-0 group-hover/sidebar:px-4 py-3 text-sm font-bold text-primary bg-primary/5 rounded-xl transition-all duration-300'
            : 'flex items-center justify-center group-hover/sidebar:justify-start gap-0 group-hover/sidebar:gap-3 px-0 group-hover/sidebar:px-4 py-3 text-sm font-semibold text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all duration-300 rounded-xl';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        <span class="material-symbols-outlined text-[20px] shrink-0 {{ ($active ?? false) ? 'fill-1' : '' }}" style="font-variation-settings: 'FILL' {{ ($active ?? false) ? 1 : 0 }}">
            {{ $icon }}
        </span>
    @endif
    <span class="max-w-0 opacity-0 group-hover/sidebar:max-w-xs group-hover/sidebar:opacity-100 transition-all duration-300 ease-in-out overflow-hidden whitespace-nowrap">
        {{ $slot }}
    </span>
</a>
