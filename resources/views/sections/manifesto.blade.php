<section id="manifesto" class="py-24 sm:py-32 md:py-40 bg-[#151515] relative text-[#ddddd5] w-full overflow-hidden">
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)]">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 lg:gap-16 items-start">

            <!-- Left Column: Vertical Loading Bar + Stat Block & Nav Arrows (Desktop/Tablet) / Horizontal Loading Bar + Stat Left & Arrows Right (Mobile) -->
            <div class="md:col-span-5 lg:col-span-4 flex flex-col md:flex-row items-start gap-5 md:gap-4 order-2 md:order-1 pt-0.5 w-full">
                <!-- Progress Line: Horizontal on mobile (full width), Vertical on desktop & tablet (320px) -->
                <div class="manifesto-progress-track relative w-full h-[1.5px] md:w-[1.5px] md:h-[320px] bg-[#ddddd5]/20 flex-shrink-0 overflow-hidden"
                     title="Carregamento da próxima informação">
                    <div id="manifesto-progress-fill"
                         class="manifesto-progress-fill absolute top-0 left-0 w-0 h-full md:w-full md:h-0 bg-[#b60e0e] origin-left md:origin-top will-change-transform"
                         style="box-shadow: 0 0 8px rgba(182, 14, 14, 0.7);"></div>
                </div>

                <!-- Subcolumn/Row: Stat on left + Arrows on right on mobile (top-aligned); Vertical 320px frame on desktop & tablet -->
                <div class="flex flex-row items-start justify-between w-full md:flex-col md:items-start md:justify-between md:h-[320px] md:w-auto min-w-0">
                    <!-- Metric Stat Block: Left side on mobile, Top on desktop & tablet -->
                    <div id="manifesto-stat-block"
                         class="group cursor-pointer transition-all duration-300 select-none"
                         data-stats='[{"num":"1k+","label":"designs entregues"},{"num":"98%","label":"satisfação comprovada"},{"num":"10+","label":"anos de excelência"}]'
                         data-index="0"
                         onclick="window.cycleManifestoStatNext()"
                         title="Clique para avançar estatística">
                        <span id="manifesto-stat-num" class="font-display font-bold text-5xl sm:text-[50px] text-[#ddddd5] tracking-[-0.5px] sm:tracking-[-1px] leading-[1.2] block transition-colors duration-300">
                            {{ $settings['manifesto_metric_number'] ?? '1k+' }}
                        </span>
                        <span id="manifesto-stat-label" class="font-sans font-normal text-base sm:text-[18px] text-[#ddddd5] tracking-normal sm:tracking-[-0.5px] lg:tracking-[-1px] leading-[1.2] block mt-1 transition-colors duration-300">
                            {{ $settings['manifesto_metric_label'] ?? 'designs entregues' }}
                        </span>
                    </div>

                    <!-- Directional Indicator Arrows: Horizontal on mobile (right side), Vertical on desktop & tablet (bottom of 320px frame, static left-aligned) -->
                    <div class="flex flex-row items-center gap-2 sm:gap-3 md:flex-col md:items-start md:gap-[9px] md:pb-1 flex-shrink-0">
                        <!-- Prev Arrow Button: Left arrow on mobile, Up arrow on desktop & tablet -->
                        <button type="button"
                                id="manifesto-arrow-prev"
                                onclick="window.cycleManifestoStatPrev()"
                                aria-label="Estatística anterior"
                                class="manifesto-nav-arrow flex items-center justify-center md:justify-start w-8 h-8 md:w-5 md:h-5 text-[#ddddd5]/50 hover:text-[#ddddd5] transition-colors focus:outline-none group">
                            <!-- Desktop/Tablet: Up Arrow -->
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="hidden md:block transition-transform group-hover:-translate-y-0.5">
                                <path d="M5 9V1M5 1L1 5M5 1L9 5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <!-- Mobile: Left Arrow -->
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="md:hidden transition-transform group-hover:-translate-x-0.5">
                                <path d="M9 5H1M1 5L5 1M1 5L5 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <!-- Next Arrow Button: Right arrow on mobile, Down arrow on desktop & tablet -->
                        <button type="button"
                                id="manifesto-arrow-next"
                                onclick="window.cycleManifestoStatNext()"
                                aria-label="Próxima estatística"
                                class="manifesto-nav-arrow flex items-center justify-center md:justify-start w-8 h-8 md:w-5 md:h-5 text-[#ddddd5]/50 hover:text-[#ddddd5] transition-colors focus:outline-none group">
                            <!-- Desktop/Tablet: Down Arrow -->
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="hidden md:block transition-transform group-hover:translate-y-0.5">
                                <path d="M5 1V9M5 9L1 5M5 9L9 5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <!-- Mobile: Right Arrow -->
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="md:hidden transition-transform group-hover:translate-x-0.5">
                                <path d="M1 5H9M9 5L5 1M9 5L5 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Big Manifesto Statement & Studio Signature with Nog 3D split text -->
            <div class="md:col-span-7 lg:col-span-8 order-1 md:order-2 flex flex-col items-start lg:items-end">
                <div class="space-y-8 sm:space-y-10 max-w-[774px] w-full lg:mr-16 xl:mr-24">
                    <h2 data-split class="font-sans font-bold text-[clamp(1.75rem,3.47vw,3.125rem)] leading-[1.1] text-[#ddddd5] tracking-[-0.5px] sm:tracking-[-0.75px] lg:tracking-[-1px] hyphens-none">
                        Entendemos que grandes<br class="hidden sm:inline" />
                        fundadores merecem uma<br class="hidden sm:inline" />
                        presença digital a altura do<br class="hidden sm:inline" />
                        que estão construindo.
                    </h2>

                    <p data-split class="font-sans font-bold text-[clamp(1.75rem,3.47vw,3.125rem)] leading-[1.1] text-[#ddddd5] tracking-[-0.5px] sm:tracking-[-0.75px] lg:tracking-[-1px]">
                        {{ $settings['manifesto_p1'] ?? 'Muitas empresas desenvolveram marcas incríveis, mas seu website não reflete isso ainda.' }}
                    </p>

                    <!-- Studio Norra Signature with High-Contrast Monogram (aligned with text block) -->
                    <div class="flex items-center gap-4 pt-2 sm:pt-4 norra-reveal">
                        <div class="w-12 h-12 rounded-full bg-[#ddddd5] flex items-center justify-center p-2 shadow-sm text-[#101010]">
                            <x-logo-monogram class="w-full h-full object-contain" />
                        </div>
                        <span class="font-sans font-normal text-xl sm:text-[23.73px] text-[#ddddd5] tracking-normal leading-[1.2]">
                            Estúdio Norra
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

