@extends('layouts.app')

@section('content')
    <!-- Projects Page Container: Penpot exact #DDDDD5 stone background, edge-to-edge margins, scroll curtain transition -->
    <section id="todos-projetos" data-bg="light" class="pt-28 sm:pt-36 lg:pt-40 pb-24 sm:pb-32 md:pb-40 lg:pb-[40vh] bg-[#ddddd5] text-[#101010] relative z-10 w-full overflow-hidden">
        
        <!-- Atmospheric Ambient Dim Overlay during CTA reveal scroll (identical to FAQ) -->
        <div class="projects-dim-overlay absolute inset-0 bg-black opacity-0 pointer-events-none z-10"></div>

        <div class="projects-inner-container w-full relative z-0">
            <!-- Full-width container touching viewport margins (clamp 1.5rem to 3.125vw) -->
            <div class="w-full px-4 sm:px-6 lg:px-[clamp(1.5rem,3.125vw,3.5rem)]">

                <!-- Top Header: Title & Description (Penpot y=203) -->
                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4 sm:gap-6 mb-10 sm:mb-14">
                    <div>
                        <h1 class="norra-reveal is-revealed font-display font-bold text-[clamp(2.5rem,4.86vw,4.375rem)] leading-none uppercase tracking-[-0.75px] sm:tracking-[-1.5px] lg:tracking-[-2px] text-[#101010]">
                            {{ __('TODOS OS PROJETOS') }}
                        </h1>
                    </div>
                    <div class="lg:text-right">
                        <p class="font-sans font-normal text-base sm:text-[18px] text-[#808080] leading-[1.2] max-w-[220px]">
                            {!! __('Todos os projetos que<br class="hidden sm:inline"> ajudaram marcas') !!}
                        </p>
                    </div>
                </div>

                <!-- Service Filters & Dynamic Pagination (Penpot y=349) -->
                <div class="flex flex-wrap items-center justify-between gap-4 sm:gap-6 mb-3 sm:mb-4">
                    <!-- Filter Tabs: TeX Gyre Heros Bold 28px, tracking -1px -->
                    <div class="flex flex-wrap items-center gap-5 sm:gap-8 lg:gap-10" id="project-filters">
                        <button type="button"
                                data-filter="all"
                                class="project-filter-btn font-sans font-bold text-xl sm:text-2xl lg:text-[28px] tracking-[-0.25px] sm:tracking-[-0.5px] lg:tracking-[-1px] leading-[1.2] transition-colors cursor-pointer bg-transparent border-none p-0 text-[#101010]"
                                aria-pressed="true">
                            {{ __('Todos') }}
                        </button>
                        <button type="button"
                                data-filter="Website"
                                class="project-filter-btn font-sans font-bold text-xl sm:text-2xl lg:text-[28px] tracking-[-0.25px] sm:tracking-[-0.5px] lg:tracking-[-1px] leading-[1.2] transition-colors cursor-pointer bg-transparent border-none p-0 text-[#808080] hover:text-[#101010]"
                                aria-pressed="false">
                            {{ __('Website') }}
                        </button>
                        <button type="button"
                                data-filter="Aplicativo"
                                class="project-filter-btn font-sans font-bold text-xl sm:text-2xl lg:text-[28px] tracking-[-0.25px] sm:tracking-[-0.5px] lg:tracking-[-1px] leading-[1.2] transition-colors cursor-pointer bg-transparent border-none p-0 text-[#808080] hover:text-[#101010]"
                                aria-pressed="false">
                            {{ __('Aplicativo') }}
                        </button>
                        <button type="button"
                                data-filter="Design 3D"
                                class="project-filter-btn font-sans font-bold text-xl sm:text-2xl lg:text-[28px] tracking-[-0.25px] sm:tracking-[-0.5px] lg:tracking-[-1px] leading-[1.2] transition-colors cursor-pointer bg-transparent border-none p-0 text-[#808080] hover:text-[#101010]"
                                aria-pressed="false">
                            {{ __('Design 3D') }}
                        </button>
                    </div>

                    <!-- Dynamic Pagination indicator (Penpot 1, 2, 3) - Active when > 6 projects -->
                    <div id="projects-pagination" class="flex items-center gap-2 transition-opacity duration-300">
                        <!-- Populated dynamically by JS -->
                    </div>
                </div>

                <!-- Separator Line: Penpot 1px stroke #c7c7c7 (y=397) -->
                <div class="w-full h-[1px] bg-[#c7c7c7] mb-8 sm:mb-12"></div>

                <!-- Projects 2-Column Grid (Penpot 661px x 441px, gap 28px) -->
                <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-2 gap-x-7 gap-y-12 sm:gap-y-14 transition-all duration-300 w-full">
                    @forelse($projects as $project)
                        @php
                            $hasUrl = !empty($project->link_url) && $project->link_url !== '#';
                            $externalUrl = $hasUrl ? $project->link_url : '#';
                            $highlightVideo = $project->highlight_video ?? $project->highlightVideo ?? $project->video_url ?? null;
                            $videoSrc = null;
                            if (!empty($highlightVideo)) {
                                $videoSrc = (str_starts_with($highlightVideo, 'http://') || str_starts_with($highlightVideo, 'https://') || str_starts_with($highlightVideo, '/'))
                                    ? $highlightVideo
                                    : asset('storage/' . $highlightVideo);
                            }
                            $tagsArray = is_array($project->tags) ? $project->tags : (json_decode($project->tags ?? '[]', true) ?: []);
                            $projectModalData = [
                                'title' => $project->title,
                                'client' => $project->client,
                                'year' => $project->year,
                                'category' => $project->category,
                                'short_description' => $project->short_description,
                                'full_description' => $project->full_description,
                                'modal_image_url' => $project->modal_image_url,
                                'modal_video_url' => $project->modal_video_url,
                                'tags' => $tagsArray,
                            ];
                            $isMup3 = in_array(strtolower($project->slug), ['mup3', 'mup-3'], true);
                            $mup3Url = route(app()->getLocale() === 'en' ? 'en.projects.mup3' : 'projects.mup3');
                        @endphp

                        <article class="project-grid-card group flex flex-col transition-all duration-400 ease-out"
                                 data-tags='@json($tagsArray)'
                                 data-category="{{ $project->category }}"
                                 data-title="{{ $project->title }}">
                            
                            <!-- Project Media Box: No hover zoom, rounded-[4px], bg-[#b1b2b5], aspect 661/441 (~1.5) -->
                            <div class="w-full aspect-[661/441] overflow-hidden rounded-[4px] bg-[#b1b2b5] relative block cursor-pointer shadow-sm">
                                @if($isMup3)
                                    <a href="{{ $mup3Url }}"
                                       class="block w-full h-full text-inherit"
                                       aria-label="Ver projeto {{ $project->title }}">
                                @elseif($hasUrl)
                                    <a href="{{ $project->link_url }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="block w-full h-full text-inherit"
                                       aria-label="Ver projeto {{ $project->title }}">
                                @else
                                    <div role="button"
                                         tabindex="0"
                                         class="block w-full h-full text-inherit cursor-pointer select-none focus:outline-none"
                                         data-project-modal-trigger
                                         data-project="{{ json_encode($projectModalData) }}"
                                         aria-label="Ver projeto {{ $project->title }}">
                                @endif
                                    
                                    @if(!empty($project->cover_image))
                                        <img src="{{ $project->cover_image_url }}"
                                             alt="{{ $project->title }}"
                                             class="project-card-image w-full h-full object-cover"
                                             loading="lazy">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-[#b1b2b5] text-[#101010]/30 font-sans font-bold text-2xl">
                                             {{ $project->title }}
                                        </div>
                                    @endif

                                    @if($videoSrc)
                                        <video class="project-highlight-video absolute inset-0 w-full h-full object-cover opacity-0 pointer-events-none transition-opacity duration-300 rounded-[4px]"
                                               muted
                                               playsinline
                                               loop
                                               preload="metadata">
                                            <source src="{{ $videoSrc }}">
                                        </video>
                                    @endif

                                @if($isMup3 || $hasUrl)
                                    </a>
                                @else
                                    </div>
                                @endif
                            </div>

                            <!-- Project Information (Penpot y=870, y=911, y=969) -->
                            <div class="pt-3 sm:pt-4 flex flex-col space-y-2">
                                <!-- Title: TeX Gyre Heros Bold 28px #101010 -->
                                <h2 class="font-sans font-bold text-2xl sm:text-[28px] text-[#101010] tracking-[-0.5px] sm:tracking-[-0.75px] md:tracking-[-1px] leading-[1.2]">
                                    @if($isMup3)
                                        <a href="{{ $mup3Url }}"
                                           class="hover:text-[var(--color-norra-red)] transition-colors">
                                            {{ $project->title }}
                                        </a>
                                    @elseif($hasUrl)
                                        <a href="{{ $project->link_url }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="hover:text-[var(--color-norra-red)] transition-colors">
                                            {{ $project->title }}
                                        </a>
                                    @else
                                        <button type="button"
                                                class="hover:text-[var(--color-norra-red)] transition-colors text-left cursor-pointer font-sans font-bold text-2xl sm:text-[28px] tracking-[-0.5px] sm:tracking-[-0.75px] md:tracking-[-1px] leading-[1.2] p-0 bg-transparent border-0"
                                                data-project-modal-trigger
                                                data-project="{{ json_encode($projectModalData) }}">
                                            {{ $project->title }}
                                        </button>
                                    @endif
                                </h2>

                                <!-- Auxiliary text / Short description: TeX Gyre Heros 400 18px #101010 -->
                                @if(!empty($project->short_description))
                                    <p class="font-sans font-normal text-sm sm:text-base lg:text-[18px] text-[#101010] tracking-normal sm:tracking-[-0.25px] md:tracking-[-0.5px] lg:tracking-[-1px] leading-[1.2] max-w-[440px]">
                                        {{ $project->short_description }}
                                    </p>
                                @endif

                                <!-- Tags: TeX Gyre Heros Bold 12px #101010 in bg-[#c8c8c8] badges (Penpot y=969) -->
                                @if(!empty($tagsArray))
                                    <div class="flex flex-wrap items-center gap-2 pt-1.5">
                                        @foreach($tagsArray as $tag)
                                             <span class="inline-flex items-center px-2 py-0.5 rounded-[2px] bg-[#c8c8c8] text-[#101010] font-sans font-bold text-[12px] tracking-normal sm:tracking-[-0.2px] md:tracking-[-0.5px] leading-tight">
                                                 {{ __($tag) }}
                                             </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-16 text-center text-[#808080]">
                            <p class="font-sans text-xl">{{ __('Nenhum projeto cadastrado no momento.') }}</p>
                        </div>
                    @endforelse
                </div>

                <!-- Empty State for Filters -->
                <div id="no-projects-found" class="hidden py-20 text-center text-[#808080]">
                    <p class="font-sans text-xl font-bold text-[#101010] mb-2">{{ __('Nenhum projeto encontrado nesta categoria.') }}</p>
                    <button type="button"
                            id="reset-project-filter-btn"
                            onclick="window.resetProjectFilter && window.resetProjectFilter()"
                            class="text-sm font-sans font-bold uppercase tracking-wider text-[var(--color-norra-red)] hover:underline cursor-pointer">
                        {{ __('Ver todos os projetos') }}
                    </button>
                </div>

            </div>
        </div>
    </section>

    <!-- 07 CTA Final & Contact Section (Penpot exact reused component) -->
    @include('sections.cta-contact')
@endsection
