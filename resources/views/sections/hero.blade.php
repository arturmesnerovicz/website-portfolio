<section id="hero" class="relative h-screen h-[100dvh] max-h-[100dvh] min-h-0 overflow-hidden bg-[#101010] flex flex-col justify-between w-full select-none">
    <!-- Subtle Ambient Glow -->
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[400px] bg-[#e33702]/10 rounded-full blur-[160px] pointer-events-none -z-10"></div>

    <!-- Floating Showcase Devices (Absolute positioning so they never consume flex space or push content out of view) -->
    <!-- Top-Left: iMac Monitor Mockup ("Serviços") -->
    <div class="hero-float-left absolute left-4 sm:left-6 md:left-8 lg:left-12 top-20 sm:top-22 md:top-24 w-28 sm:w-36 md:w-44 lg:w-56 aspect-[280/340] rounded-[4px] overflow-hidden shadow-2xl transition-transform duration-700 ease-out pointer-events-auto z-10">
        <img src="{{ asset('storage/hero-imac.png') }}"
             alt="Estúdio Norra - Serviços Desktop"
             class="w-full h-full object-contain filter drop-shadow-[0_16px_28px_rgba(0,0,0,0.85)]"
             loading="eager">
    </div>

    <!-- Top-Right: Angled Tablet Mockup -->
    <div class="hero-float-right absolute right-4 sm:right-6 md:right-8 lg:right-12 top-16 sm:top-18 md:top-20 w-32 sm:w-40 md:w-48 lg:w-60 aspect-[280/340] rounded-[4px] overflow-hidden shadow-2xl transition-transform duration-700 ease-out pointer-events-auto z-10">
        <img src="{{ asset('storage/hero-tablet.png') }}"
             alt="Estúdio Norra - Projeto Mobile Tablet"
             class="w-full h-full object-contain filter drop-shadow-[0_16px_28px_rgba(0,0,0,0.85)] rotate-[-6deg]"
             loading="eager">
    </div>

    <!-- Bottom-Right: Floating Tilted Tablet Mockup (Desktop only) -->
    <div class="hero-float-bottom-right hidden sm:block absolute right-6 sm:right-10 md:right-14 lg:right-16 bottom-6 sm:bottom-8 md:bottom-10 w-32 sm:w-40 md:w-52 lg:w-64 aspect-[280/340] rounded-[4px] overflow-hidden shadow-2xl transition-transform duration-700 ease-out pointer-events-auto z-10">
        <img src="{{ asset('storage/hero-tablet.png') }}"
             alt="Estúdio Norra - Visual Showcase"
             class="w-full h-full object-contain filter drop-shadow-[0_16px_28px_rgba(0,0,0,0.85)] rotate-[8deg]"
             loading="lazy">
    </div>

    <!-- Main Flex Column: Contained entirely inside 100dvh -->
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)] relative z-20 flex-1 flex flex-col justify-between pt-20 sm:pt-24 pb-6 sm:pb-8 min-h-0 pointer-events-none">
        
        <!-- Top Spacer for Header Offset -->
        <div class="w-full h-2 sm:h-4 flex-shrink-0"></div>

        <!-- Center: Cinematic Headline (Fully readable, dynamically scaled, centered in available space) -->
        <div class="my-auto py-2 sm:py-4 text-center max-w-4xl lg:max-w-5xl mx-auto flex-shrink-0 pointer-events-auto">
            <h1 class="norra-reveal hero-headline font-display font-bold text-[clamp(1.75rem,4.1vw,4rem)] leading-[1.04] tracking-[-0.03em] text-[#ddddd5] uppercase hyphens-none">
                {{ $settings['hero_title'] ?? 'Criamos experiências que tornam a sua marca irresistível' }}
            </h1>
        </div>

        <!-- Bottom Row: Editorial Paragraph, Metric Badge and CTA - 100% Above the Fold -->
        <div class="relative w-full flex flex-col md:flex-row items-start md:items-end justify-between gap-4 md:gap-8 flex-shrink-0 pointer-events-auto">
            <!-- Bottom-Left: Editorial Paragraph & Metric & CTA -->
            <div class="max-w-xl space-y-3 sm:space-y-4 text-left">
                <p class="norra-reveal text-xs sm:text-sm md:text-base text-[#ddddd5]/80 font-normal leading-relaxed font-sans max-w-lg lg:max-w-xl">
                    {{ $settings['hero_subtitle'] ?? 'Ajudamos marcas consolidadas e fundadores exigentes a construir uma presença digital marcante, com estética autoral e tecnologia de alto desempenho.' }}
                </p>

                <div class="norra-reveal flex flex-wrap items-center gap-5 pt-1">
                    <!-- Penpot 30+ Metric Badge -->
                    <div class="flex items-baseline gap-2">
                        <span class="font-display font-bold text-2xl sm:text-3xl lg:text-4xl text-[#ddddd5]">
                            {{ $settings['hero_badge_number'] ?? '30+' }}
                        </span>
                        <span class="text-xs sm:text-sm text-[#888888] font-sans font-medium uppercase tracking-wider">
                            {{ $settings['hero_badge_label'] ?? 'marcas ajudadas' }}
                        </span>
                    </div>

                    <!-- CTA Button -->
                    <a href="#contato" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-[#ddddd5] text-[#101010] text-xs font-bold uppercase tracking-wider hover:bg-[#e33702] hover:text-white active:scale-95 transition-all duration-300 shadow-lg">
                        <span>Fale Conosco</span>
                        <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Empty Right Slot (Mockup floats behind gracefully) -->
            <div class="hidden sm:block w-32 md:w-48 lg:w-64 h-1 flex-shrink-0"></div>
        </div>

    </div>
</section>
