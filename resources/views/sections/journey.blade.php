<section id="jornada" class="journey-section lg:h-screen lg:h-[100dvh] lg:max-h-[100dvh] lg:overflow-hidden bg-[#101010] text-[#ddddd5] relative flex flex-col justify-start pt-24 sm:pt-28 pb-6 sm:pb-8 lg:pb-0 w-full">
    <!-- Header Block Matching Penpot 'seção jornada' -->
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)] flex-shrink-0">
        <h2 class="font-display font-bold text-[clamp(2rem,6.94vw,6.25rem)] leading-none uppercase tracking-[-6px] text-[#ddddd5] text-center">
            JORNADA DO PROJETO
        </h2>
        <div class="w-full h-[1px] bg-[#ddddd5]/30 mt-4 sm:mt-6"></div>
    </div>

    <!-- Desktop GSAP Pinned Horizontal Track (lg+) - Exactly 3 Stages Centered Horizontally -->
    <div class="journey-horizontal-container hidden lg:flex flex-1 items-center min-h-0 w-full overflow-hidden">
        <div class="journey-track flex flex-nowrap items-stretch h-full gap-36 xl:gap-44 pl-[max(5vw,calc((100vw-1308px)/2))] pr-[max(5vw,calc((100vw-1308px)/2))]">
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
                <div class="journey-stage-item w-[min(1308px,90vw)] h-full flex items-center justify-start flex-shrink-0">
                    <div class="w-full flex items-start justify-start gap-12 xl:gap-14 my-auto">
                        
                        <!-- Left: (SCROLL) & Etapa X Column -->
                        <div class="w-[260px] xl:w-[288px] flex-shrink-0 flex flex-col justify-between self-stretch">
                            <!-- (SCROLL) Indicator (Stage 1 only) -->
                            @if($loop->first)
                                <div class="flex items-center gap-2 font-sans text-[13px] font-normal tracking-[-1px] text-[#ddddd5]/70 h-[24px]">
                                    <span>(SCROLL)</span>
                                    <svg width="18" height="10" viewBox="0 0 24 10" fill="none" class="stroke-current stroke-2">
                                        <path d="M0 5H22M22 5L17 1M22 5L17 9" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            @else
                                <div class="h-[24px]"></div>
                            @endif

                            <!-- "0X ETAPA" Stacked at Bottom aligned with image bottom -->
                            <div class="space-y-0 select-none translate-y-[5px]">
                                <span class="font-display font-bold text-[clamp(3.5rem,6.94vw,6.25rem)] text-[#ddddd5] block leading-[0.88] tracking-[-1px]">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="font-display font-bold text-[clamp(3.5rem,6.94vw,6.25rem)] text-[#ddddd5] uppercase block leading-[0.88] tracking-[-1px]">
                                    ETAPA
                                </span>
                            </div>
                        </div>

                        <!-- Right: Stage Description above Video/Image Container -->
                        <div class="w-full max-w-[964px] flex-shrink-0 flex flex-col justify-start">
                            <!-- Descriptive Text corresponding to stage -->
                            <p class="journey-desc-text font-sans font-normal text-[clamp(1.125rem,2.5vw,2.375rem)] leading-[1.2] tracking-[-2px] text-[#ddddd5] max-w-[964px]">
                                {{ $step->description }}
                            </p>

                            <!-- Media Container (Clean, no overlays, no border, no text on top) -->
                            <div class="journey-media-container w-full max-w-[964px] aspect-[964/460] max-h-[clamp(260px,38vh,380px)] mt-3 sm:mt-4 rounded-[4px] overflow-hidden bg-[#151515] relative shadow-2xl">
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
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Mobile Stack Layout (< lg) - Exactly 3 Stages -->
    <div class="lg:hidden w-full px-[clamp(1.5rem,3.125vw,3.5rem)] space-y-12 my-8">
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
            <div class="border-t border-[#ddddd5]/20 pt-6 space-y-4">
                <div class="flex items-baseline gap-3">
                    <span class="font-display font-bold text-4xl sm:text-5xl text-[#ddddd5] tracking-[-1px] leading-none">
                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <span class="font-display font-bold text-2xl sm:text-3xl text-[#ddddd5] uppercase tracking-[-1px] leading-none">
                        ETAPA
                    </span>
                </div>

                <p class="font-sans font-normal text-sm sm:text-base text-[#ddddd5]/90 tracking-[-1px] leading-[1.2]">
                    {{ $step->description }}
                </p>

                <div class="journey-media-container w-full aspect-[16/10] rounded-[4px] overflow-hidden bg-[#151515] shadow-lg">
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
            </div>
        @endforeach
    </div>
</section>
