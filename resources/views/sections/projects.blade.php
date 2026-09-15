<section id="projetos" class="pt-16 sm:pt-20 lg:pt-[4.375vw] pb-4 sm:pb-5 lg:pb-[1.2vw] bg-[#DDDDD5] text-[#101010] relative w-full">
    <div class="w-full px-4 sm:px-6 lg:px-[3.125vw]">

        <!-- Section Title: Penpot exact Alte Haas Grotesk 78px uppercase -->
        <div class="mb-10 sm:mb-14 lg:mb-[3.5vw]">
            <span class="sr-only">Projetos Selecionados</span>
            <h2 class="norra-reveal font-display font-bold text-[clamp(2.5rem,5.5vw,4.875rem)] leading-none uppercase tracking-[-4px] text-[#101010]">
                PROJETOS SELECIONADOS
            </h2>
        </div>

        <!-- Projects Rows (Listed on Home) -->
        <div class="space-y-12 sm:space-y-16 lg:space-y-[3.5vw]">
            @foreach($projects->take(3) as $index => $project)
                @php
                    $externalUrl = !empty($project->link_url) ? $project->link_url : (!empty($project->external_url) ? $project->external_url : '#');
                    $highlightVideo = $project->highlight_video ?? $project->highlightVideo ?? $project->video_url ?? null;
                    $videoSrc = null;
                    if (!empty($highlightVideo)) {
                        $videoSrc = (str_starts_with($highlightVideo, 'http://') || str_starts_with($highlightVideo, 'https://') || str_starts_with($highlightVideo, '/'))
                            ? $highlightVideo
                            : asset('storage/' . $highlightVideo);
                    }
                @endphp
                <article class="project-card group">
                    <a href="{{ $externalUrl }}"
                       @if($externalUrl !== '#') target="_blank" rel="noopener noreferrer" @else onclick="event.preventDefault()" @endif
                       class="block text-inherit no-underline cursor-pointer"
                       aria-label="{{ $project->title }}">

                        <!-- Top Divider Line with Arrow Indicator matching Penpot (arrow placed beside line, not over it) -->
                        <div class="w-full flex items-center gap-2 sm:gap-2.5 lg:gap-[10px] mb-4 sm:mb-5 lg:mb-[18px]">
                            <div class="flex-1 h-[1px] bg-[#a2a1a1]"></div>
                            <!-- Row Arrow from Penpot -->
                            <span class="text-[#101010] group-hover:translate-x-1.5 transition-transform duration-300 ease-out flex-shrink-0 flex items-center">
                                <svg width="31" height="12" viewBox="0 0 31 12" fill="none" class="stroke-current stroke-2 w-[24px] sm:w-[31px] h-auto">
                                    <path d="M0 6H29M29 6L21 1M29 6L21 11" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>

                        <!-- Row Content: Left Image (Penpot 778x470 -> 57.63%), Right Info (x=861, w=440 -> 32.6%, gap 2.74%) -->
                        <div class="flex flex-col lg:flex-row items-start justify-start gap-6 lg:gap-[2.74%]">
                            <!-- Project Media: Max 4px radius, scaled proportionally to Penpot without fixed max-w restriction -->
                            <div class="project-media-container w-full lg:w-[57.63%] aspect-[778/470] overflow-hidden rounded-[4px] bg-[#B1B2B5] relative shadow-sm flex-shrink-0">
                                <img src="{{ asset('storage/' . $project->cover_image) }}"
                                     alt="{{ $project->title }}"
                                     class="project-poster w-full h-full object-cover"
                                     loading="lazy">

                                @if($videoSrc)
                                    <video class="project-highlight-video absolute inset-0 w-full h-full object-cover opacity-0 pointer-events-none transition-opacity duration-300 rounded-[4px]"
                                           muted
                                           playsinline
                                           loop
                                           preload="metadata">
                                        <source src="{{ $videoSrc }}">
                                    </video>
                                @endif
                            </div>

                            <!-- Project Details: Top-aligned, moved close to the image (gap 2.74%), font-weight: bold title -->
                            <div class="w-full lg:w-[32.6%] space-y-3 sm:space-y-4 pt-1 sm:pt-2 lg:pt-[1.6vw]">
                                <h3 class="font-sans font-bold text-2xl sm:text-[26px] lg:text-[28px] text-[#101010] tracking-[-1px] leading-[1.2]">
                                    {{ $project->title }}
                                </h3>

                                <p class="font-sans font-normal text-sm sm:text-base lg:text-[18px] text-[#101010]/80 tracking-[-1px] leading-[1.2]">
                                    {{ $project->short_description }}
                                </p>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>

        <!-- Bottom Link: 'Veja todos os projetos' matching Penpot with font-weight: bold, 48px desktop / 24px mobile, exact 4px line gap and 17px section bottom -->
        <div class="mt-7 sm:mt-8 lg:mt-[2.22vw] border-t border-[#a2a1a1]">
            <a href="#contato"
               class="group flex items-center justify-between pt-1 pb-1 sm:pt-1.5 sm:pb-1.5 lg:pt-[4px] lg:pb-[4px] text-[#101010] hover:text-[var(--color-norra-red)] transition-colors">
                <span class="font-sans font-bold text-[clamp(1.5rem,3.333vw,3rem)] leading-[1.2] tracking-[-2px]">
                    Veja todos os projetos
                </span>
                <span class="text-[#101010] group-hover:translate-x-3 group-hover:text-[var(--color-norra-red)] transition-all duration-300 flex items-center flex-shrink-0">
                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" class="stroke-current stroke-2 sm:stroke-[3] w-[32px] sm:w-[42px] lg:w-[49px] h-auto">
                        <path d="M0 9.5H47M47 9.5L38 2M47 9.5L38 17" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>

    </div>
</section>


