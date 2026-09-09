<section id="projetos" class="py-20 sm:py-28 md:py-36 bg-[#ddddd5] text-[#101010] relative w-full">
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)]">
        
        <!-- Section Title: Penpot exact Alte Haas Grotesk 78px uppercase -->
        <div class="mb-14 sm:mb-20">
            <span class="sr-only">Projetos Selecionados</span>
            <h2 class="norra-reveal font-display font-bold text-[clamp(2.5rem,5.5vw,4.875rem)] leading-none uppercase tracking-tight text-[#101010]">
                PROJETOS SELECIONADOS
            </h2>
        </div>

        <!-- Projects Rows (Exactly 2 Projects Listed on Home) -->
        <div class="space-y-16 sm:space-y-20">
            @foreach($projects->take(2) as $index => $project)
                <article class="group">
                    <!-- Top Divider Line with Arrow Indicator matching Penpot -->
                    <div class="w-full flex items-center justify-between pb-4 border-b border-[#101010]/20 mb-8 sm:mb-10">
                        <div class="w-full"></div>
                        <!-- Row Arrow from Penpot -->
                        <button type="button"
                                aria-label="Ver detalhes de {{ $project->title }}"
                                onclick="openProjectModal('{{ addslashes($project->title) }}', '{{ addslashes($project->client ?? '') }}', '{{ $project->year ?? '' }}', '{{ addslashes($project->category) }}', '{{ addslashes($project->full_description ?? $project->short_description) }}', '{{ asset('storage/' . $project->cover_image) }}', [])"
                                class="text-[#101010] group-hover:translate-x-2 transition-transform duration-300 focus:outline-none flex-shrink-0">
                            <svg width="31" height="12" viewBox="0 0 31 12" fill="none" class="stroke-current stroke-2">
                                <path d="M0 6H29M29 6L21 1M29 6L21 11" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Row Content: Left Image (Penpot 778x470 / ~54vw), Right Info (x=861, w=440) -->
                    <div class="flex flex-col lg:flex-row items-start justify-between gap-8 lg:gap-14 xl:gap-20">
                        <!-- Project Image: Max 4px radius, no zoom on hover -->
                        <div class="w-full lg:w-[54vw] max-w-[778px] aspect-[778/470] overflow-hidden rounded-[4px] bg-[#cecec5] cursor-pointer relative shadow-sm flex-shrink-0"
                             onclick="openProjectModal('{{ addslashes($project->title) }}', '{{ addslashes($project->client ?? '') }}', '{{ $project->year ?? '' }}', '{{ addslashes($project->category) }}', '{{ addslashes($project->full_description ?? $project->short_description) }}', '{{ asset('storage/' . $project->cover_image) }}', [])">
                            <img src="{{ asset('storage/' . $project->cover_image) }}"
                                 alt="{{ $project->title }}"
                                 class="w-full h-full object-cover"
                                 loading="lazy">
                        </div>

                        <!-- Project Details: Top-aligned, max-w-[440px] matching Penpot (x=861, w=440) -->
                        <div class="w-full lg:w-[440px] max-w-[440px] space-y-4 pt-1 sm:pt-2">
                            <h3 class="font-sans font-bold text-2xl sm:text-[28px] text-[#101010] tracking-tight cursor-pointer group-hover:text-[#e33702] transition-colors leading-tight"
                                onclick="openProjectModal('{{ addslashes($project->title) }}', '{{ addslashes($project->client ?? '') }}', '{{ $project->year ?? '' }}', '{{ addslashes($project->category) }}', '{{ addslashes($project->full_description ?? $project->short_description) }}', '{{ asset('storage/' . $project->cover_image) }}', [])">
                                {{ $project->title }}
                            </h3>

                            <p class="font-sans font-normal text-base sm:text-[18px] text-[#101010]/80 leading-relaxed">
                                {{ $project->short_description }}
                            </p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Bottom Link: 'Veja todos os projetos' matching Penpot -->
        <div class="mt-16 sm:mt-24 pt-8 border-t border-[#101010]/20">
            <a href="#contato"
               class="group flex items-center justify-between py-4 text-[#101010] hover:text-[#e33702] transition-colors">
                <span class="font-sans font-normal text-[clamp(1.75rem,3.2vw,3rem)] tracking-tight">
                    Veja todos os projetos
                </span>
                <span class="text-[#101010] group-hover:translate-x-3 group-hover:text-[#e33702] transition-all duration-300">
                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" class="stroke-current stroke-2">
                        <path d="M0 9.5H47M47 9.5L38 2M47 9.5L38 17" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>

    </div>
</section>


