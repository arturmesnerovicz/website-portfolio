<section id="contato" data-bg="dark" class="cta-section bg-[#101010] relative z-20 w-full min-h-screen lg:min-h-[100svh] flex items-center justify-center overflow-hidden py-24 sm:py-32 lg:py-40">
    <!-- Full-width Photographic Studio Background (Developer Desk / Estúdio Norra) -->
    <div class="cta-bg-wrap absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <picture>
            <source srcset="{{ asset('storage/cta-bg.webp') }}?v={{ file_exists(public_path('storage/cta-bg.webp')) ? filemtime(public_path('storage/cta-bg.webp')) : 1 }}" type="image/webp">
            <img src="{{ asset('storage/cta-bg.png') }}?v={{ file_exists(public_path('storage/cta-bg.png')) ? filemtime(public_path('storage/cta-bg.png')) : 1 }}"
                 alt="Estúdio Norra Workspace & Studio Atmosphere"
                 class="cta-bg-img w-full h-full object-cover object-center filter brightness-65 contrast-105">
        </picture>
        <div class="absolute inset-0 bg-[#101010]/50 backdrop-blur-[1px]"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#101010] via-transparent to-[#101010]/80"></div>
    </div>

    <!-- Centered Content Matching Penpot 'Seção CTA Final' -->
    <div class="cta-content-wrap relative z-10 w-full max-w-[930px] mx-auto px-6 sm:px-8 py-20 lg:py-24 text-center space-y-6 sm:space-y-8">
        <h2 class="font-display font-bold text-[clamp(2.15rem,6.94vw,6.25rem)] leading-[1.1] uppercase tracking-[-1.5px] sm:tracking-[-2.5px] md:tracking-[-3.5px] lg:tracking-[-4.85px] text-[#ddddd5] text-center max-w-[930px] mx-auto select-none">
            {!! __('VAMOS CRIAR<br />UMA EXPERIÊNCIA<br />QUE MOVE<br />SUA MARCA') !!}
        </h2>

        <div class="pt-2 sm:pt-4 flex justify-center">
            <x-btn-cta :text="__($settings['cta_button_text'] ?? 'Nos conte a sua história')" size="lg" />
        </div>
    </div>
</section>

