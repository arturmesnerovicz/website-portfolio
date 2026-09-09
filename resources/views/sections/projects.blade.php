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
        <div class="space-y-16 sm:space-y-24">
            @foreach($projects->take(2) as $index => $project)
                <article class="group">
                    <!-- Top Divider Line with Arrow Indicator -->
                    <div class="w-full flex items-center justify-between pb-6 border-b border-[#101010]/20 mb-8 sm:mb-12">
                        <span class="text-xs sm:text-sm font-mono text-[#101010]/60 uppercase tracking-widest">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} / {{ $project->category ?? 'Design & Dev' }}
                        </span>
                        
                        <!-- Row Arrow -->
                        <button type="button"
                                aria-label="Ver detalhes de {{ $project->title }}"
                                onclick="openProjectModal('{{ addslashes($project->title) }}', '{{ addslashes($project->client ?? '') }}', '{{ $project->year ?? '' }}', '{{ addslashes($project->category) }}', '{{ addslashes($project->full_description ?? $project->short_description) }}', '{{ asset('storage/' . $project->cover_image) }}', [])"
                                class="text-[#101010] group-hover:translate-x-2 transition-transform duration-300 focus:outline-none">
                            <svg width="32" height="12" viewBox="0 0 32 12" fill="none" class="stroke-current stroke-2">
                                <path d="M0 6H30M30 6L25 1M30 6L25 11" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Row Content: Left Image (Penpot exact 778x470 / ~54vw), Right Info (Top-aligned) -->
                    <div class="flex flex-col lg:flex-row items-start justify-between gap-8 lg:gap-14">
                        <!-- Project Image: Massive 54vw representation matching Penpot 778x470 -->
                        <div class="w-full lg:w-[54vw] max-w-[850px] aspect-[778/470] overflow-hidden rounded-2xl bg-[#cecec5] cursor-pointer relative shadow-sm group-hover:shadow-md transition-shadow flex-shrink-0"
                             onclick="openProjectModal('{{ addslashes($project->title) }}', '{{ addslashes($project->client ?? '') }}', '{{ $project->year ?? '' }}', '{{ addslashes($project->category) }}', '{{ addslashes($project->full_description ?? $project->short_description) }}', '{{ asset('storage/' . $project->cover_image) }}', [])">
                            <img src="{{ asset('storage/' . $project->cover_image) }}"
                                 alt="{{ $project->title }}"
                                 class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-700 ease-out"
                                 loading="lazy">
                        </div>

                        <!-- Project Details: Top-aligned, matching Penpot text block (x=861, w=440) -->
                        <div class="w-full lg:flex-1 max-w-[500px] space-y-4 pt-2">
                            <h3 class="font-sans font-bold text-2xl sm:text-3xl lg:text-[32px] text-[#101010] tracking-tight cursor-pointer group-hover:text-[#b70606] transition-colors leading-tight"
                                onclick="openProjectModal('{{ addslashes($project->title) }}', '{{ addslashes($project->client ?? '') }}', '{{ $project->year ?? '' }}', '{{ addslashes($project->category) }}', '{{ addslashes($project->full_description ?? $project->short_description) }}', '{{ asset('storage/' . $project->cover_image) }}', [])">
                                {{ $project->title }}
                            </h3>

                            <p class="font-sans font-normal text-base sm:text-lg text-[#101010]/75 leading-relaxed">
                                {{ $project->short_description }}
                            </p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Bottom Link: 'Veja todos os projetos' matching Penpot -->
        <div class="mt-20 sm:mt-28 pt-8 border-t border-[#101010]/20">
            <a href="#contato"
               class="group flex items-center justify-between py-4 text-[#101010] hover:text-[#b70606] transition-colors">
                <span class="font-sans font-normal text-[clamp(1.75rem,3.2vw,3rem)] tracking-tight">
                    Veja todos os projetos
                </span>
                <span class="text-[#101010] group-hover:translate-x-3 group-hover:text-[#b70606] transition-all duration-300">
                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" class="stroke-current stroke-2">
                        <path d="M0 9.5H47M47 9.5L38 2M47 9.5L38 17" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>

    </div>
</section>


