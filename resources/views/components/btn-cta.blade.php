@props([
    'text' => null,
    'type' => 'button',
    'onclick' => 'openContactModal()',
    'size' => 'default',
    'showArrow' => true,
])

@php
    $buttonText = $text ?? __('Get in touch');
@endphp

<button type="{{ $type }}"
        onclick="{{ $onclick }}"
        {{ $attributes->merge(['class' => 'vicz-suction-btn']) }}
        aria-label="{{ $buttonText }}">
    @if($showArrow)
        <span class="vicz-suction-icon vicz-suction-icon--left" aria-hidden="true">
            <svg viewBox="0 0 14 14" fill="none" class="w-3.5 h-3.5 stroke-current stroke-[2.2]" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2.5 11.5L11.5 2.5M11.5 2.5H4.5M11.5 2.5V9.5"/>
            </svg>
        </span>
    @endif
    <span class="vicz-suction-text">
        {{ $buttonText }}
    </span>
    @if($showArrow)
        <span class="vicz-suction-icon vicz-suction-icon--right" aria-hidden="true">
            <svg viewBox="0 0 14 14" fill="none" class="w-3.5 h-3.5 stroke-current stroke-[2.2]" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2.5 11.5L11.5 2.5M11.5 2.5H4.5M11.5 2.5V9.5"/>
            </svg>
        </span>
    @endif
</button>
