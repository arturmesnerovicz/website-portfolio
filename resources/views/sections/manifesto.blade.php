<section id="manifesto" class="py-24 sm:py-32 md:py-40 bg-[#151515] relative text-[#ddddd5] w-full overflow-hidden">
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

            <!-- Left Column: Vertical Loading Bar + Stat Block & Penpot Nav Arrows Beside It -->
            <div class="lg:col-span-4 flex items-start gap-4 order-2 lg:order-1 pt-0.5">
                <!-- Vertical Progress Line (320px in Penpot) -->
                <div class="manifesto-progress-track relative w-[1.5px] h-[320px] bg-[#ddddd5]/20 flex-shrink-0 overflow-hidden"
                     title="Carregamento da próxima informação">
                    <div id="manifesto-progress-fill"
                         class="manifesto-progress-fill absolute top-0 left-0 w-full bg-[#b60e0e] origin-top will-change-transform"
                         style="height: 0%; box-shadow: 0 0 8px rgba(182, 14, 14, 0.7);"></div>
                </div>

                <!-- Right Subcolumn: Metric Stat Block on top + Separate Directional Arrows at bottom of 320px frame -->
                <div class="flex flex-col justify-between h-[320px] min-w-0">
                    <!-- Metric Stat Block: No horizontal line above, side-by-side with vertical bar -->
                    <div id="manifesto-stat-block"
                         class="group cursor-pointer transition-all duration-300 select-none"
                         data-stats='[{"num":"1k+","label":"designs entregues"},{"num":"98%","label":"satisfação comprovada"},{"num":"10+","label":"anos de excelência"}]'
                         data-index="0"
                         onclick="window.cycleManifestoStatNext()"
                         title="Clique para avançar estatística">
                        <span id="manifesto-stat-num" class="font-display font-bold text-5xl sm:text-[50px] text-[#ddddd5] tracking-[-1px] leading-[1.2] block transition-colors duration-300">
                            {{ $settings['manifesto_metric_number'] ?? '1k+' }}
                        </span>
                        <span id="manifesto-stat-label" class="font-sans font-normal text-base sm:text-[18px] text-[#ddddd5] tracking-[-1px] leading-[1.2] block mt-1 transition-colors duration-300">
                            {{ $settings['manifesto_metric_label'] ?? 'designs entregues' }}
                        </span>
                    </div>

                    <!-- Separate Directional Indicator Arrows (Exact Penpot replica with individual spacing) -->
                    <div class="flex flex-col items-start gap-[9px] pb-1">
                        <!-- Up Arrow Button -->
                        <button type="button"
                                id="manifesto-arrow-prev"
                                onclick="window.cycleManifestoStatPrev()"
                                aria-label="Estatística anterior"
                                class="manifesto-nav-arrow flex items-center justify-center w-5 h-5 text-[#ddddd5]/50 hover:text-[#ddddd5] transition-colors focus:outline-none group">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="transition-transform group-hover:-translate-y-0.5">
                                <path d="M5 9V1M5 1L1 5M5 1L9 5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <!-- Down Arrow Button -->
                        <button type="button"
                                id="manifesto-arrow-next"
                                onclick="window.cycleManifestoStatNext()"
                                aria-label="Próxima estatística"
                                class="manifesto-nav-arrow flex items-center justify-center w-5 h-5 text-[#ddddd5]/50 hover:text-[#ddddd5] transition-colors focus:outline-none group">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="transition-transform group-hover:translate-y-0.5">
                                <path d="M5 1V9M5 9L1 5M5 9L9 5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Big Manifesto Statement & Studio Signature with Nog 3D split text -->
            <div class="lg:col-span-8 order-1 lg:order-2 flex flex-col items-start lg:items-end">
                <div class="space-y-8 sm:space-y-10 max-w-[774px] w-full lg:mr-16 xl:mr-24">
                    <h2 data-split class="font-sans font-bold text-[clamp(1.75rem,3.47vw,3.125rem)] leading-[1.1] text-[#ddddd5] tracking-[-1px] hyphens-none">
                        Entendemos que grandes<br class="hidden sm:inline" />
                        fundadores merecem uma<br class="hidden sm:inline" />
                        presença digital a altura do<br class="hidden sm:inline" />
                        que estão construindo.
                    </h2>

                    <p data-split class="font-sans font-bold text-[clamp(1.75rem,3.47vw,3.125rem)] leading-[1.1] text-[#ddddd5] tracking-[-1px]">
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

