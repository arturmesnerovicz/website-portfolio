<section id="jornada" class="relative w-full overflow-hidden">
    <h2 class="sr-only">{{ app()->getLocale() === 'en' ? 'Project Journey' : 'Jornada do Projeto' }}</h2>
    @php
        $marqueeText = app()->getLocale() === 'en' ? 'PROJECT JOURNEY' : 'JORNADA DO PROJETO';
        
        $steps = [
            [
                'step' => app()->getLocale() === 'en' ? 'STEP 1' : 'ETAPA 1',
                'bg' => 'bg-[#d1d1d1]',
                'text' => 'text-[#151515]',
                'marqueeColor' => 'text-[#101010]',
                'shadow' => 'shadow-[0_-20px_50px_rgba(0,0,0,0.15)]',
                'zIndex' => 10,
                'media' => asset('storage/vicz-journey-media.jpg'),
                'desc' => app()->getLocale() === 'en'
                    ? 'We start by deeply immersing ourselves in your brand, understanding your positioning and what makes you unique to build a strategic narrative that connects with users.'
                    : 'Começamos por uma imersão profunda na sua marca, compreendendo o seu posicionamento e o que a torna única para construir uma narrativa estratégica que conecta com os utilizadores.'
            ],
            [
                'step' => app()->getLocale() === 'en' ? 'STEP 2' : 'ETAPA 2',
                'bg' => 'bg-[#151515]',
                'text' => 'text-[#ddddd5]',
                'marqueeColor' => 'text-[#ddddd5]',
                'shadow' => 'shadow-[0_-30px_60px_rgba(0,0,0,0.45)]',
                'zIndex' => 20,
                'media' => file_exists(public_path('storage/01M32F038AFG6CETWEFRVFB1X3.jpeg')) ? asset('storage/01M32F038AFG6CETWEFRVFB1X3.jpeg') : asset('storage/vicz-journey-media.jpg'),
                'desc' => app()->getLocale() === 'en'
                    ? 'We translate strategic positioning into high-end aesthetics, crafting bespoke design systems, expressive typography, and fluid visual identities.'
                    : 'Traduzimos o posicionamento estratégico em estética de alto padrão, criando sistemas de design exclusivos, tipografia expressiva e identidades visuais fluidas.'
            ],
            [
                'step' => app()->getLocale() === 'en' ? 'STEP 3' : 'ETAPA 3',
                'bg' => 'bg-[#d1d1d1]',
                'text' => 'text-[#151515]',
                'marqueeColor' => 'text-[#101010]',
                'shadow' => 'shadow-[0_-30px_60px_rgba(0,0,0,0.25)]',
                'zIndex' => 30,
                'media' => file_exists(public_path('storage/01M2NXTPHVY67HWS8FKY4N419M.PNG')) ? asset('storage/01M2NXTPHVY67HWS8FKY4N419M.PNG') : asset('storage/vicz-journey-media.jpg'),
                'desc' => app()->getLocale() === 'en'
                    ? 'We engineer lightning-fast digital experiences with interactive animations, scalable architecture, and pixel-perfect attention to detail.'
                    : 'Desenvolvemos experiências digitais ultra-rápidas com animações interativas, arquitetura escalável e atenção meticulosa aos detalhes.'
            ],
        ];
    @endphp

    @foreach($steps as $index => $step)
        <div class="journey-card h-screen w-full {{ $step['bg'] }} {{ $step['text'] }} {{ $step['shadow'] }} flex items-center justify-center relative overflow-hidden"
             style="z-index: {{ $step['zIndex'] }};"
             data-journey-card="{{ $index }}">
            
            <!-- Background Infinite Marquee (Slow & Subtle) -->
            <div class="absolute top-[8%] lg:top-[12%] left-0 w-full overflow-hidden pointer-events-none select-none z-0">
                <div class="animate-vicz-marquee {{ $step['marqueeColor'] }} opacity-20 whitespace-nowrap font-display font-bold text-[clamp(4.5rem,13vw,11.5rem)] uppercase leading-none tracking-tight">
                    <span>{{ $marqueeText }} &nbsp;—&nbsp; {{ $marqueeText }} &nbsp;—&nbsp; {{ $marqueeText }} &nbsp;—&nbsp; {{ $marqueeText }} &nbsp;—&nbsp;</span>
                    <span>{{ $marqueeText }} &nbsp;—&nbsp; {{ $marqueeText }} &nbsp;—&nbsp; {{ $marqueeText }} &nbsp;—&nbsp; {{ $marqueeText }} &nbsp;—&nbsp;</span>
                </div>
            </div>

            <!-- Foreground Content (Penpot exact 893x607 media + 364px text) -->
            <div class="relative z-10 w-full site-container py-8 flex flex-col lg:flex-row items-center justify-between gap-8 lg:gap-[var(--site-gutter)]">
                <!-- Media Left (893x607) -->
                <div class="w-full lg:w-[66.15%] max-w-[55.8125rem] aspect-[893/607] rounded-[4px] overflow-hidden bg-[#222222] shadow-2xl relative flex-shrink-0">
                    <img src="{{ $step['media'] }}"
                         alt="{{ $step['step'] }}"
                         class="w-full h-full object-cover">
                </div>

                <!-- Text Right (364px) -->
                <div class="w-full lg:w-[27%] max-w-[22.75rem] flex flex-col justify-center space-y-4 lg:space-y-6">
                    <span class="font-display font-bold text-4xl sm:text-5xl lg:text-[3.625rem] leading-none uppercase">
                        {{ $step['step'] }}
                    </span>
                    <p class="font-sans font-normal text-lg sm:text-xl lg:text-[1.75rem] leading-[1.25]">
                        {{ $step['desc'] }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</section>

<script>
(function() {
    function initJourneyStack() {
        const cards = document.querySelectorAll('.journey-card');
        if (!cards.length) return;

        const gsap = window.gsap;
        const ScrollTrigger = window.ScrollTrigger;
        if (!gsap || !ScrollTrigger) return;

        // Apply GSAP ScrollTrigger pinning for the stacking card effect (coderesolution style)
        cards.forEach((card, i) => {
            // Pin all except the last one (last one scrolls naturally with next section)
            if (i < cards.length - 1) {
                ScrollTrigger.create({
                    trigger: card,
                    start: 'top top',
                    pin: true,
                    pinSpacing: false,
                    anticipatePin: 1
                });
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initJourneyStack);
    } else {
        initJourneyStack();
    }
})();
</script>
