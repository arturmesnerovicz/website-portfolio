<section id="manifesto" class="py-24 md:py-36 bg-[#101010] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-[#151515] border border-white/10 p-8 sm:p-12 lg:p-16 relative overflow-hidden">
            <!-- Background Glow -->
            <div class="absolute -top-32 -right-32 w-96 h-96 bg-[#b70606]/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left: Headline and Body -->
                <div class="lg:col-span-8 space-y-6">
                    <div class="inline-flex items-center gap-2 text-xs uppercase tracking-widest text-[#b70606] font-bold">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#b70606]"></span>
                        <span>Manifesto & Essência</span>
                    </div>

                    <h2 class="font-display font-extrabold text-[clamp(1.75rem,3.5vw,3rem)] leading-[1.15] text-white tracking-tight">
                        {{ $settings['manifesto_headline'] ?? 'Entendemos que grandes fundadores merecem uma presença digital à altura do que estão construindo.' }}
                    </h2>

                    <p class="text-base sm:text-lg text-[#999999] leading-relaxed max-w-2xl font-normal">
                        {{ $settings['manifesto_p1'] ?? 'Surgimos do incômodo com soluções genéricas e designs previsíveis. Acreditamos que estética refinada e engenharia rigorosa não se excluem: juntas, geram valor duradouro e aceleram o crescimento de marcas memoráveis.' }}
                    </p>

                    <!-- Core Pillars / Values -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-6 border-t border-white/10">
                        <div>
                            <p class="font-display font-bold text-white text-lg">01</p>
                            <p class="font-semibold text-sm text-[#ddddd5] mt-1">Estética Autoral</p>
                            <p class="text-xs text-[#888888] mt-1">Design exclusivo livre de templates genéricos.</p>
                        </div>
                        <div>
                            <p class="font-display font-bold text-white text-lg">02</p>
                            <p class="font-semibold text-sm text-[#ddddd5] mt-1">Engenharia Limpa</p>
                            <p class="text-xs text-[#888888] mt-1">Arquitetura moderna com Tailwind & Laravel.</p>
                        </div>
                        <div>
                            <p class="font-display font-bold text-white text-lg">03</p>
                            <p class="font-semibold text-sm text-[#ddddd5] mt-1">Alta Performance</p>
                            <p class="text-xs text-[#888888] mt-1">Velocidade, SEO e autonomia no painel Filament.</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Rotating Seal & Big Metric Badge -->
                <div class="lg:col-span-4 flex flex-col items-center justify-center space-y-8 lg:border-l lg:border-white/10 lg:pl-12">
                    <!-- Rotating Circular Norra Badge -->
                    <div class="relative w-40 h-40 flex items-center justify-center">
                        <svg class="w-full h-full animate-spin-slow text-[#ddddd5]" viewBox="0 0 100 100">
                            <path id="circlePath" fill="none" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0"/>
                            <text class="text-[8.5px] uppercase tracking-widest fill-current font-bold">
                                <textPath xlink:href="#circlePath">
                                    • ESTÚDIO NORRA • DESIGN & TECNOLOGIA
                                </textPath>
                            </text>
                        </svg>
                        <div class="absolute w-14 h-14 rounded-full bg-[#101010] border border-white/20 flex items-center justify-center shadow-lg">
                            <span class="font-display font-extrabold text-[#b70606] text-xl">N</span>
                        </div>
                    </div>

                    <!-- Metric Box -->
                    <div class="text-center bg-[#101010] border border-white/10 rounded-2xl p-6 w-full max-w-xs shadow-xl">
                        <p class="font-display font-extrabold text-4xl sm:text-5xl text-white tracking-tight">
                            {{ $settings['manifesto_metric_number'] ?? '1k+' }}
                        </p>
                        <p class="text-xs uppercase tracking-wider text-[#888888] font-semibold mt-2">
                            {{ $settings['manifesto_metric_label'] ?? 'designs entregues' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
