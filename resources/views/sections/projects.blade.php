<section id="projetos" class="py-24 md:py-36 bg-[#ddddd5] text-[#101010] relative transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div class="space-y-3 max-w-2xl">
                <div class="inline-flex items-center gap-2 text-xs uppercase tracking-widest text-[#b70606] font-bold">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#b70606]"></span>
                    <span>Portfólio em Destaque</span>
                </div>
                <h2 class="font-display font-extrabold text-[clamp(2rem,4.5vw,3.75rem)] leading-none tracking-tight text-[#101010] uppercase">
                    Projetos Selecionados
                </h2>
                <p class="text-sm sm:text-base text-[#101010]/70 leading-relaxed font-normal">
                    Conheça alguns dos trabalhos recentes que desenvolvemos para marcas que valorizam excelência estética, clareza e impacto.
                </p>
            </div>

            <div class="flex-shrink-0">
                <span class="text-xs uppercase tracking-wider font-semibold text-[#101010]/60">
                    {{ $projects->count() }} Casos de Sucesso
                </span>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
            @foreach($projects as $project)
                <div class="group bg-[#f2f2eb] rounded-3xl overflow-hidden border border-[#101010]/10 hover:shadow-2xl hover:border-[#101010]/25 transition-all duration-500 flex flex-col">
                    <!-- Project Image Container -->
                    <div class="relative aspect-[16/10] overflow-hidden bg-[#e5e5dc] cursor-pointer"
                         onclick="openProjectModal('{{ addslashes($project->title) }}', '{{ addslashes($project->client ?? '') }}', '{{ $project->year ?? '' }}', '{{ addslashes($project->category) }}', '{{ addslashes($project->full_description ?? $project->short_description) }}', '{{ asset('storage/' . $project->cover_image) }}', {{ json_encode($project->tags ?? []) }})">
                        <img src="{{ asset('storage/' . $project->cover_image) }}"
                             alt="{{ $project->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                             loading="lazy">

                        <!-- Category Floating Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-[#101010] text-[#ddddd5] shadow-md">
                                {{ $project->category }}
                            </span>
                        </div>
                    </div>

                    <!-- Project Info -->
                    <div class="p-6 sm:p-8 flex-1 flex flex-col justify-between space-y-4">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs text-[#101010]/60 font-semibold uppercase tracking-wider">
                                <span>{{ $project->client ?? 'Cliente Confidencial' }}</span>
                                <span>{{ $project->year ?? '2026' }}</span>
                            </div>
                            <h3 class="font-display font-bold text-xl sm:text-2xl text-[#101010] group-hover:text-[#b70606] transition-colors">
                                {{ $project->title }}
                            </h3>
                            <p class="text-xs sm:text-sm text-[#101010]/80 leading-relaxed font-normal line-clamp-3">
                                {{ $project->short_description }}
                            </p>
                        </div>

                        <!-- Tags & Trigger Button -->
                        <div class="pt-4 border-t border-[#101010]/10 flex items-center justify-between gap-4">
                            <div class="flex flex-wrap gap-1.5">
                                @if(is_array($project->tags))
                                    @foreach(array_slice($project->tags, 0, 3) as $tag)
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-medium bg-[#101010]/5 text-[#101010]/80">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>

                            <button type="button"
                                    onclick="openProjectModal('{{ addslashes($project->title) }}', '{{ addslashes($project->client ?? '') }}', '{{ $project->year ?? '' }}', '{{ addslashes($project->category) }}', '{{ addslashes($project->full_description ?? $project->short_description) }}', '{{ asset('storage/' . $project->cover_image) }}', {{ json_encode($project->tags ?? []) }})"
                                    class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-[#101010] hover:text-[#b70606] transition-colors focus:outline-none flex-shrink-0">
                                <span>Ver Detalhes</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Bottom Link / All Projects Modal or Gallery Trigger -->
        <div class="mt-16 text-center">
            <a href="#contato" class="inline-flex items-center gap-3 px-8 py-4 rounded-full bg-[#101010] text-[#ddddd5] hover:bg-[#b70606] hover:text-white transition-all duration-300 font-bold text-xs uppercase tracking-wider shadow-xl">
                <span>Quer ver o seu projeto aqui? Fale Conosco</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
            </a>
        </div>
    </div>
</section>
