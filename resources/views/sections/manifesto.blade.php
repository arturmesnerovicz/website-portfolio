<section id="manifesto" class="py-24 sm:py-32 md:py-40 bg-[#101010] relative text-[#ddddd5] border-t border-white/10">
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            
            <!-- Left Column: Metric & Sub-navigation / Indicator -->
            <div class="lg:col-span-4 flex flex-col justify-between h-full order-2 lg:order-1 pt-2 norra-reveal">
                <div class="space-y-4">
                    <div class="w-full max-w-[280px] h-px bg-white/20 mb-8 hidden lg:block"></div>
                    <div>
                        <span class="font-display font-bold text-5xl sm:text-6xl text-[#ddddd5] tracking-tight block">
                            {{ $settings['manifesto_metric_number'] ?? '1k+' }}
                        </span>
                        <span class="font-sans text-base sm:text-lg text-[#999999] tracking-normal block mt-2">
                            {{ $settings['manifesto_metric_label'] ?? 'designs entregues' }}
                        </span>
                    </div>
                </div>

                <!-- Minimal Directional Indicator from Penpot -->
                <div class="hidden lg:flex items-center gap-2 text-white/30 pt-28">
                    <svg width="14" height="28" viewBox="0 0 14 28" fill="none" class="stroke-current stroke-2">
                        <path d="M7 2L7 26M7 2L2 7M7 2L12 7M7 26L2 21M7 26L12 21" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <!-- Right Column: Big Manifesto Statement & Studio Signature -->
            <div class="lg:col-span-8 order-1 lg:order-2 space-y-10 lg:space-y-14">
                <div class="space-y-8">
                    <h2 class="font-sans font-normal text-[clamp(1.75rem,3.2vw,3.125rem)] leading-[1.25] text-[#ddddd5] tracking-tight hyphens-none norra-reveal">
                        {{ $settings['manifesto_headline'] ?? 'Entendemos que grandes fundadores merecem uma presença digital a altura do que estão construindo.' }}
                    </h2>

                    <p class="font-sans font-normal text-[clamp(1.5rem,2.8vw,2.75rem)] leading-[1.25] text-[#888888] tracking-tight norra-reveal">
                        {{ $settings['manifesto_p1'] ?? 'Muitas empresas desenvolveram marcas incríveis, mas seu website não reflete isso ainda.' }}
                    </p>
                </div>

                <!-- Studio Norra Signature with Circular Monogram -->
                <div class="flex items-center gap-4 pt-4 norra-reveal">
                    <div class="w-12 h-12 rounded-full bg-[#151515] border border-white/15 flex items-center justify-center p-2.5 shadow-sm">
                        <img src="{{ asset('assets/logos/logo-monogram.svg') }}" alt="Estúdio Norra" class="w-full h-full object-contain" />
                    </div>
                    <span class="font-sans font-normal text-xl sm:text-2xl text-[#ddddd5] tracking-tight">
                        Estúdio Norra
                    </span>
                </div>
            </div>

        </div>
    </div>
</section>

