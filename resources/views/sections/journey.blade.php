<section id="jornada" class="journey-section lg:h-screen lg:h-[100dvh] lg:max-h-[100dvh] lg:overflow-hidden bg-[#101010] text-[#ddddd5] relative border-t border-white/10 flex flex-col justify-between py-6 sm:py-8 w-full">
    <!-- Header Block (Compact & crisp, contained in viewport) -->
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)] flex-shrink-0 mb-4 sm:mb-6">
        <div class="flex flex-col md:flex-row md:items-baseline justify-between gap-4 pb-4 border-b border-white/15">
            <div>
                <h2 class="norra-reveal font-display font-bold text-[clamp(2rem,4.5vw,4.25rem)] leading-none uppercase tracking-tight text-[#ddddd5]">
                    JORNADA DO PROJETO
                </h2>
                <p class="norra-reveal font-sans text-sm sm:text-base text-[#999999] mt-2 max-w-2xl font-normal">
                    {{ $settings['journey_subtitle'] ?? 'Nosso método estruturado elimina ruídos e garante entregas pontuais, transparentes e com acabamento de excelência.' }}
                </p>
            </div>
            
            <div class="hidden lg:flex items-center gap-3 text-xs uppercase tracking-widest text-[#888888] font-mono flex-shrink-0">
                <span>(SCROLL HORIZONTAL)</span>
                <svg width="24" height="10" viewBox="0 0 24 10" fill="none" class="stroke-current stroke-2">
                    <path d="M0 5H22M22 5L17 1M22 5L17 9" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Desktop GSAP Pinned Horizontal Track (lg+) - 100vw each stage, contained vertically -->
    <div class="journey-horizontal-container hidden lg:flex flex-1 items-center min-h-0 w-full overflow-hidden">
        <div class="journey-track flex flex-nowrap items-stretch h-full">
            @foreach($journeySteps as $step)
                @php
                    $stepImage = ($loop->first && file_exists(public_path('storage/journey-stage-1.jpg')))
                        ? asset('storage/journey-stage-1.jpg')
                        : ($step->image_path ? asset('storage/' . $step->image_path) : asset('storage/journey-stage-1.jpg'));
                @endphp
                <div class="journey-slide w-screen min-w-[100vw] h-full flex items-center px-[clamp(1.5rem,3.125vw,3.5rem)] flex-shrink-0">
                    <div class="w-full grid grid-cols-12 gap-8 xl:gap-14 items-center my-auto">
                        
                        <!-- Left: Huge Penpot ETAPA Number & Information -->
                        <div class="col-span-5 space-y-4 xl:space-y-6">
                            <div class="space-y-0.5">
                                <span class="font-display font-bold text-6xl xl:text-8xl text-white block leading-none">
                                    {{ str_pad($step->step_num ?? ($step->order_num ?? $loop->iteration), 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="font-display font-bold text-4xl xl:text-6xl text-[#ddddd5] uppercase block leading-none tracking-tight">
                                    ETAPA
                                </span>
                            </div>

                            <div class="space-y-2 pt-2">
                                <h3 class="font-sans font-bold text-xl xl:text-3xl text-white tracking-tight">
                                    {{ $step->title }}
                                </h3>
                                @if($step->subtitle)
                                    <p class="text-xs uppercase tracking-widest text-[#e33702] font-bold">
                                        {{ $step->subtitle }}
                                    </p>
                                @endif
                                <p class="font-sans text-sm xl:text-base text-[#999999] leading-relaxed max-w-lg">
                                    {{ $step->description }}
                                </p>
                            </div>

                            @if(!empty($step->deliverables) && is_array($step->deliverables))
                                <div class="space-y-2 pt-3 border-t border-white/10 max-w-lg">
                                    <span class="text-[11px] uppercase tracking-widest text-[#777777] font-semibold block">O que entregamos nesta fase:</span>
                                    <div class="flex flex-wrap gap-1.5 pt-0.5">
                                        @foreach($step->deliverables as $deliv)
                                            <span class="px-3 py-1 rounded-full text-[11px] bg-white/5 border border-white/10 text-[#ddddd5]">
                                                {{ $deliv }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Right: Massive Panoramic Screen Mockup (Max 4px radius, no zoom hover) -->
                        <div class="col-span-7 flex justify-end">
                            <div class="w-full max-w-[920px] max-h-[48vh] aspect-[964/460] rounded-[4px] overflow-hidden bg-[#151515] border border-white/15 shadow-2xl relative">
                                <img src="{{ $stepImage }}"
                                     alt="{{ $step->title }}"
                                     class="w-full h-full object-cover"
                                     loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-70"></div>
                                <div class="absolute bottom-4 left-6 right-6 flex items-center justify-between text-xs text-white/80">
                                    <span class="font-mono uppercase tracking-widest text-xs">Fase {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} / 04</span>
                                    <span class="px-2.5 py-1 rounded-full bg-black/70 backdrop-blur-md border border-white/10 text-[10px] uppercase font-bold tracking-wider">Metodologia Norra</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Mobile Stack Layout (< lg) -->
    <div class="lg:hidden w-full px-[clamp(1.5rem,3.125vw,3.5rem)] space-y-12 mt-6">
        @foreach($journeySteps as $step)
            @php
                $stepImage = ($loop->first && file_exists(public_path('storage/journey-stage-1.jpg')))
                    ? asset('storage/journey-stage-1.jpg')
                    : ($step->image_path ? asset('storage/' . $step->image_path) : asset('storage/journey-stage-1.jpg'));
            @endphp
            <div class="border-t border-white/15 pt-6 space-y-4">
                <div class="flex items-baseline gap-3">
                    <span class="font-display font-bold text-5xl text-white">
                        {{ str_pad($step->step_num ?? ($step->order_num ?? $loop->iteration), 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <span class="font-display font-bold text-3xl text-[#ddddd5] uppercase tracking-tight">
                        ETAPA
                    </span>
                </div>

                <div class="rounded-[4px] overflow-hidden aspect-[16/10] bg-[#151515] border border-white/15 shadow-lg">
                    <img src="{{ $stepImage }}"
                         alt="{{ $step->title }}"
                         class="w-full h-full object-cover"
                         loading="lazy">
                </div>

                <div class="space-y-2">
                    <h3 class="font-sans font-bold text-xl text-white">
                        {{ $step->title }}
                    </h3>
                    <p class="font-sans text-xs text-[#999999] leading-relaxed">
                        {{ $step->description }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</section>


