<section id="expertise" class="py-24 sm:py-32 md:py-40 bg-[#101010] text-[#ddddd5] relative border-t border-white/10 w-full">
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)]">

        <!-- Section Header: Penpot EXPERTISE 78px - Aligned with Service Titles -->
        <div class="mb-12 sm:mb-16 px-4 sm:px-8">
            <h2 class="norra-reveal font-display font-bold text-[clamp(2.5rem,5.5vw,4.875rem)] leading-none uppercase tracking-tight text-[#ddddd5]">
                EXPERTISE
            </h2>
        </div>

        <!-- Services List (All start 100% closed for authentic experience) -->
        <div class="services-list relative w-full">
            <!-- Top Delimiter Line with entrance animation from left to right -->
            <div class="service-line w-full" aria-hidden="true"></div>

            @foreach($services as $index => $service)
                <div class="service-item relative rounded-[4px] py-6 sm:py-7 px-4 sm:px-8 cursor-pointer transition-all duration-500 ease-out overflow-hidden group"
                     onclick="toggleServiceAccordion(this)">

                    <!-- Expanding Luminous Radial Gradient Background on Hover & Active -->
                    <div class="service-bg absolute inset-0 pointer-events-none rounded-[4px]"
                         style="background: radial-gradient(circle at 50% 50%, #f7f7f2 0%, #eaeae4 100%);"></div>

                    <!-- Row Content relative on top of bg -->
                    <div class="relative z-10 w-full">
                        <!-- Row Header -->
                        <div class="flex items-center justify-between gap-6">
                            <!-- Left: Title -->
                            <div class="service-title-wrap min-w-0 flex-1">
                                <span class="service-title block font-sans font-bold tracking-[-4px] text-[clamp(1.75rem,4.2vw,4.375rem)] leading-tight">
                                    {{ $service->title }}
                                </span>
                            </div>

                            <!-- Right: Category Tag + Short Minimalist Arrow (↗ rotates to ↘) -->
                            <div class="flex items-center gap-6 sm:gap-10 flex-shrink-0">
                                <span class="service-category hidden md:inline-block font-sans text-xs uppercase tracking-widest text-[#888888] font-normal transition-colors duration-500">
                                    {{ $service->category ?? 'Interface e experiência' }}
                                </span>

                                <!-- Short Minimalist Arrow with rounded caps (↗ in closed state, rotates to ↘ when opened) -->
                                <div class="service-arrow-wrap flex items-center justify-center w-8 h-8 flex-shrink-0">
                                    <svg class="service-arrow-icon w-5 h-5 sm:w-6 sm:sm-6 transform origin-center"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="2.2"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="13 6 19 12 13 18"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Expandable Body with CSS Grid transition (0 residual space when collapsed) -->
                        <div class="service-accordion-grid">
                            <div class="overflow-hidden">
                                <!-- Aligned Expandable Content -->
                                <div class="service-accordion-content pt-5 sm:pt-6 space-y-6 sm:space-y-7 min-w-0">
                                    <!-- Description (Framer-Motion RevealParagraph replica) -->
                                    @php
                                        $descWords = preg_split('/\s+/', trim($service->description ?? ''));
                                    @endphp
                                    <p class="service-desc font-sans text-base sm:text-lg lg:text-[1.375rem] text-[#888888] leading-relaxed font-normal max-w-3xl flex flex-wrap transition-colors duration-500">
                                        @foreach($descWords as $wIdx => $word)
                                            <span class="inline-block overflow-hidden mr-[0.3em] px-[0.03em] pb-1">
                                                <span class="reveal-word inline-block"
                                                      style="transition-delay: {{ 80 + ($wIdx * 15) }}ms;">
                                                    {{ $word }}
                                                </span>
                                            </span>
                                        @endforeach
                                    </p>

                                    <!-- Bottom Row: Deliverables Chips on Left, FALE CONOSCO Pill CTA on Right -->
                                    <div class="service-bottom-row flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-2">
                                        <!-- Deliverables Chips -->
                                        @if(!empty($service->deliverables) && is_array($service->deliverables))
                                            <div class="flex flex-wrap items-center gap-2">
                                                @foreach($service->deliverables as $deliverable)
                                                    <span class="service-chip px-3.5 py-1.5 rounded-[4px] text-xs font-normal border-0 text-[#ffffff] transition-all duration-500">
                                                        {{ $deliverable }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <div></div>
                                        @endif

                                        <!-- FALE CONOSCO Button with bottom-center ink fill -->
                                        <div class="flex-shrink-0">
                                            <a href="#contato"
                                               onclick="event.stopPropagation();"
                                               class="service-cta-btn relative overflow-hidden inline-flex items-center justify-center px-6 py-2.5 rounded-[4px] border-[1.5px] text-[11px] sm:text-xs font-medium uppercase tracking-widest transition-all duration-300">
                                                <span class="service-cta-ink" aria-hidden="true"></span>
                                                <span class="service-cta-text relative z-10 transition-colors duration-300">FALE CONOSCO</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Delimiter Line of this service card -->
                    <div class="service-line absolute bottom-0 left-0 right-0" aria-hidden="true"></div>
                </div>
            @endforeach
        </div>

    </div>
</section>

<script>
function toggleServiceAccordion(element) {
    const isOpen = element.classList.contains('is-active');

    // Close all items
    document.querySelectorAll('.service-item').forEach(item => {
        item.classList.remove('is-active');
    });

    // Toggle clicked item if it was closed
    if (!isOpen) {
        element.classList.add('is-active');
    }
}
</script>


