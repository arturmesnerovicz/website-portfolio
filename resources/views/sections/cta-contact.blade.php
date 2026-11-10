@php
    $isEn = app()->getLocale() === 'en';

    $defaultPtTitle = "VAMOS CRIAR\nUMA EXPERIÊNCIA\nQUE MOVE\nSUA MARCA";
    $defaultEnTitle = "LET'S BUILD\nAN EXPERIENCE\nTHAT ELEVATES\nYOUR BRAND";

    $rawTitle = $isEn
        ? ($settings['cta_title_en'] ?? null)
        : ($settings['cta_title'] ?? null);

    $legacyPtTitles = [
        'VAMOS CRIAR UMA EXPERIÊNCIA QUE MOVE SUA MARCA',
        "VAMOS CRIAR\nUMA EXPERIÊNCIA QUE\nMOVE\nSUA MARCA",
        "VAMOS CRIAR\r\nUMA EXPERIÊNCIA QUE\r\nMOVE\r\nSUA MARCA",
    ];

    if (empty($rawTitle) || (!$isEn && in_array(trim($rawTitle), $legacyPtTitles, true))) {
        $rawTitle = $isEn ? $defaultEnTitle : $defaultPtTitle;
    }

    $normalizedTitle = preg_replace('/<br\s*\/?>/i', "\n", $rawTitle);
    $titleLines = array_filter(array_map('trim', explode("\n", $normalizedTitle)), fn ($line) => $line !== '');

    $ctaButtonText = $isEn
        ? ($settings['cta_button_text_en'] ?? __('Nos conte a sua história'))
        : ($settings['cta_button_text'] ?? 'Nos conte a sua história');

    $customBg = $settings['cta_bg_image'] ?? null;
@endphp

<section id="contato" data-bg="dark" class="cta-section bg-[#101010] relative z-20 w-full min-h-screen lg:min-h-[100svh] flex items-center justify-center overflow-hidden py-24 sm:py-32 lg:py-40">
    <!-- Full-width Photographic Studio Background (Developer Desk / Estúdio Norra) -->
    <div class="cta-bg-wrap absolute inset-0 z-0 overflow-hidden pointer-events-none">
        @if(!empty($customBg))
            <img src="{{ asset('storage/' . $customBg) }}"
                 alt="Estúdio Norra Workspace & Studio Atmosphere"
                 class="cta-bg-img w-full h-full object-cover object-center filter brightness-65 contrast-105">
        @else
            <picture>
                <source srcset="{{ asset('storage/cta-bg.webp') }}?v={{ file_exists(public_path('storage/cta-bg.webp')) ? filemtime(public_path('storage/cta-bg.webp')) : 1 }}" type="image/webp">
                <img src="{{ asset('storage/cta-bg.png') }}?v={{ file_exists(public_path('storage/cta-bg.png')) ? filemtime(public_path('storage/cta-bg.png')) : 1 }}"
                     alt="Estúdio Norra Workspace & Studio Atmosphere"
                     class="cta-bg-img w-full h-full object-cover object-center filter brightness-65 contrast-105">
            </picture>
        @endif
        <div class="absolute inset-0 bg-[#101010]/50 backdrop-blur-[1px]"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#101010] via-transparent to-[#101010]/80"></div>
    </div>

    <!-- Centered Content Matching Penpot 'Seção CTA Final' -->
    <div class="cta-content-wrap relative z-10 w-full max-w-[75rem] mx-auto px-6 sm:px-8 py-20 lg:py-24 text-center space-y-6 sm:space-y-8">
        <h2 class="font-display font-bold text-[clamp(2.15rem,6.94vw,6.25rem)] leading-[1.06] uppercase tracking-[-1.5px] sm:tracking-[-2.5px] md:tracking-[-3.5px] lg:tracking-[-4.85px] text-[#ddddd5] text-center mx-auto select-none">
            @foreach($titleLines as $line)
                <span class="block sm:whitespace-nowrap">{{ $line }}</span>
            @endforeach
        </h2>

        <div class="pt-2 sm:pt-4 flex justify-center">
            <x-btn-cta :text="$ctaButtonText" variant="light" />
        </div>
    </div>
</section>
