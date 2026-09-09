<section id="expertise" class="py-24 sm:py-32 md:py-40 bg-[#101010] text-[#ddddd5] relative border-t border-white/10 w-full">
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)]">
        
        <!-- Section Header: Penpot EXPERTISE 78px -->
        <div class="mb-14 sm:mb-20">
            <h2 class="norra-reveal font-display font-bold text-[clamp(2.5rem,5.5vw,4.875rem)] leading-none uppercase tracking-tight text-[#ddddd5]">
                EXPERTISE
            </h2>
        </div>

        <!-- Services List -->
        <div class="border-t border-white/20 divide-y divide-white/20">
            @foreach($services as $index => $service)
                <div class="service-item group py-8 sm:py-12 cursor-pointer transition-all duration-400 {{ $index === 0 ? 'is-active' : '' }}"
                     onclick="toggleServiceAccordion(this)">
                    
                    <!-- Row Header -->
                    <div class="flex items-center justify-between gap-6">
                        <!-- Left: Number + Title -->
                        <div class="flex items-baseline gap-6 sm:gap-12 lg:gap-16 flex-1 min-w-0">
                            <span class="service-number font-sans text-xl sm:text-2xl lg:text-3xl text-[#777777] font-normal tracking-tight flex-shrink-0 transition-colors">
                                {{ str_pad($service->order_num ?? ($index + 1), 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <h3 class="service-title font-sans font-normal text-[clamp(1.75rem,4.2vw,4.375rem)] leading-tight text-[#ddddd5] transition-colors truncate">
                                {{ $service->title }}
                            </h3>
                        </div>

                        <!-- Right: Category Tag + 40px Circular Plus Button -->
                        <div class="flex items-center gap-6 sm:gap-10 flex-shrink-0">
                            <span class="service-category hidden md:inline-block font-sans text-xs uppercase tracking-widest text-[#888888] font-normal transition-colors">
                                {{ $service->category ?? 'Interface e experiência' }}
                            </span>

                            <!-- Penpot 40x40 circle button -->
                            <button type="button"
                                    aria-label="Expandir detalhes do serviço {{ $service->title }}"
                                    class="service-chevron w-10 h-10 rounded-full border border-white/25 flex items-center justify-center text-[#ddddd5] transition-all duration-300 focus:outline-none">
                                <svg class="w-4 h-4 transform transition-transform duration-300 {{ $index === 0 ? 'rotate-45' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Expandable Body (Initially open on first item, closed on others) -->
                    <div class="service-body overflow-hidden transition-all duration-500 ease-in-out {{ $index === 0 ? 'max-h-96 opacity-100 mt-6' : 'max-h-0 opacity-0' }}">
                        <div class="pl-12 sm:pl-20 lg:pl-28 pr-4 space-y-6 max-w-4xl">
                            <p class="service-desc font-sans text-base sm:text-lg text-[#999999] leading-relaxed font-normal transition-colors">
                                {{ $service->description }}
                            </p>

                            @if(!empty($service->deliverables) && is_array($service->deliverables))
                                <div class="space-y-2 pt-2">
                                    <p class="service-tag text-xs uppercase tracking-widest text-[#777777] font-semibold transition-colors">Entregáveis & Tecnologias:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($service->deliverables as $deliverable)
                                            <span class="service-chip px-3.5 py-1.5 rounded-full text-xs font-normal bg-white/5 border border-white/10 text-[#ddddd5] transition-colors">
                                                {{ $deliverable }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="pt-2">
                                <a href="#contato" class="service-link inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#b70606] transition-colors">
                                    <span>Solicitar proposta para este serviço</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                                </a>
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
    const body = element.querySelector('.service-body');
    const chevron = element.querySelector('.service-chevron svg');
    const isOpen = element.classList.contains('is-active');

    // Close all siblings
    document.querySelectorAll('.service-item').forEach(item => {
        item.classList.remove('is-active');
        const b = item.querySelector('.service-body');
        const c = item.querySelector('.service-chevron svg');
        if (b && c) {
            b.classList.remove('opacity-100');
            b.classList.add('max-h-0', 'opacity-0');
            b.classList.remove('max-h-96', 'mt-6');
            c.style.transform = 'rotate(0deg)';
        }
    });

    // Toggle current
    if (!isOpen) {
        element.classList.add('is-active');
        body.classList.remove('max-h-0', 'opacity-0');
        body.classList.add('max-h-96', 'opacity-100', 'mt-6');
        chevron.style.transform = 'rotate(45deg)';
    }
}
</script>


