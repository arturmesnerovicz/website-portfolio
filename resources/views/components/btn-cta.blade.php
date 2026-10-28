@props([
    'text' => null,
    'type' => 'button',
    'onclick' => 'openContactModal()',
    'size' => 'default',
])

@php
    $buttonText = $text ?? __('Fale Conosco');
    $sizeClass = match($size) {
        'lg' => 'faq-cta-btn--lg',
        'sm' => 'faq-cta-btn--sm',
        default => '',
    };
@endphp

<button type="{{ $type }}"
        onclick="{{ $onclick }}"
        {{ $attributes->merge(['class' => 'faq-cta-btn ' . $sizeClass]) }}>
    <span class="faq-cta-text-contain">
        <span class="faq-cta-text">{{ $buttonText }}</span>
    </span>
    <span class="faq-cta-aside">
        <span class="faq-cta-aside-bg"></span>
        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="faq-cta-svg">
            <path d="M0 10L10 0M1 0H10V9" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="faq-cta-svg is-absolute">
            <path d="M0 10L10 0M1 0H10V9" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>
</button>
