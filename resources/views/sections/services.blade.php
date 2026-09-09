<section id="expertise" class="py-24 md:py-36 bg-[#101010] text-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="space-y-3 max-w-2xl mb-16">
            <div class="inline-flex items-center gap-2 text-xs uppercase tracking-widest text-[#b70606] font-bold">
                <span class="w-1.5 h-1.5 rounded-full bg-[#b70606]"></span>
                <span>O Que Fazemos</span>
            </div>
            <h2 class="font-display font-extrabold text-[clamp(2rem,4.5vw,3.75rem)] leading-none tracking-tight text-white uppercase">
                Expertise
            </h2>
            <p class="text-sm sm:text-base text-[#888888] leading-relaxed font-normal">
                Soluções digitais completas para marcas que precisam unir estética autoral, estratégia de negócio e engenharia de alta performance.
            </p>
        </div>

        <!-- Services Accordion List -->
        <div class="divide-y divide-white/10 border-t border-b border-white/10">
            @foreach($services as $index => $service)
                <div class="service-item group py-8 cursor-pointer transition-colors duration-300 hover:bg-white/[0.02]"
                     onclick="toggleServiceAccordion(this)">
                    <!-- Header Bar -->
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-6 sm:gap-10">
                            <span class="font-display font-bold text-xl sm:text-2xl text-[#b70606] tracking-tight">
                                {{ $service->order_num }}
                            </span>
                            <div>
                                <h3 class="font-display font-bold text-2xl sm:text-3xl lg:text-4xl text-white group-hover:text-[#ddddd5] transition-colors">
                                    {{ $service->title }}
                                </h3>
                                <span class="text-xs uppercase tracking-wider text-[#888888] font-medium block sm:inline mt-1 sm:mt-0 sm:ml-4">
                                    {{ $service->category }}
                                </span>
                            </div>
                        </div>

                        <!-- Toggle Chevron / Indicator -->
                        <div class="service-chevron w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-white/60 group-hover:text-white group-hover:border-white/30 transition-transform duration-300">
                            <svg class="w-4 h-4 transform transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                    </div>

                    <!-- Expandable Body (Initially open on first item, closed on others) -->
                    <div class="service-body overflow-hidden transition-all duration-400 ease-in-out {{ $index === 0 ? 'max-h-96 opacity-100 mt-6' : 'max-h-0 opacity-0' }}">
                        <div class="pl-12 sm:pl-16 pr-4 space-y-6 max-w-4xl">
                            <p class="text-sm sm:text-base text-[#aaaaaa] leading-relaxed font-normal">
                                {{ $service->description }}
                            </p>

                            <!-- Deliverables Chips -->
                            @if(is_array($service->deliverables))
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-wider text-[#888888] font-semibold">Entregáveis & Tecnologias:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($service->deliverables as $deliverable)
                                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-[#151515] border border-white/10 text-[#ddddd5]">
                                                {{ $deliverable }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="pt-2">
                                <a href="#contato" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#b70606] hover:text-white transition-colors">
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
    const isOpen = body.classList.contains('opacity-100');

    // Close all siblings
    document.querySelectorAll('.service-item').forEach(item => {
        const b = item.querySelector('.service-body');
        const c = item.querySelector('.service-chevron svg');
        b.classList.remove('opacity-100');
        b.classList.add('max-h-0', 'opacity-0');
        b.classList.remove('max-h-96', 'mt-6');
        c.style.transform = 'rotate(0deg)';
    });

    // Toggle current
    if (!isOpen) {
        body.classList.remove('max-h-0', 'opacity-0');
        body.classList.add('max-h-96', 'opacity-100', 'mt-6');
        chevron.style.transform = 'rotate(45deg)';
    }
}
</script>
