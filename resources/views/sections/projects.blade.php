<section id="projects" class="w-full bg-[#f6f6f6] text-[#101010] pt-12 sm:pt-16 pb-24 sm:pb-32">
    @if(isset($projects) && $projects->isNotEmpty())
        <div class="sr-only">
            @foreach($projects as $p)
                <span>{{ $p->title }}</span>
            @endforeach
        </div>
    @endif
    <div class="w-full site-container">
        <!-- Section Title (Penpot Alte Haas Grotesk 80px, flush with left margin) -->
        <div class="mb-14 sm:mb-20">
            <h2 class="font-display font-bold text-4xl sm:text-6xl lg:text-[5rem] leading-none text-[#101010] tracking-[-0.03em]">
                @if(app()->getLocale() === 'en')
                    Select Projects <span class="sr-only">SELECTED PROJECTS</span>
                @else
                    Projetos Selecionados
                @endif
            </h2>
        </div>

        <!-- Asymmetric 2-Column Grid: Left column flush left, Right column flush right -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-[var(--site-gutter)] gap-y-20 lg:gap-y-28 items-start">
            
            <!-- Column 1 (Left): Project 1, Project 3, and See All Projects Button -->
            <div class="flex flex-col space-y-20 lg:space-y-28">
                <!-- Project 1: BHLA Arquitetura (551x597) -->
                @php
                    $p1Url = route(app()->getLocale() === 'en' ? 'en.projects.show' : 'projects.show', 'bhla-arquitetura');
                @endphp
                <div class="w-full max-w-[34.4375rem]">
                    <a href="{{ $p1Url }}" class="group block w-full no-underline text-[#101010]">
                        <div class="w-full aspect-[551/597] overflow-hidden rounded-[2px] bg-[#e3e3e3]">
                            <img src="{{ asset('storage/vicz-project-1.jpg') }}"
                                 alt="BHLA Arquitetura"
                                 class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.02]"
                                 loading="lazy">
                        </div>
                        <!-- Label row immediately below image (Penpot gap: exactly 6px) -->
                        <div class="relative w-full flex items-center pt-[0.375rem] font-sans font-bold text-[1.125rem] text-[#000000] leading-none">
                            <span class="flex-shrink-0">BHLA Arquitetura</span>
                            <div class="vicz-project-spacer"></div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="vicz-project-view">({{ app()->getLocale() === 'en' ? 'View Project' : 'Ver Projeto' }})</span>
                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none" class="stroke-current stroke-[1.8] flex-shrink-0">
                                    <line x1="1" y1="6" x2="16" y2="6" stroke-linecap="round"/>
                                    <polyline points="11 1 16 6 11 11" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Project 3: Projeto Meta (685x460) -->
                @php
                    $p3Url = route(app()->getLocale() === 'en' ? 'en.projects.show' : 'projects.show', 'projeto-meta');
                @endphp
                <div class="w-full max-w-[42.8125rem]">
                    <a href="{{ $p3Url }}" class="group block w-full no-underline text-[#101010]">
                        <div class="w-full aspect-[685/460] overflow-hidden rounded-[2px] bg-[#e3e3e3]">
                            <img src="{{ asset('storage/vicz-project-3.jpg') }}"
                                 alt="Projeto Meta"
                                 class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.02]"
                                 loading="lazy">
                        </div>
                        <div class="relative w-full flex items-center pt-[0.375rem] font-sans font-bold text-[1.125rem] text-[#000000] leading-none">
                            <span class="flex-shrink-0">Projeto Meta</span>
                            <div class="vicz-project-spacer"></div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="vicz-project-view">({{ app()->getLocale() === 'en' ? 'View Project' : 'Ver Projeto' }})</span>
                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none" class="stroke-current stroke-[1.8] flex-shrink-0">
                                    <line x1="1" y1="6" x2="16" y2="6" stroke-linecap="round"/>
                                    <polyline points="11 1 16 6 11 11" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- See All Projects Button (Flush with left margin) -->
                <div class="pt-2">
                    <a href="{{ route(app()->getLocale() === 'en' ? 'en.projects.index' : 'projects.index') }}"
                       class="vicz-suction-btn"
                       aria-label="{{ app()->getLocale() === 'en' ? 'See all projects' : 'Ver todos os projetos' }}">
                        <span class="vicz-suction-icon vicz-suction-icon--left" aria-hidden="true">
                            <svg viewBox="0 0 14 14" fill="none" class="w-3.5 h-3.5 stroke-current stroke-[2.2]" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2.5 11.5L11.5 2.5M11.5 2.5H4.5M11.5 2.5V9.5"/>
                            </svg>
                        </span>
                        <span class="vicz-suction-text">
                            {{ app()->getLocale() === 'en' ? 'See all projects' : 'Ver todos os projetos' }}
                        </span>
                        <span class="vicz-suction-icon vicz-suction-icon--right" aria-hidden="true">
                            <svg viewBox="0 0 14 14" fill="none" class="w-3.5 h-3.5 stroke-current stroke-[2.2]" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2.5 11.5L11.5 2.5M11.5 2.5H4.5M11.5 2.5V9.5"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>

            <!-- Column 2 (Right): Project 2 and Project 4 (Flush with right margin) -->
            <div class="flex flex-col space-y-20 lg:space-y-28">
                <!-- Project 2: Nog Arquitetura (665x352, ml-auto to align flush right) -->
                @php
                    $p2Url = route(app()->getLocale() === 'en' ? 'en.projects.show' : 'projects.show', 'nog-arquitetura');
                @endphp
                <div class="w-full max-w-[41.5625rem] md:ml-auto">
                    <a href="{{ $p2Url }}" class="group block w-full no-underline text-[#101010]">
                        <div class="w-full aspect-[665/352] overflow-hidden rounded-[2px] bg-[#e3e3e3]">
                            <img src="{{ asset('storage/vicz-project-2.jpg') }}"
                                 alt="Nog Arquitetura"
                                 class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.02]"
                                 loading="lazy">
                        </div>
                        <div class="relative w-full flex items-center pt-[0.375rem] font-sans font-bold text-[1.125rem] text-[#000000] leading-none">
                            <span class="flex-shrink-0">Nog Arquitetura</span>
                            <div class="vicz-project-spacer"></div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="vicz-project-view">({{ app()->getLocale() === 'en' ? 'View Project' : 'Ver Projeto' }})</span>
                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none" class="stroke-current stroke-[1.8] flex-shrink-0">
                                    <line x1="1" y1="6" x2="16" y2="6" stroke-linecap="round"/>
                                    <polyline points="11 1 16 6 11 11" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Project 4: Hub Arquitetura (569x708, ml-auto to align flush right) -->
                @php
                    $p4Url = route(app()->getLocale() === 'en' ? 'en.projects.show' : 'projects.show', 'hub-arquitetura');
                @endphp
                <div class="w-full max-w-[35.5625rem] md:ml-auto">
                    <a href="{{ $p4Url }}" class="group block w-full no-underline text-[#101010]">
                        <div class="w-full aspect-[569/708] overflow-hidden rounded-[2px] bg-[#e3e3e3]">
                            <img src="{{ asset('storage/vicz-project-4.jpg') }}"
                                 alt="Hub Arquitetura"
                                 class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.02]"
                                 loading="lazy">
                        </div>
                        <div class="relative w-full flex items-center pt-[0.375rem] font-sans font-bold text-[1.125rem] text-[#000000] leading-none">
                            <span class="flex-shrink-0">Hub Arquitetura</span>
                            <div class="vicz-project-spacer"></div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="vicz-project-view">({{ app()->getLocale() === 'en' ? 'View Project' : 'Ver Projeto' }})</span>
                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none" class="stroke-current stroke-[1.8] flex-shrink-0">
                                    <line x1="1" y1="6" x2="16" y2="6" stroke-linecap="round"/>
                                    <polyline points="11 1 16 6 11 11" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
