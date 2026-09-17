<section id="jornada" class="journey-section h-[100svh] min-h-[100svh] xl:h-screen xl:max-h-screen overflow-hidden bg-[#101010] text-[#ddddd5] relative flex flex-col justify-between xl:justify-start pt-5 sm:pt-6 md:pt-8 lg:pt-10 xl:pt-28 pb-3 sm:pb-4 md:pb-6 xl:pb-0 w-full">
    <!-- Header Block Matching Penpot 'seção jornada' -->
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)] flex-shrink-0">
        <h2 class="font-display font-bold text-[clamp(1.75rem,6.94vw,6.25rem)] leading-none uppercase tracking-[-1.5px] sm:tracking-[-2.5px] md:tracking-[-4px] lg:tracking-[-5px] xl:tracking-[-6px] text-[#ddddd5] text-center">
            JORNADA DO PROJETO
        </h2>
        <div class="w-full h-[1px] bg-[#ddddd5]/30 mt-2 sm:mt-2.5 md:mt-3.5 xl:mt-6"></div>
    </div>

    <!-- GSAP Pinned Horizontal Track (Mobile, Tablet, Desktop) - Exactly 3 Stages -->
    <div class="journey-horizontal-container flex flex-1 items-center justify-start min-h-0 w-full overflow-hidden py-1 sm:py-2 md:py-3 xl:py-0">
        <div class="journey-track flex flex-nowrap items-stretch h-full gap-20 sm:gap-24 md:gap-28 lg:gap-36 xl:gap-44 px-[6vw] md:px-[6vw] lg:px-[6vw] xl:pl-[max(5vw,calc((100vw-1308px)/2))] xl:pr-[max(5vw,calc((100vw-1308px)/2))]">
            @foreach($journeySteps->take(3) as $step)
                @php
                    $isVideo = ($step->media_type === 'video' && !empty($step->video_path));
                    $videoSrc = null;
                    if ($isVideo) {
                        $videoSrc = (str_starts_with($step->video_path, 'http://') || str_starts_with($step->video_path, 'https://') || str_starts_with($step->video_path, '/'))
                            ? $step->video_path
                            : asset('storage/' . $step->video_path);
                    }
                    $stepImage = ($step->image_path && file_exists(public_path('storage/' . $step->image_path)))
                        ? asset('storage/' . $step->image_path)
                        : (file_exists(public_path('storage/journey-stage-1.jpg'))
                            ? asset('storage/journey-stage-1.jpg')
                            : asset('storage/cta-bg.png'));
                @endphp
                <div class="journey-stage-item w-[88vw] sm:w-[88vw] md:w-[88vw] lg:w-[88vw] xl:w-[min(1308px,90vw)] max-w-[1308px] h-full flex items-center justify-start flex-shrink-0">
                    <div class="w-full flex flex-col xl:flex-row items-stretch xl:items-start justify-center xl:justify-start gap-2.5 sm:gap-3.5 md:gap-4 lg:gap-5 xl:gap-14 my-auto">
                        
                        <!-- Left/Top: (SCROLL) & Etapa X Column (top row on mobile & all tablets, left column on desktop xl+) -->
                        <div class="w-full xl:w-[288px] flex-shrink-0 flex flex-row xl:flex-col justify-between items-baseline xl:items-start xl:self-stretch">
                            <!-- (SCROLL) Indicator (Stage 1 only) -->
                            @if($loop->first)
                                <div class="order-2 xl:order-1 flex items-center gap-1.5 sm:gap-2 font-sans text-[12px] sm:text-[13px] md:text-[14px] lg:text-[15px] font-normal tracking-normal sm:tracking-[-0.5px] lg:tracking-[-1px] text-[#ddddd5]/70 h-[24px]">
                                    <span>(SCROLL)</span>
                                    <svg width="18" height="10" viewBox="0 0 24 10" fill="none" class="stroke-current stroke-2">
                                        <path d="M0 5H22M22 5L17 1M22 5L17 9" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            @else
                                <div class="hidden xl:block h-[24px]"></div>
                            @endif

                            <!-- "0X ETAPA" Stacked at Bottom aligned with image bottom on desktop (xl+), side-by-side on mobile & all tablets -->
                            <div class="order-1 xl:order-2 flex xl:block items-baseline gap-2.5 sm:gap-3 md:gap-4 space-y-0 select-none xl:translate-y-[5px]">
                                <span class="font-display font-bold text-3xl sm:text-4xl md:text-5xl lg:text-[56px] xl:text-[clamp(3.5rem,6.94vw,6.25rem)] text-[#ddddd5] block leading-none xl:leading-[0.88] tracking-[-0.5px] lg:tracking-[-1px]">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="font-display font-bold text-lg sm:text-xl md:text-2xl lg:text-[28px] xl:text-[clamp(3.5rem,6.94vw,6.25rem)] text-[#ddddd5] uppercase block leading-none xl:leading-[0.88] tracking-[-0.5px] lg:tracking-[-1px]">
                                    ETAPA
                                </span>
                            </div>
                        </div>

                        <!-- Right/Body: Stage Description & Video/Image Container -->
                        <div class="w-full flex-1 min-w-0 xl:max-w-[964px] flex flex-col justify-start">
                            <!-- Media Container (order-1 on mobile & all tablets to sit above text, order-2 on desktop xl+) -->
                            <div class="order-1 xl:order-2 journey-media-container w-full h-[clamp(220px,36vh,340px)] sm:h-[clamp(240px,38vh,360px)] md:h-[clamp(280px,40vh,440px)] lg:h-[clamp(320px,44vh,500px)] xl:h-auto xl:aspect-[964/460] xl:max-h-[clamp(260px,38vh,380px)] mt-2.5 sm:mt-3 md:mt-3.5 lg:mt-4 rounded-[4px] overflow-hidden bg-[#151515] relative shadow-2xl">
                                @if($isVideo && $videoSrc)
                                    <video class="journey-stage-video w-full h-full object-cover"
                                           muted
                                           playsinline
                                           loop
                                           preload="metadata"
                                           @if($stepImage) poster="{{ $stepImage }}" @endif>
                                        <source src="{{ $videoSrc }}">
                                    </video>
                                @else
                                    <img src="{{ $stepImage }}"
                                         alt="Etapa {{ $loop->iteration }}"
                                         class="w-full h-full object-cover"
                                         loading="lazy">
                                @endif
                            </div>

                            <!-- Descriptive Text corresponding to stage (order-2 on mobile & all tablets to sit below image, order-1 on desktop xl+) -->
                            <p class="order-2 xl:order-1 journey-desc-text font-sans font-normal text-[19px] sm:text-[20px] md:text-[24px] lg:text-[26px] xl:text-[clamp(1.125rem,2.5vw,2.375rem)] leading-[1.45] sm:leading-[1.5] md:leading-[1.35] lg:leading-[1.3] xl:leading-[1.2] tracking-normal sm:tracking-[-0.3px] md:tracking-[-0.5px] lg:tracking-[-0.75px] xl:tracking-[-2px] text-[#ddddd5] mt-3.5 sm:mt-4 md:mt-5 lg:mt-6 xl:mt-0 max-w-full xl:max-w-[964px]">
                                {{ $step->description }}
                            </p>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
