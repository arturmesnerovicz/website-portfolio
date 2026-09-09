<section id="jornada" class="journey-section py-20 sm:py-28 md:py-36 bg-[#101010] text-[#ddddd5] relative border-t border-white/10 overflow-hidden w-full">
    <!-- Header Block (Pinned in context or scrolled into view) -->
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)] mb-8 sm:mb-12">
        <h2 class="norra-reveal font-display font-bold text-[clamp(2.5rem,6.5vw,6.25rem)] leading-none uppercase tracking-tight text-[#ddddd5]">
            JORNADA DO PROJETO
        </h2>

        <!-- Full-width Divider Line -->
        <div class="w-full h-px bg-white/20 my-8 sm:my-10"></div>

        <!-- Auxiliary Subhead Row -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-12 items-start mb-6">
            <div class="lg:col-span-3 flex items-center gap-3 text-xs uppercase tracking-widest text-[#888888]">
                <span>(SCROLL)</span>
                <svg width="24" height="10" viewBox="0 0 24 10" fill="none" class="stroke-current stroke-2">
                    <path d="M0 5H22M22 5L17 1M22 5L17 9" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="lg:col-span-9">
                <p class="norra-reveal font-sans text-xl sm:text-2xl lg:text-3xl font-normal text-[#999999] leading-snug">
                    {{ $settings['journey_subtitle'] ?? 'Nosso método estruturado elimina ruídos e garante entregas pontuais, transparentes e com acabamento de excelência.' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Desktop GSAP Pinned Horizontal Track (lg+) - 100vw each stage -->
    <div class="journey-horizontal-container hidden lg:block w-full overflow-hidden">
        <div class="journey-track flex flex-nowrap items-stretch">
            @foreach($journeySteps as $step)
                @php
                    $stepImage = ($loop->first && file_exists(public_path('storage/journey-stage-1.jpg')))
                        ? asset('storage/journey-stage-1.jpg')
                        : ($step->image_path ? asset('storage/' . $step->image_path) : asset('storage/journey-stage-1.jpg'));
                @endphp
                <div class="journey-slide w-screen min-w-[100vw] min-h-[720px] lg:h-[80vh] flex items-center px-[clamp(1.5rem,3.125vw,3.5rem)] flex-shrink-0">
                    <div class="w-full grid grid-cols-12 gap-12 xl:gap-16 items-center">
                        
                        <!-- Left: Huge Penpot ETAPA Number & Information -->
                        <div class="col-span-5 space-y-6">
                            <div class="space-y-1">
                                <span class="font-display font-bold text-7xl xl:text-9xl text-white block leading-none">
                                    {{ str_pad($step->step_num ?? ($step->order_num ?? $loop->iteration), 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="font-display font-bold text-5xl xl:text-7xl text-[#ddddd5] uppercase block leading-none tracking-tight">
                                    ETAPA
                                </span>
                            </div>

                            <div class="space-y-3 pt-4">
                                <h3 class="font-sans font-bold text-2xl xl:text-4xl text-white tracking-tight">
                                    {{ $step->title }}
                                </h3>
                                @if($step->subtitle)
                                    <p class="text-xs uppercase tracking-widest text-[#b70606] font-bold">
                                        {{ $step->subtitle }}
                                    </p>
                                @endif
                                <p class="font-sans text-base xl:text-lg text-[#999999] leading-relaxed max-w-xl">
                                    {{ $step->description }}
                                </p>
                            </div>

                            @if(!empty($step->deliverables) && is_array($step->deliverables))
                                <div class="space-y-2 pt-4 border-t border-white/10 max-w-xl">
                                    <span class="text-xs uppercase tracking-widest text-[#777777] font-semibold block">O que entregamos nesta fase:</span>
                                    <div class="flex flex-wrap gap-2 pt-1">
                                        @foreach($step->deliverables as $deliv)
                                            <span class="px-3.5 py-1.5 rounded-full text-xs bg-white/5 border border-white/10 text-[#ddddd5]">
                                                {{ $deliv }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Right: Massive Panoramic Screen Mockup (964x460 aspect ratio) -->
                        <div class="col-span-7 flex justify-end">
                            <div class="w-full max-w-[964px] aspect-[964/460] rounded-2xl overflow-hidden bg-[#151515] border border-white/15 shadow-2xl relative group">
                                <img src="{{ $stepImage }}"
                                     alt="{{ $step->title }}"
                                     class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-700 ease-out"
                                     loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-60"></div>
                                <div class="absolute bottom-6 left-8 right-8 flex items-center justify-between text-xs text-white/80">
                                    <span class="font-mono uppercase tracking-widest text-sm">Fase {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} / 04</span>
                                    <span class="px-3 py-1.5 rounded-full bg-black/70 backdrop-blur-md border border-white/10 text-[11px] uppercase font-bold tracking-wider">Metodologia Norra</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Mobile Stack Layout (< lg) -->
    <div class="lg:hidden w-full px-[clamp(1.5rem,3.125vw,3.5rem)] space-y-16 mt-8">
        @foreach($journeySteps as $step)
            @php
                $stepImage = ($loop->first && file_exists(public_path('storage/journey-stage-1.jpg')))
                    ? asset('storage/journey-stage-1.jpg')
                    : ($step->image_path ? asset('storage/' . $step->image_path) : asset('storage/journey-stage-1.jpg'));
            @endphp
            <div class="border-t border-white/15 pt-8 space-y-6">
                <div class="flex items-baseline gap-4">
                    <span class="font-display font-bold text-6xl text-white">
                        {{ str_pad($step->step_num ?? ($step->order_num ?? $loop->iteration), 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <span class="font-display font-bold text-4xl text-[#ddddd5] uppercase tracking-tight">
                        ETAPA
                    </span>
                </div>

                <div class="rounded-2xl overflow-hidden aspect-[16/10] bg-[#151515] border border-white/15 shadow-lg">
                    <img src="{{ $stepImage }}"
                         alt="{{ $step->title }}"
                         class="w-full h-full object-cover"
                         loading="lazy">
                </div>

                <div class="space-y-3">
                    <h3 class="font-sans font-bold text-2xl text-white">
                        {{ $step->title }}
                    </h3>
                    <p class="font-sans text-sm text-[#999999] leading-relaxed">
                        {{ $step->description }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</section>


