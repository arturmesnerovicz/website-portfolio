<section id="hero" class="relative min-h-[90vh] md:min-h-screen pt-28 pb-16 md:pt-36 md:pb-24 overflow-hidden bg-[#101010] flex flex-col justify-between w-full">
    <!-- Subtle Ambient Glow -->
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[600px] bg-[#b70606]/10 rounded-full blur-[180px] pointer-events-none -z-10"></div>

    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)] relative z-10 flex-1 flex flex-col justify-between">
        
        <!-- Top Row: Floating Showcase Elements Spanning the Viewport -->
        <div class="relative w-full h-36 sm:h-44 md:h-56 select-none pointer-events-none">
            <!-- Top-Left: iMac Monitor Mockup ("Serviços") -->
            <div class="hero-float-left absolute left-0 md:left-2 top-0 w-28 sm:w-56 md:w-64 lg:w-76 xl:w-84 aspect-[280/340] rounded-2xl overflow-hidden shadow-2xl transition-transform duration-700 ease-out hover:scale-105 pointer-events-auto">
                <img src="{{ asset('storage/hero-imac.png') }}"
                     alt="Estúdio Norra - Serviços Desktop"
                     class="w-full h-full object-contain filter drop-shadow-[0_25px_35px_rgba(0,0,0,0.85)]"
                     loading="eager">
            </div>

            <!-- Top-Right: Angled Tablet Mockup -->
            <div class="hero-float-right absolute right-0 md:right-2 -top-4 sm:top-0 w-32 sm:w-60 md:w-72 lg:w-84 xl:w-96 aspect-[280/340] rounded-2xl overflow-hidden shadow-2xl transition-transform duration-700 ease-out hover:scale-105 pointer-events-auto">
                <img src="{{ asset('storage/hero-tablet.png') }}"
                     alt="Estúdio Norra - Projeto Mobile Tablet"
                     class="w-full h-full object-contain filter drop-shadow-[0_25px_35px_rgba(0,0,0,0.85)] rotate-[-6deg]"
                     loading="eager">
            </div>
        </div>

        <!-- Center: Massive Cinematic Headline -->
        <div class="my-auto py-6 sm:py-10 md:py-16 text-center max-w-6xl mx-auto relative z-20">
            <h1 class="norra-reveal hero-headline font-display font-bold text-[clamp(2.5rem,6.2vw,5.5rem)] leading-[1.03] tracking-[-0.03em] text-[#ddddd5] uppercase hyphens-none">
                {{ $settings['hero_title'] ?? 'Criamos experiências que tornam a sua marca irresistível' }}
            </h1>
        </div>

        <!-- Bottom Row: Editorial Balance (Text + Metric Left, Tablet Right) -->
        <div class="relative w-full min-h-[160px] md:min-h-[220px] flex flex-col md:flex-row items-end justify-between gap-8 pt-6">
            <!-- Bottom-Left: Editorial Paragraph & Metric -->
            <div class="max-w-xl space-y-6 text-left relative z-20">
                <p class="norra-reveal text-base sm:text-lg lg:text-xl text-[#ddddd5]/80 font-normal leading-relaxed font-sans max-w-xl">
                    {{ $settings['hero_subtitle'] ?? 'Ajudamos marcas consolidadas criando uma experiência de website, que reflete aquilo que construíram e o que as tornam únicas.' }}
                </p>

                <div class="norra-reveal flex flex-wrap items-center gap-6 pt-2">
                    <!-- Penpot 30+ Metric Badge -->
                    <div class="flex items-baseline gap-2">
                        <span class="font-display font-bold text-3xl sm:text-4xl text-[#ddddd5]">
                            {{ $settings['hero_badge_number'] ?? '30+' }}
                        </span>
                        <span class="text-xs sm:text-sm text-[#888888] font-sans font-medium uppercase tracking-wider">
                            {{ $settings['hero_badge_label'] ?? 'marcas ajudadas' }}
                        </span>
                    </div>

                    <a href="#contato" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-[#ddddd5] text-[#101010] text-xs font-bold uppercase tracking-wider hover:bg-white active:scale-95 transition-all duration-200 shadow-lg">
                        <span>Fale Conosco</span>
                        <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Bottom-Right: Floating Tilted Tablet Mockup -->
            <div class="hero-float-bottom-right relative md:absolute right-0 bottom-0 w-44 sm:w-64 md:w-76 lg:w-92 aspect-[280/340] select-none pointer-events-none md:pointer-events-auto">
                <img src="{{ asset('storage/hero-tablet.png') }}"
                     alt="Estúdio Norra - Visual Showcase"
                     class="w-full h-full object-contain filter drop-shadow-[0_25px_35px_rgba(0,0,0,0.85)] rotate-[8deg] hover:rotate-[4deg] transition-transform duration-700 ease-out"
                     loading="lazy">
            </div>
        </div>

    </div>
</section>


