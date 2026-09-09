<section id="hero" class="relative pt-32 pb-20 md:pt-44 md:pb-32 overflow-hidden bg-[#101010]">
    <!-- Ambient Red Gradient Glow in Background -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#b70606]/15 rounded-full blur-[140px] pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Top Metadata / Badge -->
        <div class="flex items-center gap-3 mb-6">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#151515] border border-white/10 text-xs font-medium text-[#ddddd5]">
                <span class="w-2 h-2 rounded-full bg-[#25d366] animate-pulse"></span>
                <span>{{ $settings['hero_badge_number'] ?? '30+' }} {{ $settings['hero_badge_label'] ?? 'marcas ajudadas' }}</span>
            </span>
            <span class="text-xs uppercase tracking-widest text-[#888888] font-semibold hidden sm:inline-block">
                Design & Engenharia Digital
            </span>
        </div>

        <!-- Main Headline -->
        <div class="max-w-5xl">
            <h1 class="font-display font-extrabold text-[clamp(2.25rem,6vw,4.75rem)] leading-[1.05] tracking-tight text-white">
                {{ $settings['hero_title'] ?? 'Criamos experiências que tornam a sua marca irresistível' }}
            </h1>
        </div>

        <!-- Subtitle & CTA Row -->
        <div class="mt-8 flex flex-col md:flex-row md:items-center justify-between gap-8 max-w-5xl">
            <p class="text-base sm:text-lg lg:text-xl text-[#999999] max-w-2xl font-normal leading-relaxed">
                {{ $settings['hero_subtitle'] ?? 'Ajudamos marcas consolidadas e fundadores exigentes a construir uma presença digital marcante, com estética autoral e tecnologia de alto desempenho.' }}
            </p>

            <div class="flex flex-wrap items-center gap-4 flex-shrink-0">
                <a href="#contato" class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-full bg-[#ddddd5] text-[#101010] font-bold text-xs uppercase tracking-wider hover:bg-white active:scale-95 transition-all duration-200 shadow-xl shadow-black/40">
                    <span>Fale Conosco</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                    </svg>
                </a>
                <a href="#projetos" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full bg-[#151515] border border-white/15 text-white font-semibold text-xs uppercase tracking-wider hover:border-white/40 hover:bg-white/5 transition-all duration-200">
                    <span>Ver Projetos</span>
                    <svg class="w-3.5 h-3.5 text-[#888888]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                </a>
            </div>
        </div>

        <!-- Hero Showcase Mockups (Penpot Staggered 3D Showcase) -->
        <div class="mt-16 md:mt-24 pt-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <!-- Mockup 1: Hub Arquitetura -->
                <div class="group relative rounded-3xl overflow-hidden bg-[#151515] border border-white/10 hover:border-white/30 transition-all duration-500 shadow-2xl">
                    <div class="aspect-[16/10] overflow-hidden bg-[#121212]">
                        <img src="{{ asset('storage/projects/1783454102263-hub.webp') }}"
                             alt="Hub Arquitetura - Estúdio Norra"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                             loading="eager">
                    </div>
                    <div class="p-5 flex items-center justify-between">
                        <div>
                            <span class="text-[11px] uppercase tracking-wider text-[#b70606] font-semibold">Web Site</span>
                            <h3 class="font-display font-bold text-white text-base mt-0.5">Hub Arquitetura</h3>
                        </div>
                        <button type="button"
                                onclick="openProjectModal('Hub Arquitetura', 'Hub Arquitetura', '2026', 'Web Site', 'Website imersivo desenvolvido para a Hub Arquitetura, valorizando espacialidade e fotografia de alta resolução.', '{{ asset('storage/projects/1783454102263-hub.webp') }}', ['Web Design', 'Frontend', 'Arquitetura'])"
                                class="w-9 h-9 rounded-full bg-[#101010] border border-white/10 flex items-center justify-center text-white/70 group-hover:text-white group-hover:bg-[#b70606] transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Mockup 2: Nog Arquitetura -->
                <div class="group relative rounded-3xl overflow-hidden bg-[#151515] border border-white/10 hover:border-white/30 transition-all duration-500 shadow-2xl md:-translate-y-4">
                    <div class="aspect-[16/10] overflow-hidden bg-[#121212]">
                        <img src="{{ asset('storage/projects/1783548230799-NOG-ARQUITETURA.webp') }}"
                             alt="Nog Arquitetura - Estúdio Norra"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                             loading="eager">
                    </div>
                    <div class="p-5 flex items-center justify-between">
                        <div>
                            <span class="text-[11px] uppercase tracking-wider text-[#b70606] font-semibold">Identidade & Web</span>
                            <h3 class="font-display font-bold text-white text-base mt-0.5">Nog Arquitetura</h3>
                        </div>
                        <button type="button"
                                onclick="openProjectModal('Nog Arquitetura', 'Nog Arquitetura', '2026', 'Web Site', 'Plataforma digital com curadoria fotográfica imersiva e estética minimalista contemporânea.', '{{ asset('storage/projects/1783548230799-NOG-ARQUITETURA.webp') }}', ['UI/UX', 'Identidade Visual', 'Performance'])"
                                class="w-9 h-9 rounded-full bg-[#101010] border border-white/10 flex items-center justify-center text-white/70 group-hover:text-white group-hover:bg-[#b70606] transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Mockup 3: Projeto Meta -->
                <div class="group relative rounded-3xl overflow-hidden bg-[#151515] border border-white/10 hover:border-white/30 transition-all duration-500 shadow-2xl">
                    <div class="aspect-[16/10] overflow-hidden bg-[#121212]">
                        <img src="{{ asset('storage/projects/1783538518016-SITE-PROJETO-META.webp') }}"
                             alt="Projeto Meta - Estúdio Norra"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                             loading="eager">
                    </div>
                    <div class="p-5 flex items-center justify-between">
                        <div>
                            <span class="text-[11px] uppercase tracking-wider text-[#b70606] font-semibold">Web Plataforma</span>
                            <h3 class="font-display font-bold text-white text-base mt-0.5">Projeto Meta</h3>
                        </div>
                        <button type="button"
                                onclick="openProjectModal('Projeto Meta', 'Projeto Meta', '2026', 'Web Site', 'Plataforma de engajamento humanitário desenvolvida para uma iniciativa missionária no Quênia.', '{{ asset('storage/projects/1783538518016-SITE-PROJETO-META.webp') }}', ['Web Design', 'Responsivo', 'Social'])"
                                class="w-9 h-9 rounded-full bg-[#101010] border border-white/10 flex items-center justify-center text-white/70 group-hover:text-white group-hover:bg-[#b70606] transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
