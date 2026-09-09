<section id="expertise" class="py-24 sm:py-32 md:py-40 bg-[#101010] text-[#ddddd5] relative border-t border-white/10 w-full">
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)]">
        
        <!-- Section Header: Penpot EXPERTISE 78px -->
        <div class="mb-14 sm:mb-20">
            <h2 class="norra-reveal font-display font-bold text-[clamp(2.5rem,5.5vw,4.875rem)] leading-none uppercase tracking-tight text-[#ddddd5]">
                EXPERTISE
            </h2>
        </div>

        <!-- Services List (All start 100% closed for authentic experience) -->
        <div class="border-t border-white/20 divide-y divide-white/20">
            @foreach($services as $index => $service)
                <div class="service-item relative rounded-[4px] py-8 sm:py-10 px-4 sm:px-8 cursor-pointer transition-all duration-700 ease-out overflow-hidden group"
                     onclick="toggleServiceAccordion(this)">
                    
                    <!-- Expanding Luminous Radial Gradient Background on Active -->
                    <div class="service-bg absolute inset-0 opacity-0 pointer-events-none transition-opacity duration-700 ease-out rounded-[4px]"
                         style="background: radial-gradient(circle at 50% 50%, #f7f7f2 0%, #eaeae4 100%);"></div>

                    <!-- Row Content relative on top of bg -->
                    <div class="relative z-10 w-full">
                        <!-- Row Header -->
                        <div class="flex items-center justify-between gap-6">
                            <!-- Left: Number + Title with SwapText Roll-up -->
                            <div class="flex items-baseline gap-6 sm:gap-12 lg:gap-16 flex-1 min-w-0">
                                <span class="service-number font-sans text-xl sm:text-2xl lg:text-3xl text-[#777777] font-normal tracking-tight flex-shrink-0 transition-colors duration-500">
                                    {{ str_pad($service->order_num ?? ($index + 1), 2, '0', STR_PAD_LEFT) }}
                                </span>
                                
                                <!-- Roll-up Title (SwapText) -->
                                <div class="service-title-wrap relative overflow-hidden py-1 min-w-0 flex-1">
                                    <span class="service-title-default block font-sans font-normal text-[clamp(1.75rem,4.2vw,4.375rem)] leading-tight text-[#ddddd5] truncate">
                                        {{ $service->title }}
                                    </span>
                                    <span class="service-title-active absolute inset-0 block font-sans font-normal text-[clamp(1.75rem,4.2vw,4.375rem)] leading-tight text-[#101010] truncate" aria-hidden="true">
                                        {{ $service->title }}
                                    </span>
                                </div>
                            </div>

                            <!-- Right: Category Tag + 40px Circular Plus/Close Button -->
                            <div class="flex items-center gap-6 sm:gap-10 flex-shrink-0">
                                <span class="service-category hidden md:inline-block font-sans text-xs uppercase tracking-widest text-[#888888] font-normal transition-colors duration-500">
                                    {{ $service->category ?? 'Interface e experiência' }}
                                </span>

                                <!-- Penpot 40x40 circle button with 135deg rotation to '×' -->
                                <button type="button"
                                        aria-label="Expandir detalhes do serviço {{ $service->title }}"
                                        class="service-chevron w-10 h-10 rounded-full border border-white/25 flex items-center justify-center text-[#ddddd5] transition-all duration-500 focus:outline-none">
                                    <svg class="w-4 h-4 transform transition-transform duration-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Expandable Body with Word-by-Word RevealParagraph -->
                        <div class="service-body max-h-0 opacity-0 overflow-hidden transition-all duration-700 ease-[cubic-bezier(0.32,0.72,0,1)]">
                            <div class="pl-12 sm:pl-20 lg:pl-24 pr-4 pt-6 space-y-6 max-w-4xl">
                                @php
                                    $descWords = explode(' ', $service->description ?? '');
                                @endphp
                                <p class="service-desc font-sans text-base sm:text-xl text-[#555555] leading-relaxed font-normal flex flex-wrap">
                                    @foreach($descWords as $wIdx => $w)
                                        <span class="inline-block overflow-hidden mr-[0.3em] pb-1">
                                            <span class="reveal-word inline-block"
                                                  style="transition-delay: {{ 80 + ($wIdx * 16) }}ms;">
                                                {{ $w }}
                                            </span>
                                        </span>
                                    @endforeach
                                </p>

                                @if(!empty($service->deliverables) && is_array($service->deliverables))
                                    <div class="space-y-2 pt-2">
                                        <p class="service-tag text-xs uppercase tracking-widest text-[#777777] font-semibold transition-colors duration-500">
                                            Entregáveis & Tecnologias:
                                        </p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($service->deliverables as $deliverable)
                                                <span class="service-chip px-3.5 py-1.5 rounded-full text-xs font-normal bg-white/5 border border-white/10 text-[#ddddd5] transition-colors duration-500">
                                                    {{ $deliverable }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="pt-2">
                                    <a href="#contato" class="service-link inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#e33702] hover:text-[#b70606] transition-colors">
                                        <span>Solicitar proposta para este serviço</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>

<script>
function toggleServiceAccordion(element) {
    const isOpen = element.classList.contains('is-active');

    // Close all other items
    document.querySelectorAll('.service-item').forEach(item => {
        item.classList.remove('is-active');
        const body = item.querySelector('.service-body');
        if (body) {
            body.classList.remove('opacity-100', 'mt-6', 'pb-6');
            body.classList.add('max-h-0', 'opacity-0');
        }
    });

    // Toggle selected item
    if (!isOpen) {
        element.classList.add('is-active');
        const body = element.querySelector('.service-body');
        if (body) {
            body.classList.remove('max-h-0', 'opacity-0');
            body.classList.add('max-h-[800px]', 'opacity-100', 'mt-6', 'pb-6');
        }
    }
}
</script>


