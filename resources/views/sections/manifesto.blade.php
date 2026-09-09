<section id="manifesto" class="py-24 sm:py-32 md:py-40 bg-[#101010] relative text-[#ddddd5] border-t border-white/10">
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            
            <!-- Left Column: Metric & Dynamic Interactive Light-Pulse Bar & Arrow -->
            <div class="lg:col-span-4 flex flex-col items-start order-2 lg:order-1 pt-2">
                <div class="space-y-4">
                    <div class="w-full max-w-[280px] h-px bg-white/20 mb-8 hidden lg:block"></div>
                    <div id="manifesto-stat-block"
                         class="group cursor-pointer transition-all duration-500 hover:translate-x-1"
                         data-stats='[{"num":"1k+","label":"designs entregues"},{"num":"98%","label":"satisfação comprovada"},{"num":"10+","label":"anos de excelência"}]'
                         data-index="0"
                         onclick="cycleManifestoStat()"
                         title="Clique para alternar estatísticas">
                        <span id="manifesto-stat-num" class="font-display font-bold text-5xl sm:text-6xl text-[#ddddd5] group-hover:text-white tracking-tight block transition-all duration-300">
                            {{ $settings['manifesto_metric_number'] ?? '1k+' }}
                        </span>
                        <span id="manifesto-stat-label" class="font-sans text-base sm:text-lg text-[#999999] group-hover:text-[#ddddd5] tracking-normal block mt-2 transition-all duration-300">
                            {{ $settings['manifesto_metric_label'] ?? 'designs entregues' }}
                        </span>
                    </div>
                </div>

                <!-- Ultra-thin vertical bar with interactive dynamic travelling gradient beam -->
                <div class="relative w-[2px] h-40 sm:h-52 md:h-60 bg-white/10 my-6 overflow-hidden ml-3 rounded-full">
                    <div class="manifesto-beam absolute -top-24 left-0 w-full h-24 bg-gradient-to-b from-transparent via-[#e33702] to-transparent shadow-[0_0_10px_#e33702]"></div>
                </div>

                <!-- Directional Indicator from Penpot with swap interaction -->
                <button type="button"
                        id="manifesto-arrow-btn"
                        onclick="cycleManifestoStat()"
                        aria-label="Alternar estatística e rolar"
                        class="flex items-center gap-2 text-white/40 hover:text-[#e33702] transition-colors ml-1 focus:outline-none group">
                    <svg width="14" height="28" viewBox="0 0 14 28" fill="none" class="stroke-current stroke-2 group-hover:translate-y-1 transition-transform">
                        <path d="M7 2L7 26M7 2L2 7M7 2L12 7M7 26L2 21M7 26L12 21" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <!-- Right Column: Big Manifesto Statement & Studio Signature with Nog 3D split text -->
            <div class="lg:col-span-8 order-1 lg:order-2 space-y-10 lg:space-y-14">
                <div class="space-y-8">
                    <h2 data-split class="font-sans font-normal text-[clamp(1.75rem,3.2vw,3.125rem)] leading-[1.25] text-[#ddddd5] tracking-tight hyphens-none">
                        {{ $settings['manifesto_headline'] ?? 'Entendemos que grandes fundadores merecem uma presença digital a altura do que estão construindo.' }}
                    </h2>

                    <p data-split class="font-sans font-normal text-[clamp(1.5rem,2.8vw,2.75rem)] leading-[1.25] text-[#888888] tracking-tight">
                        {{ $settings['manifesto_p1'] ?? 'Muitas empresas desenvolveram marcas incríveis, mas seu website não reflete isso ainda.' }}
                    </p>
                </div>

                <!-- Studio Norra Signature with High-Contrast Monogram -->
                <div class="flex items-center gap-4 pt-4 norra-reveal">
                    <div class="w-12 h-12 rounded-full bg-[#151515] border border-white/15 flex items-center justify-center p-2.5 shadow-sm text-[#ddddd5]">
                        <x-logo-monogram class="w-full h-full object-contain" />
                    </div>
                    <span class="font-sans font-normal text-xl sm:text-2xl text-[#ddddd5] tracking-tight">
                        Estúdio Norra
                    </span>
                </div>
            </div>

        </div>
    </div>
</section>

