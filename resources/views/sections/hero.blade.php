<section id="hero" class="relative h-screen h-[100dvh] max-h-[100dvh] min-h-0 overflow-hidden bg-[#101010] flex flex-col justify-between w-full select-none">
    <!-- Subtle Ambient Glow -->
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[400px] bg-[#e33702]/10 rounded-full blur-[160px] pointer-events-none -z-10"></div>

    <!-- Floating Showcase Devices (Absolute positioning so they never consume flex space or push content out of view) -->
    <!-- Top-Left: iMac Monitor Mockup ("Serviços") -->
    <div class="hero-float-left absolute left-[clamp(1.5rem,3.125vw,3.5rem)] top-[calc(6.5rem+1px)] sm:top-[calc(7rem+1px)] md:top-[calc(7.5rem+1px)] w-28 sm:w-36 md:w-44 lg:w-[280px] aspect-[280/340] rounded-[2px] overflow-hidden shadow-2xl transition-transform duration-700 ease-out pointer-events-auto z-10">
        <img src="{{ asset('storage/hero-imac.png') }}"
             alt="Estúdio Norra - Serviços Desktop"
             class="w-full h-full object-contain filter drop-shadow-[0_16px_28px_rgba(0,0,0,0.85)]"
             loading="eager">
    </div>

    <!-- Top-Right: Angled Tablet Mockup -->
    <div class="hero-float-right absolute right-[clamp(1.5rem,3.125vw,3.5rem)] top-[calc(6.5rem+1px)] sm:top-[calc(7rem+1px)] md:top-[calc(7.5rem+1px)] w-28 sm:w-36 md:w-44 lg:w-[280px] aspect-[280/340] rounded-[2px] overflow-hidden shadow-2xl transition-transform duration-700 ease-out pointer-events-auto z-10">
        <img src="{{ asset('storage/hero-tablet.png') }}"
             alt="Estúdio Norra - Projeto Mobile Tablet"
             class="w-full h-full object-contain filter drop-shadow-[0_16px_28px_rgba(0,0,0,0.85)]"
             loading="eager">
    </div>

    <!-- Bottom-Right: Floating Tablet Mockup (Desktop only) -->
    <div class="hero-float-bottom-right hidden sm:block absolute right-[clamp(1.5rem,3.125vw,3.5rem)] bottom-6 sm:bottom-8 md:bottom-10 w-28 sm:w-36 md:w-44 lg:w-[280px] aspect-[280/340] rounded-[2px] overflow-hidden shadow-2xl transition-transform duration-700 ease-out pointer-events-auto z-10">
        <img src="{{ asset('storage/hero-tablet-bottom.png') }}"
             alt="Estúdio Norra - Visual Showcase"
             class="w-full h-full object-contain filter drop-shadow-[0_16px_28px_rgba(0,0,0,0.85)]"
             loading="lazy">
    </div>

    <!-- Main Flex Column: Contained entirely inside 100dvh -->
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)] relative z-20 flex-1 flex flex-col justify-between pt-20 sm:pt-24 pb-6 sm:pb-8 md:pb-10 min-h-0 pointer-events-none">
        
        <!-- Top Spacer for Header Offset -->
        <div class="w-full h-2 sm:h-4 flex-shrink-0"></div>

        <!-- Center: Cinematic Headline (Penpot 726px width, exact 3 lines) -->
        <div class="my-auto py-2 sm:py-4 text-center max-w-[726px] mx-auto flex-shrink-0 pointer-events-auto">
            @php
                $heroTitle = $settings['hero_title'] ?? "Criamos experiências\nque tornam a sua marca\nirresistível";
                if ($heroTitle === 'Criamos experiências que tornam a sua marca irresistível') {
                    $heroTitle = "Criamos experiências\nque tornam a sua marca\nirresistível";
                }
            @endphp
            <h1 class="norra-reveal hero-headline font-display font-bold text-[clamp(1.75rem,4.5vw,4.0625rem)] leading-[1.1] tracking-[-0.5px] sm:tracking-[-0.75px] md:tracking-[-1.31px] text-[#ddddd5] hyphens-none">
                {!! nl2br(e($heroTitle)) !!}
            </h1>
        </div>

        <!-- Bottom Row: Editorial Paragraph - 100% Above the Fold -->
        <div class="relative w-full flex flex-col md:flex-row items-start md:items-end justify-between gap-4 md:gap-8 flex-shrink-0 pointer-events-auto">
            <!-- Bottom-Left: Editorial Paragraph (486px matching Penpot) -->
            <div class="max-w-[486px] text-left">
                <p class="norra-reveal text-base sm:text-lg md:text-xl lg:text-[24px] text-[#ddddd5]/80 font-normal leading-[1.25] tracking-normal sm:tracking-[-0.5px] lg:tracking-[-1px] font-sans">
                    {{ $settings['hero_subtitle'] ?? 'Ajudamos marcas consolidadas craindo uma experiência de website, que reflete aquilo que construíram e o que as tornam únicas.' }}
                </p>
            </div>

            <!-- Empty Right Slot (Mockup floats behind gracefully) -->
            <div class="hidden sm:block w-32 md:w-48 lg:w-64 h-1 flex-shrink-0"></div>
        </div>

    </div>
</section>
