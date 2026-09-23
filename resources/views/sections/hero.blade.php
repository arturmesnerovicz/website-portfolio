<section id="hero" class="relative h-screen h-[100dvh] max-h-[100dvh] min-h-0 overflow-hidden bg-[#101010] flex flex-col justify-between w-full select-none">
    <!-- Subtle Ambient Glow -->
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[400px] bg-[#e33702]/10 rounded-full blur-[160px] pointer-events-none -z-10"></div>

    <!-- Floating Showcase Devices (Dynamic via CMS Hero Section, fallback to default mockups) -->
    @php
        $heroLeftImg = !empty($settings['hero_image_left']) && file_exists(public_path('storage/' . $settings['hero_image_left']))
            ? asset('storage/' . $settings['hero_image_left'])
            : asset('storage/hero-imac.png');

        $heroRightImg = !empty($settings['hero_image_right']) && file_exists(public_path('storage/' . $settings['hero_image_right']))
            ? asset('storage/' . $settings['hero_image_right'])
            : asset('storage/hero-tablet.png');

        $heroBottomRightImg = !empty($settings['hero_image_bottom_right']) && file_exists(public_path('storage/' . $settings['hero_image_bottom_right']))
            ? asset('storage/' . $settings['hero_image_bottom_right'])
            : asset('storage/hero-tablet-bottom.png');
    @endphp

    <!-- Top-Left: iMac Monitor Mockup -->
    <div class="hero-float-left hero-mockup-frame absolute left-[clamp(1.5rem,3.125vw,3.5rem)] top-[calc(5rem+clamp(0.5rem,1.8vh,1.5rem))] rounded-[2px] overflow-hidden shadow-2xl transition-transform duration-700 ease-out pointer-events-auto z-10">
        <img src="{{ $heroLeftImg }}"
             alt="Estúdio Norra - Showcase Esquerda"
             class="w-full h-full object-contain filter drop-shadow-[0_16px_28px_rgba(0,0,0,0.85)]"
             loading="eager">
    </div>

    <!-- Top-Right: Angled Tablet Mockup -->
    <div class="hero-float-right hero-mockup-frame absolute right-[clamp(1.5rem,3.125vw,3.5rem)] top-[calc(5rem+clamp(0.5rem,1.8vh,1.5rem))] rounded-[2px] overflow-hidden shadow-2xl transition-transform duration-700 ease-out pointer-events-auto z-10">
        <img src="{{ $heroRightImg }}"
             alt="Estúdio Norra - Showcase Direita"
             class="w-full h-full object-contain filter drop-shadow-[0_16px_28px_rgba(0,0,0,0.85)]"
             loading="eager">
    </div>

    <!-- Bottom-Right: Floating Tablet Mockup (Desktop only) -->
    <div class="hero-float-bottom-right hero-mockup-frame hidden sm:block absolute right-[clamp(1.5rem,3.125vw,3.5rem)] bottom-[clamp(1.25rem,3.5vh,2.5rem)] rounded-[2px] overflow-hidden shadow-2xl transition-transform duration-700 ease-out pointer-events-auto z-10">
        <img src="{{ $heroBottomRightImg }}"
             alt="Estúdio Norra - Showcase Inferior"
             class="w-full h-full object-contain filter drop-shadow-[0_16px_28px_rgba(0,0,0,0.85)]"
             loading="lazy">
    </div>

    <!-- Main Flex Column: Contained entirely inside 100dvh -->
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)] relative z-20 flex-1 flex flex-col justify-between pt-[clamp(5rem,9.5vh,6rem)] pb-[clamp(1.25rem,3.5vh,2.5rem)] min-h-0 pointer-events-none">
        
        <!-- Top Spacer for Header Offset -->
        <div class="w-full h-1 sm:h-2 flex-shrink-0"></div>

        <!-- Center: Cinematic Headline (Penpot 726px width, exact 3 lines) -->
        <div class="my-auto py-2 sm:py-3 text-center max-w-[726px] mx-auto flex-shrink-0 pointer-events-auto">
            @php
                $heroTitle = $settings['hero_title'] ?? "Criamos experiências\nque tornam a sua marca\nirresistível";
                if ($heroTitle === 'Criamos experiências que tornam a sua marca irresistível') {
                    $heroTitle = "Criamos experiências\nque tornam a sua marca\nirresistível";
                }
            @endphp
            <h1 class="norra-reveal hero-headline font-display font-bold text-[clamp(1.75rem,min(4.5vw,6.5vh),4.0625rem)] leading-[1.1] tracking-[-0.5px] sm:tracking-[-0.75px] md:tracking-[-1.31px] text-[#ddddd5] hyphens-none">
                {!! nl2br(e($heroTitle)) !!}
            </h1>
        </div>

        <!-- Bottom Row: Editorial Paragraph - 100% Above the Fold -->
        <div class="relative w-full flex flex-col md:flex-row items-start md:items-end justify-between gap-4 md:gap-8 flex-shrink-0 pointer-events-auto">
            <!-- Bottom-Left: Editorial Paragraph (486px matching Penpot) -->
            <div class="max-w-[486px] text-left">
                <p class="norra-reveal text-base sm:text-lg md:text-xl lg:text-[clamp(1.125rem,1.5vw,1.5rem)] text-[#ddddd5]/80 font-normal leading-[1.25] tracking-normal sm:tracking-[-0.5px] lg:tracking-[-1px] font-sans">
                    {{ $settings['hero_subtitle'] ?? 'Ajudamos marcas consolidadas craindo uma experiência de website, que reflete aquilo que construíram e o que as tornam únicas.' }}
                </p>
            </div>

            <!-- Empty Right Slot (Mockup floats behind gracefully) -->
            <div class="hidden sm:block hero-mockup-slot h-1 flex-shrink-0"></div>
        </div>

    </div>
</section>
